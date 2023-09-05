<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_category extends Model
{
    use HasFactory;

    protected $table = 'm_category';

	protected $fillable = [
		'category_id' => 'string',
		'category_name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
	];

    public function m_category()
	{
        return $this->all();
	}
	
}
