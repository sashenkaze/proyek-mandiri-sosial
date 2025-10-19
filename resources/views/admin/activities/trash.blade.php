@extends('templates.app')

@section('content')
    <div class="container mt-5 mb-5">

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-end gap-2 mb-4">
            <a href="{{ route('admin.activities.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        {{-- Alert Section --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <h3 class="fw-bold mb-4 text-danger">
            <i class="fa fa-trash me-2"></i> Data Kegiatan Terhapus
        </h3>

        @if ($activities->isEmpty())
            <div class="alert alert-warning text-center">
                Tidak ada data kegiatan di tong sampah.
            </div>
        @else
            <div class="table-responsive shadow-3 rounded-4">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $key => $activity)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="fw-semibold text-dark">{{ $activity->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}</td>
                                <td>{{ $activity->location }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        {{-- Restore --}}
                                        <form action="{{ route('admin.activities.restore', $activity->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success me-2">
                                                <i class="fa fa-undo me-1"></i> Kembalikan
                                            </button>
                                        </form>

                                        {{-- Delete Permanent --}}
                                        <form action="{{ route('admin.activities.delete_permanent', $activity->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus permanen kegiatan ini?')">
                                                <i class="fa fa-trash-alt me-1"></i> Hapus Permanen
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
