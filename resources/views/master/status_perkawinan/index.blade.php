@extends('layouts.main')

@section('title')
  Dasbor | Pelayanan Desa Cilame
@endsection

@section('css')
  <link
    rel="stylesheet"
    type="text/css"
    href="/assets/vendor/datatables-plugins/dataTables.bootstrap.css"
  />
  <link
    rel="stylesheet"
    type="text/css"
    href="/assets/vendor/datatables-responsive/dataTables.responsive.css"
  />
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <ul class="breadcrumb">
        <li><a href="#">Dasbor</a></li>
        <li class="active">Master - Status Perkawinan</li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      @if(session('notification'))
        <div class="alert alert-success" role="alert">
          {{ session('notification') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <p>
        <a
          href="/master/status-perkawinan/form-tambah"
          class="btn btn-sm btn-social btn-vk"
        >
          <i class="fa fa-plus"></i> Tambah
        </a>
      </p>
      <div class="panel panel-default">
        <div class="panel-heading">
          Tabel Data Status Perkawinan
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table
              width="100%"
              class="table table-striped table-bordered table-hover"
              id="status-perkawinan-table"
            >
              <thead>
                <tr>
                  <th>Keterangan</th>
                  <th width="150">Opsi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script
    type="text/javascript"
    src="/assets/vendor/datatables/js/jquery.dataTables.min.js"
  ></script>
  <script
    type="text/javascript"
    src="/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"
  ></script>
  <script
    type="text/javascript"
    src="/assets/vendor/datatables-responsive/dataTables.responsive.js"
  ></script>
  <script>
    var status_perkawinan_table = $('#status-perkawinan-table').DataTable({
      ajax: {
        url: '/master/status-perkawinan/data',
        type: 'get'
      },
      datatype: 'json',
      columns: [
        {data: 'keterangan'},
        {data: 'action'}
      ],
      responsive: true
    });

    function destroy(id)
    {
      var confirmation = confirm("Yakin akan menghapus data ini?");

      if (confirmation) {
        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/master/status-perkawinan/hapus/'+id,
            type: 'delete',
            dataType: 'json',
            success: function(result){
              alert('Data berhasil dihapus!');
              status_perkawinan_table.ajax.reload();
            }
        });
      }
    }
  </script>
@endsection
