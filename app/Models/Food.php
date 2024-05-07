<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "foods";

    protected $fillable = [
        'food_name',
        'category_id',
        'price',
        'quantity',
        'food_image',
        'food_unit',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
