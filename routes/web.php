<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\MucLucController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\TruyenController;

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

Route::get('/', [IndexController::class, 'home']);
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/doc-sach/{slug}', [IndexController::class, 'docsach']);
Route::get('/xem-mucluc/{slug}', [IndexController::class, 'xemmucluc']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);


Route::POST('/tim-kiem', [IndexController::class, 'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);
Route::post('/sachnoibat', [SachController::class, 'sachnoibat']);
Route::post('/tabs-danhmuc', [IndexController::class, 'tabs_danhmuc']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/danhmuc', DanhMucController::class);
Route::resource('/sach', SachController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/mucluc', MucLucController::class);
Route::resource('/theloai', TheLoaiController::class);
Route::resource('/information', InfoController::class);
