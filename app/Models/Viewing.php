<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewing extends Model
{
    protected $table = 'viewing';

    protected $primaryKey = 'viewing_id';

    public $timestamps = false;

    protected $fillable = [
        'renter_id',
        'property_id',
        'viewing_date',
        'comments',
    ];

    public function renter()
    {
        return $this->belongsTo(
            Renter::class,
            'renter_id',
            'renter_id'
        );
    }
}
