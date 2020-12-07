<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [         // BEST used for Resources, Controllers and Models
        
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()      // Best used for indiviaul items not covered by the above
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user) {
            return $user->is_admin;
        });

        // Gate::define('update-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });

        // Gate::define('delete-post', function($user, $post) {
        //     return $user->id == $post->user_id;
        // });  // SEE BELOW:-

        // Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
        // Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');


        // te 'resource' is now registered ABOVE as an entire class!
        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        // gives posts.create, posts.view, posts.update, posts.delete automatically

        Gate::before(function ($user, $ability) {       // this will ALWAYS run BEFORE any other Gate
            if ($user->is_admin && in_array($ability, ['update'])) {   // with the ability to Override a standrad Gate

        //     // if ($user->is_admin && in_array($ability, ['update-post', 'delete-post'])) {     // with the ability to Override a standrad Gate
            return true;                                // so here will aways return True (ie Admin Override)
            }                                           // and standard Gate will not even run
        });

        // Gate::after() is immediatelt After standard Gate heck and accepts the $reult of the gate check
        // and allows an opportunity to override the result - same as Gate::before but executed After Gate check
        // Gate::after(function($user, $ability, $result) {
        //     if($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
