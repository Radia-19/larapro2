@extends('adminLayout')

@section('title','Login')

@push('css')

@endpush


@section('content')
    <div class="container">

        <div class="row">
            <div class="col-4 offset-4">
                @include('errors.error')
                <div class="mt-4" style="text-align: center;">
                    <img style="height: 60px;"  src="{{ asset('image/7j0XhM-LogoMakr.png')}}"  alt="Example Image">
                   </div>
                <h3 class="mt-2 mb-2 text-center">Register Here!</h3>
                <form action="{{ route('admin.register') }}" class="form-group" method="POST">
                    @csrf
                    <lable for="">Username:</lable>
                    <input type="text" class="form-control mb-2" name="username">
                    <lable for="">Fullname:</lable>
                    <input type="text" class="form-control mb-2" name="full_name">
                    <lable for="">Email:</lable>
                    <input type="email" class="form-control mb-2" name="email">
                    <lable for="">Password:</lable>
                    <input type="password" class="form-control mb-2" name="password">
                    <lable for="">Confirm Password:</lable>
                    <input type="password" class="form-control mb-2" name="password_confirmation">
                    <div class="text-center">
                    <input type="submit" name="submit" value="register" class="mt-2 mb-2 btn btn-info w-100">
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@push('js')

@endpush

