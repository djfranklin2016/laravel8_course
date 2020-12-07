<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    // Foreign Key fix

// use Illuminate\Support\Facades\DB; // seee Query Test below!

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
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
        return view(
            'posts.index',
            ['posts' => BlogPost::withCount('comments')->get()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        
        $validated = $request->validated();

        $post = new BlogPost();
        $post->title = $validated['title'];
        $post->content = $validated['content'];

        $post->user_id = Auth::user()->id;

        $post->save();
        // OR:-

        // $post['user_id'] = Auth::user()->id;
        // die(echo "$post->user_id" );
        
        //die(echo $post['user_id'] = Auth::user()->id;
        
        // dd($request);

        // $post = BlogPost::create($validated);
        
        $request->session()->flash('status', 'The Blog Post was Created!');

        return redirect()->route('posts.show', ['post' => $post->id]);
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

        return view('posts.show', [
            'post' => BlogPost::with('comments')->findOrFail($id)
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
        return view('posts.edit', ['post' => BlogPost::findOrFail($id)]);
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

        $post->delete();

        session()->flash('status', 'The Blog Post was Deleted!');

        return redirect()->route('posts.index');
    }
}
