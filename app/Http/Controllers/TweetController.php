<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetPostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Tweet;
use Inertia\Inertia;

class TweetController extends Controller
{

    public function index(): RedirectResponse
    {
        return redirect();
    }

    public function show(Tweet $tweet): RedirectResponse
    {
        dd($tweet);

        return redirect();
    }

    public function create(TweetPostRequest $request): RedirectResponse
    {
        $vdata = $request->validated();
        $user = $request->user();

        $tweet = Tweet::create([
            'text' => $vdata['text'],
            'created_by' => $user->id,
        ]);

        //
        return redirect()->back();//->with(['tweet' => $tweet]);
    }

    public function update(Request $request, string $id): RedirectResponse //Tweet $tweet instead of $id
    {
        return redirect();
    }


    public function destroy(Tweet $tweet, Request $request): RedirectResponse
    {
        $user = $request->user();
        if ($tweet->created_by === $user->id)
            $tweet->delete();

        return redirect()->to('/');
    }
}
