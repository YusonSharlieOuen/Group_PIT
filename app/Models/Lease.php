<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
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
