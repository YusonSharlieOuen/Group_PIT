<?php

namespace App\Http\Controllers;

use App\Models\Renter;
use Illuminate\Http\Request;

class RenterInformationController extends Controller
{
    public function show(Request $request)
    {
        // Protect: only logged in users with Renter role
        $user = $request->user();

        if (! $user || ! ($user->hasRole('Renter') || strtolower($user->user_type ?? '') === 'renter' || strtolower($user->user_type ?? '') === 'client')) {
            abort(403);
        }

        $renter = Renter::query()
            ->where('user_id', $user->id)
            ->first();

        if (! $renter) {
            // If renter record doesn't exist, still show page with placeholders.
            $renter = new Renter();
            $renter->user_id = $user->id;
        }

        return view('Renter.renter_information', compact('renter'));
    }
}

