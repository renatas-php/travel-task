<?php

namespace App\Models\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
                            'hotel_id',
                            'hotel_name',
                            'hotel_rating',
                            'room_name',
                            'departure_airport',
                            'city_id',
                            'country_name',
                            'operator',
                            'list_updated'
                        ];
}
