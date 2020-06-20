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
use  App\RegisterInternet;
use App\Role;
use App\Role_User;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});


//Access Control
Route::get('/access/createroles', ['uses' => 'AccessController@create_roles', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/createrole', ['uses' => 'AccessController@create_r', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/access/roles', ['uses' => 'AccessController@assignrole', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/role', ['uses' => 'AccessController@link', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/access/access', ['uses' => 'AccessController@accessview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/store', ['uses' => 'AccessController@store', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/access/state', ['uses' => 'AccessController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/status', ['uses' => 'AccessController@status', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/test/test', ['uses' => 'AccessController@test', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Logs
Route::get('/logs/display', ['uses' => 'LogsController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Cues
Route::get('/cues/display', ['uses' => 'KeyController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/cues/create', ['uses' => 'KeyController@creatview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cues/creates', ['uses' => 'KeyController@creates', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cues/delete', ['uses' => 'KeyController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Guest User
Route::get('/access/userhome', ['uses' => 'UserHomeController@index' ]);

//statistics
Route::post('/statistics', ['uses' => 'StatisticsController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);





//PIN Reset
Route::GET('/wallet/reset_view', ['uses' => 'WalletManagementController@reset_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/reset', ['uses' => 'WalletManagementController@reset', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/reset_preauth', ['uses' => 'WalletManagementController@reset_preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Authentication Services
Route::GET('/authentication/display', ['uses' => 'AuthenticationServiceController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/authentication/createview', ['uses' => 'AuthenticationServiceController@create_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/authentication/create', ['uses' => 'AuthenticationServiceController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/authentication/updateview', ['uses' => 'AuthenticationServiceController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/authentication/update', ['uses' => 'AuthenticationServiceController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Authentication Roles Services
Route::GET('/roles/display', ['uses' => 'AuthRolesController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/roles/createview', ['uses' => 'AuthRolesController@create_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/roles/create', ['uses' => 'AuthRolesController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/roles/search', ['uses' => 'AuthRolesController@search', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/roles/search_user', ['uses' => 'AuthRolesController@search_user', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/roles/update_user', ['uses' => 'AuthRolesController@update_user', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Permissions

Route::get('/permissions/display', ['uses' => 'PermissionsController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/permissions/create_permissions', ['uses' => 'PermissionsController@create_permissions', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/permissions/create', ['uses' => 'PermissionsController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/permissions/edit', ['uses' => 'PermissionsController@edit', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/permissions/update_profile', ['uses' => 'PermissionsController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/error/401', ['uses' => 'PermissionsController@error', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/permissions/users', ['uses' => 'PermissionsController@users', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);



//Company
Route::get('/home/page', ['uses' => 'CondurreAppController@homePage', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/company/display', 'CondurreAppController@displayCompanies');
Route::get('/company/create', 'CondurreAppController@createCompany');
Route::post('/company/creates', 'CondurreAppController@createsCompany');
Route::post('/company/id', 'CondurreAppController@companyById');
Route::any('/company/updates', 'CondurreAppController@updatesCompany');


Route::get('/company/exams', 'CondurreAppController@displayExams');
Route::get('/exam/create', 'CondurreAppController@createExam');
Route::any('/exam/creates', 'CondurreAppController@createsExam');
Route::any('/exam/id', 'CondurreAppController@examById');
Route::any('/exam/updates', 'CondurreAppController@updatesExam');
Route::any('/exam/questions', 'CondurreAppController@examQuestions');
Route::any('/possible/answers', 'CondurreAppController@possibleAnswers');


//Questions
Route::any("/exam/create/questions", 'CondurreAppController@createQuestion');
Route::any("/exam/creates/questions", 'CondurreAppController@createsQuestions');
Route::any("/exam/update/questions", 'CondurreAppController@updateQuestions');
Route::any("/exam/updates/questions", 'CondurreAppController@updatesQuestions');

//Answers
Route::any("/exam/create/answers", 'CondurreAppController@createAnswers');
Route::any("/exam/creates/answer", 'CondurreAppController@createsAnswers');
Route::any("/exam/update/answers", 'CondurreAppController@updatesAnswers');
Route::any("/exam/updates/answers", 'CondurreAppController@updateAnswer');

//Deletion
Route::any("/exam/delete", 'CondurreAppController@examDelete');
Route::any("/questions/delete", 'CondurreAppController@questionsDelete');
Route::any("/answers/delete", 'CondurreAppController@answersDelete');






//Company
Route::get('/company-admin/display', 'CondurreAppController@displayCompaniesAdmin');
Route::post('/company-admin/id', 'CondurreAppController@companyAdminsById');
Route::post('/company-admin-view/id', 'CondurreAppController@companyAdminsViewByCompanyId');
Route::post('/company-admin/create', 'CondurreAppController@createCompanyAdmin');
Route::post('/company-admin-edit', 'CondurreAppController@updateCompanyAdmins');
Route::post('/company-admin/updates', 'CondurreAppController@updateCompanyAdminsPost');

//visitors
Route::get('/visitors/display', 'CondurreAppController@displayVisitors');
Route::post('/visitor-edit', 'CondurreAppController@displayVisitorById');
Route::post('/visitor/updates', 'CondurreAppController@updateVisitor');



Route::POST('/login/internet/preauth', [ 'uses' =>'AuthServerController@login_service']);

Route::get('/migrate','MigrationsController@index');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::get('/', ['middleware' => 'auth', 'uses' =>'HomeController@index'])->name('home');



