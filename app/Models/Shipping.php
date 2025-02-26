<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ["division", "district", "thana", "address", "name", "phone"];
    use HasFactory;
}
