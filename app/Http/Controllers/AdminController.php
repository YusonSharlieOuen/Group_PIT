<?php

namespace App\Http\Controllers;

use App\Models\PropertyDetails;
use App\Models\Staff;
use App\Models\Lease;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalProperties = PropertyDetails::count();
        $available = PropertyDetails::where('status', 'Available')->count();
        $totalStaff = Staff::count();

        return view('admin.dashboard', compact('totalProperties', 'available', 'totalStaff'));
    }

    public function reports()
    {
        // basic placeholder reports page
        return view('admin.reports');
    }
}

