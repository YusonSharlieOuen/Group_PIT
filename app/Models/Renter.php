<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $table = 'renter';

    protected $primaryKey = 'renter_id';

    public $incrementing = false;

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
}
