<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\Sach;
use App\Models\Truyen;
use App\Models\MucLuc;
use App\Models\TheLoai;
use App\Models\Info;

class IndexController extends Controller
{
    //
    public function timkiem_ajax(Request $request)
    {
        $data = $request->all();
        if ($data['keywords']) {
            
            $sach = Sach::where('tinhtrang', '0')->where('tensach','LIKE', '%'.$data['keywords'].'%')->get();

            $output =  '<ul class="dropdown-menu" style="display:block;">';

            foreach ($sach as $key => $s) {
                $output .= '<li class="dropdown-item li_timkiem_ajax"><a href="#" class="">'.$s->tensach.'</a></li>';
            }
        }

        $output .= '</ul>';
        echo $output;
    }

    public function tabs_danhmuc(Request $request)
    {
        $data = $request->all();
        $output = '';
        $sach = Sach::with('danhmuc', 'theloai')->where('danhmuc_id', $data['danhmuc_id'])->take(30)->get();
        foreach ($sach as $key => $value) {
            $output.='
            <ul class="mucluctab_sach">
                <li><a target="_blank" href="'.url('doc-sach/'.$value->slug_sach).'" class="text-decoration-none">'.$value->tensach.'</a></li>
            </ul>';
        }
        echo $output;
    }

    public function home()
    {
        $theloai = TheLoai::orderBy('id', 'DESC')->get();

        $slide_sach = Sach::orderBy('id', 'DESC')->where('kichhoat', '0')->take(8)->get();

        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();
        $sach = Sach::orderBy('id', 'DESC')->where('kichhoat', '0')->get();

        $truyen = Truyen::orderBy('id', 'DESC')->where('kichhoat', '0')->get();
        return view('pages.home')->with(compact('danhmuc','sach', 'truyen', 'theloai', 'slide_sach'));
    }
    
    public function danhmuc($slug)
    {
        $theloai = TheLoai::orderBy('id', 'DESC')->get();

        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();

        $slide_sach = Sach::orderBy('id', 'DESC')->where('kichhoat', '0')->take(8)->get();

        $danhmuc_id = DanhMuc::where('slug_danhmuc', $slug)->first();

        $tendanhmuc = $danhmuc_id->tenDM;

        $sach = Sach::orderBy('id', 'DESC')->where('kichhoat','0')->where('danhmuc_id', $danhmuc_id->id)->get();
        
        return view('pages.danhmuc')->with(compact('danhmuc', 'sach', 'tendanhmuc', 'theloai', 'slide_sach'));
    }

    public function theloai($slug)
    {
        $theloai = TheLoai::orderBy('id', 'DESC')->get();

        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();

        $slide_sach = Sach::orderBy('id', 'DESC')->where('kichhoat', '0')->take(8)->get();

        $theloai_id = TheLoai::where('slug_theloai', $slug)->first();

        $tentheloai = $theloai_id->tentheloai;

        $sach = Sach::orderBy('id', 'DESC')->where('kichhoat','0')->where('theloai_id', $theloai_id->id)->get();
        
        return view('pages.theloai')->with(compact('danhmuc', 'sach', 'tentheloai', 'theloai', 'slide_sach'));
    }

    public function docsach($slug)
    {
        $theloai = TheLoai::orderBy('id', 'DESC')->get();

        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();

        $sach = Sach::with('danhmuc', 'theloai')->where('slug_sach', $slug)->where('kichhoat','0')->first();

        $sachnoibat = Sach::where('sach_noibat', 1)->take(10)->get();
        $sachxemnhieu = Sach::where('sach_noibat', 2)->take(10)->get();

        $mucluc = MucLuc::with('sach')->orderBy('id', 'ASC')->where('sach_id', $sach->id)->get();

        $mucluc_dau = MucLuc::with('sach')->orderBy('id', 'ASC')->where('sach_id', $sach->id)->first();

        $mucluc_cuoi = MucLuc::with('sach')->orderBy('id', 'DESC')->where('sach_id', $sach->id)->first();

        $cungdanhmuc = Sach::with('danhmuc', 'theloai')->where('danhmuc_id', $sach->danhmuc->id)->whereNotIn('id', [$sach->id])->get();

        return view('pages.Sach')->with(compact('danhmuc', 'sach', 'mucluc', 'cungdanhmuc', 'mucluc_dau', 'mucluc_cuoi', 'theloai', 'sachnoibat', 'sachxemnhieu'));
    }

    public function xemmucluc($slug){
        $theloai = TheLoai::orderBy('id', 'DESC')->get();

        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();

        $sach = MucLuc::where('slug_mucluc', $slug)->first();

        //breadcrumb 
        $sach_breadcrumb = Sach::with('danhmuc', 'theloai')->where('id', $sach->sach_id)->where('kichhoat','0')->first();
        //end breadcrumb 

        $mucluc = MucLuc::with('sach')->where('slug_mucluc', $slug)->where('sach_id', $sach->sach_id)->first(); 

        $all_mucluc = MucLuc::with('sach')->orderBy('id', 'ASC')->where('sach_id', $sach->sach_id)->get();

        $next = MucLuc::where('sach_id', $sach->sach_id)->where('id', '>', $mucluc->id)->min('slug_mucluc');

        $max = MucLuc::where('sach_id', $sach->sach_id)->orderBy('id', 'DESC')->first();

        $min = MucLuc::where('sach_id', $sach->sach_id)->orderBy('id', 'ASC')->first();

        $previous = MucLuc::where('sach_id', $sach->sach_id)->where('id', '<', $mucluc->id)->max('slug_mucluc');
        return view('pages.chuong')->with(compact('danhmuc', 'mucluc', 'all_mucluc', 'next', 'previous', 'max', 'min', 'theloai', 'sach_breadcrumb'));
    }

    public function timkiem(Request $request)
    {
        $data = $request->all();
        $slide_sach = Sach::orderBy('id', 'DESC')->where('kichhoat', '0')->take(8)->get();

        $theloai = TheLoai::orderBy('id', 'DESC')->get();
        
        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();

        $tukhoa = $data['tukhoa'];

        $sach = Sach::with('danhmuc', 'theloai')->where('tensach','LIKE', '%'.$tukhoa.'%')
        ->orWhere('tomtat','LIKE', '%'.$tukhoa.'%')->orWhere('tacgia','LIKE', '%'.$tukhoa.'%')->get();

        return view('pages.timkiem')->with(compact('danhmuc','sach', 'theloai', 'tukhoa', 'slide_sach'));
    }

    public function tag($tag)
    {
        $info = Info::find(1);
        $title = 'Tìm kiếm tags';

        //seo
        // $meta_desc = 'Tìm kiếm tags';
        // $meta_keywords = 'Tìm kiếm tags';
        // $url_canonical = \URL::current();
        // $og_image = url('public/upload/logo' .$info->logo);
        // $link_icon = url('public/upload/logo' .$info->logo);
        //end seo

        $slide_sach = Sach::orderBy('id', 'DESC')->where('kichhoat', '0')->take(8)->get();

        $theloai = TheLoai::orderBy('id', 'DESC')->get();
        
        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();

        $tags = explode("-", $tag);

        $sach = Sach::with('danhmuc', 'theloai')->where(
            function ($query) use($tags)
            {
                for ($i=0; $i < count($tags); $i++) { 
                    $query->orwhere('tukhoa', 'like', '%' .$tags[$i]. '%');
                }
            }
        )->paginate(12);
        
        return view('pages.tag')->with(compact('danhmuc', 'sach','theloai','slide_sach', 'tag','info',
        'title'));
    }
}
