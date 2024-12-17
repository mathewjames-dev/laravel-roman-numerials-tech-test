<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IntegerApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'integers',
    'as' => 'integers.',
], function () {
    Route::post('/convert-to-roman-numeral', [IntegerApiController::class, 'convertToRomanNumeral'])
        ->name('convert_to_roman_numeral');

    Route::get('/recent-conversions', [IntegerApiController::class, 'recentConversions'])
        ->name('recent_conversions');

    Route::get('/top-ten-conversions', [IntegerApiController::class, 'topTenConversions'])
        ->name('top_ten_conversions');
});

