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
use App\Http\Controllers\Api\V1\ListenController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\ReadController;
use App\Models\Module;
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

    // Route::middleware(['cors'])->group(function() {
    Route::group(['middleware' => ['jwt.verify', 'cors', 'throttle:40,10']], function () {
        
        //* CHECK TOKEN *//
        Route::post('check/token', [AuthController::class, 'checkToken']);

        //* ADMIN DASHBOARD *//
        Route::get('count/user', [UserController::class, 'countUserRegistered']);
        Route::get('count/user/weekly', [UserController::class, 'countUserWeekly']);
        Route::get('count/module', [ModuleController::class, 'countModuleByStatus']);

        //* Select User *//
        Route::get('user/{id?}', [UserController::class, 'getDataUser']);

        Route::post('filter/student', [UserController::class, 'filterUser']);
        Route::get('user/progress/{id}', [UserController::class, 'getUserProgress']);
        Route::get('module/{slug}/answer/user/{id}', [UserController::class, 'getUserAnswer']);

        //* Module *//
        Route::get('module/{id?}', [ModuleController::class, 'list']);
        Route::post('module', [ModuleController::class, 'store']);
        Route::put('module/{module_id}', [ModuleController::class, 'deactivateActivate']);
        Route::post('find/module', [ModuleController::class, 'findModuleByName']);
        Route::post('find/module/status', [ModuleController::class, 'findModuleByStatus']);

        Route::get('category/all', [CategoryController::class, 'list']);

        Route::get('detail/outline/{outline_id}', [OutlineController::class, 'getOutlineDetailById']);
        Route::get('outline/{module_id?}', [OutlineController::class, 'getListOutlineByModule']);
        Route::post('outline', [OutlineController::class, 'store']);

        Route::get('detail/part/{part_id}', [PartController::class, 'getPartDetailById']);
        Route::get('part/{outline_id?}', [PartController::class, 'list']);
        // Route::get('part/all', [PartController::class, 'list']);
        Route::post('part', [PartController::class, 'store']);
        Route::delete('part/{part_id}/{outline_id}/{module_id}', [PartController::class, 'delete']);

        Route::get('element/{part_id}', [ElementController::class, 'list']);
        Route::get('detail/element/{element_id}', [ElementController::class, 'getDetailElementById']);
        Route::delete('element/{element_id}', [ElementController::class, 'delete']);
        Route::post('element', [ElementController::class, 'store']);
        Route::put('element/{group_id}', [ElementController::class, 'update']);
        Route::put('order/element', [ElementController::class, 'updateOrder']);

        Route::get('preview/{module_id}', [ModuleController::class, 'preview']);

        //* USER SIDE **//

        Route::post('read', [ReadController::class, 'read']);
        Route::get('listen/module/{slug}', [ListenController::class, 'getModuleBySlug']);
        Route::get('listen/section/{slug}', [ListenController::class, 'getSectionDataBySlug']);
        Route::get('listen/part/outline/{outline_id}', [ListenController::class, 'getPartByOutlineId']);
        Route::get('listen/element/{part_id}/{group_id?}', [ListenController::class, 'getModuleContent']);

        Route::get('profile', [ProfileController::class, 'profileUser']);
        Route::post('profile', [ProfileController::class, 'updateProfileUser']);
        Route::post('request/email-change', [ProfileController::class, 'requestChangeEmail']);
        Route::get('change/mail/{verification_code}', [ProfileController::class, 'verifyAndChangeEmail']);
        Route::post('change/password', [ProfileController::class, 'changePassword']);

        Route::get('act/latest/read', [ListenController::class, 'lastRead']);
        Route::get('act/view/answer/{module_slug}', [ListenController::class, 'viewAnswer']);

        // Route::get('module/create/{module_id?}/{outline_id?}/{part_id?}', [ModuleController::class, 'getDataModule']);
    });
});
