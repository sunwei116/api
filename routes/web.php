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

Route::get('/', function () {
    return view('welcome');
});
//视图
Route::any('member/add', function () {
    return view('member.add');
});
Route::resource('/api/member', 'Api\MemberController');
//Route::any('/api/member', 'Api\MemberController@index');