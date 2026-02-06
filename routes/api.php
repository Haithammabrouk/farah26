<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Organized API routes using dedicated controllers for each feature.
| All existing endpoint URLs remain unchanged - only backend organization improved.
|
*/

// Trip Management Routes
Route::get('trips', 'API\V1\TripController@index');
Route::get('additionalTrips', 'API\V1\TripController@allAdditionalTrips');
Route::get('tripAdditionals/{tripId}', 'API\V1\TripController@additionals');
Route::get('getReserved/{tripId}', 'API\V1\TripController@cabinAvailability');

// Reservation Routes
Route::post('addReservation', 'API\V1\ReservationController@store');
Route::get('getCheckout/{reservationId}', 'API\V1\ReservationController@checkout');
Route::post('paymentResponse', 'API\V1\ReservationController@paymentResponse');

// Content Routes
Route::get('gallery', 'API\V1\ContentController@galleries');
Route::get('facilities', 'API\V1\ContentController@facilities');
Route::get('infos', 'API\V1\ContentController@infos');
Route::get('itineraries', 'API\V1\ContentController@itineraries');
Route::get('pages/{id}', 'API\V1\ContentController@page');
Route::get('decks', 'API\V1\ContentController@decks');
Route::get('homePage', 'API\V1\ContentController@homepage');

// Contact & Newsletter Routes
Route::post('contactus', 'API\V1\ContactController@submitContact');
Route::post('newsletter', 'API\V1\ContactController@subscribe');

// Utility Routes
Route::get('countries', 'API\V1\UtilityController@countries');
Route::get('metas', 'API\V1\UtilityController@metas');
Route::get('closedDates', 'API\V1\UtilityController@closedDates');
Route::get('apply-coupon/{coupon}/{trip_id}/{user_mobile}', 'API\V1\UtilityController@applyCoupon');

Route::group(['middleware' => ['auth:api']], function () {
//  Route::post('refresh', 'HomeController@refresh');
});


// Route::get('mail', function () {
// // 	Mail::to('user@email.com')->send(new \App\Mail\ReservationBooked());

// 	return 'hiii';
// });
