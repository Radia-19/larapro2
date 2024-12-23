<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TaskM</title>
    <!-- Favicon-->

    <!-- Bootstrap icons-->
    <!-- Bootstrap css cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@push('css')

@endpush
</head>
<body>
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd">
                     <div class="container">
                         <a class="navbar-brand" href="{{ route('home') }}">Task Manager</a>
                         <div class="float-right">
                            @if(\Illuminate\Support\Facades\Auth::check())
                               <a class="navbar-brand" href="{{ route('task.create.show') }}">Create</a>
                               @if(\Illuminate\Support\Facades\Auth::user()->google_login != '1')
                               <a class="navbar-brand" href="{{ route('googleLogin') }}">Add Google Account</a>
                               @endif
                               <a class="navbar-brand" href="{{ route('logout') }}">[{{ (\Illuminate\Support\Facades\Auth::user()->username)}}] | Logout</a>
                            @else
                            <a class="navbar-brand" href="{{ route('user.login.show') }}">Login</a>
                            <a class="navbar-brand" href="{{ route('user.register.show') }}">Register</a>
                            @endif
                         </div>
                     </div>
                 </nav>

                 @yield('content')

             </div>
         </div>
     </div>
@push('js')

@endpush
     <!-- Bootstrap js cdn-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
