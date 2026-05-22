<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    protected $table = 'next_of_kin';

    protected $primaryKey = 'kin_id';

    public $timestamps = false;

    protected $fillable = [
        'staff_id',
        'full_name',
        'relationship',
        'address',
        'phone',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}
