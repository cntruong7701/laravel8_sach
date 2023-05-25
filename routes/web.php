<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MucLucController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\UserController;

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
//add comments
Route::post('/doc-sach/{slug}/comments', [CommentsController::class, 'store']);
Route::post('/xem-mucluc/{slug}/comments', [CommentsController::class, 'store']);
Route::get('/xem-mucluc/{slug}', [IndexController::class, 'xemmucluc']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);
Route::get('/kytu/{kytu}', [IndexController::class, 'kytu']);
// //tim kiếm
Route::get('/tim-kiem', [IndexController::class, 'search'])->name('tim-kiem');


// Route::post('/tim-kiem', [IndexController::class, 'timkiem']);
// Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);
Route::post('/sachnoibat', [SachController::class, 'sachnoibat']);
Route::post('/tabs-danhmuc', [IndexController::class, 'tabs_danhmuc']);

Auth::routes();



Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::resource('/user', UserController::class);
    Route::get('phan-vaitro/{id}',[UserController::class, 'phanvaitro']);
    Route::get('phan-quyen/{id}',[UserController::class, 'phanquyen']);

    Route::post('inset_roles/{id}',[UserController::class, 'inset_roles']);
    Route::post('inset_permission/{id}',[UserController::class, 'inset_permission']);
    Route::post('inset_permission',[UserController::class, 'inset_per_permission']);
    Route::post('inset_role/',[UserController::class, 'inset_per_role']);
});

Route::group(['middleware' => ['auth']], function () {
    
    Route::resource('/danhmuc', DanhMucController::class);
    Route::resource('/sach', SachController::class);
    Route::resource('/mucluc', MucLucController::class);
    Route::resource('/theloai', TheLoaiController::class);
    Route::resource('/comment', CommentsController::class);
    
    
});

Route::get('/home', [HomeController::class, 'index'])->name('home');



