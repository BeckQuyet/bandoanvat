<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Product - San pham do an vat
 * Thuoc ve 1 danh muc (category)
 */
class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description', 'price', 'image', 'category_id', 'quantity'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
