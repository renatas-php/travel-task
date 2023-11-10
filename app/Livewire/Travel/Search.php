<?php

namespace App\Livewire\Travel;

use Livewire\Component;

use Illuminate\Support\Facades\Http;

use App\Models\Travel\Hotel;

class Search extends Component
{   
    public $maxResults = 1000;
    public $dateFrom;
    public $dateTo;
    public $countryId = null;
    public $durationFrom = 7;
    public $durationTo = 10;
    public $hotelRating;
    public $hotelId = null;
    public $hotelIds = [];
    public $cityId = null;
    //public $cities = [];
    public $hotel;
    public $hotels = [];
    public $search;
    public $test;
    public $countries = [];
    public $results = [];
    public $showCitySelection = false;
    public $showHotelSelection = false;
    public $country;
    //public $paginationNumber = 40;
    //public $paginationPages;
    //public $page = 1;

    protected $rules = [
        //'countryId' => 'required|numeric',
        //'dateFrom' => 'required|string',
        //'dateTo' => 'required|string',
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

    public function mount()
    {
        $this->cityId = null;
    }

    public function render()
    {   
        
        return view('livewire.travel.search');
    }

    public function updateSearch()
    {   
        $this->validate();

        $results = \App\Helpers\TravelApiHelper::getCheapTravels($this->dateFrom, $this->dateTo, $this->cityId, $this->countryId, $this->hotelIds, $this->hotelRating, $this->durationFrom, $this->durationTo, $this->maxResults);
        
        //$this->paginationPages = ceil(count($results) / $this->paginationNumber);
        $this->results = $results;        
        
    }

    public function searchByCity()
    {

    }

    public function updatedCountry()
    {   
        if(empty($this->country))
        {
            $this->countryId = null;
        }
        else 
        {
            $qcountry = $this->country;
            $countries = \App\Helpers\TravelHelper::getDestinationsCountries();

            if(!empty($this->country))
            {
                $this->countries = $countries->where('title', 'like', $qcountry);/*$countries->filter(function ($item) use ($qcountry) {
                    return false !== stristr($item['title'], $qcountry);
                });*/
            }
        }
    }

    public function removeCountry()
    {
        $this->countryId = null;
        $this->country = null;
        $this->countries = \App\Helpers\TravelHelper::getDestinationsCountries();
    }

    public function selectCountry(string $name)
    {   
        $this->country = $name;
        $this->shit = $name;
    }

    public function updatedHotel()
    {   
        if(empty($this->hotel))
        {
            $this->hotelId = null;
        }
        else 
        {
            $this->hotels = Hotel::where('hotel_name', 'like', '%' . $this->hotel . '%')->take(20)->get();
        }        
    }

    /*public function goToPage(int $page)
    {   
        $this->dispatch('scrollToResults');
        $this->page = $page;
        $this->results = $this->results->skip($page * $this->paginationNumber);
    }*/
}

