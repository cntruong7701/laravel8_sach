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
        <hr>
        <h2 class="mt-3 text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Bình Luận</h2>
        <div class="col-12">
            <form action="{{ url('xem-mucluc/'. $comment_sach->slug_sach . '/comments') }}" method="POST"
                class="mb-0 d-flex flex-column">
                @csrf
                <label for="exampleInputEmail1" class="form-label">Tên Sách</label>
                <select class="form-select form-control" name="tenSach" id="inputGroupSelect02">
                    <option value="{{ $comment_sach->id }}">{{ $comment_sach->tensach }}</option>
                </select>
                <label for="author" class="font-medium text-gray-700">Tên</label>
                <input type="text" name="author"
                    class="mt-1 py-2 px-3 block w-full border border-light rounded shadow-sm" value="{{ old('author') }}"
                    required>

                <label for="author" class="mt-3 block font-medium text-gray-700">Nội dung</label>
                <textarea name="text" class="mt-1 py-2 px-3 block w-full border border-light rounded shadow-sm" required>{{ old('text') }}</textarea>

                <button type="submit" style="width: 10%"
                    class="mt-3 py-2 px-4 border border-light font-medium rounded text-white bg-info">Post</button>

            </form>
        </div>
        {{-- <div class="fb-comments" data-href="{{ \URL::current() }}" data-width="" data-numposts="10"></div> --}}
        {{-- Show Comment --}}
        <div class="col-12 mt-3">
            @foreach ($comments as $comment)
                <div class="container">
                    <div class="review-list">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    <div class="left">
                                        <span>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="profile-pict-img img-fluid" alt="" />
                                        </span>
                                    </div>
                                    <div class="right">
                                        <h4>
                                            {{ $comment->author }}
                                        </h4>
                                        <div class="review-description">
                                            <p>
                                                {{ $comment->text }}
                                            </p>
                                        </div>
                                        <span
                                            class="publish py-3 d-inline-block w-100">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
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
