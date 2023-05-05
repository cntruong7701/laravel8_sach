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
                        <form method="POST" action="{{ route('sach.update', [$book->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Sách</label>
                                <input type="text" class="form-control" value="{{$book->tensach}}" name="tenSach" onkeyup="ChangeToSlug();" id="slug"
                                    aria-describedby="emailHelp" placeholder="tên sách ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                <input type="text" class="form-control" value="{{$book->tacgia}}" name="tacgia"
                                    aria-describedby="emailHelp" placeholder="tên tác giả...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Từ Khóa</label>
                                <input type="text" class="form-control" value="{{$book->tukhoa}}" name="tukhoa"
                                    aria-describedby="emailHelp" placeholder="từ khóa...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                                <input type="text" class="form-control" value="{{$book->slug_sach}}" name="slug_sach" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="tên sách ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tóm tắt sách</label>
                                <textarea class="form-control" name="tomtat" rows="5" style="resize: none;">{{$book->tomtat}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Danh mục sách</label>
                                <select class="form-select form-control" name="danhmuc" id="inputGroupSelect02">
                                    @foreach($danhmuc as $key => $muc)
                                        <option {{$muc->id == $book->danhmuc_id ? 'selected' : ''}} value="{{$muc->id}}">{{$muc->tenDM}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Thể Loại</label>
                                <select class="form-select form-control" name="theloai" id="inputGroupSelect02">
                                    @foreach($theloai as $key => $the)
                                        <option {{$the->id == $book->theloai_id ? 'selected' : ''}} value="{{$the->id}}">{{$the->tentheloai}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control-file" value="{{old('hinhanh')}}" name="hinhanh">
                                <img src="{{asset('public/uploads/sach/'.$book->hinhanh)}}" height="200" width="200" alt="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt sách</label>
                                <select class="form-select form-control" name="kichhoat" id="inputGroupSelect02">
                                    @if ($book->kichhoat == 0)
                                        <option selected value="0">Kích hoạt</option>
                                        <option value="1">Không kích hoạt</option>
                                    @else
                                        <option value="0">Kích hoạt</option>
                                        <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Sách nổi bật</label>
                                <select class="form-select form-control" name="sachnoibat" id="inputGroupSelect02">
                                    @if ($book->sach_noibat == 0)
                                        <option selected value="0">Sách mới</option>
                                        <option value="1">Sách nổi bật</option>
                                        <option value="2">Sách xem nhiều</option>
                                    @else
                                        @if ($book->sach_noibat == 1)
                                            <option value="0">Sách mới</option>
                                            <option selected value="1">Sách nổi bật</option>
                                            <option value="2">Sách xem nhiều</option>
                                        @else
                                            <option value="0">Sách mới</option>
                                            <option value="1">Sách nổi bật</option>
                                            <option selected value="2">Sách xem nhiều</option>
                                        @endif
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="themsach" class="btn btn-primary">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
