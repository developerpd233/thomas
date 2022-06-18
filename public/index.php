<?php

//define('PAYPAL_SANDBOX','1'); //For sendbox
define('PAYPAL_SANDBOX','1');  //For paypal

if(PAYPAL_SANDBOX==1){
    define ("PAYPAL_URL","https://api-m.sandbox.paypal.com/");
    //define ("PAYPAL_CLIENT_ID","AVEwS642ZyQB0UE548pH-L6qjI9K70Pt6tXO5kB1xkjgXpsY2cZid9CeC8ahMx7vnPlUKpUFM1sISkOf");
    define ("PAYPAL_CLIENT_ID",'Aa8t1AwisEK5X5BIznQPJdkvgKSJEkMFhSBxiPfSN97FWQ12H_xmDdcuah0dRoTEqTVhNhcn9qPNANK8');
    //define ("PAYPAL_CLIENT_SECRET","EGv-YVa_flVmmoRm--6nDW87ZgOYtT3Hj3sNUkSU5QyNQN3wBpeYc0_kXlVPrfQcxqxgAULGWvWsgE--");
    define ("PAYPAL_CLIENT_SECRET",'EHJlQbCSVAA-QiZ0tr2oQzb1zBhuyrWiDXdzMvPfb9riC5NoTnzBaNPJxsvoL1w4BPm4HifqR2fFfLvG');
}
else{
    define ("PAYPAL_URL","https://api-m.paypal.com/");
    define ("PAYPAL_CLIENT_ID",'AZ1RQTYhnmFbgF-kVeKJ74OsE0rEC6lvD6m2XM58wNs9_pMiZ1XWbwTfcpRBASfVUUDapZ1zpnS47QKU');
    define ("PAYPAL_CLIENT_SECRET",'EEOk-AfUT23KiI5dqQ0JzVK1s3s2NWgnpPZ009mRvSvBg2AJ4h3KwYW50NeEWVP_5sTGsBECIgmu-wmV');
}
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
<<<<<<< HEAD
| Once we have the application, we can handle the incoming request
=======
| Once we ha ve the application, we can handle the incoming request
>>>>>>> 6178de7f946270d6bc03e0bdf8ce31210613ff80
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
