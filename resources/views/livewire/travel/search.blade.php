<div class="min-h-screen flex flex-col gap-[50px] items-center">
    <form id="searchForm" class="flex items-center justify-center flex-col gap-[16px] border-2 border-[#000] p-[32px] rounded-xl mt-[64px]">
        <div class="w-full flex justify-between gap-[32px] relative" x-data="{ clickedCountry: false, clickedHotel: false, country: '', hotel: '' }"> 
            <div class="w-full m-auto" @click="clickedCountry = true" @click.away="clickedCountry = false">
                <label class="px-4 block mb-2 font-medium">Kryptis</label>
                <div class="border-2 border-[#000] rounded-xl w-full h-14 ">
                    <input type="text" wire:model.live="country" x-model="country" value="{{ $country }}" placeholder="Įveskite kryptį" class="font-medium w-full h-full bg-transparent px-4 focus:input-focus-shadow rounded-xl focus:outline-none transition-all">
                </div>    
                @error('countryId')
                    <span class="invalid-feedback mt-[8px]" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror            
            </div>
            @if($countries)
            <div class="absolute top-[100px] z-10 border-2 border-[#000] rounded-xl w-full bg-[#fff] max-h-[500px] overflow-y-scroll" x-show="clickedCountry">
                <ul class="py-[16px] px-[16px]">
                    @forelse($countries as $entity)
                    <li class="relative pb-[8px] last:pb-[0px]">
                        <p class="font-medium">{{ $entity['title'] }}</p>
                        <input type="radio" @click="country = '{{ $entity['title'] }}'" wire:key="{{ $entity['id'] }}" wire:model="countryId" name="countryId" value="{{ $entity['id'] }}" class="w-full h-full absolute top-0 left-0 opacity-0 cursor-pointer" >
                    </li>
                    @empty 
                    @endforelse
                </ul>
            </div>
            @endif
            <div class="w-full m-auto" @click="clickedHotel = true" @click.away="clickedHotel = false">
                <label class="px-4 block mb-2 font-medium">Viešbutis</label>
                <div class="border-2 border-[#000] rounded-xl w-full h-14 ">
                    <input type="text" wire:model.live="hotel" x-model="hotel" value="{{ $hotel }}" placeholder="Įveskite viešbuti" class="font-medium w-full h-full bg-transparent px-4 focus:input-focus-shadow rounded-xl focus:outline-none transition-all">
                </div>
            </div>
            @if($hotels)
            <div class="absolute top-[100px] z-10 border-2 border-[#000] rounded-xl w-full bg-[#fff] max-h-[500px] overflow-y-scroll" x-show="clickedHotel">
                <ul class="py-[16px] px-[16px]">
                    @forelse($hotels as $entity)
                    <li class="relative pb-[8px]">
                        <p class="font-medium">{{ $entity['hotel_name'] }}</p>
                        <input type="radio" @click="hotel = '{{ $entity['hotel_name'] }}'" wire:key="{{ $entity['id'] }}" wire:model="hotelId" name="hotelId" value="{{ $entity['hotel_id'] }}" class="w-full h-full absolute top-0 left-0 opacity-0 cursor-pointer" >
                    </li>
                    @empty 
                    @endforelse
                </ul>
            </div>
            @endif
            {{--@include('front.includes.elements.livewire.select', 
            [
                'label' => 'Šalis', 
                'value' => old('countryId'), 
                'name' => 'Šalis', 
                'inputName' => 'countryId', 
                'items' => $countries, 
                'feedback' => true, 
                'class' => 'w-full', 
                'showingValue' => 'title', 
                'inputValue' => 'id',
            ])--}}
            @if($showCitySelection == true && $cities)
                @include('front.includes.elements.livewire.select', 
                [
                    'label' => 'Miestas', 
                    'value' => old('cityId'), 
                    'name' => 'Miestas', 
                    'inputName' => 'cityId', 
                    'items' => $cities, 
                    'feedback' => true, 
                    'class' => 'w-full', 
                    'showingValue' => 'city_name', 
                    'inputValue' => 'city_id',
                ])
            @endif
        </div>
        <div class="w-full flex flex-col md:flex-row justify-between gap-[32px]">
            @include('front.includes.elements.livewire.date_input', 
            [
                'label' => 'Kelionės data nuo',
                'inputName' => 'dateFrom',
                'value' => old('dateFrom', $dateFrom),
                'feedback' => true,
            ])
            @include('front.includes.elements.livewire.date_input', 
            [
                'label' => 'Kelionės data iki',
                'inputName' => 'dateTo',
                'value' => old('dateTo', $dateTo),
                'feedback' => true,
            ])
        </div>
        <div class="w-full flex flex-col md:flex-row justify-between gap-[32px]">
            @include('front.includes.elements.livewire.input', 
            [
                'inputName' => 'durationFrom', 
                'value' => old('durationFrom'), 
                'label' => 'Kelionės trukmė nuo', 
                'placeholder' => 'Įveskite kelionės trukmę nuo', 
                'type' => 'number',
                'min' => 7,
                'max' => 14,
                'feedback' => true
            ])
            @include('front.includes.elements.livewire.input', 
            [
                'inputName' => 'durationTo', 
                'value' => old('durationTo'), 
                'label' => 'Kelionės trukmė iki', 
                'placeholder' => 'Įveskite kelionės trukmę iki', 
                'type' => 'number',
                'min' => 7,
                'max' => 14,
                'feedback' => true
            ])
        </div>
        @include('front.includes.elements.livewire.select_array', 
        [
            'label' => 'Viešbučio reitingas', 
            'value' => old('hotelRating'), 
            'name' => 'Viešbučio reitingas', 
            'inputName' => 'hotelRating', 
            'items' => [1,2,3,4,5], 
            'feedback' => true, 
            'class' => 
            'w-full'
        ])
        {{--@if($showHotelSelection == true && $hotels->count())
            @include('front.includes.elements.livewire.select', 
            [
                'label' => 'Viešbutis', 
                'value' => old('hotelId'), 
                'name' => 'Viešbutis', 
                'inputName' => 'hotelId', 
                'items' => $hotels, 
                'feedback' => true, 
                'class' => 'w-full', 
                'showingValue' => 'hotel_name', 
                'inputValue' => 'hotel_id',
            ])
        @endif--}}
        <button type="button" wire:click="updateSearch" class="rounded-button bg-[#000] text-[#fff] text-[16px] font-medium px-[70px] py-[14px]">
            <span class="block" wire:loading.class="hidden" wire:target="updateSearch">Ieškoti</span>
            <div wire:loading wire:target="updateSearch">
                Ieškoma pasiūlymų...
            </div>
        </button>
    </form>
    @if($results)
    <div class="grid flex-1 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-[32px] mt-[32px] px-container-mobile md:px-container" wire:loading.class="hidden" wire:target="goToPage" id="results">
        @forelse($results->take(40) as $item)
        <a href="{{ $item['link'] }}" target="_blank" class="border-2 border-[#000] rounded-xl relative">
            <img src="{{ $item['image'] }}" class="rounded-tl-xl rounded-tr-xl" loading="lazy" width="500" height="400">
            <div class="absolute top-[32px] right-[16px] bg-[#1e90ff] rounded-full text-[18px] h-[60px] w-[60px] text-[#fff] flex items-center justify-center font-bold">{{ $item['duration'] . 'd.' }}</div>
            <div class="flex flex-col gap-[4px] p-16px">
                <div class="flex flex-col justify-between w-full gap-[10px]">
                    <div class="flex flex-col gap-[0px]">
                        <div class="flex gap-[8px] justify-between">
                            <p class="font-semibold text-[16px]">{{ $item['hotel_name'] }}</p>
                            <span class="rounded-full h-[20px] w-[20px] flex justify-center items-center bg-[#ffe600] text-[14px]">{{ $item['hotel_rating'] }}</span>
                        </div>
                        <span class="text-[14px]">{{ 'Nuo ' . $item['date'] }}</span>
                    </div>
                    <div class="flex flex-col leading-[35px]">
                        <div class="flex justify-between gap-[10px]">
                            <span class="text-[14px]">Kaina asmeniui:</span>
                            <span class="text-[40px] font-semibold">{{ \App\Helpers\TravelResultsHelper::formatPrice($item['price_before_per_person'], '€') }}</span>
                        </div>
                        <div class="flex justify-between gap-[10px]">
                            <span class="text-[14px]">Bendra kaina:</span>
                            <span class="text-[18px] font-semibold">{{ \App\Helpers\TravelResultsHelper::formatPrice($item['price_before'], '€') }}</span>
                        </div>
                    </div>
                </div>
                <p class="">{{ $item['room_name'] . ', ' . \App\Helpers\TravelApiHelper::getMealsInText($item['meal_group_id']) }}</p>
                <p class="">{{ $item['city_name'] . ', ' . $item['country_name'] }}</p>
                <p class="">{{ ucfirst($item['operator']) }}</p>
            </div>
        </a>
        @empty 
        @endforelse
    </div>
    <div class="" wire:loading wire:target="goToPage"><span class="loader"></span></div>
    <div class="flex gap-[8px] flex-wrap px=container-mobile md:px-container pb-[64px] justify-center">
        @for($i = 1; $i <= $paginationPages; $i++)
        <button class="rounded-full h-[40px] w-[40px] border-2 border-[#000] @if($page == $i) bg-[#000] text-[#fff] @endif" type="button" wire:click="goToPage('{{ $i }}')">{{ $i }}</button>
        @endfor
    </div>
    {{--@elseif(empty($results) && $countryId)
        <div class="text-[30px] font-semibold">Pasiūlymų nerasta</div>--}}
    @endif
    <script>
        window.addEventListener('scrollToResults', event => {
            let resultsDiv = document.getElementById('results');
            resultsDiv.scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</div>
