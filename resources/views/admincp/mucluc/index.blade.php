@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liệt kê Mục Lục</div>

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
                                        <td>{{ $muc->tomtat }}</td>
                                        <td>{{ $muc->noidung }}</td>
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
                                                <a href="{{ route('mucluc.edit', [$muc->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('mucluc.destroy', [$muc->id]) }}"
                                                    method="POST">
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
        </div>
    </div>
@endsection
