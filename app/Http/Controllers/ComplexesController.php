<?php

namespace App\Http\Controllers;

use App\Apartments;
use Illuminate\Http\Request;
use App\Complexes;
use App\Http\Requests\Complex;

class ComplexesController extends MenuController
{
    protected $activeSubmenu;
    protected $menu;
    protected $submenu;

    public function __construct(){
        $this->setMenuName('complex');
        $this->setSubmenuArray(array(
            'main' => 'Lista',
            'new' => 'Dodaj nowy',
        ));
    }

    public function index(){

        $this->setActiveSubmenu('main');

        $complexes = new Complexes();
        $complexes = $complexes->mainList();

        return view('complex.index', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'apartments' => $complexes,
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

        $mainPhotoId = $apartment->apartmentMainPhoto($id);

        return view('apartments.photos', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'photos' => $photos,
            'apartmentId' => $id,
            'mainPhotoId' => $mainPhotoId,
        ]);

    }

    /*
     * Save photos
     */
    public function savePhotos(Request $request){

        $newMainPhotoId = $request->mainPhoto;
        $apartmentId = $request->apartmentId;

        $apartment = new Apartments();
        $changedMainImg = $apartment->checkMainImgChanged($newMainPhotoId, $apartmentId);
        $mainImgLink = $apartment->getMainImgLink($newMainPhotoId, $apartmentId);

        $apartment->saveApartmentPhotos($request);
        $apartment->changeMainImg($mainImgLink, $apartmentId);

        if($changedMainImg){
            //resize and replace main img
            $apartment->resizeMainImg($mainImgLink, $apartmentId);
        }

        return redirect()->route("apartments.main");
    }

    public function newPhotos(){

        return view('apartments.photos-new', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
        ]);

    }

    public function prices($id){

        $apartment = new Apartments();
        $prices = $apartment->apartmentPrices($id);

        return view('apartments.prices', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'prices' => $prices,
            'apartmentId' => $id,
        ]);
    }
}
