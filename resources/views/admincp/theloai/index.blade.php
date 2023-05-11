@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê sách</div>

                    <div class="card-body">
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
                                <form method="POST" action="{{ route('theloai.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm Thể Loại</h5>
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
                                                        <label for="exampleInputEmail1" class="form-label">Tên Thể
                                                            Loại</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('tentheloai') }}" name="tentheloai"
                                                            onkeyup="ChangeToSlug();" id="slug"
                                                            aria-describedby="emailHelp" placeholder="Tên Thể Loại ...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Mô Tả</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('mota') }}" name="mota"
                                                            aria-describedby="emailHelp" placeholder="Mô tả...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Slug Thể
                                                            Loại</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('slug_theloai') }}" name="slug_theloai"
                                                            id="convert_slug" aria-describedby="emailHelp"
                                                            placeholder="Tên Thể Loại ...">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Kích hoạt Thể
                                                            Loại</label>
                                                        <select class="form-select form-control" name="kichhoat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Kích hoạt</option>
                                                            <option value="1">Không kích hoạt</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" name="themtheloai"
                                                        class="btn btn-primary">Thêm</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                </form>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Thể Loại</th>
                            <th scope="col">Slug Thể Loại</th>
                            <th scope="col">Mô Tả</th>
                            <th scope="col">Kích Hoạt</th>
                            <th scope="col">Quản Lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($theloai as $key => $loai)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $loai->tentheloai }}</td>
                                <td>{{ $loai->slug_theloai }}</td>
                                <td>{{ $loai->mota }}</td>
                                <td>
                                    @if ($loai->kichhoat == 0)
                                        <span class="text text-success">Kích Hoạt</span>
                                    @else
                                        <span class="text text-danger">Không Kích Hoạt</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('theloai.edit', [$loai->id]) }}" class="btn btn-primary">Sửa</a>
                                        <form action="{{ route('theloai.destroy', [$loai->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có chắc muốn xóa sách này không?')"
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
