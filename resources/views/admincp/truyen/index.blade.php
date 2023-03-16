@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê Truyện</div>
                    <div class="card-body">
                        <div id="thongbao"></div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên Truyện</th>
                                    <th scope="col">Từ khóa</th>
                                    <th scope="col">Slug Truyện</th>
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
                                @foreach ($list_truyen as $key => $truyen)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td><img src="{{ asset('public/uploads/truyen/' . $truyen->hinhanh) }}" height="200"
                                                width="200" alt=""></td>
                                        <td>{{ $truyen->tentruyen }}</td>
                                        <td>{{ $truyen->tukhoa }}</td>
                                        <td>{{ $truyen->slug_truyen }}</td>
                                        <td>
                                            @php
                                                $tomtat = substr($truyen->tomtat,0,200)
                                            @endphp
                                            {!! $tomtat !!}
                                        </td>
                                        <td>
                                            @foreach ($thuocdanh as $key => $muc)
                                                {{ $muc->danhmuc_id }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($thuocloai as $key => $loai)
                                                {{ $loai->tentheloai }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($truyen->kichhoat == 0)
                                                <span class="text text-success">Kích Hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích Hoạt</span>
                                            @endif
                                        </td>
                                        <td width="15%">
                                            @if ($truyen->truyen_noibat == 0)
                                                <form action="">
                                                    @csrf
                                                    <select class="form-select truyennoibat" data-truyen_id="{{$truyen->id}}" name="truyennoibat"
                                                        id="inputGroupSelect02">
                                                        <option selected value="0">Sách mới</option>
                                                        <option value="1">Sách nổi bật</option>
                                                        <option value="2">Sách xem nhiều</option>
                                                    </select>
                                                </form>
                                            @else
                                                @if ($truyen->truyen_noibat == 1)
                                                    <form action="">
                                                        @csrf
                                                        <select class="form-select truyennoibat" data-truyen_id="{{$truyen->id}}" name="truyennoibat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Sách mới</option>
                                                            <option selected value="1">Sách nổi bật</option>
                                                            <option value="2">Sách xem nhiều</option>
                                                        </select>
                                                    </form>
                                                @else
                                                    <form action="">
                                                        @csrf
                                                        <select class="form-select truyennoibat" data-truyen_id="{{$truyen->id}}" name="truyennoibat"
                                                            id="inputGroupSelect02">
                                                            <option value="0">Sách mới</option>
                                                            <option value="1">Sách nổi bật</option>
                                                            <option selected value="2">Sách xem nhiều</option>
                                                        </select>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $truyen->created_at }} - {{ $truyen->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if ($truyen->updated_at != '')
                                                {{ $truyen->updated_at }} - {{ $truyen->updated_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('truyen.edit', [$truyen->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('truyen.destroy', [$truyen->id]) }}" method="POST">
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
