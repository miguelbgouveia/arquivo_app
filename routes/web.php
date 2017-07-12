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

Route::get('/', [  'uses' => 'HomeController@getLogin', 'as' =>'login']);
Route::prefix('admin')->group(function(){
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index');
});
Route::get('/admin_menu', 'AdminController@getAdminMenu')->name('admin_menu');
Route::get('/data_base_inser', 'DataBaseController@getData_Base_Inser')->name('data.base.inser');
Auth::routes();
Route::post('/admin_inser', [
  'uses' => 'AdminController@postUser_Inser', 'as'=>'admin_inser'
]);
Route::post('/admin_depart_insert', [
  'uses' => 'AdminController@postAdmin_Depart_Insert', 'as'=>'admin.depart.insert'
]);
Route::post('/admin_depart_edit', [
  'uses' => 'AdminController@postAdmin_Depart_Edit', 'as'=>'admin.depart.edit'
]);
Route::get('/admin_logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::post('/apagar_user', [
  'uses' => 'AdminController@postApagar_User', 'as'=>'apagar_user'
]);
Route::post('/apagar_type_doc', [
  'uses' => 'AdminController@postApagar_Type_doc', 'as'=>'apagar.type_doc'
]);
Route::post('/admin_type_doc_insert', [
  'uses' => 'AdminController@postAdmin_Type_Doc_Insert', 'as'=>'admin.type_doc.insert'
]);
Route::post('/admin_type_doc_edit', [
  'uses' => 'AdminController@postAdmin_Type_Doc_Edit', 'as'=>'admin.type_doc.edit'
]);
Route::post('/apagar_depart', [
  'uses' => 'AdminController@postApagar_Depart', 'as'=>'apagar.depart'
]);
Route::post('/admin_edit', [
  'uses' => 'AdminController@postAdmin_Edit', 'as'=>'admin_edit'
]);
Route::get('/user_table',[
  'uses' => 'AdminController@getUser_table', 'as' =>'user_table'
]);
Route::get('/type_doc_table',[
  'uses' => 'AdminController@getType_Doc', 'as' =>'type.doc.table'
]);
Route::get('/user_depart',[
  'uses' => 'AdminController@getUser_Depart', 'as' =>'user.depart'
]);

Route::get('/home', [
  'uses' => 'HomeController@getDashboard', 'as' =>'dashboard'
]);

Route::get('/logout',[
  'uses' => 'HomeController@getLogout', 'as' =>'logout'
]);
Route::get('/dashboard',[
  'uses' => 'HomeController@getDashboard', 'as' =>'dashboard'
]);
Route::post('/insert', [
  'uses' => 'HomeController@postInsert', 'as'=>'insert'
]);
Route::post('/delete-doc}',[
  'uses'=>'HomeController@postDeleteDoc', 'as' =>'doc.delete'
]);
Route::post('/edit', [
  'uses' => 'HomeController@postEditDoc', 'as'=>'edit'
]);
