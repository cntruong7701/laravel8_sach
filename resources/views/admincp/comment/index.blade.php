@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê mục sách</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên người dùng</th>
                                    <th scope="col">Tên Sách</th>
                                    <th scope="col">nội dung</th>
                                    <th scope="col">Quản ký</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comment as $key => $com)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $com->author }}</td>
                                        <td>
                                            {{ $com->sach->tensach}}
                                        </td>
                                        <td>{{ $com->text}}</td>
                                        
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <form action="{{ route('comment.destroy', [$com->id]) }}"
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
