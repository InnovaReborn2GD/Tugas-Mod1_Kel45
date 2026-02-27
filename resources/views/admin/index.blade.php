@extends('admin.layout')
@section('content')
    <h4 class="mt-5">Data atmin woilah cikk</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.create') }}" type="button" class="btn btn-success rounded-3">Tambah data baru...</a>
        <a href="{{ route('admin.trash') }}" type="button" class="btn btn-outline-danger rounded-3">Buka Trash</a>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->id_admin }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->username }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $data->id_admin) }}" type="button"
                            class="btn btn-warning rounded-3">Ubah</a>
                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#hapusModal{{ $data->id_admin }}">
                            Hapus
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="hapusModal{{ $data->id_admin }}" tabindex="-1"
                            aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Penghapusan Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('admin.delete', $data->id_admin) }}">
                                        @csrf
                                        <div class="modal-body">
                                            Kamu yakin pengen hapus data ini?? gapapa sihh, ntar masi bisa dii restore kokk klo kmuu berubah pikiran       
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gajadi dehh...</button>
                                            <button type="submit" class="btn btn-primary">Iyaa, aku mau apuss</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
</table> @stop
