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
        int|null|string|array $hotelIds = null, 
        int|string|null $hotelRating, 
        int $durationFrom, 
        int $durationTo, 
        int|null $maxResults = 1000
        )
    {   
        set_time_limit(0);
        
        $collections = collect();

        if($hotelIds)
        {   
            foreach($hotelIds as $hotelId)
            {   
                $collections = $collections->merge(Http::get('https://pasirinksparnus.waavo.com/api/v1/cheap_travels/?', [
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
                )->collect());
            }
        }
        else 
        {
            $collections = $collections->merge(Http::get('https://pasirinksparnus.waavo.com/api/v1/cheap_travels/?', [
                    'dateFrom' => $dateFrom,
                    'dateTo' => $dateTo,
                    'cityId' => $cityId,
                    'countryId' => $countryId, 
                    'hotelId' => $hotelIds,
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
            )->collect());
        }

        return $collections->unique('link')->sortBy('price_before_per_person');
    }

    public static function getMealsInText(int $mealId)
    {
        $mealsTypes = Http::get('https://pasirinksparnus.waavo.com/api/v1/hotel/pansions/groups')->collect();
        if($mealsTypes)
        {
            $equivalent = $mealsTypes->where('id', $mealId)->first();
            return $equivalent ? $equivalent['code'] : null;
        }
        return null;
    }

}