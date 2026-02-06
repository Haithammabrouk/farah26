<?php

use Illuminate\Support\Facades\Route;

Route::get('trips', 'HomeController@trips');
Route::get('additionalTrips', 'HomeController@additionalTrips');
Route::get('tripAdditionals/{tripId}', 'HomeController@tripAdditionals');
Route::get('countries', 'HomeController@countries');
Route::get('getReserved/{tripId}', 'HomeController@getReserved');
Route::post('addReservation', 'HomeController@addReservation');
Route::get('gallery', 'HomeController@gallery');
Route::post('contactus', 'HomeController@contactus');
Route::post('newsletter', 'HomeController@newsletter');
Route::get('facilities', 'HomeController@facilities');
Route::get('infos', 'HomeController@infos');
Route::get('itineraries', 'HomeController@itineraries');
Route::get('pages/{id}', 'HomeController@pages');
Route::get('decks', 'HomeController@decks');
Route::get('homePage', 'HomeController@homePage');
Route::get('metas', 'HomeController@metas');
Route::get('closedDates', 'HomeController@closedDates');



Route::post('paymentResponse', 'HomeController@paymentResponse');
Route::get('getCheckout/{reservationId}', 'HomeController@getCheckout');

Route::get('apply-coupon/{coupon}/{trip_id}/{user_mobile}' , 'HomeController@applyCoupon');


Route::group(['middleware' => ['auth:api']], function () {
// 	Route::post('refresh', 'HomeController@refresh');
});


// Route::get('mail', function () {
// // 	Mail::to('user@email.com')->send(new \App\Mail\ReservationBooked());

// 	return 'hiii';
// });
