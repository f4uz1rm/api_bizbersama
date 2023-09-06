<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'm_color';

    protected $fillable = [
        'color_id'      => 'string',
        'sub_color_id'  => 'string',
        'color_name'    => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    protected $primaryKey   = 'color_id';
    protected $secondaryKey = 'sub_color_id';

    function products_color()
    {
        return $this->hasMany(Products::class);
    }
}
