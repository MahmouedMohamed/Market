<?php

namespace App\Models;

use App\ConverterModels\OrderStatus;

class Order extends BaseModel
{
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatus($value)
    {
        $source = app()->getLocale() === 'ar' ? 'text_ar' : 'text';
        if ($value) {
            return OrderStatus::$$source[$value];
        }

        return null;
    }

    public function setStatusAttribute($text)
    {
        $source = app()->getLocale() === 'ar' ? 'value_ar' : 'value';

        $this->attributes['status'] = OrderStatus::$$source[$text];
    }
}
