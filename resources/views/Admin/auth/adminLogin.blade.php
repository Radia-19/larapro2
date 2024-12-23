@extends('adminLayout')

@section('content')

<div class="row mt-3">
    <div class="col-8 offset-2">
        <h3>Login</h3>
        @include('errors.error')
        <form action="{{ route('admin.login')}}" method="POST">
            @csrf
            <label class="form-label">Username: </label>
            <input class="form-control" type="text" name="username">
            <label class="form-label">Password: </label>
            <input class="form-control" type="password" name="password">
            <div class="d-flex" style="height: 100vh;">
             <input class="btn btn-block btn-info  m-auto w-100 mt-3" type="submit" name="login" value="Login">
            </div>

        </form>
    </div>
</div>

@endsection
