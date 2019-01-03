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

        $complex = new Complexes();
        $availableApartments = $complex->availableApartments([0]);
        //dd($availableApartments);

        return view('complex.form', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'request' => $request,
            'availableApartments' => $availableApartments,
            'selectedApartments' => null,
        ]);

    }

    public function edit($id, Request $request){

        $this->setActiveSubmenu('new');

        $complex = new Complexes();
        $complexToEdit = $complex->apartmentToEdit($id);
        $availableApartments = $complex->availableApartments([$id, 0]);
        $selectedApartments = $complex->selectedApartments($id);
        $mergedIds = $complex->allApartmentIds($id);
        $mergedIds = implode(', ', $mergedIds);

        return view('complex.form', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => 'edycja',
            'apartment' => $complexToEdit,
            'request' => $request,
            'availableApartments' => $availableApartments,
            'selectedApartments' => $selectedApartments,
            'mergedIds' => $mergedIds,
        ]);

    }

    public function insert(Complex $request){

        $apartment = new Complexes();
        $apartment->saveNew($request);

        return redirect()->route("complex.main");

    }

    public function update(Complex $request){

        $apartment = new Complexes();
        $apartment->saveChanges($request);

        return redirect()->route("complex.main");

    }

    public function photos($id){

        $apartment = new Complexes();
        $photos = $apartment->apartmentPhotos($id);

        $mainPhotoId = $apartment->apartmentMainPhoto($id);

        return view('complex.photos', [
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

        $apartment = new Complexes();
        $changedMainImg = $apartment->checkMainImgChanged($newMainPhotoId, $apartmentId);
        $mainImgLink = $apartment->getMainImgLink($newMainPhotoId, $apartmentId);

        $apartment->saveApartmentPhotos($request);
        $apartment->changeMainImg($mainImgLink, $apartmentId);

        if($changedMainImg){
            //resize and replace main img
            $apartment->resizeMainImg($mainImgLink, $apartmentId);
        }

        return redirect()->route("complex.main");
    }

    public function newPhotos(){

        return view('complex.photos-new', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
        ]);

    }

    public function prices($id){

        $apartment = new Complexes();
        $prices = $apartment->apartmentPrices($id);

        return view('complex.prices', [
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'activeSubmenu' => $this->activeSubmenu,
            'prices' => $prices,
            'apartmentId' => $id,
        ]);
    }
}
