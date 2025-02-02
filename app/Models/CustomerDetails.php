<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    protected $fillable = ["customer_id", "full_name", "division", "district", "thana", "address", "phone", "default_address", "shipping_address", "billing_address"];
    use HasFactory;
}
