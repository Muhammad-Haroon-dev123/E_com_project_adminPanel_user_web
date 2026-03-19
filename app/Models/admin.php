<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_image',
    ];

    // Many-to-Many relationship with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'admin_category');
    }
}
