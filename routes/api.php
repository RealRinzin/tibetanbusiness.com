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
        Route::get('restaurant/{restaurant_basic_info}/facility', 'Restaurant\RestaurantFacilityController@facility');
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
        // Restaurant Facility

        // RENT API
        /**
         * Rent API
         * Authorization
         */
        Route::apiResource('rent','Rent\RentBasicInfoController');
        Route::apiResource('rent_comments', 'Rent\RentCommentController');
        Route::apiResource('rent_facilities', 'Rent\RentFacilityController');
        Route::apiResource('rent_room_photos', 'Rent\RentRoomPhotoController');
        Route::apiResource('rent_view_photos', 'Rent\RentViewPhotoController');
        Route::get('user/rents', 'Rent\RentBasicInfoController@user_rent');
        Route::patch('rent/status_update/{id}', 'Rent\RentBasicInfoController@status_update');
        Route::get('rent/individual/{id}', 'Rent\RentBasicInfoController@show_individual');
        Route::patch('rent/banner_update/{id}', 'Rent\RentBasicInfoController@banner_update');
        Route::get('rent/{rent_basic_info}/facility', 'Rent\RentFacilityController@facility');
        // JOB API
        /**
         * Rent API
         * Authorization
         */
        Route::apiResource('job','Job\JobBasicInfoController',['except'=>['index','create']]);
        Route::apiResource('job_apply', 'Job\JobApplyController',['except' => ['index','create','show']]);
        Route::apiResource('job_question', 'Job\JobQuestionController', ['except' => ['show','index','create']]);
        Route::post('job/question/reply','Job\JobQuestionController@reply_store');
        Route::get('user/jobs', 'Job\JobBasicInfoController@user_job');
        Route::patch('job/status_update/{id}', 'Job\JobBasicInfoController@status_update');
        Route::get('job/individual/{id}', 'Job\JobBasicInfoController@show_individual');
        Route::patch('job/banner_update/{id}', 'Job\JobBasicInfoController@banner_update');
        Route::get('job_apply/{job_basic_info}/applicant', 'Job\JobApplyController@applicant');
   
        // Event API
        /**
         * Event API
         * Authorization
         */
        Route::apiResource('event', 'Event\EventBasicInfoController');
        Route::apiResource('event_photo', 'Event\EventPhotoController');
        Route::apiResource('event_review', 'Event\EventReviewController');
        Route::get('user/events', 'Event\EventBasicInfoController@user_event');
        Route::patch('event/status_update/{id}', 'Event\EventBasicInfoController@status_update');
        Route::patch('event/banner_update/{id}', 'Event\EventBasicInfoController@banner_update');

        // Sale API
        /**
         * Sale API
         * Authorization
         */
        Route::apiResource('sale', 'Sale\SaleBasicInfoController');
        Route::apiResource('sale_photo', 'Sale\SalePhotoController');
        Route::get('user/sales', 'Sale\SaleBasicInfoController@user_sale');
        Route::patch('sale/status_update/{id}', 'Sale\SaleBasicInfoController@status_update');
        Route::patch('sale/banner_update/{id}', 'Sale\SaleBasicInfoController@banner_update');

        // Service API
        /**
         * Service API
         * Authorization
         */
        Route::apiResource('service', 'Service\ServiceBasicInfoController');
        Route::apiResource('service_photo', 'Service\ServicePhotoController');
        Route::apiResource('service_working_day', 'Service\ServiceWorkingDayController');
        Route::apiResource('service_review', 'Service\ServiceReviewController');
        Route::get('user/services', 'Service\ServiceBasicInfoController@user_service');
        Route::patch('service/banner_update/{id}', 'Service\ServiceBasicInfoController@banner_update');
        Route::patch('service/status_update/{id}', 'Service\ServiceBasicInfoController@status_update');



    // Other API
        Route::apiResource('location', 'Location\LocationController', ['except' => ['index']]);
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
    Route::get('rent_comments/comment/{id}', 'Rent\RentCommentController@comment');
    Route::get('rent/view/{id}','Rent\RentBasicInfoController@display');
    Route::get('rent/list/featured_ad', 'Rent\RentBasicInfoController@featured_ad');
    Route::get('rent/list/sidebar_ad', 'Rent\RentBasicInfoController@sidebar_ad');
    Route::get('rent/list/home_ad', 'Rent\RentBasicInfoController@home_ad');
        // Route::get('rent/{rent_basic_info}/facility', 'Rent\RentFacilityController@facility');

    /**
     * JOB API 
     * Custom 
     * Deauthorized
     */

    Route::get('job/list/all', 'Job\JobBasicInfoController@all');
    Route::get('job/{job_basic_info}/questions', 'Job\JobQuestionController@question');
    Route::get('job/{job_question}/replies', 'Job\JobQuestionController@replies');
    Route::get('job/view/{id}', 'Job\JobBasicInfoController@display');
    Route::get('job/list/featured_ad', 'Job\JobBasicInfoController@featured_ad');
    Route::get('job/list/sidebar_ad', 'Job\JobBasicInfoController@sidebar_ad');
    Route::get('job/list/home_ad', 'Job\JobBasicInfoController@home_ad');

    /**
     * Event API 
     * Custom 
     * Deauthorized
     */
    Route::get('event/list/all', 'Event\EventBasicInfoController@all');
    Route::get('event/view/{id}', 'Event\EventBasicInfoController@display');
    Route::get('event/list/featured_ad', 'Event\EventBasicInfoController@featured_ad');
    Route::get('event/list/sidebar_ad', 'Event\EventBasicInfoController@sidebar_ad');
    Route::get('event/list/home_ad', 'Event\EventBasicInfoController@home_ad');
    Route::get( 'event/{event_basic_info}/photos', 'Event\EventPhotoController@photo');
    Route::get('event/{event_basic_info}/reviews', 'Event\EventReviewController@review');

    /**
     * SALE API 
     * Custom 
     * Deauthorized
     */
    Route::get('sale/list/all', 'Sale\SaleBasicInfoController@all');
    Route::get('sale/list/featured_ad', 'Sale\SaleBasicInfoController@featured_ad');
    Route::get('sale/list/sidebar_ad', 'Sale\SaleBasicInfoController@sidebar_ad');
    Route::get('sale/list/home_ad', 'Sale\SaleBasicInfoController@home_ad');
    Route::get('sale/{sale_basic_info}/photos', 'Sale\SalePhotoController@photo');
    Route::get('sale/view/{id}', 'Sale\SaleBasicInfoController@display');

    /**
     * SERVICE API 
     * Custom 
     * Deauthorized
     */
    Route::get('service/list/all', 'Service\ServiceBasicInfoController@all');
    Route::get('service/list/featured_ad', 'Service\ServiceBasicInfoController@featured_ad');
    Route::get('service/list/home_ad', 'Service\ServiceBasicInfoController@home_ad');
    Route::get('service/list/sidebar_ad', 'Service\ServiceBasicInfoController@sidebar_ad');
    Route::get( 'service/{service_basic_info}/photos', 'Service\ServicePhotoController@photo');
    Route::get('service/{service_basic_info}/reviews', 'Service\ServiceReviewController@review');
    Route::get('service_working_day/{service_basic_info}/working_day', 'Service\ServiceWorkingDayController@working_day');
    Route::get('service/view/{id}', 'Service\ServiceBasicInfoController@display');


// Search Result
// restaurant
    Route::get( 'search/restaurants/', 'Restaurant\RestaurantBasicInfoController@search');
    Route::get('search/rents/', 'Rent\RentBasicInfoController@search');
    Route::get('search/sales/', 'Sale\SaleBasicInfoController@search');
    Route::get('search/services/', 'Service\ServiceBasicInfoController@search');
    Route::get('search/jobs/', 'Job\JobBasicInfoController@search');
    Route::get('search/events/', 'Event\EventBasicInfoController@search');

// Other API
    Route::get('location', 'Location\LocationController@index');
