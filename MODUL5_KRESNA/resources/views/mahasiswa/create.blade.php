@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Create Mahasiswa') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="post">
                @csrf

                <div class="form-group">
                  <label for="nim">NIM</label>
                  <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" placeholder="NIM" autocomplete="off" value="{{ old('nim') }}">
                  @error('nim')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="nama_mahasiswa">Nama Mahasiswa</label>
                  <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" id="nama_mahasiswa" placeholder="Nama Mahasiswa" autocomplete="off" value="{{ old('nama_mahasiswa') }}">
                  @error('nama_mahasiswa')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="jurusan">Jurusan</label>
                  <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan" placeholder="Jurusan" autocomplete="off" value="{{ old('jurusan') }}">
                  @error('jurusan')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="dosen_id">Dosen</label>
                  <select class="form-control @error('dosen_id') is-invalid @enderror" name="dosen_id" id="dosen_id">
                    <option value="">Pilih Dosen</option>
                    @foreach($dosen as $dsn)
                      <option value="{{ $dsn->id }}">{{ $dsn->nama_dosen }}</option>
                    @endforeach
                  </select>
                  @error('dosen_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
