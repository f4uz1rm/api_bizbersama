<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'm_size';

    protected $fillable = [
        'size_id'      => 'string',
        'sub_size_id'  => 'string',
        'size_name'    => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    protected $primaryKey   = 'size_id';
    protected $secondaryKey = 'sub_size_id';

    function products_size()
    {
        return $this->hasMany(Products::class);
    }
}
