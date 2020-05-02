<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
/**
 * Resources Authorization
 * Token base API
 *  */ 
// Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        // RESTAURANT API 
        Route::apiResource('restaurant', 'Restaurant\RestaurantBasicInfoController');
        Route::apiResource('restaurant_operation_days', 'Restaurant\RestaurantOperationDayController');
        Route::apiResource('restaurant_facilities', 'Restaurant\RestaurantFacilityController');
        Route::apiResource('restaurant_comments', 'Restaurant\RestaurantCommentController');
        Route::apiResource('restaurant_food_photos', 'Restaurant\RestaurantFoodPhotoController');
        Route::apiResource('restaurant_menu_photos', 'Restaurant\RestaurantMenuPhotoController');
    // showing the individual restaurant without relationship datas
        Route::get('restaurant/individual/{id}', 'Restaurant\RestaurantBasicInfoController@show_individual');
    // Update restaurant Rate
        Route::patch('restaurants/rating/{id}', 'Restaurant\RestaurantBasicInfoController@update_rate');
     // Restaurant status update
        Route::patch('restaurant/status_update/{id}', 'Restaurant\RestaurantBasicInfoController@status_update');
    // Restaurant banner update
        Route::patch('restaurant/banner_update/{id}', 'Restaurant\RestaurantBasicInfoController@banner_update');
        /**
         * Getting the API of Ower Restaurant
         *  */ 
        Route::get('user/restaurants','Restaurant\RestaurantBasicInfoController@user_restaurant');

        // RENT API
        /**
         * Rent API
         * Authorization
         */
        Route::apiResource('rent','Rent\RentBasicInfoController');
    });
    /**
 * RESTAURANT API (DEAUTH)
 * Restaurannt
 * Access the resource Without authorization
 * No authorazation
 * Comments
 * Listing Advertisment
 *  */
    Route::get('restaurant_comments/comment/{id}','Restaurant\RestaurantCommentController@comment');
    Route::get('restaurant/list/featured_ad/', 'Restaurant\RestaurantBasicInfoController@featured_ad');
    Route::get('restaurant/list/sidebar_ad/', 'Restaurant\RestaurantBasicInfoController@sidebar_ad');
    Route::get('restaurant/list/home_ad/', 'Restaurant\RestaurantBasicInfoController@home_ad');
    Route::get('restaurant/list/all', 'Restaurant\RestaurantBasicInfoController@all');

/**
 * RENT API 
 * Custom 
 * Deauthorized
  */
    Route::get('rent/list/all', 'Rent\RentBasicInfoController@all'); //all rents
    Route::get('rent/view/{id}','Rent\RentBasicInfoController@display'); // show individual (no authorization)
    Route::get('rent/list/featured_ad', 'Rent\RentBasicInfoController@featured_ad');
    Route::get('rent/list/sidebar_ad', 'Rent\RentBasicInfoController@sidebar_ad');
    Route::get('rent/list/home_ad', 'Rent\RentBasicInfoController@home_ad');
