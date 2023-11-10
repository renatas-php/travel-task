@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <form action="/search" class="flex items-center justify-center flex-col gap-[16px] border-2 border-[#000] p-[32px] rounded-xl" method="GET">
        <div class="w-full flex justify-between gap-[32px]">    
            @include('front.includes.elements.select', 
            [
                'label' => 'Šalis', 
                'value' => old('countryId'), 
                'name' => 'Šalis', 
                'inputName' => 'countryId', 
                'items' => \App\Helpers\TravelHelper::getDestinationsCountries(), 
                'feedback' => true, 
                'class' => 'w-full', 
                'showingValue' => 'title', 
                'inputValue' => 'id',
            ])
            {{--@include('front.includes.elements.select_country', 
            [
                'label' => 'Miestas', 
                'value' => old('cityId'), 
                'name' => 'Miestas', 
                'inputName' => 'cityId', 
                'items' => \App\Helpers\TravelHelper::getDestinations(), 
                'feedback' => true, 
                'class' => 'w-full', 
                'showingValue' => 'full_name', 
                'showingValueSecond' => 'title', 
                'inputValue' => 'city',
                'inputValueSecond' => 'id'
            ])--}}
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
        @include('front.includes.elements.select_array', ['label' => 'Viešbučio reitingas', 'value' => old('hotelRating'), 'name' => 'Viešbučio reitingas', 'inputName' => 'hotelRating', 'items' => [1,2,3,4,5,6,7,8,9,10], 'feedback' => true, 'class' => 'w-full'])
        <button type="submit" class="rounded-button bg-[#000] text-[#fff] text-[16px] font-medium px-[70px] py-[14px]">Ieškoti</button>
    </form>
</div>
<!-- Flatpicker --> 
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="/admin-assets/plugins/flatpicker/flatpicker-lt.js"></script>
<script>
    flatpickr("#dateFrom", {             
        locale: "lt",
        dateFormat: "Y-m-d",
    });
    flatpickr("#dateTo", {             
        locale: "lt",
        dateFormat: "Y-m-d",
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function(){
        var getCountries = document.querySelectorAll('.country-value');

        /*jQuery('.country-value').each(function(e){

            jQuery(this).on('click', function(e){

                var countryId = jQuery(this).val();

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/getCities') }}" + '/' + countryId,
                    method: 'get',
                    success: function(result){
                        console.log(result)
                        
                    }
                });
            });        
        });*/
    });
</script>
@endsection
