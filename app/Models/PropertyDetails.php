<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDetails extends Model
{
    protected $table = 'property';

    protected $primaryKey = 'property_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'street',
        'area',
        'city',
        'postcode',
        'property_type',
        'number_of_rooms',
        'monthly_rent',
        'status',
        'photo_path',
        'branch_id',
        'staff_id',
    ];

    /*
    PROPERTY BELONGS TO STAFF
    */

    public function staff()
    {
        return $this->belongsTo(
            Staff::class,
            'staff_id',
            'staff_id'
        );
    }

    /*
    PROPERTY BELONGS TO BRANCH
    */

    public function branch()
    {
        return $this->belongsTo(
            Branch::class,
            'branch_id',
            'branch_id'
        );
    }

    /*
    PROPERTY HAS MANY LEASES
    */

    public function leases()
    {
        return $this->hasMany(
            Lease::class,
            'property_id',
            'property_id'
        );
    }
}
