<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\DanhMuc;
use App\Models\TheLoai;
use App\Models\Sach;
use App\Models\MucLuc;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Carbon::setLocale('vi');
        $category_total = DanhMuc::all()->count();
        $genre_total = TheLoai::all()->count();
        $book_total = Sach::all()->count();
        $chapter_total = MucLuc::all()->count();
        View::share([
            'category_total'=>$category_total,
            'genre_total'=>$genre_total,
            'book_total'=>$book_total,
            'chapter_total'=>$chapter_total,
        ]);
    }
}
