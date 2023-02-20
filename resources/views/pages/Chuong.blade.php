@extends('../layout')
{{-- @section('slider')
    @include('pages.slider')
@endsection --}}
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ url('the-loai/' . $sach_breadcrumb->theloai->slug_theloai) }}">{{ $sach_breadcrumb->theloai->tentheloai }}</a>
            </li>
            <li class="breadcrumb-item"><a
                    href="{{ url('danh-muc/' . $sach_breadcrumb->danhmuc->slug_danhmuc) }}">{{ $sach_breadcrumb->danhmuc->tenDM }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sach_breadcrumb->tensach }}</li>
        </ol>
    </nav>
    <div class="row">
        <h4>{{ $mucluc->sach->tensach }}</h4>
        <p>Chương hiện tại: {{ $mucluc->tieude }}</p>
        <div class="col-md-5">
            <style type="text/css">
                .isDisabled {
                    color: currentColor;
                    pointer-events: none;
                    opacity: 0.5;
                    text-decoration: none;
                }
            </style>
            <div class="form-group">
                <label for="">Chọn chương:</label>
                <p><a href="{{ url('xem-mucluc/' . $previous) }}"
                        class="btn btn-primary my-3 {{ $mucluc->id == $min->id ? 'isDisabled' : '' }}">Tập trước</a></p>
                <select name="select-mucluc" aria-label=".form-select-lg example"
                    class="form-select form-select-lg select-mucluc">
                    @foreach ($all_mucluc as $key => $muc)
                        <option value="{{ url('xem-mucluc/' . $muc->slug_mucluc) }}">{{ $muc->tieude }}</option>
                    @endforeach
                </select>
                <p><a href="{{ url('xem-mucluc/' . $next) }}"
                        class="btn btn-primary my-3 {{ $mucluc->id == $max->id ? 'isDisabled' : '' }}">Tập sau</a></p>
            </div>
        </div>
        <div class="noidungchuong">
            {!! $mucluc->noidung !!}
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="" class="">Chọn chương:</label>
                <select name="select-mucluc" aria-label=".form-select-lg example"
                    class="form-select form-select-lg select-mucluc">
                    @foreach ($all_mucluc as $key => $muc)
                        <option value="{{ url('xem-mucluc/' . $muc->slug_mucluc) }}">{{ $muc->tieude }}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="fb-comments" data-href="{{ \URL::current() }}" data-width="" data-numposts="10">
                </div>
            </div>
        </div>
        <div>
            <h3>Lưu và chia sẻ:</h3>
            <div class="fb-share-button" data-href="{{ \URL::current() }}" data-layout="button_count" data-size="small">
                <a target="_blank" href="{{ \URL::current() }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                    Chia sẻ
                </a>
            </div>
            <a href=""><i class="fab fa-twitter"></i></a>
        </div>
    </div>
@endsection
