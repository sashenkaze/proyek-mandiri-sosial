@extends('templates.app')

@section('content')
<div class="container mt-5 mb-5 w-75">

    {{-- Alert untuk sukses & error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.activities.update', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-6">
                <label for="title" class="form-label">Judul Kegiatan</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $activity->title) }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-6">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text"
                       name="location"
                       id="location"
                       class="form-control @error('location') is-invalid @enderror"
                       value="{{ old('location', $activity->location) }}">
                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Tanggal Kegiatan</label>
            <input type="date"
                   name="date"
                   id="date"
                   class="form-control @error('date') is-invalid @enderror"
                   value="{{ old('date', date('Y-m-d', strtotime($activity->date))) }}">
            @error('date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description"
                      id="description"
                      rows="5"
                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $activity->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-save me-2"></i> Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
