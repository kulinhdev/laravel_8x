<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'status'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function product()
    {
        return $this->hasOne(Product::class, 'category_id', 'id');
    }

}
