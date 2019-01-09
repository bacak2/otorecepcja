<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'ApartmentsController@index');

    Route::get('/wtf', 'HomeController@index')->name('reservations');

    Route::get('/apartments', 'ApartmentsController@index')->name('apartments');

    Route::get('/apartments/main', 'ApartmentsController@index')->name('apartments.main');

    Route::get('/apartments/new', 'ApartmentsController@newApartment')->name('apartments.new');

    Route::post('/apartments/insert', 'ApartmentsController@insert')->name('apartments.insert');

    Route::post('/apartments/update', 'ApartmentsController@update')->name('apartments.update');

    Route::get('/apartments/photos/{id}', 'ApartmentsController@photos')->name('apartments.photos');

    Route::get('/apartments/photos/new/{id}', 'ApartmentsController@newPhotos')->name('apartments.photosNew');

    Route::post('/apartments/photos/{id}/upload', 'ApartmentsController@uploadPhotos')->name('apartments.uploadPhotos');

    Route::post('/apartments/save-photos', 'ApartmentsController@savePhotos')->name('apartments.savePhotos');

    Route::get('/apartments/edit/{id}', 'ApartmentsController@edit')->name('apartments.edit');

    Route::get('/apartments/prices/{id}', 'ApartmentsController@prices')->name('apartments.prices');

    Route::get('/complex', 'ComplexesController@index')->name('complex');

    Route::get('/complex/main', 'ComplexesController@index')->name('complex.main');

    Route::get('/complex/new', 'ComplexesController@newApartment')->name('complex.new');

    Route::post('/complex/insert', 'ComplexesController@insert')->name('complex.insert');

    Route::post('/complex/update', 'ComplexesController@update')->name('complex.update');

    Route::get('/complex/photos/{id}', 'ComplexesController@photos')->name('complex.photos');

    Route::get('/complex/photos/new/{id}', 'ComplexesController@newPhotos')->name('complex.photosNew');

    Route::post('/complex/save-photos', 'ComplexesController@savePhotos')->name('complex.savePhotos');

    Route::get('/complex/edit/{id}', 'ComplexesController@edit')->name('complex.edit');

    Route::get('/complex/prices/{id}', 'ComplexesController@prices')->name('complex.prices');
    
});