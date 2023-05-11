@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê mục sách</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Thêm Nhanh
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                {!! Form::open(['route' => 'danhmuc.store', 'method' => 'POST']) !!}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm Danh Mục</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
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
                                                <div class="form-group">
                                                    {!! Form::label('title', 'Tên Danh Mục', []) !!}
                                                    {!! Form::text('tenDM', '', [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Nhập vào dữ liệu ...',
                                                        'id' => 'slug',
                                                        'onkeyup' => 'ChangeToSlug()',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('slug', 'Slug', []) !!}
                                                    {!! Form::text('slug_danhmuc', '', [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Nhập vào dữ liệu ...',
                                                        'id' => 'convert_slug',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('description', 'Mô Tả Danh Mục', []) !!}
                                                    {!! Form::textarea('mota', '', [
                                                        'style' => 'resize:none',
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Nhập vào dữ liệu ...',
                                                        'id' => 'description',
                                                    ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('Active', 'Active', []) !!}
                                                    {!! Form::select('kichHoat', ['1' => 'Không Kích Hoạt', '0' => 'Kích Hoạt'], '', [
                                                        'class' => 'form-control',
                                                    ]) !!}
                                                </div>
                                                {{-- @if (!isset($category))
                                                    {!! Form::submit('Thêm Dữ liệu', ['class' => 'btn btn-success my-3']) !!}
                                                @else
                                                    {!! Form::submit('Cập Nhật Dữ liệu', ['class' => 'btn btn-success my-3']) !!}
                                                @endif --}}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        {!! Form::submit('Thêm Dữ liệu', ['class' => 'btn btn-primary my-3']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên Danh Mục</th>
                                    <th scope="col">Slug Danh Mục</th>
                                    <th scope="col">Mô Tả</th>
                                    <th scope="col">Kích Hoạt</th>
                                    <th scope="col">Quản ký</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhSach as $key => $DanhMuc)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $DanhMuc->tenDM }}</td>
                                        <td>{{ $DanhMuc->slug_danhmuc }}</td>
                                        <td>{{ $DanhMuc->mota }}</td>
                                        <td>
                                            @if ($DanhMuc->kichHoat == 0)
                                                <span class="text text-success">Kích Hoạt</span>
                                            @else
                                                <span class="text text-danger">Không Kích Hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('danhmuc.edit', [$DanhMuc->id]) }}"
                                                    class="btn btn-primary">Sửa</a>
                                                <form action="{{ route('danhmuc.destroy', [$DanhMuc->id]) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có chắc muốn xóa danh mục không?')"
                                                        class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
