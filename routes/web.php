<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Admin\DashboardController@login')->name('login');
Route::get('/login/{token?}', 'Admin\DashboardController@login')->name('login');
Route::get('/register', 'Admin\DashboardController@register')->name('register');
Route::post('register/user', 'Admin\DashboardController@registerUser')->name('register.user');

Auth::routes();

//user
Route::group(['middleware' => ['auth:sanctum','user'], 'namespace' => 'User'], function (){
    Route::get('/home', 'MainController@home')->name('home');
    Route::get('main/category/{id}/sub/categories','MainController@getSubCategories')->name('get_sub_categories_of_main_category');
    Route::get('sub/sub/category/{id}/detail','MainController@getSubSubCategoryDetail')->name('get_sub_sub_category_detail');
    Route::post('search/sub/sub/category', 'MainController@search')->name('search_sub_sub_category');

});

//admin
Route::group(['middleware' => ['auth:sanctum', 'admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin_dashboard');
    Route::get('update/profile', 'DashboardController@update')->name('admin_update_profile');
    Route::put('profile/{id}/updated', 'DashboardController@profileUpdated')->name('admin_profile_updated');

    //main category
    Route::namespace('MainCategory')->prefix('main')->group(function () {
        Route::get('category/create', 'MainCategoryController@create')->name('admin_create_main_category');
        Route::post('category/store', 'MainCategoryController@store')->name('admin_store_main_category');
        Route::get('categories/list', 'MainCategoryController@index')->name('admin_get_main_categories');
        Route::get('category/edit/{id}', 'MainCategoryController@edit')->name('admin_edit_main_category');
        Route::put('category/update/{id}', 'MainCategoryController@update')->name('admin_update_main_category');
        Route::delete('category/delete/{id}', 'MainCategoryController@destroy')->name('admin_delete_main_category');
    });

    //sub category
    Route::namespace('SubCategory')->prefix('sub')->group(function () {
        Route::get('category/create', 'SubCategoryController@create')->name('admin_create_sub_category');
        Route::post('category/store', 'SubCategoryController@store')->name('admin_store_sub_category');
        Route::get('categories/list', 'SubCategoryController@index')->name('admin_get_sub_categories');
        Route::get('category/edit/{id}', 'SubCategoryController@edit')->name('admin_edit_sub_category');
        Route::put('category/update/{id}', 'SubCategoryController@update')->name('admin_update_sub_category');
        Route::delete('category/delete/{id}', 'SubCategoryController@destroy')->name('admin_delete_sub_category');
    });

    //sub sub category
    Route::namespace('SubSubCategory')->prefix('sub/sub')->group(function () {
        Route::get('category/create', 'SubSubCategoryController@create')->name('admin_create_sub_sub_category');
        Route::post('category/store', 'SubSubCategoryController@store')->name('admin_store_sub_sub_category');
        Route::get('categories/list', 'SubSubCategoryController@index')->name('admin_get_sub_sub_categories');
        Route::get('category/{id}/details', 'SubSubCategoryController@details')->name('admin_get_sub_sub_category_details');
        Route::put('category/update/{id}', 'SubSubCategoryController@update')->name('admin_update_sub_sub_category');
        Route::delete('category/delete/{id}', 'SubSubCategoryController@destroy')->name('admin_delete_sub_sub_category');
        Route::post('category/document/delete', 'SubSubCategoryController@destroyDocument')->name('admin_delete_sub_sub_category_document');
    });

    Route::post('sub/categories/of/main/categroy', 'SubSubCategory\SubSubCategoryController@getSubCategories')->name('admin_get_sub_categories_of_main_category');

});
