@extends('masterLayout')

@section('content')

<div class="row mt-3">
    <div class="col-8 offset-2">
        @include('errors.error')
        <h3>Register</h3>
        <form action="{{ route('user.register')}}" method="POST">
            @csrf
            <label class="form-label">Username: </label>
            <input class="form-control" type="text" name="username" value="{{ old('username')}}">
            <label class="form-label">Email: </label>
            <input class="form-control" type="email" name="email" value="{{ old('email')}}">
            <label class="form-label">Password: </label>
            <input class="form-control" type="password" name="password">
            <label class="form-label">Confirm Password: </label>
            <input class="form-control" type="password" name="password_confirmation">
            <div class="d-flex" style="height: 100vh;">
               <input class="btn btn-primary m-auto w-100 mt-3" type="submit" name="register" value="Register">
            </div>
            <div class="text-center">
                <p>Already Have An Account? <a href="{{ url('/login') }}">Login Here</a></p>
            </div>
        </form>
    </div>
</div>

@endsection
