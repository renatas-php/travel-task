<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class FrontHelper {    

    public static function makeBold(string $words, string $text)
    {   
        $string = explode(' ', strtolower($words));
        $text = strtolower($text);

        foreach($string as $str)
        {
            $text = str_replace($str, "<b>" . ucwords($str) . "</b>", $text);
        }

        return ucwords($text);

    }

}