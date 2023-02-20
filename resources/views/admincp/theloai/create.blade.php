@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thể Loại</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('theloai.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Thể Loại</label>
                                <input type="text" class="form-control" value="{{old('tentheloai')}}" name="tentheloai" onkeyup="ChangeToSlug();" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên Thể Loại ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Mô Tả</label>
                                <input type="text" class="form-control" value="{{old('mota')}}" name="mota"
                                    aria-describedby="emailHelp" placeholder="Mô tả...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slug Thể Loại</label>
                                <input type="text" class="form-control" value="{{old('slug_theloai')}}" name="slug_theloai" id="convert_slug"
                                    aria-describedby="emailHelp" placeholder="Tên Thể Loại ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kích hoạt Thể Loại</label>
                                <select class="form-select" name="kichhoat" id="inputGroupSelect02">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                            <button type="submit" name="themtheloai" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
