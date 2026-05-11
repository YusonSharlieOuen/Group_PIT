<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        // DEBUG STEP: If you see this message on your screen, the route is fixed.
        // dd('The controller is finally reached!'); 

        $properties = Property::all(); 

        return view('find-home', compact('properties'));
    }
}