@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Dosen') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dosen.update', $dosen->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="kode_dosen">Kode Dosen</label>
                  <input type="text" class="form-control @error('kode_dosen') is-invalid @enderror" name="kode_dosen" id="kode_dosen" placeholder="Kode Dosen" autocomplete="off" value="{{ old('kode_dosen') ?? $dosen->kode_dosen }}">
                  @error('kode_dosen')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="nama_dosen">Nama Dosen</label>
                  <input type="text" class="form-control @error('nama_dosen') is-invalid @enderror" name="nama_dosen" id="nama_dosen" placeholder="Nama Dosen" autocomplete="off" value="{{ old('nama_dosen') ?? $dosen->nama_dosen }}">
                  @error('nama_dosen')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" placeholder="NIP" autocomplete="off" value="{{ old('nip') ?? $dosen->nip }}">
                  @error('nip')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autocomplete="off" value="{{ old('email') ?? $dosen->email }}">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="no_telepon">No Telepon</label>
                  <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" id="no_telepon" placeholder="No Telepon" autocomplete="off" value="{{ old('no_telepon') ?? $dosen->no_telepon }}">
                  @error('no_telepon')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('dosen.index') }}" class="btn btn-default">Back to list</a>

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
