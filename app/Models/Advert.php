<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table = 'advert';

    protected $primaryKey = 'advert_id';

    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'newspaper',
        'date_advertised',
    ];

    public function property()
    {
        return $this->belongsTo(PropertyDetails::class, 'property_id', 'property_id');
    }
}
