<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends BaseModel
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
        'quantity_sold',
        'need_cooking',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function bills(){
        return $this->belongsToMany(Bill::class,'orders','food_id','bill_id');
    }

    public function waiter_notification()
    {
        return $this->hasMany(WaiterNotification::class);
    }
}
