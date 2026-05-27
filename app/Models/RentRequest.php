<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentRequest extends Model
{
    protected $fillable = [
        'renter_id',
        'property_id',
        'assigned_staff_id',
        'approved_by',
        'status',
    ];

    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id', 'renter_id');
    }

    public function property()
    {
        return $this->belongsTo(PropertyDetails::class, 'property_id', 'property_id');
    }

    public function assignedStaff()
    {
        return $this->belongsTo(Staff::class, 'assigned_staff_id', 'staff_id');
    }

    public function approver()
    {
        return $this->belongsTo(Staff::class, 'approved_by', 'staff_id');
    }
}
