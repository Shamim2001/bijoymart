<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'create_by');
    // }

    // public function countProducts()
    // {
    //     return $this->hasMany(Product::class, 'b_id');
    // }

    // public function getStatusAttribute($value)
    // {
    //     return ucfirst($value);
    // }
}
