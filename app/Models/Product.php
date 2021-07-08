<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'image', 'category_id', 'price', 'sale_price'];

    protected $hidden = ['created_at','updated_at', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
}
