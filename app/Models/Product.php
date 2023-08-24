<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "filename",
        "name",
        "description"
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->cartItems->each(function ($item) {
                $item->delete();
            });
        });
    }



}
