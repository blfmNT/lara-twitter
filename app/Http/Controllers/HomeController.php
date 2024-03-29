<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tweet;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tweets = Tweet::orderBy('created_at', 'DESC')->get();

        $tweet_ids = $tweets->pluck('id');

        dd($tweet_ids);

        return Inertia::render('Home', [
            'tweets' => $tweets->load(['user']),//reactions
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
