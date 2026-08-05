<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodOrders;

class Order extends Model
{
/**
* ORDER ATTRIBUTES
* $this->attributes['id'] - int - contains the order primary key (id)
* $this->attributes['total'] - string - contains the order name
* $this->attributes['user_id'] - int - contains the referenced user id
* $this->attributes['created_at'] - timestamp - contains the order creation date
* $this->attributes['updated_at'] - timestamp - contains the order update date
* $this->user - User - contains the associated User
* $this->foodOrders - FoodOrders[] - contains the associated items
*/
    protected $fillable = [
        'total',
        'user_id',
    ];

    public static function validate($request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodOrders()
    {
        return $this->hasMany(FoodOrders::class);
    }
}
