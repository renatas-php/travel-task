<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GetHotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-hotels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create/Update hotels list in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $hotelLists = [
            'teztour' => ['name' => 'teztour', 'url' => 'https://waavo.com/content/hotels_teztour.csv'],
            'coral' => ['name' => 'coral', 'url' => 'https://waavo.com/content/hotels_coral.csv'],
            'joinup' => ['name' => 'coral', 'url' => 'https://waavo.com/content/hotels_joinup.csv'],
            'novaturas' => ['name' => 'coral', 'url' => 'https://waavo.com/content/hotels_novaturas.csv'],
            'itaka' => ['name' => 'coral', 'url' => 'https://waavo.com/content/hotels_itaka.csv'],
            'rainbow' => ['name' => 'coral', 'url' => 'https://waavo.com/content/hotels_rainbow.csv'],
            'anextour' => ['name' => 'coral', 'url' => 'https://waavo.com/content/hotels_anextour.csv']
        ];

        foreach($hotelLists as $list)
        {   
            set_time_limit(0);
            try 
            {
                \App\Services\DownloadList::getCSVListFromUrl($list['url'], $list['name']);    
            }
            catch(Exception $e)
            {
                Log::syncHotels($e->getMessage());
            }                  
        }
    }
}
