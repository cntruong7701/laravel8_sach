@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê sách</div>
                    <div class="card-body">
                        <div id="thongbao"></div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Thêm Nhanh
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="POST" action="{{ route('sach.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm Sách</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
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

                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Tên Sách</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('tenSach') }}" name="tenSach"
                                                            onkeyup="ChangeToSlug();" id="slug"
                                                            aria-describedby="emailHelp" placeholder="tên sách ...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('tacgia') }}" name="tacgia"
                                                            aria-describedby="emailHelp" placeholder="tên tác giả...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Từ khóa</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('tukhoa') }}" name="tukhoa"
                                                            aria-describedby="emailHelp" placeholder="từ khóa...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Slug sách</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('slug_sach') }}" name="slug_sach"
                                                            id="convert_slug" aria-describedby="emailHelp"
                                                            placeholder="tên sách ...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Tóm tắt
                                                            sách</label>
                                                        <textarea class="form-control" name="tomtat" rows="5" style="resize: none;"></textarea>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="exampleInputEmail1" class="form-label">Số Tập</label>
                                                        <input type="text" class="form-control" value="{{ old('sochuong') }}" name="sochuong">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Danh mục
                                                            sách:</label><br>
                                                        <select class="form-select form-control" name="danhmuc"
                                                            id="inputGroupSelect02">
                                                            @foreach ($danhmuc as $key => $muc)
                                                                <option value="{{ $muc->id }}">{{ $muc->tenDM }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Thể Loại</label>
                                                        <select class="form-select form-control" name="theloai"
                                                            id="inputGroupSelect02">
                                                            @foreach ($theloai as $key => $the)
                                                                <option value="{{ $the->id }}">{{ $the->tentheloai }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Hình
                                                            ảnh</label>
                                                        <input type="file" class="form-control-file"
                                                            value="{{ old('hinhanh') }}" name="hinhanh">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Kích hoạt
                                                            sách</label>
                                                        <select class="form-select form-control" name="kichhoat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Kích hoạt</option>
                                                            <option value="1">Không kích hoạt</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Sách nổi
                                                            bật</label>
                                                        <select class="form-select form-control" name="sachnoibat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Sách mới</option>
                                                            <option value="1">Sách nổi bật</option>
                                                            <option value="2">Sách xem nhiều</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            {!! Form::submit('Thêm Dữ liệu', ['class' => 'btn btn-primary my-3']) !!}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table" id="tableBook">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên Sách</th>
                                    <th scope="col">Từ khóa</th>
                                    {{-- <th scope="col">Slug Sách</th> --}}
                                    <th scope="col">Tóm tắt</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Kích Hoạt</th>
                                    <th scope="col">Nổi Bật</th>
                                    <th scope="col">Ngày Tạo</th>
                                    <th scope="col">Ngày Sửa</th>
                                    <th scope="col">Quản ký</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_book as $key => $Sach)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td><img src="{{ asset('uploads/sach/' . $Sach->hinhanh) }}" height="100"
                                                width="100" alt=""></td>
                                        <td>
                                            {{-- {{ $Sach->tensach }} --}}
                                            {{ substr($Sach->tensach, 1, 30) }}...
                                        </td>
                                        <td>{{ substr($Sach->tukhoa, 0, 30) }}...</td>
                                        {{-- <td>{{ $Sach->slug_sach }}</td> --}}
                                        <td>
                                            {{ substr($Sach->tomtat, 1, 30) }}...
                                        </td>
                                        <td>{{ $Sach->danhmuc->tenDM }}</td>
                                        <td>{{ $Sach->theloai->tentheloai }}</td>
                                        <td>
                                            @if ($Sach->kichhoat == 0)
                                                <span class="text text-success">Kích Hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích Hoạt</span>
                                            @endif
                                        </td>
                                        <td width="15%">
                                            @if ($Sach->sach_noibat == 0)
                                                <form action="">
                                                    @csrf
                                                    <select class="form-select form-control sachnoibat"
                                                        data-sach_id="{{ $Sach->id }}" name="sachnoibat"
                                                        id="inputGroupSelect02">
                                                        <option selected value="0">Sách mới</option>
                                                        <option value="1">Sách nổi bật</option>
                                                        <option value="2">Sách xem nhiều</option>
                                                    </select>
                                                </form>
                                            @else
                                                @if ($Sach->sach_noibat == 1)
                                                    <form action="">
                                                        @csrf
                                                        <select class="form-select form-control sachnoibat"
                                                            data-sach_id="{{ $Sach->id }}" name="sachnoibat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Sách mới</option>
                                                            <option selected value="1">Sách nổi bật</option>
                                                            <option value="2">Sách xem nhiều</option>
                                                        </select>
                                                    </form>
                                                @else
                                                    <form action="">
                                                        @csrf
                                                        <select class="form-select form-control sachnoibat"
                                                            data-sach_id="{{ $Sach->id }}" name="sachnoibat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Sách mới</option>
                                                            <option value="1">Sách nổi bật</option>
                                                            <option selected value="2">Sách xem nhiều</option>
                                                        </select>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $Sach->created_at }} - {{ $Sach->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if ($Sach->updated_at != '')
                                                {{ $Sach->updated_at }} - {{ $Sach->updated_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('sach.edit', [$Sach->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('sach.destroy', [$Sach->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Bạn có chắc muốn xóa sách này không?')"
                                                        class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
