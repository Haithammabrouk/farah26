<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanel\ReservationController;
/*
|--------------------------------------------------------------------------
| Builder Generator Routes
|--------------------------------------------------------------------------
*/


///////////////////////////////////////////////////////////////////////////
///								end builder routes 						///
///////////////////////////////////////////////////////////////////////////


/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'adminPanel', 'namespace' => 'AdminPanel', 'as' => 'adminPanel.'], function () {
    
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/postLogin', 'AuthController@postLogin')->name('postLogin');
    Route::get('logout', 'AuthController@logout')->name('logout');
    
    

    Route::group(['middleware' => ['auth:admin', 'permissionHandler']], function () {
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');

        // Roles CRUD
        Route::resource('roles', 'RolesController');
        Route::get('updatePermissions', 'RolesController@updatePermissions')->name('roles.updatePermissions');

        // Admins CRUD
        Route::resource('admins', 'AdminController');

        // Pages CRUD
        Route::resource('pages', 'PageController');
        
         // coupons
        Route::get('coupons' , 'CouponController@index')->name('coupon');
        Route::get('create-coupons' , 'CouponController@add')->name('coupon.create');
        Route::post('store-coupons' , 'CouponController@store')->name('coupon.store');
        Route::get('edit-coupons/{id}' , 'CouponController@edit')->name('coupon.edit');
        Route::post('update-coupons/{id}' , 'CouponController@update')->name('coupon.update');
        Route::post('destroy-coupons/{id}' , 'CouponController@destroy')->name('coupon.destroy');

        // Country CRUD
        Route::resource('countries', 'CountryController');

        // CkEditor Upload Image By Ajax
        Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

        // File Manager CRUD
        Route::resource('files', 'FileController');

        // User CRUD
        Route::resource('users', 'UserController')->only(['index', 'show', 'destroy']);

        // TripCategory CRUD
        Route::resource('tripCategories', 'TripCategoryController');

        // Trip CRUD
        Route::resource('trips', 'TripController');

        // Reservation CRUD
        Route::resource('reservations', 'ReservationController');

        // AdditionalTrip CRUD
        Route::resource('additionalTrips', 'AdditionalTripController');

        // Gallery CRUD
        Route::resource('galleries', 'GalleryController');

        // Gallery Photo CRUD
        Route::resource('galleryPhotos', 'GalleryPhotoController');

        // Contactus CRUD
        Route::resource('contactuses', 'ContactusController');

        // Facility CRUD
        Route::resource('facilities', 'FacilityController');

        // Info CRUD
        Route::resource('infos', 'InfoController');

        // Itinerary CRUD
        Route::resource('itineraries', 'ItineraryController');

        // Itinerary Detail CRUD
        Route::resource('itineraryDetails', 'ItineraryDetailController');

        // Newsletter CRUD
        Route::resource('newsletters', 'NewsletterController');

        // ReservedAdditionalTrip CRUD
        // Route::resource('reservedAdditionalTrips', 'ReservedAdditionalTripController');

        // Decks CRUD
        Route::resource('decks', 'DeckController');

        // AdditionalTripPhotos CRUD
        Route::resource('additionalTripsPhotos', 'AdditionalTripsPhotosController');

        // FacilityPhotosPhotos CRUD
        // Route::resource('facilityPhotos', 'FacilityPhotoController');

        // Partners CRUD
        Route::resource('partners', 'PartnerController');

        //Unique CRUD
        Route::resource('uniques', 'UniqueController');

        //Tripadvisor CRUD
        Route::resource('tripadvisors', 'TripadvisorController');

        //SliderPhoto CRUD
        Route::resource('sliderPhotos', 'SliderPhotoController');

        //Meta CRUD
        Route::resource('metas', 'metaController');

        //Reports
        Route::get('reports', 'ReportController@index')->name('reports.index');
        Route::get('reports/export-statistics', 'ReportController@exportStatistics')->name('reports.exportStatistics');
        Route::get('reports/export-reservations', 'ReportController@exportReservations')->name('reports.exportReservations');
        Route::get('reports/export-users', 'ReportController@exportUsers')->name('reports.exportUsers');

        //Closed Dates CRUD
        Route::resource('closedDates', 'ClosedDatesController');
    });
});

// [ReservationController::class , 'destroy']
Route::get('delete-reservations/{id}', [ReservationController::class , 'destroy'] )->name('deletereservations');

///////////////////////////////////////////////////////////////////////////
///								end admin panel routes 					///
///////////////////////////////////////////////////////////////////////////


/*
|--------------------------------------------------------------------------
| WebSite Routes
|--------------------------------------------------------------------------
*/

 Route::get('/test', function () {
    return view('adminPanel.additional_trips.index');
});

Route::get('/', 'HomeController@index');

///////////////////////////////////////////////////////////////////////////
///								end website routes  					///
///////////////////////////////////////////////////////////////////////////

