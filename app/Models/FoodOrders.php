<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodOrders extends Model
{
    use HasFactory;

    protected $table = 'food_orders';

    protected $fillable = [
        'food_id',
        'order_id',
        'quantity',
        'price',
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id', 'FOD_ID');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}