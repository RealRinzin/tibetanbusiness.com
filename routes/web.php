<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Middleware Auth
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard',function(){
        return view('dashboard');
    })->name('dashboard');

    /*  */
    /**
     * Authentications
     * Dashboard 
     * Route Grouping
     *  */
    Route::prefix('dashboard')->group(function () {
        // RESTAURANT
        Route::get('restaurant', function () {
            // Matches The "/admin/users" URL
            return view('dashboard.Restaurant.index');
        })->name('dashboard.restaurant');
        Route::get('restaurant/edit/id={id}','Restaurant\RestaurantBasicInfoController@restaurant_edit');

        // RENT
        Route::get('rent', function(){
            return view('dashboard.Rent.index');
        })->name('dashboard.rent');
        Route::get('rent/edit/id={id}', 'Rent\RentBasicInfoController@rent_edit');

        // JOB
        Route::get('job',function(){
            return view('dashboard.Job.index');
        })->name('dashboard.job');
        Route::get('job/edit/id={id}', 'Job\JobBasicInfoController@job_edit');
        // EVENT
        Route::get('event', function () {
            return view('dashboard.Event.index');
        })->name('dashboard.event');
        Route::get('event/edit/id={id}', 'Event\EventBasicInfoController@event_edit');

        // Sale
        Route::get('sale', function () {
            return view('dashboard.Sale.index');
        })->name('dashboard.sale');
        Route::get('sale/edit/id={id}', 'Sale\SaleBasicInfoController@sale_edit');
        // Service
        Route::get('service', function () {
            return view('dashboard.Service.index');
        })->name('dashboard.service');
        Route::get('service/edit/id={id}', 'Service\ServiceBasicInfoController@service_edit');



    });
    // Route::get('user/restaurants','Restaurant\RestaurantBasicInfoController@user_restaurant');
});

// Check User status
Route::get('login_status', 'HomeController@login_status');
// Socialite
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

// Other route
Route::get('/home', 'HomeController@index')->name('home');
// Route::resource('restaurant','Restaurant\RestaurantBasicInfoController');
/**
 * Restaurant Route
 *  */ 
Route::get('restaurant/{id}', 'Restaurant\RestaurantBasicInfoController@restaurant');
Route::get('view/restaurant/{id}', 'Restaurant\RestaurantBasicInfoController@view');

/**
 * Rent View / Show
 *  */ 
Route::get('rent/{id}','Rent\RentBasicInfoController@view');


/**
 * Job View / Show
 *  */
Route::get('job/{id}', 'Job\JobBasicInfoController@view');
/**
 * Event
 * View/ Show Page
 *  */  
Route::get('event/{id}', 'Event\EventBasicInfoController@view');

/**
 * Event
 * View/ Show Page
 *  */
Route::get('sale/{id}', 'Sale\SaleBasicInfoController@view');
Route::get('service/{id}', 'Service\ServiceBasicInfoController@view');

/**
 * 
 * Search 
 * Result
 * Restaurant / Service /Event
 * 
 *  */ 
Route::prefix('search')->group(function () {
    // Route::get('restaurant', function () {
    //     // Matches The "/admin/users" URL
    //     return view('dashboard.Restaurant.index');
    // })->name('dashboard.restaurant');
    // Route::get('{type}/{location?}', 'Restaurant\RestaurantBasicInfoController@search');
    Route::get('{type}', function($type){
        if($type !== null){
            // return $type;
            if($type === 'restaurants'){
                return view('restaurant.search');
            }elseif ($type === 'events') {
            } elseif ($type === 'rents') {
                return view('rent.search');
            } elseif ($type === 'services') {
                return $type;
            } elseif ($type === 'jobs') {
                return $type;
            } elseif ($type === 'sales') {
                return $type;
            }
        }
        // return $type;
    });
});