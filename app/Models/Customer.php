<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];



    public function referral()
    {
        return $this->belongsTo(Customer::class, 'referral_by');
    }
}
