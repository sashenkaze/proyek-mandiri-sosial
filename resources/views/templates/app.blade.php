<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Sosial</title>
    <link rel="shortcut icon"
        href="https://devjobsindo.org/wp-content/uploads/2023/06/indorelawan_logo-merah_png-1-1536x1442.png"
        type="image/x-icon">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger"
                href="{{ Auth::check() && Auth::user()->role === 'admin' ? route('admin.dashboard') : url('/') }}">
                Aplikasi Sosial
            </a>

            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Cek role user --}}
                @if (Auth::check() && Auth::user()->role === 'admin')
                    {{-- Navbar khusus Admin --}}
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link mx-3    "
                                href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link mx-3    " {{-- href="{{ route('admin.activities.index') }}" --}}>Kegiatan</a></li>
                        <li class="nav-item"><a class="nav-link mx-3    " {{-- href="{{ route('admin.registrations.index') }}" --}}>Pendaftaran</a></li>
                        <li class="nav-item dropdown">
                            <a data-mdb-dropdown-init class="nav-link mx-3   dropdown-toggle" href="#"
                                id="navbarDropdownMenuLink" role="button" aria-expanded="false">View/List</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" {{-- href="{{ route('admin.users.index') }}" --}}>User</a></li>
                                <li><a class="dropdown-item" {{-- href="{{ route('admin.attendance.index') }} --}}>Kehadiran</a></li>
                                <li><a class="dropdown-item" {{-- href="{{ route('admin.feedback.index') }}" --}}>Feedback</a></li>
                                <li><a class="dropdown-item" {{-- href="{{ route('admin.certificates.index') }}" --}}>Sertifikat</a></li>
                            </ul>
                        </li>
                    </ul>
                @else
                    {{-- Navbar User biasa --}}
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/organisasi">Organisasi</a></li>
                    </ul>
                @endif

                {{-- Auth section kanan --}}
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a data-mdb-dropdown-init class="nav-link dropdown-toggle" href="#"
                                id="navbarDropdownMenuLink" role="button" aria-expanded="false">Masuk/Daftar</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">Masuk</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('signup') }}">Daftar</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-fill pb-5">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-body-tertiary text-center text-lg-start mt-5">
        <div class="text-center p-3">
            © {{ date('Y') }} Mini Indorelawan | By <a class="text-body"
                href="https://github.com/SashenkAze">Sashenka Osaze</a>
        </div>
    </footer>

    {{-- MDBootstrap JS --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>

    {{-- yield versi js / dinamis isi js --}}
    @stack('script')
</body>

</html>
