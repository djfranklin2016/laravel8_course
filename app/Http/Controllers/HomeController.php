<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function home() {

        // dd(Auth::id());
        // dd(Auth::user());
        // dd(Auth::check());

        if(Auth::check()) {

            $user = User::find(Auth::user()->id);

            return view('home.index', $user);

        } else {
            
            return view('home.index');
        }

        // return view('home.index');
    }

    public function contact() {
        return view('home.contact');
    }

    public function secret() {
        return view('home.secret');
    }

}
