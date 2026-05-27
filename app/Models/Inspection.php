<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    /**
     * Assumes there is an `inspections` table.
     * If your schema differs, update `$table` and relationship keys.
     */
    protected $table = 'inspections';

    public $timestamps = false;

    /**
     * Default primary key. Update if your table uses a different key.
     */
    protected $primaryKey = 'inspection_id';

    protected $fillable = [
        'inspection_id',
        'staff_id',
        'property_id',
        'inspection_date',
        'comments',
        'status',
    ];
}

