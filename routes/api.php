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

Route::post('user/search', 'UserController@search');
Route::post('user/uniqueEmail', 'UserController@checkUniqueEmail');
Route::post('user/posibleGroups', 'UserController@posibleGroups');
Route::post('user/posiblePayments', 'UserController@posiblePayments');
Route::post('user/store', 'UserController@store');
Route::get('user/show/{id}', 'UserController@show');

Route::post('period/get', 'PeriodController@getPeriods');
Route::get('period/{id}', 'PeriodController@show');
Route::post('period/create', 'PeriodController@storePeriod');
Route::post('period/update', 'PeriodController@update');
Route::get('periodType', 'PeriodController@getPeriodsType');

Route::post('payment/get', 'PaymentController@get');
Route::get('payment/{id}', 'PaymentController@show');
Route::post('payment/store', 'PaymentController@store');
Route::post('payment/update', 'PaymentController@update');
Route::post('payment/periods', 'PaymentController@latestPeriods');
Route::post('payment/datesPayment', 'PaymentController@getDatesPayment');
Route::post('payment/storePaymentDates', 'PaymentController@storePaymentDates');
Route::post('payment/ownPeriods', 'PaymentController@ownPeriods');

Route::post('groups/getGroups', 'GroupController@getGroups');
Route::get('groups/getPeriods', 'GroupController@getPeriods');
Route::get('groups/getLevels', 'GroupController@getLevels');
Route::get('groups/getSchoolLevelModalities', 'GroupController@getSchoolLevelModalities');
Route::post('groups/storeGroups', 'GroupController@storeGroups');
Route::post('groups/storeGroup', 'GroupController@storeGroup');
Route::delete('groups/delete/{id}' , 'GroupController@deleteGroup');
Route::get('groups/show/{id}', 'GroupController@show');
Route::get('groups/posibleStudents/{id}', 'GroupController@posibleStudents');
Route::post('groups/assignGroup', 'GroupController@assignGroup');
Route::get('groups/schedules/{id}', 'GroupController@getSchedules');
Route::post('groups/searchTeachers', 'GroupController@searchTeachers');

Route::get('groups/allSubjects/{id}', 'GroupController@getAllSubjects');
Route::post('groups/updateSubjects', 'GroupController@updateSubjects');

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


Route::get('schoolLevels', 'UtilitiesController@schoolLevels');

//ESTUDIANTES
Route::get('students/mySchedule', 'StudentController@schedule');

//PADRES
Route::get('parents/myChildren', 'ParentController@getChildrens');
Route::get('parents/mySchedule/{id}', 'ParentController@getSchedule');
Route::post('parents/permission/storeImage', 'ParentController@saveImagePermission');
Route::post('parents/permission/create', 'ParentController@createPermission');
Route::post('parents/permission/getPermissions', 'ParentController@getPermissions');
Route::post('parents/permission/show', 'ParentController@showPermission');

//MAESTROS
Route::get('teachers/mySchedule', 'TeacherController@schedule');