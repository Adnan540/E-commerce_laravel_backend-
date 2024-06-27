<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Reviews extends Model
{

    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'rating'
    ];
    
    use HasFactory;

     // Many-to-One relation with User
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // Many-to-One relation with Product
     public function product()
     {
         return $this->belongsTo(Product::class);
     }
}
