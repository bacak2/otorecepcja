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

    Route::post('/apartments/save-photos', 'ApartmentsController@savePhotos')->name('apartments.savePhotos');

    Route::get('/apartments/edit/{id}', 'ApartmentsController@edit')->name('apartments.edit');

    Route::get('/apartments/prices/{id}', 'ApartmentsController@prices')->name('apartments.prices');

    Route::get('/complex', 'HomeController@index')->name('complex');

    Route::get('/price-list', 'HomeController@index')->name('price-list');

});