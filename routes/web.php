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

Route::group(['prefix' => '/'], function()
{
  Route::get('/login', 'Login\LoginController@index');
  Route::get('/logout', 'Login\LoginController@logout');
  Route::put('/login/run', 'Login\LoginController@doLogin');

  Route::get('/auth/list', 'Permission\AuthController@index');
  Route::get('/auth/editStatus', 'Permission\AuthController@editStatus');
  Route::get('/auth/edit/{authId}', 'Permission\AuthController@edit');
  Route::get('/auth/edit', 'Permission\AuthController@edit');
  Route::put('/auth/editRun', 'Permission\AuthController@editRun');

  Route::get('/user/list', 'Permission\UserController@index');
  Route::get('/user/editStatus', 'Permission\UserController@editStatus');
  Route::get('/user/edit/{userId}', 'Permission\UserController@edit');
  Route::get('/user/edit', 'Permission\UserController@edit');
  Route::put('/user/editRun', 'Permission\UserController@editRun');

  Route::get('/role/list', 'Permission\RoleController@index');
  Route::get('/role/editStatus', 'Permission\RoleController@editStatus');
  Route::get('/role/edit/{roleId}', 'Permission\RoleController@edit');
  Route::get('/role/edit', 'Permission\RoleController@edit');
  Route::put('/role/editRun', 'Permission\RoleController@editRun');

  Route::get('/site/list', 'CMS\SiteController@index');
  Route::get('/site/edit/{siteId}', 'CMS\SiteController@edit');
  Route::get('/site/edit', 'CMS\SiteController@edit');
  Route::put('/site/editRun', 'CMS\SiteController@editRun');
  Route::get('/site/editStatus', 'CMS\SiteController@editStatus');

  Route::get('/webpage/list', 'CMS\WebpageController@index');
  Route::get('/webpage/edit/{webpageId}', 'CMS\WebpageController@edit');
  Route::get('/webpage/edit', 'CMS\WebpageController@edit');
  Route::put('/webpage/editRun', 'CMS\WebpageController@editRun');
  Route::get('/webpage/editStatus', 'CMS\WebpageController@editStatus');

  Route::get('/block/list', 'CMS\BlockController@index');
  Route::get('/block/edit/{blockId}', 'CMS\BlockController@edit');
  Route::get('/block/edit', 'CMS\BlockController@edit');
  Route::put('/block/editRun', 'CMS\BlockController@editRun');
  Route::get('/block/editStatus', 'CMS\BlockController@editStatus');

  Route::get('/category/list', 'CMS\CategoryController@index');
  Route::get('/category/edit/{categoryId}', 'CMS\CategoryController@edit');
  Route::get('/category/edit', 'CMS\CategoryController@edit');
  Route::put('/category/editRun', 'CMS\CategoryController@editRun');
  Route::get('/category/editStatus', 'CMS\CategoryController@editStatus');

  Route::get('/content/list', 'CMS\ContentController@index');
  Route::get('/content/edit/{contentId}', 'CMS\ContentController@edit');
  Route::get('/content/edit', 'CMS\ContentController@edit');
  Route::put('/content/editRun', 'CMS\ContentController@editRun');
  Route::get('/content/editStatus', 'CMS\ContentController@editStatus');

  //passport管理
  Route::get('/passport/user/list', 'Passport\PassportUserController@index');

  Route::get('/', 'Admin\HomeController@index');
});


/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::group(['prefix' => '/', 'namespace' => 'Admin'], function()
{
  Route::get('/', 'HomeController@index');
});

Route::group(['prefix' => '/login', 'namespace' => 'Login'], function()
{
  Route::get('/', 'LoginController@index');
  Route::put('run', 'LoginController@doLogin');
});
*/

/*Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'Login\LoginController@index');
    Route::put('/login/run', 'Login\LoginController@doLogin');
});*/

//Route::resource('photos', 'PhotoController');
//Route::controller("home","HomeController",['middleware'=>'common']);
/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'sts' => 'Sts\StsServerController',
    'feed' => 'Moments\MomentController',
    'comment' => 'Comments\CommentController',
]);
*/

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

