<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'm_category';

    protected $fillable = [
		'category_id'   => 'string',
		'category_name' => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
	];

    protected $primaryKey = 'category_id';


    function products_category()
    {
        return $this->hasMany(Products::class);
    }

}
