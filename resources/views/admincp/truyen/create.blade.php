@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm Truyện</div>
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
                        <form method="POST" action="{{ route('truyen.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Truyện</label>
                                <input type="text" class="form-control" value="{{ old('tentruyen') }}" name="tentruyen"
                                    onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp"
                                    placeholder="tên Truyện ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" value="{{ old('tacgia') }}" name="tacgia"
                                    aria-describedby="emailHelp" placeholder="tên tác giả...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                <input type="text" class="form-control" value="{{ old('tukhoa') }}" name="tukhoa"
                                    aria-describedby="emailHelp" placeholder="từ khóa...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug Truyện</label>
                                <input type="text" class="form-control" value="{{ old('slug_truyen') }}"
                                    name="slug_truyen" id="convert_slug" aria-describedby="emailHelp"
                                    placeholder="tên Truyện ...">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt Truyện</label>
                                <textarea class="form-control" name="tomtat" rows="5" style="resize: none;"></textarea>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="exampleInputEmail1" class="form-label">Danh mục Truyện: </label><br>
                                @foreach ($danhmuc as $key => $muc)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}"
                                            value="{{$muc->id}}">
                                        <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{ $muc->tenDM }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3 form-group">
                                <label for="exampleInputEmail1" class="form-label">Thể Loại: </label><br>
                                @foreach ($theloai as $key => $the)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="theloai[]" type="checkbox" id="theloai_{{$the->id}}"
                                            value="{{$the->id}}">
                                        <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control-file" value="{{ old('hinhanh') }}" name="hinhanh">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt Truyện</label>
                                <select class="form-select" name="kichhoat" id="inputGroupSelect02">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Truyện nổi bật</label>
                                <select class="form-select" name="truyennoibat" id="inputGroupSelect02">
                                    <option value="0">Truyện mới</option>
                                    <option value="1">Truyện nổi bật</option>
                                    <option value="2">Truyện xem nhiều</option>
                                </select>
                            </div>
                            <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
