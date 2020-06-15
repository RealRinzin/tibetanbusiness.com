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
