<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_code',
        'char_code',
        'nominal',
        'name',
    ];

    public function rates()
    {
        return $this->hasMany(CurrencyRate::class);
    }
}
