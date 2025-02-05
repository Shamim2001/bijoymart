<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    // protected $fillable = ['delivery_status'];
    protected $fillable = [
        'user_id',
        'order_no',
        'customer_id',
        'customer_name',
        'customer_phone',
        'shipping_address',
        'delivery_status',
        'payment_type',
        'payment_status',
        'grand_total',
        'delivery_charge',
        'total',
        'discount',
        'tracking_code',
        'date',
        // Add other fields as needed
    ];



    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    public function OrderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'order_id');
    }

    // new 16
    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }

}
