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

Route::post('login', 'LoginController@signin');
Route::get('checkAuth', 'LoginController@checkAuth');

Route::post('user/search', 'Admin\UserController@search');
Route::post('user/uniqueEmail', 'Admin\UserController@checkUniqueEmail');
Route::post('user/posibleGroups', 'Admin\UserController@posibleGroups');
Route::post('user/posiblePayments', 'Admin\UserController@posiblePayments');
Route::post('user/store', 'Admin\UserController@store');
Route::get('user/show/{id}', 'Admin\UserController@show');
Route::post('user/update', 'Admin\UserController@update');
Route::post('user/getChildren', 'Admin\UserController@getChildren');

Route::post('period/get', 'PeriodController@getPeriods');
Route::get('period/{id}', 'PeriodController@show');
Route::post('period/create', 'PeriodController@storePeriod');
Route::post('period/update', 'PeriodController@update');
Route::get('periodType', 'PeriodController@getPeriodsType');
Route::post('period/checkDelete', 'PeriodController@checkDelete');

Route::post('payment/get', 'PaymentController@get');
Route::get('payment/{id}', 'PaymentController@show');
Route::post('payment/store', 'PaymentController@store');
Route::post('payment/update', 'PaymentController@update');
Route::post('payment/periods', 'PaymentController@latestPeriods');
Route::post('payment/datesPayment', 'PaymentController@getDatesPayment');
Route::post('payment/storePaymentDates', 'PaymentController@storePaymentDates');
Route::post('payment/ownPeriods', 'PaymentController@ownPeriods');

Route::post('groups/getGroups', 'Admin\GroupController@getGroups');
Route::get('groups/getPeriods', 'Admin\GroupController@getPeriods');
Route::get('groups/getLevels', 'Admin\GroupController@getLevels');
Route::get('groups/getSchoolLevelModalities', 'Admin\GroupController@getSchoolLevelModalities');
Route::post('groups/storeGroups', 'Admin\GroupController@storeGroups');
Route::post('groups/storeGroup', 'Admin\GroupController@storeGroup');
Route::delete('groups/delete/{id}' , 'Admin\GroupController@deleteGroup');
Route::delete('groups/delete/{id}' , 'Admin\GroupController@deleteGroup');
Route::get('groups/show/{id}', 'Admin\GroupController@show');
Route::get('groups/posibleStudents/{id}', 'Admin\GroupController@posibleStudents');
Route::post('groups/assignGroup', 'Admin\GroupController@assignGroup');
Route::get('groups/schedules/{id}', 'Admin\GroupController@getSchedules');
Route::post('groups/searchTeachers', 'Admin\GroupController@searchTeachers');

Route::get('groups/allSubjects/{id}', 'Admin\GroupController@getAllSubjects');
Route::post('groups/updateSubjects', 'Admin\GroupController@updateSubjects');

Route::post('subjects/get', 'SubjectController@get');
Route::post('subjects/store', 'SubjectController@store');
Route::post('subjects/update', 'SubjectController@update');
Route::delete('subjects/delete/{id}', 'SubjectController@delete');

Route::post('schedules/store', 'ScheduleController@store');
Route::delete('schedules/delete/{id}', 'ScheduleController@delete');

Route::post('permission/getPermissions', 'PermissionRequestController@get');
Route::post('permission/show', 'PermissionRequestController@show');
Route::post('permission/validate', 'PermissionRequestController@validatePermission');
Route::post('permission/negate', 'PermissionRequestController@negate');


// UTILITIES CONTROLLER
Route::get('schoolLevels', 'UtilitiesController@schoolLevels');
Route::post('saveImageProfile', 'UtilitiesController@saveImageProfile');
Route::post('chat/getConversation', 'UtilitiesController@getConversation');
Route::post('chat/createConversation', 'UtilitiesController@createConversation');
Route::post('chat/getMessages', 'UtilitiesController@getMessages');
Route::post('chat/sentMessage', 'UtilitiesController@sentMessage');
Route::get('chat/undefinedContact/{id}', 'UtilitiesController@undefinedContact');
Route::post('chat/setMessagesRead', 'UtilitiesController@setMessagesRead');
Route::get('chat/contacts', 'UtilitiesController@getContacts');


//ESTUDIANTES
Route::get('students/mySchedule', 'StudentController@schedule');
Route::post('students/searchConversations', 'StudentController@searchConversations');
Route::get('students/contacts', 'StudentController@getContacts');


//PADRES
Route::get('parents/myChildren', 'ParentController@getChildrens');
Route::get('parents/mySchedule/{id}', 'ParentController@getSchedule');
Route::post('parents/permission/storeImage', 'ParentController@saveImagePermission');
Route::post('parents/permission/create', 'ParentController@createPermission');
Route::post('parents/permission/getPermissions', 'ParentController@getPermissions');
Route::post('parents/permission/show', 'ParentController@showPermission');

//MAESTROS
Route::get('teachers/mySchedule', 'TeacherController@schedule');