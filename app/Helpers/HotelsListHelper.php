<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class HotelsListHelper {    

    public static function getCSVListFromUrl()
    {   
        
    }

    public static function skipDuplicates(string $name)
    {
        $duplicateWords = ['hotel', 'Hotel', 'resort', 'Resort'];
        $removeQuetes = str_replace('"', "", $name);

        foreach($duplicateWords as $word)
        {   
            $isHotels = \App\Models\Travel\Hotel::select('id', 'hotel_name')->where('hotel_name', $name)->get();
            if($isHotels && $isHotels->count() > 1) 
            {   
                return true;
            }

            if($removeQuetes == $removeQuetes . ' ' . $word)
            {
                return true;
            }
            if($removeQuetes == $word . ' ' . $removeQuetes)
            {
                return true;
            }
        }
    }

    public static function removeDuplicates(string|null $name = null)
    {
        $duplicateWords = ['hotel', 'Hotel', 'HOTEL', 'resort', 'Resort', 'RESORT'];
        $removeQuetes = str_replace('"', "", $name);

        $duplicate = false;

        foreach($duplicateWords as $word)
        {   
            foreach(\App\Models\Travel\Hotel::select('id', 'hotel_name')->get() as $hotel) 
            {   
                $isHotels = \App\Models\Travel\Hotel::select('id', 'hotel_name')->where('hotel_name', $hotel->hotel_name)->get();
                if($isHotels && $isHotels->count() > 1) 
                {   
                    foreach($isHotels->skip(1) as $isHotel)
                    {
                        $hotel->delete();
                    }
                }
                if($hotel->hotel_name == $hotel->hotel_name . ' ' . $word)
                {   
                    $duplicate = true;
                }
                if($hotel->hotel_name == $hotel->hotel_name . ' ' . $word)
                {   
                    $duplicate = true;
                }
                elseif($hotel->hotel_name == $word . ' ' . $hotel->hotel_name)
                {   
                    $duplicate = true;
                }
            }
        }

        return $duplicate;
    }

}