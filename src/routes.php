<?php

/*
|--------------------------------------------------------------------------
| LaravelPress Routes
|--------------------------------------------------------------------------
|
|
*/


Route::get('/', function()
{
    return "Home";
});

Route::get('/{slug}', 'LaravelPressController@Home' );
