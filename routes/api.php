<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ModuleController;
use App\Http\Controllers\Api\V1\OutlineController;
use App\Http\Controllers\Api\V1\PartController;
use App\Http\Controllers\Api\V1\VerificationController;
use App\Http\Controllers\Api\V1\ResetPasswordController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ElementController;
use App\Models\Outline;

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

    // Route::group(['middleware' => ['jwt.verify']], function () {

        //* Select User *//
        Route::get('user/{id?}', [UserController::class, 'getDataUser']);

        Route::post('filter/student', [UserController::class, 'filterUser']);

        //* Module *//
        Route::get('module/{id?}', [ModuleController::class, 'list']);
        Route::post('module', [ModuleController::class, 'store']);
        Route::post('find/module', [ModuleController::class, 'findModuleByName']);

        Route::get('category/all', [CategoryController::class, 'list']);

        Route::get('detail/outline/{outline_id}', [OutlineController::class, 'getOutlineDetailById']);
        Route::get('outline/{module_id?}', [OutlineController::class, 'getListOutlineByModule']);
        Route::post('outline', [OutlineController::class, 'store']);

        Route::get('part/{outline_id?}', [PartController::class, 'list']);
        // Route::get('part/all', [PartController::class, 'list']);
        Route::post('part', [PartController::class, 'store']);
        Route::delete('part/{part_id}', [PartController::class, 'delete']);

        Route::get('element/all', [ElementController::class, 'list']);
        Route::post('element', [ElementController::class, 'store']);

        Route::get('module/create/{module_id?}/{outline_id?}/{part_id?}', [ModuleController::class, 'getDataModule']);
    // });
});
