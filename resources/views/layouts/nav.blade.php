<section class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Admin</a>
                    </li>
                    @role('admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Quản lý user
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.create') }}">Thêm User
                                        website</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.index') }}">Liệt kê User
                                        website</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Thông tin website
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('information.create') }}">Thêm Thông tin
                                        website</a></li>
                            </ul>
                        </li>
                    @endrole
                    @hasanyrole('edit|admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Quản lý danh mục
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('danhmuc.create') }}">Thêm danh mục</a></li>
                                <li><a class="dropdown-item" href="{{ route('danhmuc.index') }}">Liệt kê danh mục</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Thể loại
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('theloai.create') }}">Thêm Thể loại</a></li>
                                <li><a class="dropdown-item" href="{{ route('theloai.index') }}">Liệt kê Thể loại</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sách
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('sach.create') }}">Thêm Sách</a></li>
                                <li><a class="dropdown-item" href="{{ route('sach.index') }}">Liệt kê Sách</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Mục Lục
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('mucluc.create') }}">Thêm Mục Lục</a></li>
                                <li><a class="dropdown-item" href="{{ route('mucluc.index') }}">Liệt kê Mục Lục</a></li>
                            </ul>
                        </li>
                    @endhasanyrole
                </ul>
            </div>
        </div>
    </nav>
</section>
