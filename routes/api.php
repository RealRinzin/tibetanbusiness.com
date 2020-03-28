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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Restaurant API
Route::apiResource('restaurant', 'Restaurant\RestaurantBasicInfoController');
Route::apiResource('restaurant_comments', 'Restaurant\RestaurantCommentController');
Route::apiResource('restaurant_facilities', 'Restaurant\RestaurantFacilityController');
Route::apiResource('restaurant_food_photos', 'Restaurant\RestaurantFoodPhotoController');
Route::apiResource('restaurant_menu_photos', 'Restaurant\RestaurantMenuPhotoController');
Route::apiResource('restaurant_operation_days', 'Restaurant\RestaurantOperationDayController');
