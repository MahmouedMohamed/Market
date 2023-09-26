<?php

namespace App\Traits;

use Carbon\Carbon;
use NumberFormatter;

trait Formatter
{
    public function formatCurrency($value)
    {
        $amount = new NumberFormatter(app()->currentLocale(), NumberFormatter::CURRENCY);

        return $amount->formatCurrency($value, 'USD');
    }

    public function formatDateTime(Carbon $date)
    {
        return $date->timezone(request()->headers->get('Time-Zone') ?? 'UTC')->format('Y-m-d H:m:s');
    }

    public function calculatePrice(string $discountType, string $discount, float $price)
    {
        $priceAfterDiscount = 0;
        switch ($discountType) {
            case '#':
                $priceAfterDiscount = $price - $discount;
                break;
            case '%':
                $priceAfterDiscount = $price - ($price * $discount / 100);
                break;
            default:
                $priceAfterDiscount = $price;
                break;
        }

        return max($priceAfterDiscount, 0);
    }
}
