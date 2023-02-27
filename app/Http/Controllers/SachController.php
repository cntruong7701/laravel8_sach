<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DanhMuc;
use App\Models\Sach;
use App\Models\TheLoai;

class SachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_book = Sach::with('danhmuc', 'theloai')->orderBy('id','DESC')->get();
        //dd($sach);
        return view('admincp.sach.index')->with(compact('list_book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $theloai = TheLoai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();
        return view('admincp.sach.create')->with(compact('danhmuc', 'theloai'));
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
                'tenSach' => 'required|unique:sach|max:255',
                'slug_sach' => 'required|unique:sach|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,
                    min_height=100,max_width=1000,max_height=1000',
                'tomtat' => 'required',
                'tacgia' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'sachnoibat' => 'required',
            ],
            [
                'tenSach.required' => 'Vui lòng nhập tên sách!',
                'tenSach.unique' => 'Tên sách đã tồn tại, Vui lòng nhập tên sách khác!',
                'slug_sach.unique' => 'Slug sách đã tồn tại, Vui lòng nhập slug sách khác!',
                'slug_sach.required' => 'Vui lòng nhập slug sách!',
                'tomtat.required' => 'Vui lòng nhập mô tả sách!',
                'tacgia.required' => 'Vui lòng nhập tên tác giả!',
                'hinhanh.required' => 'Vui lòng hình ảnh sách!',
                'hinhanh.dimensions' => 'Kích thước hình ảnh quá lớn!',
            ]
        );
        // dd($data);
        $Sach = new Sach();
        $Sach->tenSach = $data['tenSach'];
        $Sach->tacgia = $data['tacgia'];
        $Sach->slug_sach = $data['slug_sach'];
        $Sach->theloai_id = $data['theloai'];
        $Sach->tomtat = $data['tomtat'];
        $Sach->kichhoat = $data['kichhoat'];
        $Sach->danhmuc_id = $data['danhmuc'];
        $Sach->tukhoa = $data['tukhoa'];
        $Sach->sach_noibat = $data['sachnoibat'];

        $Sach->created_at = Carbon::now('Asia/Ho_Chi_Minh');//sử dụng ngày format theo muối h của của việt nam
        //them anh vao folder
        $get_image = $data['hinhanh'];
        $path = 'public/uploads/sach/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);

        $Sach->hinhanh = $new_image;

        $Sach->save();
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
        $book = Sach::find($id);
        //dd($sach);
        $danhmuc = DanhMuc::orderBy('id', 'DESC')->get();
        return view('admincp.sach.edit')->with(compact('book', 'danhmuc', 'theloai'));
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
                'tenSach' => 'required|max:255',
                'tacgia' => 'required',
                'slug_sach' => 'required|max:255',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'tukhoa' => 'required',
                'sachnoibat' => 'required',
            ],
            [
                'tacgia.required' => 'Vui lòng nhập tên tác giả!',
                'tenSach.required' => 'Vui lòng nhập tên sách!',
                'slug_sach.required' => 'Vui lòng nhập slug sách!',
                'tomtat.required' => 'Vui lòng nhập mô tả sách!',
            ]
        );
        // dd($data);
        $Sach = Sach::find($id);
        $Sach->tenSach = $data['tenSach'];
        $Sach->tacgia = $data['tacgia'];
        $Sach->slug_sach = $data['slug_sach'];
        $Sach->theloai_id = $data['theloai'];
        $Sach->tomtat = $data['tomtat'];
        $Sach->kichhoat = $data['kichhoat'];
        $Sach->danhmuc_id = $data['danhmuc'];
        $Sach->tukhoa = $data['tukhoa'];
        $Sach->sach_noibat = $data['sachnoibat'];

        $Sach->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        //them anh vao folder
        $get_image = $request->hinhanh;
        if ($get_image) {
            $path = 'public/uploads/sach/' .$Sach->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/sach/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);

            $Sach->hinhanh = $new_image;
        }
        
        $Sach->save();
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
        $sach = Sach::find($id);
        $path = 'public/uploads/sach/' .$sach->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        Sach::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }

    public function sachnoibat(Request $request)
    {
        $data = $request->all();
        $sach = Sach::find($data['sach_id']);
        
        $sach->sach_noibat = $data['sachnoibat'];
        $sach->save();
    }
}
