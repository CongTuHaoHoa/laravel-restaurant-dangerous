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

    use HasFactory;
}
