<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = [
        'active',
        'price',
        'name',
        'description',
        'users_limit',
        'products_limit',
        'transactions_fees',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
    ];
}
