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
    public $cityId = null;
    public $cities = [];
    public $hotel;
    public $hotels = [];
    public $search;
    public $test;
    public $countries = [];
    public $results = [];
    public $showCitySelection = false;
    public $showHotelSelection = false;
    public $country;
    public $shit;
    public $paginationNumber = 40;
    public $paginationPages;
    public $page = 1;

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

        if($this->countryId != $this->countryId)
        {
            $this->cityId = null;
        }

        $results = \App\Helpers\TravelApiHelper::getCheapTravels($this->dateFrom, $this->dateTo, $this->cityId, $this->countryId, $this->hotelId, $this->hotelRating, $this->durationFrom, $this->durationTo, $this->maxResults);
        
        $this->paginationPages = ceil(count($results) / $this->paginationNumber);
        $this->results = $results;
         
        
        
    }

    public function searchByCity()
    {

    }

    public function updatedCountry()
    {   
        $qcountry = $this->country;
        $countries = \App\Helpers\TravelHelper::getDestinationsCountries();
        $this->countries = $countries->filter(function ($item) use ($qcountry) {
            return false !== stristr($item['title'], $qcountry);
        });
    }

    public function selectCountry(string $name)
    {   
        $this->country = $name;
        $this->shit = $name;
    }

    public function updatedHotel()
    {   
        $this->hotels = Hotel::where('hotel_name', 'like', '%' . $this->hotel . '%')->take(20)->get();
    }

    public function goToPage(int $page)
    {   
        $this->dispatch('scrollToResults');
        $this->page = $page;
        $this->results = $this->results->skip($page * $this->paginationNumber);
    }
}

