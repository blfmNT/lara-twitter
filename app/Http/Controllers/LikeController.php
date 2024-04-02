<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeStoreRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Tweet;

class LikeController extends Controller
{
    public function store(LikeStoreRequest $request): RedirectResponse
    {
        $vdata = $request->validated();
        $user = $request->user();
        $tweet = Tweet::findOrFail($vdata['tweet_id']);

        $exists = $tweet->likes()->where('user_id', $user->id)->exists();

        if ($exists)
            $tweet->likes()->delete($user->id);
        else
            $tweet->likes()->create(['user_id' => $user->id]);

        return redirect()->back()->with('message', $exists ? false : true);
    }
}
