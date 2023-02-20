<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MucLuc;
use App\Models\Sach;

class MucLucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mucluc = MucLuc::with('sach')->orderBy('id','DESC')->get();
        //dd($mucluc);
        return view('admincp.mucluc.index')->with(compact('mucluc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sach = Sach::orderBy('id','DESC')->get();
        return view('admincp.mucluc.create')->with(compact('sach'));
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
                'tieude' => 'required|unique:mucluc|max:255',
                'slug_mucluc' => 'required|unique:mucluc|max:255',
                
                'noidung' => 'required',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'sach_id' => 'required',
            ],
            [
                'tieude.required' => 'Vui lòng nhập tên sách!',
                'tieude.unique' => 'Tên sách đã tồn tại, Vui lòng nhập tên sách khác!',
                'slug_mucluc.unique' => 'Slug sách đã tồn tại, Vui lòng nhập slug sách khác!',
                'slug_mucluc.required' => 'Vui lòng nhập slug sách!',
                'tomtat.required' => 'Vui lòng nhập tóm tắt mục lục!',
                'noidung.required' => 'Vui lòng nhập nội dung mục luc!',
            ]
        );
        // dd($data);
        $MucLuc = new MucLuc();
        $MucLuc->tieude = $data['tieude'];
        $MucLuc->slug_mucluc = $data['slug_mucluc'];
        $MucLuc->tomtat = $data['tomtat'];
        $MucLuc->kichhoat = $data['kichhoat'];
        $MucLuc->sach_id = $data['sach_id'];
        $MucLuc->noidung = $data['noidung'];

        $MucLuc->save();
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
        $mucluc = MucLuc::find($id);
        $sach = Sach::orderBy('id','DESC')->get();
        return view('admincp.mucluc.edit')->with(compact('sach','mucluc'));
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
                'tieude' => 'required|max:255',
                'slug_mucluc' => 'required|max:255',
                
                'noidung' => 'required',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'sach_id' => 'required',
            ],
            [
                'tieude.required' => 'Vui lòng nhập tên sách!',
                'tieude.unique' => 'Tên sách đã tồn tại, Vui lòng nhập tên sách khác!',
                'slug_mucluc.unique' => 'Slug sách đã tồn tại, Vui lòng nhập slug sách khác!',
                'slug_mucluc.required' => 'Vui lòng nhập slug sách!',
                'tomtat.required' => 'Vui lòng nhập tóm tắt mục lục!',
                'noidung.required' => 'Vui lòng nhập nội dung mục luc!',
            ]
        );
        // dd($data);
        $MucLuc = MucLuc::find($id);
        $MucLuc->tieude = $data['tieude'];
        $MucLuc->slug_mucluc = $data['slug_mucluc'];
        $MucLuc->tomtat = $data['tomtat'];
        $MucLuc->kichhoat = $data['kichhoat'];
        $MucLuc->sach_id = $data['sach_id'];
        $MucLuc->noidung = $data['noidung'];

        $MucLuc->save();
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
        MucLuc::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}
