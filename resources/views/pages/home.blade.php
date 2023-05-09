@extends('../layout')
@section('slider')
    @include('pages.slider')
@endsection
@section('content')
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        @foreach ($danhmuc as $key => $tab_danhmuc)
            <form>
                @csrf
                <li class="nav-item" role="presentation">
                    <button data-danhmuc_id="{{ $tab_danhmuc->id }}" class="nav-link tabs_danhmuc" id="{{ $tab_danhmuc->id }}"
                        data-bs-toggle="tab" data-bs-target="#{{ $tab_danhmuc->slug_danhmuc }}" type="button" role="tab"
                        aria-controls="{{ $tab_danhmuc->slug_danhmuc }}" aria-selected="true">{{ $tab_danhmuc->tenDM }}
                    </button>
                </li>
            </form>
        @endforeach
    </ul>
    <div id="tabs_danhmuc"></div>
    <div class="container">
        <h3>Mới Cập Nhật</h3>
        <!-- row -->
        <div class="row">
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
        </div>
        <!-- row -->
    </div>
@endsection
