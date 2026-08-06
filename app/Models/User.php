<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use App\Models\Comment;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
    * USER ATTRIBUTES
    * $this->attributes['id'] - int - contains the user primary key (id)
    * $this->attributes['name'] - string - contains the user name
    * $this->attributes['email'] - string - contains the user email
    * $this->attributes['email_verified_at'] - timestamp - contains the user email verification date
    * $this->attributes['password'] - string - contains the user password
    * $this->attributes['remember_token'] - string - contains the user password
    * $this->attributes['role'] - string - contains the user role (client or admin)
    * $this->attributes['balance'] - int - contains the user balance
    * $this->attributes['created_at'] - timestamp - contains the user creation date
    * $this->attributes['updated_at'] - timestamp - contains the user update date
    * $this->orders - Order[] - contains the associated orders
    */


    protected $fillable = 
        [
            'name',
            'email',
            'phone_number',
            'address',
            'password',
            'balance',
            'avatar',
        ];
            protected $hidden = [
            'password',
            'remember_token',
        ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders(){
    return $this->hasMany(Order::class);
    }

    public function comments(){
    return $this->hasMany(Comment::class);
    }
}