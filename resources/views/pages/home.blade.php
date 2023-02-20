@extends('../layout')
@section('slider')
    @include('pages.slider')
@endsection
@section('content')
    <h3>Sách mới cập nhật</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($sach as $key => $value)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ asset('public/uploads/sach/'.$value->hinhanh) }}" width="400" alt="">
                            <div class="card-body">
                                <h5>{{$value->tensach}}</h5>
                                <p class="card-text">{{$value->tomtat}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{url('doc-sach/'.$value->slug_sach)}}" class="btn btn-sm btn-outline-secondary">Đọc</a>
                                        <a href="" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye">
                                                4020</i></a>
                                    </div>
                                    <small class="text-muted">9 mins ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="" class="btn btn-success my-5">Xem tất cả</a>
        </div>
    </div>
@endsection
