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
  Route::group(['prefix'=>'v1'], function () {
      Route::get('setting', 'API\v1\SettingController@index');

      Route::post('un_sub', 'API\v1\EventController@unSub');
      Route::post('login', 'API\v1\AuthController@login');
      Route::group(['middleware' => 'api', 'cors'], function () {
          Route::post('forget-password', 'API\v1\AuthController@forgetPassword');
          Route::post('reset-password', 'API\v1\AuthController@resetPassword');
          Route::get('get-setting', 'API\v1\EventController@setting');
          Route::group(['middleware' =>'auth:api'], function () {
              Route::post('upload-logo', 'API\v1\EventController@uploadLogo');
              Route::post('create_admin', 'API\v1\AuthController@create');

              Route::get('all-users', 'API\v1\AuthController@allUser');
              Route::get('all-details/{email}', 'API\v1\AuthController@allDetails');
              Route::get('users-with-event/{id}', 'API\v1\AuthController@eventPatricipents');

              Route::post('update-profile', 'API\v1\AuthController@editProfile');

              Route::post('suspend-admin', 'API\v1\AuthController@suspend');
              Route::post('delete-admin', 'API\v1\AuthController@delete');
              Route::post('restore-admin', 'API\v1\AuthController@restore');

              Route::post('create_participant', 'API\v1\AdminController@create');
              Route::post('campaign', 'API\v1\CampaignsController@index');
              Route::get('incomplete_transaction', 'API\v1\EventController@incomplete');
              Route::get('delete-incomplete-transaction/{id}', 'API\v1\EventController@deleteIncompleteTransection');
              Route::get('un-selected', 'API\v1\EventController@unselected');
              Route::post('file-upload', 'API\v1\EventController@fileUpload');
              Route::group(['prefix'=>'event'], function () {
                  Route::get('state', 'API\v1\EventController@state');
                  Route::get('event_paid_participant', 'API\v1\EventController@eventPaidParticipant');
                  Route::get('un-paid-participant', 'API\v1\EventController@unpaid');
                  Route::get('delete-participant/{id}', 'API\v1\EventController@deleteParticipant');
                  Route::post('add_payment', 'API\v1\EventController@addPayment');
                  Route::get('active_event', 'API\v1\EventController@activeEvent');
                  Route::get('active_archive', 'API\v1\EventController@activeArchived');
                  Route::get('show/{id}', 'API\v1\EventController@show');
                  Route::post('edit/{id}', 'API\v1\EventController@edit');
                  Route::post('delete_event', 'API\v1\EventController@deleteEvent');
                  Route::get('archived', 'API\v1\EventController@archived');
                  Route::post('create_event', 'API\v1\EventController@create');
                  Route::get('get_all', 'API\v1\EventController@index');
                  Route::post('payment-history', 'API\v1\EventController@getHistory');
              });
              Route::post('booking_comment', 'API\v1\EventController@saveBooking');
              Route::post('generate-pdf', 'API\v1\EmailsController@generatePdf');

              Route::group(['prefix'=>'emails'], function () {
                  Route::post('add-email', 'API\v1\EmailsController@store');
                  Route::get('edit-email/{id}', 'API\v1\EmailsController@edit');
                  Route::post('update-email', 'API\v1\EmailsController@update');
                  Route::get('get-emails', 'API\v1\EmailsController@show');
              });

              Route::post('setting', 'API\v1\SettingController@update');

              Route::group(['prefix'=>'reminder'], function () {
                  Route::post('set_reminder', 'API\v1\ReminderController@setReminders');
              });
              Route::get('user', 'API\v1\AdminController@index');
              Route::get('payed_participant', 'API\v1\EventController@payedParticipant');
          });
          Route::post('search_event', 'API\v1\EventController@searchEvent');
          Route::get('get_all_events', 'API\v1\EventController@index');
          Route::post('search_event', 'API\v1\EventController@searchEvent');
          Route::group(['prefix'=>'event_book'], function () {
              Route::post('select_event', 'API\v1\EventController@store');
              Route::post('save_transaction', 'API\v1\EventController@saveTransaction');
          });

          Route::get('test_method', 'API\v1\EventController@test');
      });
  });
 Route::get('/test', function () {
     return view('pdf');
 });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
