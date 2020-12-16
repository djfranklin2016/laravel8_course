<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

// a Global Scope for Logged-In Admins to also view (soft) deleted Posts
// NOTE: this global scope then has to be registered in the BlogPost Model's boot() section
class DeletedAdminScope implements Scope {

    public function apply(Builder $builder, Model $model) {

        if (Auth::check() && Auth::user()->is_admin) {
            // $builder->withTrashed();
            $builder->withoutGlobalScope('Illuminate\Database\Eloquent\SoftDeletingScope');
        }
    }   // instead of using withTrashed you can also Remove SoftDelete global scope just for this specific query - same effect
}
