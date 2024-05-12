<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";

    protected $fillable = [
        'food_id',
        'quantity',
        'price',
        'quantity',
        'table_name',
        'order_status',
        'note',

    ];
    public function food() {
        return $this->belongsTo(Food::class);
    }   
}
