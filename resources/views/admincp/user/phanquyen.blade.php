@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cấp quyền user: {{ $user->name }}</div>

                    <form action="{{ url('inset_permission', [$user->id]) }}" method="POST">
                        @csrf
                        @if (isset($name_roles))
                            Vai Trò Hiện Tại: {{ $name_roles }}
                        @endif
                        @foreach ($permission as $key => $per)
                            <div class="form-check">
                                <input class="form-check-input"
                                    @foreach ($get_permission_via_role as $key => $get)
                                        @if ($get->id == $per->id)
                                            checked
                                        @endif @endforeach
                                    type="checkbox" name="permission[]" value="{{ $per->name }}" id="{{ $per->id }}">
                                <label class="form-check-label" for="{{ $per->id }}">
                                    {{ $per->name }}
                                </label>
                            </div>
                        @endforeach
                        <input type="submit" name="" id="" value="Cấp Quyền Cho User"
                            class="btn btn-danger">
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ url('inset_permission') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên Quyền</label>
                            <input type="text" class="form-control" value="{{ old('permission') }}" name="permission" aria-describedby="emailHelp"
                                placeholder="Tên Quyền ...">
                        </div>
                        <input type="submit" name="insetper" value="Thêm Quyền" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
