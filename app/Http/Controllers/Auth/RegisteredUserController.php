<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Renter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string'],
        'phone' => ['required', 'string', 'max:20'],

        'preferred_property_type' => ['nullable', 'string'],
        'max_rent' => ['nullable', 'numeric'],
        'comments' => ['nullable', 'string'],

        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // Optional
            'user_type' => 'renter',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Renter ID
        |--------------------------------------------------------------------------
        */

        $latestRenter = Renter::where('renter_id', 'LIKE', 'R%')
            ->orderByRaw("CAST(REGEXP_SUBSTR(renter_id, '[0-9]+') AS INTEGER) DESC")
            ->first();

        $nextNumber = 1;

        if ($latestRenter) {

            preg_match('/([0-9]+)$/', $latestRenter->renter_id, $matches);

            if (isset($matches[1])) {
                $nextNumber = (int) $matches[1] + 1;
            }
        }

        $renterId = 'R' . $nextNumber;

        /*
        |--------------------------------------------------------------------------
        | Create Renter
        |--------------------------------------------------------------------------
        */

        Renter::create([
            'renter_id' => $renterId,

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

            'address' => $request->address,
            'phone' => $request->phone,

            'preferred_property_type' => $request->preferred_property_type,
            'max_rent' => $request->max_rent,
            'comments' => $request->comments,

            'user_id' => $user->id,

            // Optional
            'branch_id' => null,
        ]);

        DB::commit();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));

    } catch (\Throwable $e) {

        DB::rollBack();

        return back()
            ->withErrors([
                'error' => $e->getMessage()
            ])
            ->withInput();
    }
}
}
