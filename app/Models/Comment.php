<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodOrders;

class Comment extends Model
{

    protected $fillable = 
    [
        'food_id',
        'user_id',
        'content',
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodOrders()
    {
        return $this->hasMany(FoodOrders::class);
    }
}
