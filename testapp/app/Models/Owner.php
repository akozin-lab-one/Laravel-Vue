<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone_number', 'address', 'user_id'];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
