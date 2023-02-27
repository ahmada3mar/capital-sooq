<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'image'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
    ];
}
