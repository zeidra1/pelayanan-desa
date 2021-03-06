@extends('layouts.main')

@section('title')
  Dasbor &raquo; KAUR Pemerintahan &raquo; Keterangan KK Sementara &raquo; Form Tambah | Pelayanan Desa Cilame
@endsection

@section('css')
  <link
    rel="stylesheet"
    type="text/css"
    href="/assets/css/bootstrap-datetimepicker.min.css"
  />
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <ul class="breadcrumb">
        <li><a href="#">Dasbor</a></li>
        <li><a href="#">KAUR Pemerintahan - Keterangan Tanggungan Keluarga</a></li>
        <li class="active">Form Tambah</li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Form Ubah
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="/kaur-kesra/keterangan-tanggungan-keluarga/simpan" method="post">
                <h4>
                  <b>
                    IDENTITAS PENDUDUK
                  </b>
                </h4>
                <hr />
                <input
                  type="hidden"
                  name="_token"
                  value="{{ csrf_token() }}"
                />
                <input
                  type="hidden"
                  name="_method"
                  value="put"
                />
                <input
                  type="hidden"
                  name="penduduk_id"
                  id="master-penduduk-id"
                  value="{{ $keteranganTTanggunganKeluarga->penduduk_id }}"
                />
                @include('layouts.partials.form_ubah_identitas_penduduk')
                <h4>
                  <b>
                    KETERANGAN SURAT
                  </b>
                </h4>
                <hr />
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <label for="">
                        Jumlah Anggota Keluarga <small class="text-danger">*</small>
                      </label>
                      <input
                        type="number"
                        name="anggota_keluarga"
                        class="form-control"
                        id="anggota-keluarga"
                      />
                    </div>
                  </div>
                </div>
                <div id="form-keluarga"></div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <label for="">
                        Keterangan Redaksi <small class="text-danger">*</small>
                        <button
                          id="ubah-keterangan-redaksi"
                          class="btn btn-sm btn-social btn-warning"
                        >
                          <i class="fa fa-pencil"></i> Ubah
                        </button>
                      </label>
                      <textarea
                        name="redaksi"
                        class="form-control"
                        id="redaksi"
                        rows="5"
                        readonly
                      >Nama – nama tanggungan tersebut di atas benar-benar tidak mempunyai penghasilan / tidak bekerja dan tidak mendapat fasilitas kesehatan / biaya rawat inap dari pihak manapun baik Intansi Pemerintah maupun Swasta. Keterangan Tanggungan ini dipergunakan untuk melengkapi persyaratan administrasi tanggungan keluarga.</textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <label for="">
                        Ditanda Tangani Oleh
                      </label>
                      <select
                        name="perangkat_id"
                        class="form-control"
                      >
                        <option value="0">
                          -
                        </option>
                        @foreach($perangkat as $item)
                          <option value="{{ $item->id }}">
                            {{ $item->jabatan }} - {{ $item->nama }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <p>
                  <small>
                    <code>
                      Label ber-simbol (*) perlu diisi/dipilih.
                    </code>
                  </small>
                </p>
                <button
                  type="submit"
                  class="btn btn-sm btn-social btn-vk"
                >
                  <i class="fa fa-check"></i> Simpan
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script
    type="text/javascript"
    src="/assets/js/moment.js"
  ></script>
  <script
    type="text/javascript"
    src="/assets/js/bootstrap-datetimepicker.min.js"
  ></script>
  <script>
    var penduduk_id = $('#master-penduduk-id').val();

    if (penduduk_id != 0 || penduduk_id != null) {
      $.ajax({
        url: '/kependudukan/penduduk/api/data-by-id/'+penduduk_id,
        type: 'get',
        dataType: 'json',
        success: function(result){
          $('#nik').val(result.nik);
          $('#nama').val(result.nama);
          $('#tempat-lahir').val(result.tempat_lahir);
          $('#tanggal-lahir').val(result.tanggal_lahir);
          $('#jenis-kelamin').val(result.jenis_kelamin);
          $('#status-perkawinan').val(result.status_perkawinan);
          $('#agama').val(result.agama);
          $('#pendidikan').val(result.pendidikan);
          $('#pekerjaan').val(result.pekerjaan);
          $('#alamat').val(result.alamat);
        }
      });
    }

    $('#nik').typeahead({
      source: function(query, process) {
        $.ajax({
            url: '/kependudukan/penduduk/api/data-nik',
            type: 'get',
            dataType: 'json',
            success: function(json){
              return process(json)
            }
        });
      },
      autoSelect: true,
      templates: {
        suggestion: function(result){
          return 'Klik Tambah Data Penduduk, jika tidak menemukan data.';
        }
      },
      afterSelect: function(result){
        var nik = $('#nik').val();
        $.ajax({
          url: '/kependudukan/penduduk/api/data/'+nik,
          type: 'get',
          dataType: 'json',
          success: function(data){
            $('#master-penduduk-id').val(data.id);
            $('#nama').val(data.nama);
            $('#tempat-lahir').val(data.tempat_lahir);
            $('#tanggal-lahir').val(data.tanggal_lahir);
            $('#jenis-kelamin').val(data.jenis_kelamin);
            $('#status-perkawinan').val(data.status_perkawinan);
            $('#agama').val(data.agama);
            $('#pendidikan').val(data.pendidikan);
            $('#pekerjaan').val(data.pekerjaan);
            $('#alamat').val(data.alamat);
          }
        });
      }
    });
    $('#nama').typeahead({
      source: function(query, process) {
        $.ajax({
            url: '/kependudukan/penduduk/api/data-nama',
            type: 'get',
            dataType: 'json',
            success: function(json){
              return process(json)
            }
        });
      },
      autoSelect: true,
      templates: {
        suggestion: function(result){
          return 'Klik Tambah Data Penduduk, jika tidak menemukan data.';
        }
      },
      afterSelect: function(result){
        var nama = $('#nama').val();
        $.ajax({
          url: '/kependudukan/penduduk/api/data-by-nama/'+nama,
          type: 'get',
          dataType: 'json',
          success: function(data){
            $('#master-penduduk-id').val(data.id);
            $('#nik').val(data.nik);
            $('#nama').val(data.nama);
            $('#tempat-lahir').val(data.tempat_lahir);
            $('#tanggal-lahir').val(data.tanggal_lahir);
            $('#jenis-kelamin').val(data.jenis_kelamin);
            $('#status-perkawinan').val(data.status_perkawinan);
            $('#agama').val(data.agama);
            $('#pendidikan').val(data.pendidikan);
            $('#pekerjaan').val(data.pekerjaan);
            $('#alamat').val(data.alamat);
          }
        });
      }
    });
    $('#ubah-keterangan-redaksi').click(function(event){
      event.preventDefault();
      $('#redaksi').prop('readonly', false);
      $('#redaksi').focus();
      $('#ubah-keterangan-redaksi').attr('disabled', true);
    });
    $('#anggota-keluarga').keyup(function(event){
      var element;
      var anggota_keluarga = $('#anggota-keluarga').val();
      if(anggota_keluarga == 0 || anggota_keluarga == '') {
        $('#form-keluarga').empty().hide();
      }else{
        for(x=0; x<anggota_keluarga; x++){
          element =
            '<div class="form-group">'+
              '<div class="row">'+
                '<div class="col-lg-6 col-md-6 col-xs-12">'+
                  '<label>NIK <small class="text-danger">*</small></label>'+
                  '<input type="text" name="nik[]" class="form-control" />'+
                '</div>'+
              '</div>'+
            '</div>'+
            '<div class="row">'+
              '<div class="col-lg-3 col-md-3 col-xs-12">'+
                '<div class="form-group">'+
                  '<label>Nama Lengkap <small class="text-danger">*</small></label>'+
                  '<input type="text" name="nama[]" class="form-control" />'+
                '</div>'+
              '</div>'+
              '<div class="col-lg-3 col-md-3 col-xs-12">'+
                '<div class="form-group">'+
                  '<label>Tempat Lahir <small class="text-danger">*</small></label>'+
                  '<input type="text" name="tempat_lahir[]" class="form-control" />'+
                '</div>'+
              '</div>'+
              '<div class="col-lg-3 col-md-3 col-xs-12">'+
                '<div class="form-group">'+
                  '<label>Tanggal Lahir <small class="text-danger">*</small></label>'+
                  '<div class="input-group date tanggal-lahir" id="">'+
                    '<input type="text" name="tanggal_lahir[]" class="form-control" />'+
                    '<span class="input-group-addon"><span class="fa fa-calendar"></span></span>'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="col-lg-3 col-md-3 col-xs-12">'+
                '<div class="form-group">'+
                  '<label>Jenis Kelamin<small class="text-danger">*</small></label>'+
                  '<select name="jenis_kelamin[]" class="form-control">'+
                    '<option value="Laki-laki">Laki-laki</option>'+
                    '<option value="Perempuan">Perempuan</option>'+
                  '</select>'+
                '</div>'+
              '</div>'+
            '</div>'+
            '<div class="row">'+
              '<div class="col-lg-6 col-md-6 col-xs-12">'+
                '<div class="form-group">'+
                    '<label>Hubungan Keluarga <small class="text-danger">*</small></label>'+
                    '<input type="text" name="hubungan_keluarga[]" class="form-control" />'+
                '</div>'+
              '</div>'+
              '<div class="col-lg-6 col-md-6 col-xs-12">'+
                '<div class="form-group">'+
                    '<label>Pekerjaan <small class="text-danger">*</small></label>'+
                    '<input type="text" name="pekerjaan[]" class="form-control" />'+
                '</div>'+
              '</div>'+
            '</div>';
          //   '<div class="col-lg-3 col-md-3 col-xs-12">'+
          //     '<div class="form-group">'+
          //       '<label>Hubungan Keluarga <small class="text-danger">*</small></label>'+
          //       '<input type="text" name="hubungan_keluarga[]" class="form-control" />'+
          //     '</div>'+
          //   '</div>'+
          // '</div>';

          $('#form-keluarga').append(element).show();
          $('.tanggal-lahir').datetimepicker({
            format: 'DD-MM-YYYY',
            viewMode: 'years'
          });
        }
      }
    });
  </script>
@endsection
