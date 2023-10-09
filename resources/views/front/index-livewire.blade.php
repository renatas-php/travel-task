@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('content')
@livewire('travel.search')

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
