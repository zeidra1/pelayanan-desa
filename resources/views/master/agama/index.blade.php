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
      <h1 class="page-header">Data Agama</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <p>
        <a href="/master/agama/form-tambah" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i> Tambah Data Agama
        </a>
      </p>
      <div class="panel panel-default">
        <div class="panel-heading">
          Tabel Data Agama
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table
              width="100%"
              class="table table-striped table-bordered table-hover"
              id="agama-table"
            >
              <thead>
                <tr>
                  <th>Keterangan</th>
                  <th>Opsi</th>
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
    var agama_table = $('#agama-table').DataTable({
      ajax: {
        url: '/master/agama/data',
        type: 'GET'
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
            url: '/master/agama/hapus/'+id,
            type: 'delete',
            dataType: 'json',
            success: function(result){
              alert('Data berhasil dihapus!');
              agama_table.ajax.reload();
            }
        });
      }
    }
  </script>
@endsection