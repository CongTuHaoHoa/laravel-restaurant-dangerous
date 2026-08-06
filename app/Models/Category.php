<?php

namespace App\Models;

use BcMath\Number;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =
    [
        'CTG_ID',
        'CTG_NAME',
        'CTG_COLOR',
        'CTG_CREATED_AT',
        'CTG_UPDATED_AT',
    ];

    protected $primaryKey = 'CTG_ID';
    protected $table = 'Category';

    protected $casts =
    [
        'CTG_CREATED_AT' => 'datetime',
        'CTG_UPDATED_AT' => 'datetime',
    ];

    use HasFactory;

    public function food(string $id){
    return $this->hasMany(Food::class);
    }

    public function foodContainsCategory()
    {
        return $this->belongsTo(FoodContainsCategory::class);
    }

    public function count(string $id)
    {
        return FoodContainsCategory::where("CTG_ID", $id)->count();
    }

}
