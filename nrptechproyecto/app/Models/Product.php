<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
   
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'price', 'description', 'discount', 'tax_id', 'color', 'stock', 'specs', 'features',
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_has_products')->withPivot("amount");
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id'  , 'id');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class);
    }

    public function showProducts()
    {
        $products = Product::all();
        return view('products', ['products' => $products]);
    }

}