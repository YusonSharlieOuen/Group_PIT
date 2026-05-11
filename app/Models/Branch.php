<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

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
        'fax'
    ];
}
