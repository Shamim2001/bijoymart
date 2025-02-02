<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'create_by', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'create_by');
    }

    public function countProducts()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
    public function Products()
    {
        return $this->hasMany(Product::class);
    }

    // public function getStatusAttribute($value)
    // {
    //     return ucfirst($value);
    // }
}
