<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateCoversRequest;
use App\Http\Resources\UserResource;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $tweets = $user->tweets();

        return Inertia::render('Profile/View', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => new UserResource($user),
            'tweets' => $tweets,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(User $user)
    {
        $tweets = $user->tweets()->paginate(12);
        $likes = Like::select('tweet_id')->where('user_id', $user->id)->get();
        $likes = array_column($likes->toArray(), 'tweet_id');

        return Inertia::render('Profile/View', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => new UserResource($user),
            'tweets' => $tweets,
            'likes' => $likes,
        ]);
    }

    public function updateCovers(UpdateCoversRequest $request): RedirectResponse
    {
        $vdata = $request->validated();
        $user = $request->user();

        /** @var UploadedFile $avatar */
        $avatar = $vdata['avatar'] ?? null;
        /** @var UploadedFile $profile_cover */
        $profile_cover = $vdata['profile_cover'] ?? null;

        if ($avatar) {
            $avatar_url = $avatar->store('avatars/' . $user->id, 'public');
            $user->update(['avatar_url' => $avatar_url]);
        }

        if ($profile_cover) {
            $profile_cover_url = $profile_cover->store('covers/' . $user->id,'public');
            $user->update(['profile_cover_url' => $profile_cover_url]);
        }

        return redirect()->back();
    }


}
