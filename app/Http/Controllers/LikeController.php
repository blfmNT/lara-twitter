<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(LikeStoreRequest $request): RedirectResponse
    {
        $vdata = $request->validated();
        $user = $request->user();

        $like = Like::where('liked_by', $user->id)
            ->where('tweet_id', $vdata['tweet_id'])
            ->first();

        if ($like)
        {
            $like->delete();
            return redirect()->back()->with('message', 'disliked');

        }
        else
        {
            Like::create([
                'liked_by' => $user->id,
                'tweet_id' => $vdata['tweet_id'],
            ]);
            return redirect()->back()->with('message', 'liked');
        }
    }


}
