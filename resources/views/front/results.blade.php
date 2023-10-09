@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('content')
<div class="min-h-screen px-container py-[100px]">
    <form action="/search" class="flex items-center justify-center flex-col gap-[16px] border-2 border-[#000] p-[32px] rounded-xl m-auto w-fit" method="GET">
        <div class="w-full flex justify-between gap-[32px]">    
            @include('front.includes.elements.select', 
            [
                'label' => 'Šalis', 
                'value' => old('countryId', \App\Helpers\TravelHelper::getCountryNameById(Request()->countryId)), 
                'name' => 'Šalis', 
                'inputName' => 'countryId', 
                'items' => \App\Helpers\TravelHelper::getDestinationsCountries(), 
                'feedback' => true, 
                'class' => 'w-full', 
                'showingValue' => 'title', 
                'inputValue' => 'id',
            ])
            {{--@if($items->count() > 0)
                @include('front.includes.elements.select', 
                [
                    'label' => 'Miestas', 
                    'value' => old('cityId', Request()->cityId), 
                    'name' => 'Miestas', 
                    'inputName' => 'cityId', 
                    'items' => \App\Helpers\TravelHelper::getCitiesByCountry($items), 
                    'feedback' => true, 
                    'class' => 'w-full', 
                    'showingValue' => 'city_name', 
                    'inputValue' => 'city_id',
                ])
            @endif
            @if($items->count() > 0)
                @include('front.includes.elements.select', 
                [
                    'label' => 'Viešbutis', 
                    'value' => old('hotelId', Request()->hotelId), 
                    'name' => 'Viešbutis', 
                    'inputName' => 'hotelId', 
                    'items' => \App\Helpers\TravelHelper::getHotelsByCountry(Request()->dateFrom, Request()->dateTo, Request()->cityId, Request()->countryId, Request()->hotelRating, Request()->durationFrom, Request()->durationTo, Request()->maxResults), 
                    'feedback' => true, 
                    'class' => 'w-full', 
                    'showingValue' => 'hotel_name', 
                    'inputValue' => 'hotel_id',
                ])
            @endif--}}
        </div>
        <div class="w-full flex flex-col md:flex-row justify-between gap-[32px]">
            @include('front.includes.elements.date_input', 
            [
                'label' => 'Kelionės data nuo',
                'inputName' => 'dateFrom',
                'value' => old('dateFrom', Request()->dateFrom),
                'feedback' => true,
            ])
            @include('front.includes.elements.date_input', 
            [
                'label' => 'Kelionės data iki',
                'inputName' => 'dateTo',
                'value' => old('dateTo', Request()->dateTo),
                'feedback' => true,
            ])
        </div>
        <div class="w-full flex flex-col md:flex-row justify-between gap-[32px]">
            @include('front.includes.elements.input', 
            [
                'inputName' => 'durationFrom', 
                'value' => old('durationFrom', Request()->durationFrom), 
                'label' => 'Kelionės trukmė nuo', 
                'placeholder' => 'Įveskite kelionės trukmę nuo', 
                'type' => 'number',
                'min' => 7,
                'max' => 14,
                'feedback' => true,
            ])
            @include('front.includes.elements.input', 
            [
                'inputName' => 'durationTo', 
                'value' => old('durationTo', Request()->durationTo), 
                'label' => 'Kelionės trukmė iki', 
                'placeholder' => 'Įveskite kelionės trukmę iki', 
                'type' => 'number',
                'min' => 7,
                'max' => 14,
                'feedback' => true,
            ])
        </div>
        @include('front.includes.elements.select_array', 
            [
                'label' => 'Viešbučio reitingas', 
                'value' => old('hotelRating', Request()->hotelRating), 
                'name' => 'Viešbučio reitingas', 
                'inputName' => 'hotelRating', 
                'items' => [1,2,3,4,5], 
                'feedback' => true, 
                'class' => 'w-full'
            ])
        <button type="submit" class="rounded-button bg-[#000] text-[#fff] text-[16px] font-medium px-[70px] py-[14px]">Ieškoti</button>
    </form>
    <div class="grid flex-1 grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-[32px] mt-[32px]">
        @forelse($items as $item)
        <a href="##" class="border-2 border-[#000] rounded-xl relative">
            <img src="{{ $item['image'] }}" class="rounded-tl-xl rounded-tr-xl">
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
</div>
<!-- Flatpicker --> 
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="/admin-assets/plugins/flatpicker/flatpicker-lt.js"></script>
<script>
    flatpickr("#dateFrom", {             
        locale: "lt",
        dateFormat: "Y-m-d",
        inline: true,
    });
    flatpickr("#dateTo", {             
        locale: "lt",
        dateFormat: "Y-m-d",
        inline: true,
    });
</script>
@endsection
