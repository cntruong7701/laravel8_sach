@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Liệt kê user</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Vai Trò(ROle)</th>
                                    <th scope="col">Quản Lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $value)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <th scope="row">{{ $value->name }}</th>
                                        <th scope="row">{{ $value->email }}</th>
                                        <th scope="row">{{ $value->password }}</th>
                                        <th scope="row">
                                            @foreach ($value->roles as $key => $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </th>
                                        {{-- <th scope="row">
                                            @foreach ($role->permissions as $key => $permission)
                                                <h5><span class="badge bg-danger">{{ $permission->name }}</span></h5>
                                            @endforeach
                                        </th> --}}
                                        <th scope="row">
                                            @role('admin')
                                                <a class="btn btn-success" href="{{ url('phan-vaitro/' . $value->id) }}">Phân Vai
                                                    Trò</a>
                                                {{-- <a class="btn btn-danger" href="{{ url('phan-quyen/' . $value->id) }}">Phân
                                                    Quyền</a> --}}
                                            @endrole
                                        </th>
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
