<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'address', 'price', 'beds', 'baths', 'sqft', 'type', 'image_path', 'lat', 'lng',
    ];
}
