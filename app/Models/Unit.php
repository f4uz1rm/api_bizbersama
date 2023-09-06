<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'm_unit';

    protected $fillable = [
        'unit_id'      => 'string',
        'sub_unit_id'  => 'string',
        'unit_name'    => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    protected $primaryKey   = 'unit_id';
    protected $secondaryKey = 'sub_unit_id';

    function products_unit()
    {
        return $this->hasMany(Products::class);
    }
}
