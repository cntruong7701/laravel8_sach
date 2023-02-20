<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style type="text/css">
        .switch_color {
            background: #181818;
            color: #fff;
        }

        .switch_color_light {
            background: #181818 !important;
            color: #333;
        }

        .noidung_color {
            color: #000;
        }

    </style>
</head>

<body>
    <div class="container">
        <!-----------------menu----------------->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">WebBook.com</a>
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
                            <form autocomplete="off" action="{{ url('tim-kiem') }}" method="POST">
                                @csrf
                                <div class="d-flex">
                                    <input class="form-control me-2" name="tukhoa" id="keywords" type="search"
                                        placeholder="Tìm kiếm tác giả..." aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Tìm Kiếm</button>
                                </div>
                                <div id="search_ajax"></div>
                                <select class="custom-select mr-sm-2" name="" id="switch_color">
                                    <option value="xam">Xám</option>
                                    <option value="den">Đen</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-----------------slider----------------->
        @yield('slider')
        <!-----------------new book----------------->
        @yield('content')
        <footer class="text-muted py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Back to top</a>
                </p>
                <p class="mb-1">Album example is © Bootstrap, but please download and customize it for yourself!</p>
                <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                        href="/docs/5.3/getting-started/introduction/">getting started guide</a>.</p>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#switch_color").change(function() {
                $(document.body).toggleClass('switch_color');
                $('.album').toggleClass('switch_color_light');
                $('.card-body').toggleClass('switch_color');
                $('.noidungchuong').addClass('noidung_color');
                $('ul.mucluc > li > a').css(('color', '#fff'));
                $('slidebar > a').css('color', '#fff');
                if ($(this).val() == 'den') {
                    var item = {
                        'class1':'switch_color',
                        'class2':'switch_color_light',
                    }
                    locationStorage.setItem('switch_color', JSON.stringify(item));
                } else if($(this).val() == 'xam'){
                    locationStorage.removeItem('switch_color');
                    $('ul.mucluc > li > a').css('color', '#000');
                }
            })
        })
    </script>
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var keywords = $(this).val();

            if (keywords != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ url('timkiem-ajax') }}",
                    method: "POST",
                    data: {
                        keywords: keywords,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_timkiem_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        })
    </script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
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
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0"
        nonce="1zIdhOIp"></script>
</body>

</html>
