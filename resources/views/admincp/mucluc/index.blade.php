@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê Mục Lục</div>
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
                                <form method="POST" action="{{ route('mucluc.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm Danh Mục</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tên Mục</label>
                                                <input type="text" class="form-control" value="{{ old('tieude') }}"
                                                    name="tieude" onkeyup="ChangeToSlug();" id="slug"
                                                    aria-describedby="emailHelp" placeholder="Tên Mục Lục ...">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Slug Mục Lục</label>
                                                <input type="text" class="form-control" value="{{ old('slug_mucluc') }}"
                                                    name="slug_mucluc" id="convert_slug" aria-describedby="emailHelp"
                                                    placeholder="Tên Mục Lục ...">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tóm tắt Mục Lục</label>
                                                <input type="text" class="form-control" value="{{ old('tomtat') }}"
                                                    name="tomtat" id="convert_slug" aria-describedby="emailHelp"
                                                    placeholder="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nội Dung Mục Lục</label>
                                                <textarea class="form-control" id="noidung_mucluc" name="noidung" rows="5" style="resize: none;"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Thuộc sách</label>
                                                <select class="form-control" name="sach_id" id="inputGroupSelect02">
                                                    @foreach ($sach as $key => $muc)
                                                        <option value="{{ $muc->id }}">{{ $muc->tensach }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Kích hoạt Mục Lục</label>
                                                <select class="form-control" name="kichhoat" id="inputGroupSelect02">
                                                    <option value="0">Kích hoạt</option>
                                                    <option value="1">Không kích hoạt</option>
                                                </select>
                                            </div>
                                            <button type="submit" name="themmucluc" class="btn btn-primary">Thêm</button>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                                            </button>
                                        </div>
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
                            <th scope="col">Tên Mục lục</th>
                            <th scope="col">Slug Mục lục</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Thuộc sách</th>
                            <th scope="col">Kích Hoạt</th>
                            <th scope="col">Quản ký</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mucluc as $key => $muc)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $muc->tieude }}</td>
                                <td>{{ $muc->slug_mucluc }}</td>
                                <td>
                                    {{-- {{ $muc->tomtat }} --}}
                                    {{ substr($muc->tomtat, 1, 100) }}...
                                </td>
                                <td>
                                    {{-- {{ $muc->noidung }} --}}
                                    {{ substr($muc->noidung, 1, 100) }}...
                                </td>
                                <td>{{ $muc->sach->tensach }}</td>
                                <td>
                                    @if ($muc->kichhoat == 0)
                                        <span class="text text-success">Kích Hoạt</span>
                                    @else
                                        <span class="text text-danger">Không Kích Hoạt</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('mucluc.edit', [$muc->id]) }}" class="btn btn-primary">Sửa</a>
                                        <form action="{{ route('mucluc.destroy', [$muc->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có chắc muốn xóa mục lục này không?')"
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
@endsection
