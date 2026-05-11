<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    public $timestamps = false;

    protected $primaryKey = 'staff_id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'staff_id',
        'first_name',
        'last_name',
        'address',
        'phone',
        'sex',
        'date_of_birth',
        'nin',
        'position',
        'salary',
        'date_joined',
        'branch_id',
        'supervisor_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nextOfKin()
    {
        return $this->hasOne(NextOfKin::class, 'staff_id', 'staff_id');
    }
}