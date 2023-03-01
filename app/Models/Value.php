<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Value extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'stock',
        'attribute_id'
    ];


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
