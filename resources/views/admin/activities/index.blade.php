@extends('templates.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-end gap-2 mb-4">
            <a href="#" class="btn btn-secondary">
                <i class="fa fa-file-excel me-2"></i> Export (.xlsx)
            </a>
            <a href="{{ route('admin.activities.create') }}" class="btn btn-success">
                <i class="fa fa-plus me-2"></i> Tambah Kegiatan
            </a>
            <a href="{{ route('admin.activities.trash') }}" class="btn btn-warning text-white">
                <i class="fa fa-trash me-2"></i> Data Trash
            </a>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success"><strong>Berhasil!</strong> {{ Session::get('success') }}</div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('failed') }}
            </div>
        @endif

        <div class="table-responsive shadow-3 rounded-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-semibold text-dark">{{ $item->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                            <td>{{ $item->location }}</td>
                            <td>
                                @if ($item->actived)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Aktif</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-dark rounded-pill px-3 py-2">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('admin.activities.edit', $item->id) }}" class="btn btn-primary me-2">Edit</a>
                                    <form action="{{ route('admin.activities.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger me-2" onclick="return confirm('Yakin mau hapus data ini?')">Hapus</button>
                                    </form>
                                    <form action="{{ route('admin.activities.patch', $item['id']) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning">Non-Aktifkan</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
