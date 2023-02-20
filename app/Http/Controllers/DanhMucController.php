<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $danhSach = DanhMuc::orderBy('id', 'DESC')->get();
        return view('admincp.danhmuc.index')->with(compact('danhSach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admincp.danhmuc.create');
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
                'tenDM' => 'required|unique:danhmuc|max:255',
                'slug_danhmuc' => 'required|unique:danhmuc|max:255',
                'mota' => 'required|max:255',
                'kichHoat' => 'required',
            ],
            [
                'tenDM.required' => 'Vui lòng nhập tên danh mục!',
                'tenDM.unique' => 'Tên danh mục đã tồn tại, Vui lòng nhập tên danh mục khác!',
                'slug_danhmuc' => 'Slug danh mục đã tồn tại, Vui lòng nhập slug danh mục khác!',
                'mota.required' => 'Vui lòng nhập mô tả danh mục!',
            ]
        );
        // dd($data);
        $danhMucSach = new DanhMuc();
        $danhMucSach->tenDM = $data['tenDM'];
        $danhMucSach->slug_danhmuc = $data['slug_danhmuc'];
        $danhMucSach->mota = $data['mota'];
        $danhMucSach->kichHoat = $data['kichHoat'];
        $danhMucSach->save();
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
        $danhmuc = DanhMuc::find($id);
        return view('admincp.danhmuc.edit')->with(compact('danhmuc'));

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
                'tenDM' => 'required|max:255',
                'slug_danhmuc' => 'required|max:255',
                'mota' => 'required|max:255',
                'kichHoat' => 'required',
            ],
            [
                'slug_danhmuc.required' => 'Vui lòng nhập slug danh mục!',
                'tenDM.required' => 'Vui lòng nhập tên danh mục!',
                'mota.required' => 'Vui lòng nhập mô tả danh mục!',
            ]
        );
        // dd($data);
        $danhMucSach = DanhMuc::find($id);
        $danhMucSach->tenDM = $data['tenDM'];
        $danhMucSach->mota = $data['mota'];
        $danhMucSach->kichHoat = $data['kichHoat'];
        $danhMucSach->save();
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
        DanhMuc::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
