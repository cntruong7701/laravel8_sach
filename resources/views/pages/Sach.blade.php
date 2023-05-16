@extends('../layout')
{{-- @section('slider')
    @include('pages.slider')
@endsection --}}
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ url('danh-muc/' . $sach->danhmuc->slug_danhmuc) }}">{{ $sach->danhmuc->tenDM }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sach->tensach }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img class="card-img-top" src="{{ asset('/uploads/sach/' . $sach->hinhanh) }}" width="200"
                        alt="">
                </div>
                <div class="col-md-9">
                    <style type="text/css">
                        .infomation-book {
                            list-style: none;
                        }
                    </style>
                    <ul class="infomation-book">
                        <div class="fb-share-button" data-href="{{ \URL::current() }}" data-layout="button_count"
                            data-size="large">
                            <a target="_blank" href="{{ \URL::current() }}&amp;src=sdkpreparse"
                                class="fb-xfbml-parse-ignore">Chia sẻ</a>
                        </div>
                        <script src="https://apis.google.com/js/platform.js"></script>

                        <div class="g-ytsubscribe" data-channelid="UCpvaBbBo6texpg-fDjcTx1g" data-layout="default"
                            data-theme="dark" data-count="hidden"></div>

                        <!----------Lấy Biến Wishlish----------->
                        <input type="hidden" value="{{ $sach->tensach }}" class="wishlist_title">
                        <input type="hidden" value="{{ \URL::current() }}" class="wishlist_url">
                        <input type="hidden" value="{{ $sach->id }}" class="wishlist_id">
                        <!----------EndLấy Biến Wishlish----------->

                        <li>Tên tác phẩm: {{ $sach->tensach }}</li>
                        <li>Ngày đăng: {{ $sach->created_at->diffForHumans() }}</li>
                        <li>Tác giả: {{ $sach->tacgia }}</li>
                        <li>Danh mục:
                            <a href="{{ url('danh-muc/' . $sach->danhmuc->slug_danhmuc) }}"
                                class="text-decoration-none">{{ $sach->danhmuc->tenDM }}</a>
                        </li>
                        <li>Thể Loại:
                            <a href="{{ url('the-loai/' . $sach->theloai->slug_theloai) }}"
                                class="text-decoration-none">{{ $sach->theloai->tentheloai }}</a>
                        </li>
                        <li>
                            Số chapter: 
                            {{ $chapter_current_list_count }}/{{ $sach->sochuong }} -
                                @if ($chapter_current_list_count == $sach->sochuong)
                                    <span>Hoàn Thành</span>
                                @else
                                    <span>Đang Cập Nhật</span>
                                @endif    
                        </li>
                        <li>
                            Lượt xem: 
                            @if ($sach->view > 0)
                                    {{ $sach->view }} Lượt quan tâm
                                @else
                                    @php
                                        echo rand(100, 9999);
                                    @endphp
                                    Lượt quan tâm
                                @endif    
                        </li>
                        <li><a href="#" class="text-decoration-none">Xem mục lục</a></li>
                        @if ($mucluc_dau)
                            <li>
                                <a href="{{ url('xem-mucluc/' . $mucluc_dau->slug_mucluc) }}" class="btn btn-primary mb-2">
                                    Đọc Sách
                                </a>
                                <button class="btn btn-danger mb-2 btn-thichsach"><i class="fa fa-heart"
                                        aria-hidden="true"></i> Sách Yêu Thích </button>
                            </li>
                            <li>
                                <a href="{{ url('xem-mucluc/' . $mucluc_cuoi->slug_mucluc) }}" class="btn btn-success">
                                    Đọc Chương Mới Nhất
                                </a>
                            </li>
                        @else
                            <li><a href="" class="btn btn-danger">Hiện tại chưa cập nhật nội dung</a></li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-12">
                <p>{{ $sach->tomtat }}</p>
            </div>
            <hr>
            <p>Từ khóa tìm kiếm
                @php
                    $tukhoa = explode(',', $sach->tukhoa);
                @endphp
            <div class="tagcloud05">
                <ul>
                    @foreach ($tukhoa as $key => $tu)
                        <li>
                            <a href="{{ url('tag/' . \Str::slug($tu)) }}">
                                <span>{{ $tu }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            </p>
            <hr>
            <h4>Mục Lục</h4>
            <ul class="mucluc">
                @php
                    $chapter = count($mucluc);
                @endphp
                @if ($chapter > 0)
                    @foreach ($mucluc as $key => $muc)
                        <li><a href="{{ url('xem-mucluc/' . $muc->slug_mucluc) }}"
                                class="text-decoration-none">{{ $muc->tieude }}</a></li>
                    @endforeach
                @else
                    <li>Mục lục chưa cập nhật</li>
                @endif

            </ul>
            <hr>
            <h2 class="mt-3 text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">Bình Luận</h2>
            <div class="col-12">
                <form action="{{ url('doc-sach/' . $sach->slug_sach . '/comments') }}" method="POST"
                    class="mb-0 d-flex flex-column">
                    @csrf
                    <label for="exampleInputEmail1" class="form-label">Tên Sách</label>
                    <select class="form-select form-control" name="tenSach" id="inputGroupSelect02">
                        <option value="{{ $sach->id }}">{{ $sach->tensach }}</option>
                    </select>
                    <label for="author" class="font-medium text-gray-700">Tên</label>
                    <input type="text" name="author"
                        class="mt-1 py-2 px-3 block w-full border border-light rounded shadow-sm"
                        value="{{ old('author') }}" required>

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
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="profile-pict-img img-fluid" alt="" />
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
                                        <span class="publish py-3 d-inline-block w-100">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <hr>
            <h4 class="mt-3">Sách liên quan</h4>
            <div class="row">
                @foreach ($cungdanhmuc as $key => $value)
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <img src="{{ asset('/uploads/sach/' . $value->hinhanh) }}" class="w-100" alt="">
                            <div class="card-body">
                                <h5>{{ $value->tensach }}</h5>
                                <p class="card-text limit-text-2">{{ $value->tomtat }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ url('doc-sach/' . $value->slug_sach) }}"
                                            class="btn btn-sm btn-outline-secondary">Đọc</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="col-md-3">
            <h3 class="title_sach">Sách yêu thích</h3>
            <div id="yeuthich" class="row"></div>
            <h4>Sách Nổi Bật</h4>
            <div class="row">
                @foreach ($sachnoibat as $key => $noibat)
                    <div class="row mt-2">
                        <div class="col-md-5">
                            <img src="{{ asset('/uploads/sach/' . $noibat->hinhanh) }}" width="100%" alt="">
                        </div>
                        <div class="col-md-7 sidebar">
                            <a href="{{ url('doc-sach/' . $noibat->slug_sach) }}">
                                <p>{{ $noibat->tensach }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
