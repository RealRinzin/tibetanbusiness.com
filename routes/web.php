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

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    MetaTag::set('title', 'Tibetanbusiness.com Find the best Tibetan Restaurants,Rents, Events and Deals in India');
    MetaTag::set('description', 'Find the best Tibetan Restaurants,Rents, Events and Deals in India');
    MetaTag::set('image', asset('/img/home-tibetanbusiness.jpg'));
    return view('welcome');
});

Auth::routes();
// Middleware Auth
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard',function(){
        return view('dashboard.index');
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
            MetaTag::set('title', 'Add New Restaurants - Tibetanbusiness.com');

            return view('dashboard.restaurant.index');
        })->name('dashboard.restaurant');
        Route::get('restaurant/edit/id={id}','Restaurant\RestaurantBasicInfoController@restaurant_edit');

        // RENT
        Route::get('rent', function(){
            MetaTag::set('title', 'Add New Rents - Tibetanbusiness.com');

            return view('dashboard.rent.index');
        })->name('dashboard.rent');
        Route::get('rent/edit/id={id}', 'Rent\RentBasicInfoController@rent_edit');

        // JOB
        Route::get('announcement',function(){
            MetaTag::set('title', 'Add New Jobs - Tibetanbusiness.com');
            return view('dashboard.job.index');
        })->name('dashboard.job');
        Route::get('announcement/edit/id={id}', 'Job\JobBasicInfoController@job_edit');
        // EVENT
        Route::get('event', function () {
            MetaTag::set('title', 'Add New Evenrts - Tibetanbusiness.com');

            return view('dashboard.event.index');
        })->name('dashboard.event');
        Route::get('event/edit/id={id}', 'Event\EventBasicInfoController@event_edit');

        // Sale
        Route::get('sale', function () {
            MetaTag::set('title', 'Add New Sales - Tibetanbusiness.com');
            return view('dashboard.sale.index');
        })->name('dashboard.sale');
        Route::get('sale/edit/id={id}', 'Sale\SaleBasicInfoController@sale_edit');
        // Service
        Route::get('service', function () {
            MetaTag::set('title', 'Add New Services - Tibetanbusiness.com');

            return view('dashboard.service.index');
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
Route::get('restaurant/{id}', 'Restaurant\RestaurantBasicInfoController@view');
/**
 * Rent View / Show
 *  */ 
Route::get('rent/{id}','Rent\RentBasicInfoController@view');
/**
 * Job View / Show
 *  */
Route::get('announcement/{id}', 'Job\JobBasicInfoController@view');
/**
 * Event
 * View/ Show Page
 *  */  
Route::get('event/{id}', 'Event\EventBasicInfoController@view');
// Pages
Route::get('contact-us',function(){
    MetaTag::set('title', 'Contact US - Tibetanbusiness.com Find the best Tibetan Restaurants,Rents, Events and Deals in India');
    MetaTag::set('description', 'Contact Us for advertisement and other business opportunities');
    MetaTag::set('image', asset('/img/contact-us.jpg'));
    return view('contact');
});
Route::get('promote-business',function(){
    MetaTag::set('title', 'Promote your Business- Tibetanbusiness.com Find the best Tibetan Restaurants,Rents, Events and Deals in India');
    MetaTag::set('description', 'Promote Your business so that customers can  see it');
    MetaTag::set('image', asset('/img/advertisement.jpg'));
    return view('promote');
});
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
    Route::get('Restaurants/{location?}', 'Restaurant\RestaurantBasicInfoController@search_engine');
    Route::get('Events/{location?}', 'Event\EventBasicInfoController@search_engine');
    Route::get('Jobs/{location?}', 'Job\JobBasicInfoController@search_engine');
    Route::get('Rents/{location?}', 'Rent\RentBasicInfoController@search_engine');
    Route::get('Sales/{location?}', 'Sale\SaleBasicInfoController@search_engine');
    Route::get('Services/{location?}', 'Service\ServiceBasicInfoController@search_engine');
});
