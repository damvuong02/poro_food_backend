<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaiterNotification extends BaseModel 
{
    use HasFactory;

    protected $table = "waiter_notifications";
    protected $fillable = [
        'table_name',
        'notification_status',
        'food_name',
    ];
    
}
