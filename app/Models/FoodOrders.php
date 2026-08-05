<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Food;
class FoodOrders extends Model
{
/**
* ITEM ATTRIBUTES
* $this->attributes['id'] - int - contains the item primary key (id)
* $this->attributes['quantity'] - int - contains the item quantity
* $this->attributes['price'] - int - contains the item price
* $this->attributes['order_id'] - int - contains the referenced order id
* $this->attributes['product_id'] - int - contains the referenced product id
* $this->attributes['created_at'] - timestamp - contains the item creation date
* $this->attributes['updated_at'] - timestamp - contains the item update date
* $this->order - Order - contains the associated Order
* $this->product - Product - contains the associated Product
*/

public static function validate($request)
{
    $request->validate([
    "price" => "required|numeric|gt:0",
    "quantity" => "required|numeric|gt:0",
    "product_id" => "required|exists:products,id",
    "order_id" => "required|exists:orders,id",
    ]);
}

public function order(){
return $this->belongsTo(Order::class);
}

public function food()
{
    return $this->belongsTo(Food::class, 'food_id', 'FOD_ID');
}


}
