<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'm_image';

    protected $fillable = [
        'image_id'      => 'string',
        'sub_image_id'  => 'string',
        'image_name'    => 'string',
        'image_link'    => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    protected $primaryKey   = 'image_id';
    protected $secondaryKey = 'sub_image_id';



    function products_image()
    {
        return $this->hasMany(Products::class);
    }
}
