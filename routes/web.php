<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('reservations');

    Route::get('/apartments', 'ApartmentsController@index')->name('apartments');

    Route::get('/apartments/main', 'ApartmentsController@index')->name('apartments.main');

    Route::get('/apartments/new', 'ApartmentsController@newApartment')->name('apartments.new');

    Route::post('/apartments/insert', 'ApartmentsController@insert')->name('apartments.insert');

    Route::post('/apartments/update', 'ApartmentsController@update')->name('apartments.update');

    Route::get('/apartments/photos/{id}', 'ApartmentsController@photos')->name('apartments.photos');

    Route::post('/apartments/save-photos', 'ApartmentsController@savePhotos')->name('apartments.savePhotos');

    Route::get('/apartments/edit/{id}', 'ApartmentsController@edit')->name('apartments.edit');

    Route::get('/complex', 'HomeController@index')->name('complex');

    Route::get('/price-list', 'HomeController@index')->name('price-list');

});