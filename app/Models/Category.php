<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable =
    [
        'CTG_ID',
        'CTG_NAME',
        'CTG_COLOR',
        'CTG_CREATED_AT',
        'CTG_UPDATED_AT',
    ];

    protected $table = 'Category';

    protected $casts =
    [
        'CTG_CREATED_AT' => 'datetime',
        'CTG_UPDATED_AT' => 'datetime',
    ];

    use HasFactory;
}
