<div class="min-h-screen flex flex-col gap-[50px] items-center justify-center">
    <form id="searchForm" class="flex items-center justify-center flex-col gap-[16px] border-2 border-[#000] p-[32px] rounded-xl mt-[64px]" x-data="{ scroll: () => { $el.scrollTo(0, $el.scrollHeight); } }">
        <div class="w-full flex justify-between gap-[32px]"> 
            @include('front.includes.elements.livewire.select', 
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
            ])
            @if($showCitySelection == true)
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
        <div class="w-full flex justify-between gap-[32px]">
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
        <div class="w-full flex justify-between gap-[32px]">
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
        @if($showHotelSelection == true && $hotels->count())
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
        @endif
        <button type="button" wire:click="updateSearch" class="rounded-button bg-[#000] text-[#fff] text-[16px] font-medium px-[70px] py-[14px]">
            <span class="block" wire:loading.class="hidden">Ieškoti</span>
            <div wire:loading wire:target="updateSearch">
                Ieškoma pasiūlymų...
            </div>
        </button>
    </form>
    <div class="grid flex-1 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-[32px] mt-[32px] px-container" id="results">
        @forelse($results as $item)
        <a href="##" class="border-2 border-[#000] rounded-xl relative">
            <img src="{{ $item['image'] }}" class="rounded-tl-xl rounded-tr-xl" loading="lazy" width="500" height="400">
            <div class="absolute top-[32px] right-[16px] bg-[#1e90ff] rounded-full text-[18px] h-[60px] w-[60px] text-[#fff] flex items-center justify-center font-bold">{{ $item['duration'] . 'd.' }}</div>
            <div class="flex flex-col gap-[4px] p-16px">
                <div class="flex justify-between w-full gap-[32px]">
                    <div class="flex flex-col gap-[0px]">
                        <div class="flex gap-[8px]">
                            <p class="font-semibold text-[16px]">{{ $item['hotel_name'] }}</p>
                            <span class="rounded-full h-[20px] w-[20px] flex justify-center items-center bg-[#ffe600] text-[14px]">{{ $item['hotel_rating'] }}</span>
                        </div>
                        <span class="text-[14px]">{{ 'Nuo ' . $item['date'] }}</span>
                    </div>
                    <span class="text-[40px] font-semibold">{{ $item['price'] }}</span>
                </div>
                <p class="">{{ $item['city_name'] . ', ' . $item['country_name'] }}</p>
            </div>
        </a>
        @empty 
        @endforelse
    </div>
    <script>
        window.addEventListener('scrollToResults', event => {
            let resultsDiv = document.getElementById('results');
            resultsDiv.scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</div>
