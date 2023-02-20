@extends('../layout')
{{-- @section('slider')
    @include('pages.slider')
@endsection --}}
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang Chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
        </ol>
    </nav>
    <h3> Bạn tìm kiếm với từ khóa là: {{ $tukhoa }}</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @php
                    $count = count($sach);
                @endphp

                @if ($count == 0)
                    <div class="col-md-12">
                        <div class="card col-mb-12 shadow-sm">
                            <div class="card-body">
                                <p>Không tìm thấy sách!</p>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($sach as $key => $value)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="{{ asset('public/uploads/sach/' . $value->hinhanh) }}" width="400"
                                    alt="">
                                <div class="card-body">
                                    <h5>{{ $value->tensach }}</h5>
                                    <p class="card-text">{{ $value->tomtat }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ url('doc-sach/' . $value->slug_sach) }}"
                                                class="btn btn-sm btn-outline-secondary">Đọc</a>
                                            <a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye">
                                                    4020</i></a>
                                        </div>
                                        <small class="text-muted">9 mins ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
