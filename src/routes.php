<?php

/*
|--------------------------------------------------------------------------
| LaravelPress Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group(array( 'prefix'=> Config::get("laravelpress::settings.baseURL") ), function() {

    Route::get('/', 'LaravelPressController@Home');

    Route::get('/{slug}', 'LaravelPressController@Content' );

    Route::get('/tag/{slug}', 'LaravelPressController@Tag' );
    Route::get('/category/{slug}', 'LaravelPressController@Category' );

});
