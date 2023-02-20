@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm Mục Lục</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('mucluc.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Mục</label>
                                <input type="text" class="form-control" value="{{old('tieude')}}" name="tieude" onkeyup="ChangeToSlug();" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên Mục Lục ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug Mục Lục</label>
                                <input type="text" class="form-control" value="{{old('slug_mucluc')}}" name="slug_mucluc" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="Tên Mục Lục ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt Mục Lục</label>
                                <input type="text" class="form-control" value="{{old('tomtat')}}" name="tomtat" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nội Dung Mục Lục</label>
                                <textarea class="form-control" id="noidung_mucluc" name="noidung" rows="5" style="resize: none;"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thuộc sách</label>
                                <select class="form-select" name="sach_id" id="inputGroupSelect02">
                                    @foreach($sach as $key => $muc)
                                        <option value="{{$muc->id}}">{{$muc->tensach}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt Mục Lục</label>
                                <select class="form-select" name="kichhoat" id="inputGroupSelect02">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                            <button type="submit" name="themmucluc" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
