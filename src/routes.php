<?php

/*
|--------------------------------------------------------------------------
| LaravelPress Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group(array( 'prefix'=> Config::get("laravelpress::routes.baseURL") ), function() {

    Route::get('/', function()
    {
        return "Home";
    });

    Route::get('/{slug}', 'LaravelPressController@Home' );

});
