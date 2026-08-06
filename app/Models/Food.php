<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\FoodOrders;
/**
 * @property mixed|string $FOD_ID
 */
class Food extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =
    [
        'FOD_ID',
        'FOD_NAME',
        'FOD_DESCRIPTION',
        'FOD_PRICE',
        'FOD_IMAGE',
        'FOD_CREATED_AT',
        'FOD_UPDATED_AT',
    ];

    protected $table = 'Food';
    protected $primaryKey = 'FOD_ID';
    protected $casts =
    [
        'FOD_CREATED_AT' => 'datetime',
        'FOD_UPDATED_AT' => 'datetime',
    ];

    public function getCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'FoodContainsCategory', 'FOD_ID', 'CTG_ID', 'FOD_ID', 'CTG_ID');
    }

    public function checkCategory(string $CTG_ID):bool
    {
        return FoodContainsCategory::where('FOD_ID', $this->FOD_ID)->where('CTG_ID', $CTG_ID)->exists();
    }

    use HasFactory;

    public function foodOrders(){
    return $this->hasMany(FoodOrders::class);
    }

    public static function sumPricesByQuantities($foods, $foodsInSession)
    {
        $total = 0;
        foreach($foods as $food)
        {
            $total += ($food->FOD_PRICE * $foodsInSession[$food->FOD_ID]);
        }
        return $total;
    }
}
