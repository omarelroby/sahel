<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::namespace('Auth')->group(function () {
    Route::get('register','LoginController@register')->name('register');
    Route::post('register-save','LoginController@register_save')->name('register.save');
    Route::get('login','LoginController@get')->name('login');
    Route::post('login','LoginController@post')->name('login.post');
    Route::get('logout','LoginController@logout')->name('logout');
});

Route::get('/', 'HomeController@index')->name('home.root');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('customers', 'CustomersController');
Route::resource('invoice', 'InvoicesController');
Route::get('/download/{id}', 'InvoicesController@download_invoice')->name('invoice.download');
