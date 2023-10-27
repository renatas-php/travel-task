<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use App\Models\Travel\Hotel;

class DownloadList {

    public static function getCSVListFromUrl(string $url, string $organizator) {
        set_time_limit(0);
        $contents = file_get_contents($url);
        $contentsToArray = explode("\n", $contents);
        /*foreach(Hotel::all() as $hot)
        {
            $hot->delete();
        }*/
        foreach($contentsToArray as $row) {
            $splitRow = explode(',', $row);
            $existHotel = Hotel::where('id', $splitRow[0])->first();
            if($existHotel) 
            {
                $existHotel->update(
                    [
                        'hotel_name' => $splitRow[1], 
                        'list_updated' => $splitRow[2]
                    ]
                );
            }
            else 
            {   
                if(isset($splitRow[0]) && isset($splitRow[1]))
                {
                    Hotel::create(
                        [   
                            'hotel_id' => $splitRow[0],
                            'hotel_name' => $splitRow[1], 
                            'list_updated' => isset($splitRow[2]) ? $splitRow[2] : null 
                        ]
                    );
                }
            }
           
        }
    }

}