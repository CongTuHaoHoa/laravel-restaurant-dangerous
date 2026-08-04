<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Food extends Model
{

    /**
    * PRODUCT ATTRIBUTES
    * $this->attributes['id'] - int - contains the product primary key (id)
    * $this->attributes['name'] - string - contains the product name
    * $this->attributes['description'] - string - contains the product description
    * $this->attributes['image'] - string - contains the product image
    * $this->attributes['price'] - int - contains the product price
    * $this->attributes['created_at'] - timestamp - contains the product creation date
    * $this->attributes['updated_at'] - timestamp - contains the product update date
    * $this->items - Item[] - contains the associated items
    */


    public $timestamps = false;
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

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts =
    [
        'FOD_CREATED_AT' => 'datetime',
        'FOD_UPDATED_AT' => 'datetime',
    ];

    public static function sumPricesByQuantities($foods, $foodsInSession)
    {
        $total = 0;
        foreach($foods as $food)
            {
                $total += ($food->FOD_PRICE*$foodsInSession[$food->FOD_ID]);
            }
        return $total;
    }

    use HasFactory;

    public function items(){
    return $this->hasMany(Item::class);
    }


}
