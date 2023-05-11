<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>

<body>
    <div class="container">
        <!-----------------menu----------------->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid bg-white">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img width="100"
                        src="http://webtruyensach.com/laravel8/laravel-book/public/uploads/logo/book-logo.png"
                        alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Danh Mục Sách
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($danhmuc as $key => $danh)
                                    <li><a class="dropdown-item"
                                            href="{{ url('danh-muc/' . $danh->slug_danhmuc) }}">{{ $danh->tenDM }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Thể loại Sách
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($theloai as $key => $the)
                                    <li><a class="dropdown-item"
                                            href="{{ url('the-loai/' . $the->slug_theloai) }}">{{ $the->tentheloai }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            <form autocomplete="off" action="{{ url('tim-kiem') }}" method="get">
                                <div class="d-flex">
                                    <input class="form-control me-2" name="tukhoa" id="keywords" type="search"
                                        placeholder="Tìm kiếm tác phẩm..." aria-label="Search">
                                    <button style="width: 118px;" class="btn btn-outline-success" type="submit">
                                        Tìm kiếm
                                    </button>
                                </div>
                            </form>
                            <ul class="list-group search-wrap" id="result" style="display: none;">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <select class="form-select mr-sm-2" name="" style="width:80px;" id="switch_color">
                <option value="xam">Xám</option>
                <option value="den">Đen</option>
            </select> --}}
        </nav>

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="addthis_inline_share_toolbox"></div>

        <!-----------------slider----------------->
        @yield('slider')
        <!-----------------new book----------------->
        @yield('content')
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2022 Company, CaoNhatTruong</p>
        
            <a href="{{url('/')}}" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
              <img src="{{asset('uploads/logo/book-logo.png')}}" alt="" width="100">
            </a>
        
            <ul class="nav col-md-4 justify-content-end">
              <li class="nav-item"><a href="{{url('/')}}" class="nav-link px-2 text-muted">Trang Chủ</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
          </footer>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-640eb87a913bc15e"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- tabs danh muc --}}
    <script type="text/javascript">
        $('.tabs_danhmuc').click(function() {
            const danhmuc_id = $(this).data('danhmuc_id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/tabs-danhmuc') }}",
                method: "POST",
                data: {
                    _token: _token,
                    danhmuc_id: danhmuc_id,
                },
                success: function(data) {
                    $('#tabs_danhmuc').html(data);
                }
            });
        })
    </script>
    {{-- end tabs danh muc --}}

    {{-- localStrorage Sách yêu thích --}}
    <script type="text/javascript">
        show_wishlist();

        function show_wishlist() {
            if (localStorage.getItem('wishlist_sach') != null) {
                var data = JSON.parse(localStorage.getItem('wishlist_sach'));

                data.reverse();

                for (i = 0; i < data.length; i++) {
                    var title = data[i].title;
                    var img = data[i].img;
                    var id = data[i].id;
                    var url = data[i].url;

                    $('#yeuthich').append(`
                        <div class="row mt-2">
                            <div class="col-md-5">
                                <img class="img img-responsive card-img-top" with="100%" src="` + img + `" alt="` +
                        title + `"/>
                            </div>
                            <div class="col-md-7">
                                <a href="` + url + `"> <p>` + title + `</p> </a>
                            </div>
                        </div>
                    `);
                }
            }

        }
        $('.btn-thichsach').click(function() {
            $('.fa.fa-heart').css('color', '#333');
            const id = $('.wishlist_id').val();
            const title = $('.wishlist_title').val();
            const img = $('.card-img-top').attr('src');
            const url = $('.wishlist_url').val();

            const item = {
                'id': id,
                'title': title,
                'img': img,
                'url': url,
            }

            if (localStorage.getItem('wishlist_sach') == null) {
                localStorage.setItem('wishlist_sach', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('wishlist_sach'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })

            if (matches.length) {
                alert('Bạn đã thêm vào mục yêu thích!');
            } else {
                if (old_data.length <= 10) {
                    old_data.push(item);
                } else {
                    alert('Danh sách yêu thích đã đầy.');
                }

                $('#yeuthich').append(`
                    <div class="row mt-2">
                        <div class="col-md-5">
                            <img class="img img-responsive card-img-top" with="100%" src="` + img + `" alt="title"/>
                        </div>
                        <div class="col-md-7">
                            <a href="` + url + `">
                                <p>` + title + `</p>     
                            </a>
                        </div>
                    </div>
                `);

                localStorage.setItem('wishlist_sach', JSON.stringify(old_data));
                alert('đã thêm vào danh sách yêu thích.');
            }
            localStorage.setItem('wishlist_sach', JSON.stringify(old_data));
        });
    </script>
    {{-- end localStrorage Sách yêu thích --}}

    {{-- Lưu màu vào theme --}}
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            if (localStorage.getItem('switch_color') !== null) {
                const data = localStorage.getItem('switch_color');
                const data_obj = JSON.parse(data);
                $(document.body).addClass(data_obj.class1);
                $('.album').addClass(data_obj.class2);
                $('.card-body').addClass(data_obj.class1);

                $('ul.mucluc > li > a').css(('color', '#fff'));
                $('.sidebar > a').css('color', '#fff');

                $("select option[value = 'den']").attr("selected", "selected");
            }
            $("#switch_color").change(function() {
                $(document.body).toggleClass('switch_color');
                $('.album').toggleClass('switch_color_light');
                $('.card-body').toggleClass('switch_color');
                $('.noidungchuong').addClass('noidung_color');
                $('ul.mucluc > li > a').css(('color', '#fff'));
                $('slidebar > a').css('color', '#fff');

                if ($(this).val() == 'den') {
                    var item = {
                        'class1': 'switch_color',
                        'class2': 'switch_color_light'
                    }
                    localStorage.setItem('switch_color', JSON.stringify(item));
                } else if ($(this).val() == 'xam') {
                    localStorage.removeItem('switch_color');
                    $('ul.mucluc > li > a').css('color', '#0a58ca');
                }
            })
        })
    </script> --}}
    {{-- end Lưu màu vào theme --}}


    {{-- Tìm kiếm  --}}
    <script type="text/javascript">
        // $('#keywords').keyup(function() {
        //     var keywords = $(this).val();

        //     if (keywords != '') {
        //         var _token = $('input[name="_token"]').val();

        //         $.ajax({
        //             url: "{{ url('timkiem-ajax') }}",
        //             method: "POST",
        //             data: {
        //                 keywords: keywords,
        //                 _token: _token
        //             },
        //             success: function(data) {
        //                 $('#search_ajax').fadeIn();
        //                 $('#search_ajax').html(data);
        //             }
        //         });
        //     } else {
        //         $('#search_ajax').fadeOut();
        //     }
        // });
        // $(document).on('click', '.li_timkiem_ajax', function() {
        //     $('#keywords').val($(this).text());
        //     $('#search_ajax').fadeOut();
        // })

        //search
        $(document).ready(function() {
            $('#keywords').keyup(function() {
                $('result').html('');
                var search = $('#keywords').val();
                if (search != '') {
                    $('#result').css('display', 'inherit');
                    var expression = new RegExp(search, "i");
                    $.getJSON('/laravel8/laravel-book/public/json/sach.json', function(data) {
                        $.each(data, function(key, val) {
                            if (val.tensach.search(expression) != -1) {
                                $('#result').append(
                                    '<li style="cursor:pointer; display: flex;" class="img-thumbnail list-group-item link-class"><div style="flex-direction: column; margin-left: 2px;"><h4 width="100%">' +
                                    val.tensach +
                                    '</h4><p class="limit-text text-muted">| ' +
                                    val.tomtat + '</p></div></li>');
                            }
                        })
                    })
                } else {
                    $('#result').css('display', 'none');
                }
            })

            //lấy title searching
            $('#result').on('click', 'li', function() {
                var clickText = $(this).text().split('|');

                $('#keywords').val($.trim(clickText[0]));
                $('#result').html('');
            })
        })
    </script>
    {{-- End Tìm kiếm  --}}


    {{-- Slider --}}
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 4,
            autoplay: true,
            nav: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    {{-- End Slider --}}

    {{-- Select mục lục --}}
    <script>
        $('.select-mucluc').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        })

        current_mucluc();

        function current_mucluc() {
            var url = window.location.href;
            $('.select-mucluc').find('option[value="' + url + '"]').attr("selected", true);
        }
    </script>
    {{-- End Select mục lục --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0"
        nonce="1zIdhOIp"></script>
</body>

</html>
