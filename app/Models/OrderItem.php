<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function book()
    {
        return $this->belongsTo(Book::class, 'item_id');
    }



    // Define the relationship with Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
