@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liệt kê mục sách</div>

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
                                    <th scope="col">Tên Danh Mục</th>
                                    <th scope="col">Slug Danh Mục</th>
                                    <th scope="col">Mô Tả</th>
                                    <th scope="col">Kích Hoạt</th>
                                    <th scope="col">Quản ký</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhSach as $key => $DanhMuc)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $DanhMuc->tenDM }}</td>
                                        <td>{{ $DanhMuc->slug_danhmuc }}</td>
                                        <td>{{ $DanhMuc->mota }}</td>
                                        <td>
                                            @if ($DanhMuc->kichHoat == 0)
                                                <span class="text text-success">Kích Hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích Hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('danhmuc.edit', [$DanhMuc->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('danhmuc.destroy', [$DanhMuc->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có chắc muốn xóa danh mục không?')"
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
