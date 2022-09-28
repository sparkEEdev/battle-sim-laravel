<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\FoodGroupController;
use App\Http\Controllers\Api\v1\Auth\NewPasswordController;
use App\Http\Controllers\Api\v1\Auth\VerifyEmailController;
use App\Http\Controllers\Api\v1\Auth\RegisteredUserController;
use App\Http\Controllers\Api\v1\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\v1\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Api\v1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\v1\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Api\v1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\v1\FoodServingSizeController;
use App\Http\Controllers\Api\v1\FoodController;


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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// Guest routes
Route::group([], function () {

    Route::group(['prefix' => 'auth'], function () {

        Route::post('/register', [RegisteredUserController::class, 'store']);
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        /* Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update'); */

    });

});

Route::group(['middleware' => ['authenticated']], function () {

    Route::group(['prefix' => 'auth'], function () {

        Route::get('/me', [AuthenticatedSessionController::class, 'me']);

       /*  Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware(['throttle:6,1']); */

    });
});
