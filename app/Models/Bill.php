<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends BaseModel
{
    use HasFactory;
    protected $table = "bills";

    protected $fillable = [
        'account_id',
        'bill_detail',
        'table_name',
        'created_at'
    ];
    public function account() {
        return $this->BelongsTo(Account::class);
    }
}
