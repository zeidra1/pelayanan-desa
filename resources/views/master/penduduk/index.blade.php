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
      <h1 class="page-header">Data Penduduk</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <p>
        <a href="/dasbor/master/penduduk/form-tambah" class="btn btn-sm btn-primary">
          <i class="fa fa-plus"></i> Tambah Data Penduduk
        </a>
      </p>
      <div class="panel panel-default">
        <div class="panel-heading">
          Tabel Data Penduduk
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table
              width="100%"
              class="table table-striped table-bordered table-hover"
              id="penduduk-table"
            >
              <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Alamat</th>
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
    var penduduk_table = $('#penduduk-table').DataTable({
      ajax: {
        url: '/master/penduduk/data',
        type: 'GET'
      },
      datatype: 'json',
      columns: [
        {data: 'nik'},
        {data: 'nama'},
        {data: 'alamat'},
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
            url: '/master/penduduk/hapus/'+id,
            type: 'delete',
            dataType: 'json',
            success: function(result){
              alert('Data berhasil dihapus!');
              penduduk_table.ajax.reload();
            }
        });
      }
    }
  </script>
@endsection
