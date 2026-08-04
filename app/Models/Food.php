<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
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
                $total = $total + ($food->getPrice()*$foodsInSession[$food->getId()]);
            }
        return $total;
    }

    use HasFactory;

    public function getId(){
    return $this->attributes['id'];
    }
    public function setId($id){
    $this->attributes['id'] = $id;
    }
    public function getName(){
    return $this->attributes['name'];
    }
    public function setName($name) {
    $this->attributes['name'] = $name;
    }
}
