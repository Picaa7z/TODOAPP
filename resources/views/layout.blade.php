<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/list.png') }}" type="image/x-icon">

    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" 
          rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0wAa8CrdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">

    {{-- CDN Font Awesome --}}
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQ0PoWDdYTDPqeRdPCVd1SpvCA9XcUnZ52FmJNp1coAFzvtCN9BmameE+4aHK8yyUHU5CcJHgXIoTyT2A=="
          crossorigin="anonymous" 
          referrerpolicy="no-referrer" />

    {{-- Nama aplikasi yang akan tampil pada tab browser --}}
    <title>Todo App</title>
</head>

<body>
    {{-- Agar navbar hanya dapat diakses setelah login --}}
    @if (Auth::check())
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Todo App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{route('todo.index')}}">Data</a>
                        <a class="nav-link" href="{{route('todo.create')}}">Create</a>
                        <a class="nav-link" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    @endif

    {{-- Konten halaman --}}
    @yield('content')

    {{-- CDN Bootstrap & Popper.js --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
            integrity="sha384-oBqDVmMz9ATKxIep9tiCx5Z9NFExbxfAX1YMaBEAIsFuzCmZSmSbNIomIp3p3xg9" 
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" 
            integrity="sha384-IDwe1+Lc02ROU9k972gdvyIAESN10+x7tBkgc9I5HFtuN2UoWnPclzo6p9vxnk" 
            crossorigin="anonymous"></script>
</body>
</html>
