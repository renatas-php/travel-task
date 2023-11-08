<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class StringHelper {    

    public static function fixHotelName(string $name)
    {   
        $name = ucwords(str_replace('"', "", $name));

        $duplicateWords = ['hotel', 'Hotel', 'HOTEL', 'resort', 'Resort', 'RESORT'];

        foreach($duplicateWords as $word)
        {
            $name = str_replace($word, '', $name);
        }

        return $name;
    }

}