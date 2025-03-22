<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bill';
    protected $fillable = ['order_id', 'bill_date', 'payment_method_id', 'customer_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PayMethod::class, 'payment_method_id');
    }
}
