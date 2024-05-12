<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = "accounts";

    protected $fillable = [
        'user_name',
        'password',
        'name',
        'role',
    ];

    public function bills() {
        return $this->hasMany(Bill::class);
    }
}
