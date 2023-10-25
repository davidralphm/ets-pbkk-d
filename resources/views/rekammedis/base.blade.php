<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item mx-4">
                    <a href="/rekamMedis/" class="nav-link text-light">Riwayat Rekam Medis</a>
                </li>

                <li class="nav-item mx-4">
                    <a href="/rekamMedis/create" class="nav-link text-light">Buat Rekam Medis Baru</a>
                </li>

                <li class="nav-item mx-4">
                    <a href="/rekamMedis/my" class="nav-link text-light">Rekam Medis Saya</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <h3 class="mt-3">@yield('heading')</h3>
        <h4>{{ Auth::user()->name }} ({{ Auth::user()->role }})</h4>
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible">
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>{{ $error }}</strong>
                </div>
            @endforeach
        @endif

        @if (Session::has('message-error'))
            <div class="alert alert-danger alert-dismissible">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <strong>{{ Session::get('message-error') }}</strong>
            </div>
        @endif

        @if (Session::has('message-success'))
            <div class="alert alert-success alert-dismissible">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <strong>{{ Session::get('message-success') }}</strong>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>