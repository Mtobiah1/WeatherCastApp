<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/weather/current', [WeatherController::class, 'getCurrentWeather']);
Route::post('/weather/forecast', [WeatherController::class, 'get16DayForecast']);
Route::get('/weather/history', [WeatherController::class, 'getSearchHistory']);

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
