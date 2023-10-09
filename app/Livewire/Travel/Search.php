<?php

namespace App\Livewire\Travel;

use Livewire\Component;

use Illuminate\Support\Facades\Http;

class Search extends Component
{   
    public $maxResults = 100;
    public $dateFrom;
    public $dateTo;
    public $countryId = null;
    public $durationFrom;
    public $durationTo;
    public $hotelRating;
    public $hotelId = null;
    public $cityId = null;
    public $cities = [];
    public $hotels = [];
    public $search;
    public $test;
    public $countries;
    public $results = [];
    public $showCitySelection = false;
    public $showHotelSelection = false;

    protected $rules = [
        'countryId' => 'required|numeric',
        'dateFrom' => 'required|string',
        'dateTo' => 'required|string',
        'durationFrom' => 'required|numeric|min:6|max:14',
        'durationTo' => 'required|numeric|min:6|max:14'
    ];

    protected $messages = [
        'countryId.required' => 'Privalote pasirinkti kelionės šalį',
        'dateFrom.required' => 'Privalote pasirinkti kelionės datą nuo',
        'dateTo.required' => 'Privalote pasirinkti kelionės datą iki',
        'durationFrom.required' => 'Privalote pasirinkti kelionės trukmę nuo',
        'durationTo.required' => 'Privalote pasirinkti kelionės trukmę iki'
    ];

    protected $listeners = ['scrollToResults'];

    public function mounr()
    {
        $this->cityId = null;
    }

    public function render()
    {   
        $this->countries = \App\Helpers\TravelHelper::getDestinationsCountries();
        return view('livewire.travel.search')->with(['countries' => $this->countries]);
    }

    public function updateSearch()
    {   
        $this->validate();

        if($this->countryId != $this->countryId)
        {
            $this->cityId = null;
        }

        $results = \App\Helpers\TravelApiHelper::getCheapTravels($this->dateFrom, $this->dateTo, $this->cityId, $this->countryId, $this->hotelRating, $this->durationFrom, $this->durationTo, $this->maxResults);

        if(!$this->cityId)
        {   
            $this->cities = \App\Helpers\TravelHelper::getCitiesByCountry($this->dateFrom, $this->dateTo, $this->cityId, $this->countryId, $this->hotelRating, $this->durationFrom, $this->durationTo, $this->maxResults);
        }    

        if(!$this->hotelId)
        {   
            $this->hotels = \App\Helpers\TravelHelper::getHotelsByCountry($this->dateFrom, $this->dateTo, $this->cityId, $this->countryId, $this->hotelRating, $this->durationFrom, $this->durationTo, $this->maxResults);
        }    

        $this->showCitySelection = true;
        $this->showHotelSelection = true;
        
        $this->results = $results;

        $this->dispatch('scrollToResults');
    }

    public function searchByCity()
    {

    }
}

