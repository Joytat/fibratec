<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XuiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rutas mínimas para la aplicación IPTV.
|
*/

Route::get('/', function () {
    return response()->view('welcome')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache');
});

// XUI / Xtream-like API proxy endpoints
Route::post('/login', [XuiController::class, 'login']);
Route::post('/live-categories', [XuiController::class, 'liveCategories']);
Route::post('/live-streams', [XuiController::class, 'liveStreams']);
Route::post('/stream-url', [XuiController::class, 'streamUrl']);
Route::post('/compatible-stream', [XuiController::class, 'compatibleStream']);
Route::post('/compatible-stream/stop', [XuiController::class, 'stopCompatibleStream']);
Route::get('/compat-stream/{token}/{file}', [XuiController::class, 'compatibleStreamFile'])
    ->where(['token' => '[a-f0-9]{64}', 'file' => '[A-Za-z0-9_.-]+']);

// Proxy GET para evitar CORS en m3u8 / ts / otros recursos remotos.
// Uso: /proxy?url={url_remota}
Route::get('/proxy', [XuiController::class, 'proxy']);