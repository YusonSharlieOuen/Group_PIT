<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Renter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    $request->user()->save();

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

        $renter->branch_id = 'B1';
    }

    /*
    UPDATE RENTER FIELDS
    */

    $renter->first_name = $request->first_name;
    $renter->last_name = $request->last_name;
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
