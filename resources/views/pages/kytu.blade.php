@extends('../layout')
@section('slider')
    @include('pages.slider')
@endsection
@section('content')
    <style type="text/css">
        a.kytu {
            font-weight: bold;
            padding: 0px 13px;
            margin: 5px;
            color: black;
            background: burlywood;
            cursor: pointer;
            text-decoration: none;
        }

        a.kytu:hover {
            color: blue;
            background-color: antiquewhite;
        }
    </style>
    <h3 class="title">Lọc Truyện Sách</h3>

    <div class="my-4">
        <a class="kytu" href="{{ url('/kytu/0-9') }}" class="">0-9</a>

        @foreach (range('A', 'Z') as $char)
            <a class="kytu" href="{{ url('/kytu/' . $char) }}" class=""> {{ $char }} </a>
        @endforeach
    </div>

    <h3>Mới Cập Nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Tên Sách</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Danh Mục</th>
                        <th scope="col">Thể Loại</th>
                        <th scope="col">Lượt xem</th>
                        <th scope="col">Xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sach as $key => $value)
                        <tr>
                            <td>
                                <a target="_blank"
                                    href="{{ url('doc-sach/' . $value->slug_sach) }}">{{ $value->tensach }}</a>
                            </td>
                            <td>
                                <img src="{{ asset('public/uploads/sach/' . $value->hinhanh) }}" width="80"
                                    height="80">
                            </td>
                            <td>{{ $value->danhmuc->tenDM }}</td>
                            <td>{{ $value->theloai->tentheloai }}</td>
                            <td>{{ $value->view }}</td>
                            <td>
                                <a target="_blank" href="{{ url('doc-sach/' . $value->slug_sach) }}">Đọc</a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($truyen as $key => $tr)
                        <tr>
                            <td><a target="_blank" href="#">{{ $tr->tentruyen }}</a></td>
                            <td>
                                <img src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}" width="80"
                                    height="80">
                            </td>
                            <td>{{ $tr->danhmuc->tenDM }}</td>
                            <td>{{ $tr->theloai->tentheloai }}</td>
                            <td>{{ $tr->view }}</td>
                            <td><a target="_blank" href="#">Đọc</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $truyen->onEachSide(1)->links('pagination-bootstrap-5')}} --}}
        </div>
    </div>
@endsection
