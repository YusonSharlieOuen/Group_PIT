<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

    // Primary key is NOT `id` in this schema.
    protected $primaryKey = 'branch_id';
    public $incrementing = false;
    protected $keyType = 'string';


    public $timestamps = false;

    protected $fillable = [

        'branch_id',
        'street',
        'area',
        'city',
        'postcode',
        'telephone',
        'fax',
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'branch_id', 'branch_id');
    }

    public function properties()
    {
        return $this->hasMany(PropertyDetails::class, 'branch_id', 'branch_id');
    }

    public function renters()
    {
        return $this->hasMany(Renter::class, 'branch_id', 'branch_id');
    }
}
