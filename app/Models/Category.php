<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name' , 'image'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
    ];


    public function getImageAttribute($value)
    {
        return config('app.url') . ($value ? "/storage/$value" : '/assets/images/Missing.webp');
    }

}
