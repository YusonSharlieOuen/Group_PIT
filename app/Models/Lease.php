<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    public function property()
    {
        return $this->belongsTo(PropertyDetails::class, 'property_id', 'property_id');
    }

    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id', 'renter_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    protected $table = 'lease';

    protected $primaryKey = 'lease_id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'lease_id',
        'property_id',
        'renter_id',
        'staff_id',
        'rent',
        'deposit',
        'deposit_paid',
        'payment_method',
        'start_date',
        'end_date',
        'duration',
    ];
}
