<?php

namespace App\Http\Controllers;

use App\Apartments;
use Illuminate\Http\Request;
use App\Apartament;
use App\Http\Requests\Apartment;

class ApartmentsController extends MenuController
{
    protected $activeSubmenu;
    protected $menu;
    protected $submenu;

    public function __construct(){
        $this->setMenuName('apartments');
        $this->setSubmenuArray(array(
            'main' => 'Lista',
            'new' => 'Dodaj nowy',
        ));
    }

    public function index(){

        $this->setActiveSubmenu('main');

        $apartment = new Apartments();
        $apartments = $apartment->mainList();

        return view('apartments.index', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'apartments' => $apartments,
        ]);

    }

    public function newApartment(Request $request){

        $this->setActiveSubmenu('new');

        return view('apartments.form', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'request' => $request,
        ]);

    }

    public function edit($id, Request $request){

        $this->setActiveSubmenu('new');

        $apartment = new Apartments();
        $apartment = $apartment->apartmentToEdit($id);

        return view('apartments.form', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => 'edycja',
            'apartment' => $apartment,
            'request' => $request,
        ]);

    }

    public function insert(Apartment $request){

        $apartment = new Apartments();
        $apartment->saveNew($request);

        return redirect()->route("apartments.main");

    }

    public function update(Apartment $request){

        $apartment = new Apartments();
        $apartment->saveChanges($request);

        return redirect()->route("apartments.main");

    }

    public function photos($id){

        $apartment = new Apartments();
        $photos = $apartment->apartmentPhotos($id);

        return view('apartments.photos', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'photos' => $photos,
            'apartmentId' => $id,
        ]);

    }

    public function savePhotos(Request $request){

        $apartment = new Apartments();
        $photosSaved = $apartment->saveApartmentPhotos($request);

        return redirect()->route("apartments.main");
    }

    public function prices($id){

        $apartment = new Apartments();
        $prices = $apartment->apartmentPrices($id);
        //dd($prices);

        return view('apartments.prices', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'prices' => $prices,
            'apartmentId' => $id,
        ]);
    }
}
