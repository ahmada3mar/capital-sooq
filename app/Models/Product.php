<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'active',
        'digital',
        'category_id',
        'organization_id',
        'cost',
        'price',
        'stock',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d | H:i a',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function image()
    {
        return $this->hasOne(Gallery::class)->select('image' , 'product_id')->oldest();
    }


}
