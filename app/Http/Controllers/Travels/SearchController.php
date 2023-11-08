<?php

namespace App\Http\Controllers\Travels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\Travel\TravelSearchRequest;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use File;


class SearchController extends Controller
{   
    private $maxResults = 1000;
    private $dateFrom;
    private $dateTo;
    private $countryId;
    private $durationFrom;
    private $durationTo;
    private $hotelRating = '';
    private $hotelId;
    private $cityId;

    public function index(TravelSearchRequest $request)
    {   
        $this->dateFrom = $request->dateFrom;
        $this->dateTo = $request->dateTo;
        $this->countryId = $request->countryId;
        $this->durationFrom = $request->durationFrom;
        $this->durationTo = $request->durationTo;
        $this->hotelRating = $request->hotelRating;
        $this->hotelId = $request->hotelId;
        $this->cityId = $request->cityId;
        
        $results = Http::get('https://waavodemolt.waavo.com/api/v1/cheap_travels/?dateFrom=' . 
        $this->dateFrom . 
        '&dateTo=' . $this->dateTo . 
        //'&cityId=' . $this->cityId .
        '&countryId=' . 
        $this->countryId . '&departureAirport=VNO&adults=2&children=0&hotelRating=' . 
        $this->hotelRating . '&durationFrom=' . 
        $this->durationFrom . '&durationTo=' . 
        $this->durationTo . '&groupBy=hotel&useGroupedChildrenAges=false&searchForMergedHotels=false&updatedFrom=true&limit=' . 
        $this->maxResults . '&maxStops=0');

        $results = $results->collect();
        $hotels = [];

        if($this->hotelId)
        {
            $results = $results->where('hotel_id', $this->hotelId);
        }
        
        return view('front.results')->with(['items' => $results, 'hotels' => $hotels, 'cities' => []]);
    }

    public function getCities(int $id)
    {
        //$cities = \App\Helpers\TravelHelper::getCitiesByCountry($id);
    }

    public function hotels()
    {   
        
    }

    public function importfaking(Request $request)
    {   
        dd($request->file->getClientOriginalExtension());
        Excel::import(new \App\Imports\HotelsImport, $request->file('csv'));
    }
}
