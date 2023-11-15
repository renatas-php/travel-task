<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use App\Models\Travel\Hotel;

class DownloadList {

    public static function getCSVListFromUrl(string $url, string $organizator) {
        set_time_limit(0);
        $contents = file_get_contents($url);
        $contentsToArray = explode("\n", $contents);

        //Hotel::query()->delete();
        //return;

        foreach($contentsToArray as $row) {
            $splitRow = explode(',', $row);
            $existHotelById = Hotel::select('hotel_id')->where('hotel_id', $splitRow[0])->first();
            if(isset($splitRow[1]))
            {
                $existHotelByName = Hotel::select('hotel_name')->where('hotel_name', \App\Helpers\StringHelper::fixHotelName($splitRow[1]))->first();
            }
            
            if(!$existHotelByName)
            {
                if($existHotelById) 
                {
                    $existHotelById->update(
                        [
                            'hotel_name' => \App\Helpers\StringHelper::fixHotelName($splitRow[1]), 
                            'list_updated' => $splitRow[2]
                        ]
                    );
                }
                else 
                {   
                    if(isset($splitRow[0]) && isset($splitRow[1]) && \App\Helpers\HotelsListHelper::skipDuplicates(\App\Helpers\StringHelper::fixHotelName($splitRow[1])) == false)
                    {
                        Hotel::create(
                            [   
                                'hotel_id' => $splitRow[0],
                                'hotel_name' => \App\Helpers\StringHelper::fixHotelName($splitRow[1]), 
                                'list_updated' => isset($splitRow[2]) ? $splitRow[2] : null 
                            ]
                        );
                    }
                }     
            }     
            
        }
    }

}