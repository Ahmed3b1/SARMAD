<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'phone',
        'additional_phone',
        'total',
        'status',
        'paymob_order_id',
        'paid_at',
        'payment_method',
        'session_id',
        'cart_id',
        'delivery_status',
        'subtotal',
        'shipping_cost',
        'note',
    ];

    // في Order.php
    public function cart()
    {
        return $this->belongsTo(cart::class);
    }

    // خريطة الترجمة - مكان واحد للتعديل لو احتجت تغيّر النص العربي مستقبلًا
    public const DELIVERY_STATUSES = [
        'processing' => 'قيد التجهيز',
        'shipping'   => 'قيد الشحن',
        'delivered'  => 'تم التسليم',
        'cancelled'  => 'ملغي',
    ];

    // Accessor: $order->delivery_status_label يرجع النص العربي
    public function getDeliveryStatusLabelAttribute(): string
    {
        return self::DELIVERY_STATUSES[$this->delivery_status] ?? $this->delivery_status;
    }

    public function orderItems()
    {
        return $this->hasMany(Orderitem::class);
    }

}
