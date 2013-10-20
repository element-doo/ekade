<?php

require_once __DIR__.'/libs/is_email.php';
require_once __DIR__.'/models/Modules.php';

// Sanity check za pingalicu
Route::get('ping', function()
{
    $time = (float) microtime(true);
    return 'pong @ ' . $time;
});

// Demo panel za sa formom testiranje
Route::get('/', 'HomeController@index');

// Email check kroz URL
Route::get('email-check/{email}', 'EmailController@check');

// Zahtjev check kroz JSON POST
Route::post('zahtjev-check',      'ZahtjevController@check');
