<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class TravelHelper {
    
    public static function getDestinations()
    {
        $destinations = Http::get('https://waavodemolt.waavo.com/api/v1/travels/destinations');
        $destinations = $destinations->collect();
        if($destinations['status'] == 'success')
        {   
            $destinationsData = collect($destinations['data']);
            
            $destinations = collect($destinationsData)->map(function($full_name) {
                return [
                    'title' => $full_name['full_name']['title'], 
                    'id' => $full_name['country']['id'], 
                    'country' => explode(', ', $full_name['full_name']['title'])[1], 
                    'country_id' => $full_name['country']['id'],
                    'city' => explode(', ', $full_name['full_name']['title'])[0],
                    'city_id' => $full_name['id']
                ];//$full_name;
            });

            $new_destinations = collect($destinationsData)->map(function($full_name) use ($destinations) {
                return [
                    'title' => $full_name['full_name']['title'], 
                    'id' => $full_name['country']['id'], 
                    'country' => explode(', ', $full_name['full_name']['title'])[1], 
                    'country_id' => $full_name['country']['id'],
                    'city' => explode(', ', $full_name['full_name']['title'])[0],
                    'city_id' => $full_name['id'],
                    'cities' => collect($destinations->where('country_id', $full_name['country']['id']))->map(function($item) {
                        return [
                            'id' => $item['city_id'],
                            'city' => $item['city'],
                        ];

                    })->toArray()
                ];
            });
            return $new_destinations->unique('country_id');            
        }
        return [];
    }

    public static function getDestinationsCountries()
    {
        $destinations = Http::get('https://waavodemolt.waavo.com/api/v1/travels/destinations');
        $destinations = $destinations->collect();
        if($destinations['status'] == 'success')
        {   
            $destinationsData = collect($destinations['data']);
            $countries = collect($destinationsData)->map(function($full_name){
                   return ['title' => explode(', ', $full_name['full_name']['title'])[1], 'id' => $full_name['country']['id']];//$full_name;
                });
            return $countries->unique();
        }
        return [];
    }

    public static function getCountryNameById(int $id): string {
        return self::getDestinationsCountries()->where('id', $id)->value('title');
    }

    public static function getCountryName(string $destination): string
    {   
        $countryName = explode(',', $destination);        
        if(isset($countryName[1]))
        {
            return $countryName[1];
        }
        return $destination;        
    }

    public static function getCityName(string $destination): string
    {   
        $countryName = explode(',', $destination);        
        if(isset($countryName[0]))
        {
            return $countryName[0];
        }
        return $destination;        
    }

    public static function getCitiesByCountry($dateFrom, $dateTo, int|null|string $cityId = null, $countryId, $hotelRating = null, $durationFrom, $durationTo, $maxResults): Collection
    {   
        $destinations = \App\Helpers\TravelApiHelper::getCheapTravels($dateFrom, $dateTo, $cityId, $countryId, $hotelRating, $durationFrom, $durationTo, $maxResults);
        $results = $destinations->map(function ($item, $key) {
            return [
                'city_id' => $item['city_id'], 
                'city_name' => $item['city_name'], 
                'country_name' => $item['country_name'], 
            ];
        })->unique('city_name');
        return $results;
    }

    public static function getHotelsByCountry($dateFrom, $dateTo, int|null|string $cityId = null, $countryId, $hotelRating = null, $durationFrom, $durationTo, $maxResults = 1000): Collection
    {   
        $destinations = \App\Helpers\TravelApiHelper::getCheapTravels($dateFrom, $dateTo, $cityId, $countryId, $hotelRating, $durationFrom, $durationTo, $maxResults);
        $results = $destinations->map(function ($item, $key) {
            return [
                'hotel_id' => $item['hotel_id'], 
                'hotel_name' => $item['hotel_name'], 
                'hotel_rating' => $item['hotel_rating'], 
                'roome_name' => $item['room_name'], 
                'departure_airport' => $item['departure_airport'],
                'city_id' => $item['city_id'], 
                'country_name' => $item['country_name'], 
            ];
        });
        return $results;
    }

    public static function getCities()
    {
        $destinations = Http::get('https://waavodemolt.waavo.com/api/v1/travels/destinations');
        $destinations = $destinations->collect();
        if($destinations['status'] == 'success')
        {   
            $destinationsData = collect($destinations['data']);
            $destinations = collect($destinationsData)->map(function($full_name){
                return [
                    'country' => explode(', ', $full_name['full_name']['title'])[1], 
                    'country_id' => $full_name['country']['id'],
                    'city' => explode(', ', $full_name['full_name']['title'])[0],
                    'city_id' => $full_name['id']
                ];
            });
            return $destinations;            
        }
        return [];
    }
    
    

    

}