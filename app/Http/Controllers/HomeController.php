<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tweet;
use App\Models\Like;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        //show tweets of following users instead
//        whereHas('likes', function($query) use ($user) {
//            $query->where('user_id', $user->id);
//        })
        $tweets = Tweet::with(['user'])
            ->orderBy('id', 'DESC')
            ->paginate(12);

        $likes = Like::select('tweet_id')->where('user_id', $user->id)->get();

        $likes = array_column($likes->toArray(), 'tweet_id');

        //render likes and check in front or merge in tweets collection

        return Inertia::render('Home', [
            'tweets' => $tweets,//reactions
            'likes' => $likes,
//            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
//            'status' => session('status'),
        ]);
    }
}
