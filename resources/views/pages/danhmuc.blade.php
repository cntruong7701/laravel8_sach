@extends('../layout')
{{-- @section('slider')
    @include('pages.slider')
@endsection --}}
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $tendanhmuc }}</li>
        </ol>
    </nav>
    <h3>{{ $tendanhmuc }}</h3>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @php
                    $count = count($sach);
                @endphp

                @if ($count == 0)
                    <div class="col-md-12">
                        <div class="card col-mb-12 shadow-sm">
                            <div class="card-body">
                                <p>Sách đang cập nhật...</p>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach ($sach as $key => $value)
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="row no-gutters align-items-center">
                                    <div class="col-md-4">
                                        <img src="{{ asset('/uploads/sach/' . $value->hinhanh) }}" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $value->tensach }}</h5>
                                            <p class="card-text limit-text">{{ $value->tomtat }}</p>
                                            <div class="btn-group">
                                                <a href="{{ url('doc-sach/' . $value->slug_sach) }}"
                                                    class="btn btn-sm btn-outline-secondary">Đọc</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
