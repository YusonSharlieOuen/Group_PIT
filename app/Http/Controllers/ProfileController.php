<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Branch;
use App\Models\Renter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $renter = Renter::where('user_id', $request->user()->id)->first();

        return view('profile.edit', [
            'user' => $request->user(),
            'renter' => $renter,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        /*
    UPDATE USER TABLE
    */

    $validated = $request->validated();
    $user = $request->user();

    $user->fill(collect($validated)->except(['profile_photo', 'remove_profile_photo'])->toArray());

    if ($request->boolean('remove_profile_photo')) {
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->profile_photo_path = null;
    }

    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
    }

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    /*
    UPDATE OR CREATE RENTER
    */

    $renter = Renter::where('user_id', $request->user()->id)->first();

    if (!$renter) {

        /*
        AUTO GENERATE RENTER ID
        */

        $number = 1;

        do {

            $renterId = 'R' . $number;

            $exists = Renter::where('renter_id', $renterId)->exists();

            $number++;

        } while ($exists);

        $renter = new Renter();

        $renter->renter_id = $renterId;

        $renter->user_id = $request->user()->id;

        /*
        TEMPORARY DEFAULT BRANCH
        */

        $renter->branch_id = Branch::where('branch_id', 'B1')->exists() ? 'B1' : null;
    }

    /*
    UPDATE RENTER FIELDS
    */

    $nameParts = explode(' ', trim($request->user()->name), 2);

    $renter->first_name = $request->first_name ?: ($nameParts[0] ?: 'User');
    $renter->last_name = $request->last_name ?: ($nameParts[1] ?? '');
    $renter->address = $request->address;
    $renter->phone = $request->phone;
    $renter->preferred_property_type = $request->preferred_property_type;
    $renter->max_rent = $request->max_rent;
    $renter->comments = $request->comments;

    $renter->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
