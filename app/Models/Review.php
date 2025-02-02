<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = ['product_id', 'customer_id', 'rating', 'product_review'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id')->select('id', 'name');
    }
}
