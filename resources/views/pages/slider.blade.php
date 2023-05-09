<div class="row container">
    <h3>Sách hay nên đọc</h3>
    <div class="owl-carousel owl-theme">
        @foreach ($slide_sach as $item => $value)
            <div class="item">
                <a href="{{ url('doc-sach/' . $value->slug_sach) }}">
                    <img src="{{ asset('/uploads/sach/' . $value->hinhanh) }}" class="lazy img-responsive" width="400" height="300"
                        alt="">
                </a>
            </div>
        @endforeach
    </div>
</div>
