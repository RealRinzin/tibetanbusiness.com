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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        // Basic info
        Route::apiResource('restaurant', 'Restaurant\RestaurantBasicInfoController');
        // Restaurant Operation Day API
        Route::apiResource('restaurant_operation_days', 'Restaurant\RestaurantOperationDayController');
        // Restaurant Facilities API
        Route::apiResource('restaurant_facilities', 'Restaurant\RestaurantFacilityController');
        // Restaurant Comments API
        Route::apiResource('restaurant_comments', 'Restaurant\RestaurantCommentController');
        // Food photos
        Route::apiResource('restaurant_food_photos', 'Restaurant\RestaurantFoodPhotoController');
        // Menu photos
        Route::apiResource('restaurant_menu_photos', 'Restaurant\RestaurantMenuPhotoController');
        // showing the individual restaurant without relationship datas
        Route::get('restaurant/individual/{id}', 'Restaurant\RestaurantBasicInfoController@show_individual');
        // Update restaurant Rate
        Route::patch('restaurants/rating/{id}', 'Restaurant\RestaurantBasicInfoController@update_rate');
     // Restaurant status update
        Route::patch('restaurant/status_update/{id}', 'Restaurant\RestaurantBasicInfoController@status_update');
        /**
         * Getting the API of Ower Restaurant
         *  */ 
        Route::get('user/restaurants','Restaurant\RestaurantBasicInfoController@user_restaurant');
});
/**
 * Restaurant Without
 * Auth
 *  */
Route::get('restaurant_comments/comment/{id}','Restaurant\RestaurantCommentController@comment');
