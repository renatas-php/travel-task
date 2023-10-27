<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class TravelResultsHelper {    

    public static function formatPrice(float|int $price, string $currency)
    {
        $formated = number_format($price, 2, '.', '.');
        return $currency . $formated;
    }

}