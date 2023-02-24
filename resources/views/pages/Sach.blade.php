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
                    <img class="card-img-top" src="{{ asset('public/uploads/sach/' . $sach->hinhanh) }}" width="200" alt="">
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

                        <!----------Lấy Biến Wishlish----------->
                        <input type="hidden" value="{{$sach->tensach}}" class="wishlist_title">
                        <input type="hidden" value="{{\URL::current()}}" class="wishlist_url">
                        <input type="hidden" value="{{$sach->id}}" class="wishlist_id">
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
                        <li>Số chapter: 300</li>
                        <li>Lượt xem: 2040</li>
                        <li><a href="#" class="text-decoration-none">Xem mục lục</a></li>
                        @if ($mucluc_dau)
                            <li>
                                <a href="{{ url('xem-mucluc/' . $mucluc_dau->slug_mucluc) }}" class="btn btn-primary mb-2">
                                    Đọc Sách
                                </a>
                                <button class="btn btn-danger mb-2 btn-thichsach"><i class="fa fa-heart" aria-hidden="true"></i> Sách Yêu Thích </button>
                            </li>
                            <li>
                                <a href="{{ url('xem-mucluc/' . $mucluc_cuoi->slug_mucluc) }}" class="btn btn-success">
                                    Đọc Chương Mới Nhất
                                </a>
                            </li>
                        @else
                            <li><a href="" class="btn btn-danger">Hiện tại chưa có mục lục</a></li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-12">
                <p>{{ $sach->tomtat }}</p>
            </div>
            <hr>
            <style>
                .tagcloud05 ul {
                    margin: 0;
                    padding: 0;
                    list-style: none;
                }

                .tagcloud05 ul li {
                    display: inline-block;
                    margin: 0 0 .3em 1em;
                    padding: 0;
                }

                .tagcloud05 ul li a {
                    position: relative;
                    display: inline-block;
                    height: 30px;
                    line-height: 30px;
                    padding: 0 1em;
                    background-color: #3498db;
                    border-radius: 0 3px 3px 0;
                    color: #fff;
                    font-size: 13px;
                    text-decoration: none;
                    -webkit-transition: .2s;
                    transition: .2s;
                }

                .tagcloud05 ul li a::before {
                    position: absolute;
                    top: 0;
                    left: -15px;
                    content: '';
                    width: 0;
                    height: 0;
                    border-color: transparent #3498db transparent transparent;
                    border-style: solid;
                    border-width: 15px 15px 15px 0;
                    -webkit-transition: .2s;
                    transition: .2s;
                }

                .tagcloud05 ul li a::after {
                    position: absolute;
                    top: 50%;
                    left: 0;
                    z-index: 2;
                    display: block;
                    content: '';
                    width: 6px;
                    height: 6px;
                    margin-top: -3px;
                    background-color: #fff;
                    border-radius: 100%;
                }

                .tagcloud05 ul li span {
                    display: block;
                    max-width: 100px;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    overflow: hidden;
                }

                .tagcloud05 ul li a:hover {
                    background-color: #555;
                    color: #fff;
                }

                .tagcloud05 ul li a:hover::before {
                    border-right-color: #555;
                }
            </style>
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
            <div class="fb-comments" data-href="{{ \URL::current() }}" data-width="" data-numposts="10"></div>
            <h4>Sách liên quan</h4>
            <div class="row">
                @foreach ($cungdanhmuc as $key => $value)
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <img src="{{ asset('public/uploads/sach/' . $value->hinhanh) }}" width="200" alt="">
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
            </div>
        </div>
        <div class="col-md-3">
            <h3 class="title_sach">Sách yêu thích</h3>
            <div id="yeuthich"></div>
        </div>
    </div>
@endsection
