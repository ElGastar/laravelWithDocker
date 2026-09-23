<?php

namespace App\Services;
class PriceFormatter{
    public function formatPrice(float $price):string{
        return number_format($price, 0, ' ', ' ') . ' ₽';
    }
}