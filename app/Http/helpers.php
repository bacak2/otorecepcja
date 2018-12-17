<?php
use Illuminate\Support\Facades\DB;

function getLinks(){

    return array(
        'reservations' => 'Rezerwacje',
        'apartments' => 'Apartamenty',
        'complex' => 'Kompleksy apartamentów',
        'price-list' => 'Cenniki'
    );

}

function apartaments_cities(){
    return DB::table('apartament_cities')
        ->pluck('city', 'city');
}

function apartaments_districts(){
    return DB::table('apartament_districts')
        ->pluck('district', 'district');
}

function apartament_other_equipments(){

     return DB::table('apartament_other_equipments')
        ->where('language_id', 1)
        ->whereIn('equipment_id', [3,4,5,6,7])
        ->pluck('equipment_name', 'equipment_id');

}

function apartament_other_bathroom_equipments(){

     return DB::table('apartament_other_equipments')
        ->where('language_id', 1)
        ->whereIn('equipment_id', [1,2])
        ->pluck('equipment_name', 'equipment_id');

}

function apartament_cookers(){

     return DB::table('apartament_other_equipments')
        ->where('language_id', 1)
        ->whereIn('equipment_id', [8,9])
        ->pluck('equipment_name', 'equipment_id');

}