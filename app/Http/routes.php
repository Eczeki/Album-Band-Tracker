<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * ======== Start Bands ======== 
 */

/**
 * Display All Bands
 */
Route::get('/', 'Band\BandController@bandsIndex')
        ->name('home');

/**
 * Add A New Band
 */
Route::get('/band/create', 'Band\BandController@createBand')
        ->name('band.create');

/**
 * Edit A Band
 */
Route::get('/band/edit/{id}', 'Band\BandController@editBand')
        ->name('band.edit');

/**
 * Store A Band
 */
Route::post('/band/store', 'Band\BandController@storeBand')
        ->name('band.store');

/**
 * Update A Band
 */
Route::post('/band/update/{id}', 'Band\BandController@updateBand')
        ->name('band.update');

/**
 * Delete An Existing Band
 */
Route::get('/band/delete/{id}', 'Band\BandController@deleteBand')
        ->name('band.delete');
/**
 * ======== End Bands ======== 
 */

/**
 * ======== Start Albums ======== 
 */

/**
 * Display all Albums
 */
Route::get('/albums', 'Band\AlbumController@albumIndex')
        ->name('album.home');

/**
 * Add A New Album
 */
Route::get('/album/create', 'Band\AlbumController@createAlbum')
        ->name('album.create');

/**
 * Edit An Album
 */
Route::get('/album/edit/{id}', 'Band\AlbumController@editAlbum')
        ->name('album.edit');

/**
 * Store An Album
 */
Route::post('/album/store', 'Band\AlbumController@storeAlbum')
        ->name('album.store');

/**
 * Update An Album
 */
Route::post('/album/update/{id}', 'Band\AlbumController@updateAlbum')
        ->name('album.update');

/**
 * Delete An Existing Album
 */
Route::get('/album/delete/{id}', 'Band\AlbumController@deleteAlbum')
        ->name('album.delete');
/**
 * ======== End Albums ======== 
 */