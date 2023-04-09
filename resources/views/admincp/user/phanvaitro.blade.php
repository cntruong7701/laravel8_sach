@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cấp vai trò user: {{ $user->name }}</div>

                    <form action="{{ url('inset_roles', [$user->id]) }}" method="POST">
                        @csrf
                        @foreach ($role as $key => $r)
                            @if ($all_column_roles)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{ $r->id == $all_column_roles->id ? 'checked' : '' }}
                                        type="radio" name="role" id="{{ $r->id }}" value="{{ $r->name }}">
                                    <label class="form-check-lable" for="{{ $r->id }}">{{ $r->name }}</label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="{{ $r->id }}"
                                        value="{{ $r->name }}">
                                    <label class="form-check-lable" for="{{ $r->id }}">{{ $r->name }}</label>
                                </div>
                            @endif
                        @endforeach
                        <br>
                        <input type="submit" name="phanquyen" id="" value="Cấp Quyền Cho User"
                            class="btn btn-success">
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ url('inset_role') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên Vai Trò</label>
                            <input type="text" class="form-control" value="{{ old('role') }}" name="role" aria-describedby="emailHelp"
                                placeholder="Tên vai trò ...">
                        </div>
                        <input type="submit" name="insetper" value="Thêm Vai Trò" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
