<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;
    protected $table = "bills";

    protected $fillable = [
        'account_id',
        'bill_detail',
    ];
    public function acount() {
        return $this->BelongsTo(Account::class);
    }
}
