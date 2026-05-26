<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Branch;
use App\Models\NextOfKin;
use App\Models\PropertyDetails;
use App\Models\Lease;
use App\Models\Inspection;

class Staff extends Model
{
    protected $table = 'staff';

    public $timestamps = false;

    protected $primaryKey = 'staff_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'position',
        'sex',
        'date_of_birth',
        'salary',
        'date_joined',
        'branch_id',
        'phone',
        'mobile',
        'nin',
        'supervisor_id',
        'address',
        'user_id',
    ];

    // USER
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // NEXT OF KIN
    public function nextOfKin()
    {
        return $this->hasOne(NextOfKin::class, 'staff_id', 'staff_id');
    }

    // SUPERVISOR
    public function supervisor()
    {
        return $this->belongsTo(Staff::class, 'supervisor_id', 'staff_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Staff::class, 'supervisor_id', 'staff_id');
    }

    // BRANCH
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // PROPERTIES
    public function assignedProperties()
    {
        return $this->hasMany(PropertyDetails::class, 'staff_id', 'staff_id');
    }

    public function properties()
    {
        return $this->hasMany(PropertyDetails::class, 'staff_id', 'staff_id');
    }

    // LEASES
    public function leases()
    {
        return $this->hasMany(Lease::class, 'staff_id', 'staff_id');
    }

    // INSPECTIONS
    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'staff_id', 'staff_id');
    }
}