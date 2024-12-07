@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Mahasiswa CRUD') }}</h1>

    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">New Mahasiswa</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $mhs)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $mhs->nama_mahasiswa }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <!-- Trigger Modal -->
                            <button type="button" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#mahasiswaDetailModal-{{ $mhs->id }}">Detail</button>

                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure to delete this?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modals for Each Mahasiswa -->
    @foreach ($mahasiswa as $mhs)
        <div class="modal fade" id="mahasiswaDetailModal-{{ $mhs->id }}" tabindex="-1" role="dialog" aria-labelledby="mahasiswaDetailModalLabel-{{ $mhs->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mahasiswaDetailModalLabel-{{ $mhs->id }}">Mahasiswa Name: {{ $mhs->nama_mahasiswa }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Details:</h4>
                        <ul>
                            <li>NIM: {{ $mhs->nim }}</li>
                            <li>Email: {{ $mhs->email }}</li>
                            <li>Jurusan: {{ $mhs->jurusan }}</li>
                            <li>Dosen: {{ $mhs->dosen->nama_dosen }}</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
