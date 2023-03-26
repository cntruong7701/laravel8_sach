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
        </div>
    </section>
@endsection
