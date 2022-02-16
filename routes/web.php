<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Support\Facades\Hash;

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
Route::get('testmail1', function(){
    return view('email.forgetPassword', ['fullname' => 'aiueo', 'token' => 123]);
});

Route::get('testmail', function(){
    $name = "eric";
        $verification_code = 123;
        $email = 'test@example.com';
        $subject = 'aiueo';
        Mail::send('email.forgetPassword', ['fullname' => $name, 'token' => $verification_code],
                function($mail) use ($email, $name, $subject) {
                    $mail->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });
});

Route::get('/', function () {
    return abort(404);
    // return view('index');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/digital-marketing/part-1', function() {
    return view('modules/digital-marketing/index');
});

Route::get('/digital-marketing/part-2', function() {
    return view('modules/digital-marketing/part-2');
});

Route::get('/digital-marketing/part-3', function() {
    return view('modules/digital-marketing/part-3');
});

Route::get('/digital-marketing/part-4', function() {
    return view('modules/digital-marketing/part-4');
});

Route::get('/digital-marketing/part-5', function() {
    return view('modules/digital-marketing/part-5');
});

Route::get('/digital-marketing/part-6', function() {
    return view('modules/digital-marketing/part-6');
});

Route::get('/digital-marketing/part-7', function() {
    return view('modules/digital-marketing/part-7');
});

Route::get('/digital-marketing/part-8', function() {
    return view('modules/digital-marketing/part-8');
});




/* data scientist route */
Route::get('/data-scientist/1', function() {
    return view('modules/data-scientist-part/part-1');
});

Route::get('/data-scientist/2', function() {
    return view('modules/data-scientist-part/part-2');
});

Route::get('/data-scientist/3', function() {
    return view('modules/data-scientist-part/part-3');
});

Route::get('/data-scientist/4', function() {
    return view('modules/data-scientist-part/part-4');
});

Route::get('/data-scientist/case-studies', function() {
    return view('modules/data-scientist-part/case-studies');
});

Route::get('/data-scientist/reflection', function() {
    return view('modules/data-scientist-part/reflection');
});

Route::get('/data-scientist/glossary', function() {
    return view('modules/data-scientist-part/glossary');
});

Route::get('/data-scientist/other-resources', function() {
    return view('modules/data-scientist-part/other');
});

// Route::get('/data-scientist/other-resources', function() {
//     return view('modules/data-scientist-part/part-7');
// });