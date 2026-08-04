<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string $FOD_ID
 */
class FoodContainsCategory extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable =
        [
            'FCC_ID',
            'FOD_ID',
            'CTG_ID',
        ];

    protected $table = 'FoodContainsCategory';
    protected $primaryKey = 'FCC_ID';
    protected $casts =
        [
            'FOD_CREATED_AT' => 'datetime',
            'FOD_UPDATED_AT' => 'datetime',
        ];

    use HasFactory;
}
