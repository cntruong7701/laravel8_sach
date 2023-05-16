@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thêm sách</div>
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
                        <form method="POST" action="{{ route('sach.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Sách</label>
                                <input type="text" class="form-control" value="{{ old('tenSach') }}" name="tenSach"
                                    onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp"
                                    placeholder="tên sách ...">
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
                                <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                                <input type="text" class="form-control" value="{{ old('slug_sach') }}" name="slug_sach"
                                    id="convert_slug" aria-describedby="emailHelp" placeholder="tên sách ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt sách</label>
                                <textarea class="form-control" name="tomtat" rows="5" style="resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Số Tập</label>
                                <input type="text" class="form-control" value="{{ old('sochuong') }}" name="sochuong">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Danh mục sách:</label><br>
                                <select class="form-select form-control" name="danhmuc" id="inputGroupSelect02">
                                    @foreach ($danhmuc as $key=>$muc)
                                        <option value="{{ $muc->id }}">{{ $muc->tenDM }}</option>
                                    @endforeach
                                </select>
                                {{-- @foreach ($danhmuc as $key => $muc)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="danhmuc[]" id="danhmuc_{{ $muc->id }}" value="{{ $muc->id }}">
                                    <label class="form-check-label" for="danhmuc_{{ $muc->id }}">{{ $muc->tenDM }}</label>
                                </div>
                                @endforeach --}}
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thể Loại</label>
                                <select class="form-select form-control" name="theloai" id="inputGroupSelect02">
                                    @foreach ($theloai as $key => $the)
                                        <option value="{{ $the->id }}">{{ $the->tentheloai }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control-file" value="{{ old('hinhanh') }}"
                                    name="hinhanh">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt sách</label>
                                <select class="form-select form-control" name="kichhoat" id="inputGroupSelect02">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Sách nổi bật</label>
                                <select class="form-select form-control" name="sachnoibat" id="inputGroupSelect02">
                                    <option value="0">Sách mới</option>
                                    <option value="1">Sách nổi bật</option>
                                    <option value="2">Sách xem nhiều</option>
                                </select>
                            </div>
                            <button type="submit" name="themsach" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
