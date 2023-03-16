<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Truyen;
use App\Models\DanhMuc;
use App\Models\TheLoai;
use App\Models\ThuocLoai;
use App\Models\ThuocDanh;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $list_truyen = Truyen::with('danhmuc', 'theloai')->orderBy('id','DESC')->get();
        $thuocdanh = ThuocDanh::where('id','truyen_id')->get();
        $thuocloai = ThuocLoai::where('id','truyen_id')->get();
        //dd($thuocdanh);
        return view('admincp.truyen.index')->with(compact('list_truyen','thuocdanh','thuocloai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();
        $theloai = TheLoai::orderBy('id', 'DESC')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc','theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate(
            [
                'tentruyen' => 'required|unique:truyen|max:255',
                'slug_truyen' => 'required|unique:truyen|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,
                    min_height=100,max_width=1000,max_height=1000',
                'tomtat' => 'required',
                'tacgia' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'tukhoa' => 'required',
                'truyennoibat' => 'required',
            ],
            [
                'tentruyen.required' => 'Vui lòng nhập tên truyện!',
                'tentruyen.unique' => 'Tên truyện đã tồn tại, Vui lòng nhập tên truyện khác!',
                'slug_truyen.unique' => 'Slug truyện đã tồn tại, Vui lòng nhập slug truyện khác!',
                'slug_truyen.required' => 'Vui lòng nhập slug truyện!',
                'tomtat.required' => 'Vui lòng nhập mô tả truyện!',
                'tacgia.required' => 'Vui lòng nhập tên tác giả!',
                'hinhanh.required' => 'Vui lòng hình ảnh truyện!',
                'hinhanh.dimensions' => 'Kích thước hình ảnh quá lớn!',
            ]
        );
        $data = $request->all();
        // dd($data['theloai']);
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $data['slug_truyen'];

        foreach ($data['danhmuc'] as $key => $danh) {
            $truyen->danhmuc_id = $danh[0];
        }

        foreach ($data['theloai'] as $key => $the) {
            $truyen->theloai_id = $the[0];
        }

        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->tukhoa = $data['tukhoa'];
        $truyen->truyen_noibat = $data['truyennoibat'];

        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');//sử dụng ngày format theo muối h của của việt nam
        //them anh vao folder
        $get_image = $data['hinhanh'];
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $truyen->hinhanh = $new_image;

        $truyen->save();

        $truyen->thuocnhieudanhmuc()->attach($data['danhmuc']);
        $truyen->thuocnhieutheloai()->attach($data['theloai']);

        return redirect()->back()->with('status', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $theloai = TheLoai::orderBy('id', 'DESC')->get();
        $truyen = Truyen::find($id);
        //dd($truyen);
        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();
        return view('admincp.truyen.edit')->with(compact('truyen', 'danhmuc', 'theloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate(
            [
                'tentruyen' => 'required|max:255',
                'slug_truyen' => 'required|max:255',
                'tomtat' => 'required',
                'tacgia' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'tukhoa' => 'required',
                'truyennoibat' => 'required',
            ],
            [
                'tentruyen.required' => 'Vui lòng nhập tên truyện!',
                'slug_truyen.required' => 'Vui lòng nhập slug truyện!',
                'tomtat.required' => 'Vui lòng nhập mô tả truyện!',
                'tacgia.required' => 'Vui lòng nhập tên tác giả!',
            ]
        );
        // dd($data);
        $truyen = Truyen::find($id);
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $data['slug_truyen'];

        foreach ($data['danhmuc'] as $key => $danh) {
            $truyen->danhmuc_id = $danh[0];
        }

        foreach ($data['theloai'] as $key => $the) {
            $truyen->theloai_id = $the[0];
        }

        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->tukhoa = $data['tukhoa'];
        $truyen->truyen_noibat = $data['truyennoibat'];

        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');//sử dụng ngày format theo muối h của của việt nam
        //them anh vao folder
        $get_image = $request->hinhanh;
        if ($get_image) {
            $path = 'public/uploads/truyen/' .$truyen->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);

            $truyen->hinhanh = $new_image;
        }

        $truyen->thuocnhieudanhmuc()->attach($data['danhmuc']);
        $truyen->thuocnhieutheloai()->attach($data['theloai']);

        $truyen->save();
        return redirect()->back()->with('status', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function truyennoibat(Request $request)
    {
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();
    }
}
