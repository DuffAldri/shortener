<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortenerController;

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

Route::get('/', function () {
    return redirect()->route('shortener');
});

Route::get('/+/{slug?}', [
    ShortenerController::class,
    'index']
) -> name('shortener');

Route::post('/+', [
    ShortenerController::class,
    'store']
);

Route::get('/+{slug}', [
    ShortenerController::class,
    'show']
) -> name('redirect');

Route::get('/notfound', function() {
    return view('notfound', ['title' => 'Not Found']);
}
) -> name('notfound');