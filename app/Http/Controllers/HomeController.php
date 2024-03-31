<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tweet;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tweets = Tweet::with(['user', 'like'])
            ->orderBy('id', 'DESC')
            ->paginate(12);

        $tweet_ids = $tweets->pluck('id');

        //сделать выборку лайков из твитов

        return Inertia::render('Home', [
            'tweets' => $tweets,//reactions
//            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
//            'status' => session('status'),
        ]);
    }
}
