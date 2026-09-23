<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class PriceFormatterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'price_formatter';
    }
}