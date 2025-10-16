@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success w-100 mb-0">
            <strong>{{ Session::get('success') }}</strong> Selamat Datang, {{ Auth::user()->name }}
        </div>
    @endif

    @if (session('logout'))
        <div class="alert alert-warning w-100 mb-0">
            <strong>{{ session('logout') }}</strong>
        </div>
    @endif

    {{-- Hero Section --}}
    <section class="position-relative" style="height: 70vh; overflow: hidden;">
        {{-- Background image pakai img --}}
        <img src="https://img.freepik.com/free-photo/sunny-day-trees-sky-hands-heart-selective-focus_73944-25862.jpg"
            alt="Hero background" class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">

        {{-- Overlay mask --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.5);">
        </div>

        {{-- Content --}}
        <div class="d-flex align-items-center justify-content-center h-100 position-relative text-center text-white">
            <div>
                <h1 class="fw-bold mb-3">Ambil peran jadi relawan</h1>
                <p class="lead mb-4">Ubah niat baik jadi aksi baik hari ini</p>
                <a href="" class="btn btn-danger btn-lg">Cari Aktivitas</a>
            </div>
        </div>
    </section>


    {{-- Statistik Section --}}
    <section class="container text-center py-5" style="margin-top: -100px; position: relative; z-index: 3;">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="fw-bold text-danger mb-0">295.508</h3>
                        <p class="mb-0">Relawan</p>
                    </div>
                    <div class="col-md-4">
                        <h3 class="fw-bold text-danger mb-0">6.381</h3>
                        <p class="mb-0">Organisasi</p>
                    </div>
                    <div class="col-md-4">
                        <h3 class="fw-bold text-danger mb-0">12.434</h3>
                        <p class="mb-0">Aktivitas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Layanan Section --}}
    <section class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-danger text-white h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Website #1 untuk mencari relawan</h5>
                        <p>Lebih banyak relawan, lebih besar dampaknya. Ada beragam pilihan aktivitas yang dapat diikuti
                            untuk membuat perubahan besar.</p>
                        <a href="" class="btn btn-light">Cari Aktivitas</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold text-danger">Jadi Relawan</h5>
                        <p>Baru memulai untuk jadi relawan? Pelajari selengkapnya dan mulai cari aktivitas kerelawanan
                            pertama kamu!</p>
                        <a href="" class="btn btn-danger">Cari Aktivitas</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold text-danger">Kerjasama CSR</h5>
                        <p>Tingkatkan dampak program CSR perusahaan bersama kami dengan melibatkan komunitas lokal dan
                            relawan!</p>
                        <a href="" class="btn btn-danger">Pelajari Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
