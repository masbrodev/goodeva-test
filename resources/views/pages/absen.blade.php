@extends('layouts.app')

@section('content_header')
<h1>Absen</h1>
@stop

@section('content')
@section('plugins.Datatables', true)
@section('plugins.Toastr', true)
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Absen</h3>

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
                        <th>Waktu Masuk</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absen as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $r->user ? $r->user->name : '(data karyawan dihapus)' }}</td>
                        <td>{{ $r->waktu .' - '.$r->jam }}</td>
                        <td>{{ $r->kategori }}</td>
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
