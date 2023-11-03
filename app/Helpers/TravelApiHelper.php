<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class TravelApiHelper {    

    public static function getCheapTravels(
        string|null $dateFrom, 
        string|null $dateTo, 
        int|null|string $cityId = null, 
        int|null $countryId, 
        int|null|string $hotelId = null, 
        int|string|null $hotelRating, 
        int $durationFrom, 
        int $durationTo, 
        int|null $maxResults = 1000
        )
    {   
        return Http::get('https://waavodemolt.waavo.com/api/v1/cheap_travels/?', [
                            'dateFrom' => $dateFrom,
                            'dateTo' => $dateTo,
                            'cityId' => $cityId,
                            'countryId' => $countryId, 
                            'hotelId' => $hotelId,
                            'departureAirport' => 'VNO',
                            'adults' => '2',
                            'children' => '0', 
                            'hotelRating' => $hotelRating, 
                            'durationFrom' => $durationFrom, 
                            'durationTo' => $durationTo, 
                            'groupBy' => 'hotel',
                            'useGroupedChildrenAges' => 'false',
                            'searchForMergedHotels' => 'false',
                            'updatedFrom' => 'true',
                            'limit' => $maxResults,
                            'maxStops' => '0'
                        ]
                    )->collect();
    }

    public static function getMealsInText(int $mealId)
    {
        $mealsTypes = Http::get('https://waavodemolt.waavo.com/api/v1/hotel/pansions/groups')->collect();
        if($mealsTypes)
        {
            $equivalent = $mealsTypes->where('id', $mealId)->first();
            return $equivalent ? $equivalent['code'] : null;
        }
        return null;
    }

}