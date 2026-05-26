<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $table = 'renter';

    protected $keyType = 'string';

    protected $primaryKey = 'renter_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'renter_id',
        'first_name',
        'last_name',
        'address',
        'phone',
        'preferred_property_type',
        'max_rent',
        'comments',
        'branch_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function viewings()
    {
        return $this->hasMany(Viewing::class, 'renter_id', 'renter_id');
    }

    public function leases()
    {
        return $this->hasMany(Lease::class, 'renter_id', 'renter_id');
    }
}
