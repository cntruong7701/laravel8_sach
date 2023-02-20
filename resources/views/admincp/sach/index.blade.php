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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên Sách</th>
                                    <th scope="col">Từ khóa</th>
                                    <th scope="col">Slug Sách</th>
                                    <th scope="col">Tóm tắt</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Kích Hoạt</th>
                                    <th scope="col">Ngày Tạo</th>
                                    <th scope="col">Ngày Sửa</th>
                                    <th scope="col">Quản ký</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_book as $key => $Sach)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td><img src="{{asset('public/uploads/sach/'.$Sach->hinhanh)}}" height="200" width="200" alt=""></td>
                                        <td>{{ $Sach->tensach }}</td>
                                        <td>{{ $Sach->tukhoa }}</td>
                                        <td>{{ $Sach->slug_sach }}</td>
                                        <td>{{ $Sach->tomtat }}</td>
                                        <td>{{ $Sach->danhmuc->tenDM }}</td>
                                        <td>{{ $Sach->theloai->tentheloai }}</td>
                                        <td>
                                            @if ($Sach->kichhoat == 0)
                                                <span class="text text-success">Kích Hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích Hoạt</span>
                                            @endif
                                        </td>
                                        <td>{{ $Sach->created_at }} - {{ $Sach->created_at->diffForHumans()}}</td>
                                        <td>
                                            @if ($Sach->updated_at != '')
                                                {{ $Sach->updated_at }} - {{ $Sach->updated_at->diffForHumans()}}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('sach.edit', [$Sach->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('sach.destroy', [$Sach->id]) }}"
                                                    method="POST">
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
