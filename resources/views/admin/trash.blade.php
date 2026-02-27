@extends('admin.layout')
@section('content')
    <h4 class="mt-5">Trash Data Atmin cuyy</h4>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-3">Kembali</a>

        <button type="button" class="btn btn-warning rounded-3" data-bs-toggle="modal" data-bs-target="#undoAllModal">
            Restore All
        </button>
    </div>

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Dihapus Pada</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datas as $data)
                <tr>
                    <td>{{ $data->id_admin }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->deleted_at }}</td>
                    <td>
                        <button type="button" class="btn btn-secondary rounded-3" data-bs-toggle="modal"
                            data-bs-target="#undoModal{{ $data->id_admin }}">
                            Undo
                        </button>

                        <button type="button" class="btn btn-danger rounded-3" data-bs-toggle="modal"
                            data-bs-target="#hapusPermanenModal{{ $data->id_admin }}">
                            Hapus
                        </button>

                        <div class="modal fade" id="undoModal{{ $data->id_admin }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Restore</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.undo', $data->id_admin) }}">
                                        @csrf
                                        <div class="modal-body">
                                            Kamu yakin pengen balikin data admin <strong>{{ $data->nama }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-primary">Iya, balikin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="hapusPermanenModal{{ $data->id_admin }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Hapus Permanen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.forceDelete', $data->id_admin) }}">
                                        @csrf
                                        <div class="modal-body">
                                            Kamu yakin ingin menghapus permanen data admin <strong>{{ $data->nama }}</strong>? ntar klo dah diapus permanen gabisa balik lagi lohh, jgn nangis yakk
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ngga dulu deh</button>
                                            <button type="submit" class="btn btn-danger">Iyaa, hapus permanen</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Trash kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="modal fade" id="undoAllModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Restore Semua Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.undoAll') }}">
                    @csrf
                    <div class="modal-body">
                        Yakin pengen balikin semua data dari Trash?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">g dl dh</button>
                        <button type="submit" class="btn btn-warning">y, blkn smw dh</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
