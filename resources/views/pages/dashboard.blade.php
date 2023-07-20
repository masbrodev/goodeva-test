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

        <!-- /.card-body -->
    </div>
</div>
<!-- /.card -->

@endsection




@push('scripts')
<script>
    $(function() {
        $("#table-kategori").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
@endpush
