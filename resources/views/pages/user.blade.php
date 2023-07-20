@extends('layouts.app')

@section('content_header')
<h1>Karyawan</h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Karyawan</h3>

            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                    <button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#tambah-kategori">Tambah</button>
                </ul>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="table-kategori">
                <thead>
                    <tr>
                        <th style="width: 10px">NO</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="notexport">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawan as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->name }}</td>
                        <td>{{ $r->email }}</td>
                        <td>
                            <div class="justify-content-between">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#edit-kar{{ $loop->iteration }}">Edit</button>
                                <a class="btn btn-danger" href="{{ URL::to('karyawan/hapus/'.$r->id) }}">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<!-- /.card -->

@endsection
<div class="modal fade" id="tambah-kategori">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Plilihan Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('karyawan/tambah')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Karyawan" name="nama">

                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Masukkan Email Kategori" name="email">

                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password Kategori" name="password">

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="s">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@foreach($karyawan as $r)
<div class="modal fade" id="edit-kar{{ $loop->iteration }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ URL::to('karyawan/edit/'.$r->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" value="{{ $r->name }}" name="nama">

                        <label>Email</label>
                        <input type="text" class="form-control" value="{{ $r->email }}" name="email">

                        <label>Password</label>
                        <input type="password" class="form-control" value="Ganti Password" name="password">

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="s">Simpan</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach



@section('js')
<script>
    $(function() {
        $("#table-kategori").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Export',
                exportOptions: {
                    columns: ':not(.notexport)'
                }
            }]
        });
    });
</script>
@stop
