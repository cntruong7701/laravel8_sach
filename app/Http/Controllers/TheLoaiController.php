<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $theloai = TheLoai::orderBy('id', 'DESC')->get();
        return view('admincp.theloai.index')->with(compact('theloai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admincp.theloai.create');
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
                'tentheloai' => 'required|unique:theloai|max:255',
                'slug_theloai' => 'required|unique:theloai|max:255',
                
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [
                'tentheloai.required' => 'Vui lòng nhập tên thể loại!',
                'tentheloai.unique' => 'Tên thể loại đã tồn tại, Vui lòng nhập tên thể loại khác!',
                'slug_theloai.unique' => 'Slug thể loại đã tồn tại, Vui lòng nhập slug thể loại khác!',
                'slug_theloai.required' => 'Vui lòng nhập slug thể loại!',
                'mota.required' => 'Vui lòng nhập mô tả thể loại!',
                'mota.max' => 'Mô tả quá dài!',
            ]
        );
        // dd($data);
        $TheLoai = new TheLoai();
        $TheLoai->tentheloai = $data['tentheloai'];
        $TheLoai->slug_theloai = $data['slug_theloai'];
        $TheLoai->mota = $data['mota'];
        $TheLoai->kichhoat = $data['kichhoat'];

        $TheLoai->save();
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
        $theloai = TheLoai::find($id);
        return view('admincp.theloai.edit')->with(compact('theloai'));
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
                'tentheloai' => 'required|max:255',
                'slug_theloai' => 'required|max:255',
                
                'mota' => 'required',
                'kichhoat' => 'required',
            ],
            [
                'tentheloai.required' => 'Vui lòng nhập tên thể loại!',
                'slug_theloai.required' => 'Vui lòng nhập slug thể loại!',
                'mota.required' => 'Vui lòng nhập mô tả thể loại!',
            ]
        );
        // dd($data);
        $TheLoai = TheLoai::find($id);
        $TheLoai->tentheloai = $data['tentheloai'];
        $TheLoai->slug_theloai = $data['slug_theloai'];
        $TheLoai->mota = $data['mota'];
        $TheLoai->kichhoat = $data['kichhoat'];

        $TheLoai->save();
        return redirect()->back()->with('status', 'Thay đổi thành công');
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
        TheLoai::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
