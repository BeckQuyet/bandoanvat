<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Category - Danh muc san pham
 * Moi danh muc co nhieu san pham (quan he 1-n)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
