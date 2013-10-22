<?php

require_once __DIR__.'/libs/is_email.php';
require_once __DIR__.'/models/Modules.php';

// Sanity check za pingalicu
Route::get('ping', function()
{
    $time = (float) microtime(true);
    return 'pong @ ' . $time;
});

Route::get('/random', function() 
{
    $rnd = rand(0, 4);
    
    $slike = array('e9db0736-cdb5-4f18-a216-fa788fb6f489', 
    'f7672be4-a3dc-465e-97d5-6ce7889bfced',
    '93145bba-2ad2-4ffe-adfe-fa1ed277e7eb',
    '546db918-c9e5-412e-ad1f-331d476e7bb0',
    '72fca9a6-46b1-4539-afff-b7793ba6c1a4');
    
    return Response::json(array('kadaID' => $slike[$rnd]));

});

// Demo panel za sa formom testiranje
Route::get('/', 'HomeController@index');

// Email check kroz URL
Route::get('email-check/{email}', 'EmailController@check');

// Zahtjev check kroz JSON POST
Route::post('zahtjev-check',      'ZahtjevController@check');
