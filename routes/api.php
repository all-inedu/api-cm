<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ModuleController;
use App\Http\Controllers\Api\V1\VerificationController;
use App\Http\Controllers\Api\V1\ResetPasswordController;
use App\Http\Controllers\Api\V1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::group(['prefix' => 'v1'], function() {
    //! Verification
    Route::post('email/verification-notification', [VerificationController::class, 'verificationNotification'])->middleware(['auth:api'])->name('verification.send');
    Route::get('user/verify/{verification_code}', [VerificationController::class, 'verifyUser'])->name('user.verify');

    //! Reset Password
    Route::post('password/reset/{token}', [ResetPasswordController::class, 'submitResetPassword'])->name('password.submit');
    Route::get('reset/{token}', [ResetPasswordController::class, 'handleResetPassword'])->name('password.request');
    Route::post('password/reset', [ResetPasswordController::class, 'sendResetPasswordLink'])->name('password.reset');

    //! Authentication
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['jwt.verify']], function () {

        //* Select User *//
        Route::get('user/{id?}', [UserController::class, 'getDataUser']);

        //* Module *//
        Route::get('module/{param?}', [ModuleController::class, 'list']);
        Route::post('module', [ModuleController::class, 'store']);
    });
});
