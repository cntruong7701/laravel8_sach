@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User</div>
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
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên User</label>
                                <input type="text" class="form-control" value="{{ old('tenuser') }}" name="tenuser"
                                    onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp"
                                    placeholder="Tên User ...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{ old('email') }}" name="email"
                                    aria-describedby="emailHelp" placeholder="Email...">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Password</label>
                                <input type="text" class="form-control" value="{{ old('password') }}" name="password"
                                    aria-describedby="emailHelp" placeholder="password ...">
                            </div>
                            <button type="submit" name="themuser" class="btn btn-primary">Thêm User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
