<?php

namespace App\Http\Controllers;

use App\Models\Renter;
use Illuminate\Http\Request;

class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $renter = Renter::where('user_id', auth()->id())->first();

        return view('profile.edit', [
            'user' => request()->user(),
            'renter' => $renter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Renter $renter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Renter $renter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Renter $renter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renter $renter)
    {
        //
    }
}
