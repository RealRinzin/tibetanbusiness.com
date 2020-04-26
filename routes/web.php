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
     * 
     * Dashboard 
     * Route Grouping
     *  */
    Route::prefix('dashboard')->group(function () {
        // RESTAURANT
        Route::get('restaurant', function () {
            // Matches The "/admin/users" URL
            return view('dashboard.Restaurant.index');
        })->name('dashboard.restaurant');
        // EVENTS
        Route::get('restaurant/edit/id={id}','Restaurant\RestaurantBasicInfoController@restaurant_edit');
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
Route::get('restaurants/list/', 'Restaurant\RestaurantBasicInfoController@all');


// Route::resource('post', 'PostController')->middleware('can:isOwner');
// Route::get('all','PostController@all')->middleware('can:viewAny,App\Post');


/**
 * 
 * Testing the image upload
 *  */ 
Route::post('images_upload','HomeController@images_upload');
// Route::post('upload', 'HomeController@upload');
// Route::get('upload','HomeController@upload');