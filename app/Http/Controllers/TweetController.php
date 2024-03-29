<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetPostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Tweet;
class TweetController extends Controller
{
    //replace with TweetRequest
    public function create(TweetPostRequest $request): RedirectResponse
    {
        $vdata = $request->validated();
        $user = $request->user();

        Tweet::create([
            'text' => $vdata['text'],
            'created_by' => $user->id,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, string $id): RedirectResponse //Tweet $tweet instead of $id
    {

    }


    public function destroy(Tweet $tweet): RedirectResponse
    {
        $tweet->delete();

        return redirect()->to('/');
    }
}
