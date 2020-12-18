<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    // Foreign Key fix
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;    // ref AuhServiceProvider - Gate definitions

// use Illuminate\Support\Facades\DB; // seee Query Test below!

// if Controllers and Policies are created using "resource" command then Laravel will be really clever
// and associate the following Controller functions to their related Authorisations in the class's
// Authoisation Policy (controller function PostsController => authorisations policy BlogPostPolicy)
// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete'
// ]

class PostsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')
        //     ->only(['create', 'store', 'edit', 'update', 'destroy', 'show']);

        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);   // ie Allow Show Individual Blog Posts

        // $this->middleware('auth');  // Protect ALL class actions

    }

    // private $posts = [
    //     1 => [
    //         'title' => 'Intro to Laravel',
    //         'content' => 'This is a short intro to Laravel',
    //         'is_new' => true,
    //         'has_comments' => true
    //     ],
    //     2 => [
    //         'title' => 'Intro to PHP',
    //         'content' => 'This is a short intro to PHP',
    //         'is_new' => false
    //     ],
    //     3 => [
    //         'title' => 'Intro to My Yacht Stuff',
    //         'content' => 'This is a short intro to My Yacht Stuff',
    //         'is_new' => true,
    //         'has_comments' => true
    //     ]
    // ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // --------------------------------------------------------------
        // Test routine to show difference between Eager and Lazy loading
        // reference No. of DB queries made and total time taken !
        
        // DB::connection()->enableQueryLog();

        // $posts = BlogPost::all();    // Lazy Loading - get all Posts - then iterate through for comments

        // $posts = BlogPost::with('comments')->get(); // Eager Loading - get all Posts WITH comments at same time

        // foreach($posts as $post) {

        //     foreach($post->comments as $comment) {
        //        echo $comment->content;
        //    }
        // }

        // dd(DB::getQueryLog()); // dd = Dump & Die!
        // -----------------------------------------------------------------
        
        // return view('posts.index', ['posts' => $this->posts]);
        
        // REMEMBER to include BlogPost class at TOP !
        
        // return view('posts.index', ['posts' => BlogPost::all()]);
        
        // return view('posts.index', ['posts' => BlogPost::all()]);
        
        // return view('posts.index', ['posts' => BlogPost::orderBy('created_at', 'desc')->take(5)->get()]);

        // posts index with comments_count values
        // return view('posts.index', ['posts' => BlogPost::withCount('comments')->orderBy('created_at', 'desc')->get()]);

        // CACHE
        // $mostCommented = Cache::tags(['blog-post'])->remember('blog-post-most-commented', now()->addSeconds(10), function () {
        //     return BlogPost::mostCommented()->take(5)->get();
        // });             // now part of ViewComposer - Activity Composer

        // $mostActive = Cache::remember('users-most-active', 60, function () {
        //     return User::withMostBlogPosts()->take(5)->get();
        // });            // now part of ViewComposer - Activity Composer

        // $mostActiveLastMonth = Cache::remember('users-most-active-last-month', 60, function () {
        //     return User::withMostBlogPostsLastMonth()->take(5)->get();
        // });            // now part of ViewComposer - Activity Composer


        return view('posts.index', [
            // 'posts' => BlogPost::latest()->withCount('comments')->with('user')->with('tags')->get(),

            'posts' => BlogPost::LatestWithRelations()->get(),
            
            // 'mostCommented' => $mostCommented,
            // 'mostActive' => $mostActive,
            // 'mostActiveLastMonth' => $mostActiveLastMonth,
            // now part of ViewComposer - Activity Composer
            ]     // now with LOCAL SCOPE Latest() & MostCommented()- see BlogPost Model
        );
            // ->orderBy('created_at', 'desc') is now in LatestScope as default behaviou for BlogPosts
            // see Scopes/LatestScope and also Blogpost boot()
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('posts.create');   // see notes in BlogPostPolicy create function
        
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        // dd($request);
        
        // $validated = $request->validated();

        // $post = new BlogPost();
        // $post->title = $validated['title'];
        // $post->content = $validated['content'];

        // $post->user_id = Auth::user()->id;      // Foreign Key fix

        // $post->save();
        // OR:-


        // $post['user_id'] = Auth::user()->id;
        // die(echo "$post->user_id" );
        
        //die(echo $post['user_id'] = Auth::user()->id;
        
        // dd($request);

        // $post = BlogPost::create($validated);
        
        $validated = $request->validated();

        $validated['user_id'] = $request->user()->id;

        $blogPost = BlogPost::create($validated);

        $request->session()->flash('status', 'The Blog Post was Created!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);

        // return view('posts.show', ['post' => $this->posts[$id]]);

        // return view('posts.show', [
        //     'post' => BlogPost::with('comments')->findOrFail($id)
        //     ]);
        
        // return view('posts.show', [
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id)
        // ]);

        // Above "latest()" now part of the relationship definition in BlogPost model
        
        // $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use($id) {
        //     return BlogPost::with('comments')
        //         ->with('tags')
        //         ->with('user')
        //         ->with('comments.user')    // nested relationship - get user info relating to each comment
        //         ->findOrFail($id);
        
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use($id) {
            return BlogPost::with('comments', 'tags', 'user', 'comments.user')
                ->findOrFail($id);
        });


        // Page Visitors Counter System
        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach($users as $session => $lastVisit) {
            if($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >=1) {
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;

        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);

        if(!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);
        
        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {        // ref AuhServiceProvider - Gate definitions
        //     abort(403, "You can't edit this post!");
        // }; // OR :-

        // $this->authorize('posts.update', $post);     // sorter code than the above Gate::
        // Now used as - below - see AuthServiceProvider protected $policies which registers a Class to it's Policy
        
        // $this->authorize('update', $post);     // sorter code than the above Gate::

        $this->authorize($post);     // will automtically lookup BlogPostPolicy 'update' policy - see Top Notes

        return view('posts.edit', ['post' => $post]);

        // return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {        // ref AuhServiceProvider - Gate definitions
        //     abort(403, "You can't edit this post!");
        // };   // OR:-

        // $this->authorize('update', $post);

        $this->authorize($post);    // will automtically lookup BlogPostPolicy 'update' policy - see Top Notes

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        $request->session()->flash('status', 'The Blog Post was Updated!');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)    // no $equest passed in this method
    {
        // dd($id);
        
        $post = BlogPost::findOrFail($id);
        
        // if (Gate::denies('delete-post', $post)) {        // ref AuhServiceProvider - Gate definitions
        //     abort(403, "You can't delete this post!");
        // };   // OR:-

        // $this->authorize('delete', $post);
        
        $this->authorize($post);    // will automtically lookup BlogPostPolicy 'delete' policy - see Top Notes

        $post->delete();

        session()->flash('status', 'The Blog Post was Deleted!');

        return redirect()->route('posts.index');
    }
}
