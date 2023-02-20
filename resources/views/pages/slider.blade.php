<h3>Sách hay nên đọc</h3>
<div class="owl-carousel owl-theme">
    @foreach ($slide_sach as $item => $value)
        <div class="item">
            <img src="{{ asset('public/uploads/sach/'.$value->hinhanh) }}" width="400" height="300" alt="">
            <h3>{{$value->tensach}}</h3>
            <p><i class="fa fa-eye"> {{$value->view}}</i></p>
            <a href="{{ url('doc-sach/' . $value->slug_sach) }}" class="btn btn-danger btn-sm my-5">Đọc</a>
        </div>
    @endforeach
</div>
