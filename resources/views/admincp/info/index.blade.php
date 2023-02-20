@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                                <a href="{{ route('theloai.edit', [$loai->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('theloai.destroy', [$loai->id]) }}"
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
