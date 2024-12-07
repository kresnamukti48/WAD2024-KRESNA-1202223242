@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Dosen CRUD') }}</h1>

    <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">New Dosen</a>

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
            @foreach ($dosen as $dsn)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $dsn->nama_dosen }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('dosen.edit', $dsn->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <!-- Trigger Modal -->
                            <button type="button" class="btn btn-sm btn-info mr-2" data-toggle="modal" data-target="#dosenDetailModal-{{ $dsn->id }}">Detail</button>

                            <form action="{{ route('dosen.destroy', $dsn->id) }}" method="post">
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

    <!-- Modals for Each Dosen -->
    @foreach ($dosen as $dsn)
        <div class="modal fade" id="dosenDetailModal-{{ $dsn->id }}" tabindex="-1" role="dialog" aria-labelledby="dosenDetailModalLabel-{{ $dsn->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dosenDetailModalLabel-{{ $dsn->id }}">Dosen Name: {{ $dsn->nama_dosen }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <h4>Details:</h4>
                        <ul>
                            <li>Kode Dosen: {{ $dsn->kode_dosen }}</li>
                            <li>NIP: {{ $dsn->nip }}</li>
                            <li>Email: {{ $dsn->email }}</li>
                            <li>No Telepon: {{ $dsn->no_telepon }}</li>
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
