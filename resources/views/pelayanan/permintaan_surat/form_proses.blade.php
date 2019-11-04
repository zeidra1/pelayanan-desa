@extends('layouts.main')

@section('title')
  Dasbor | Pelayanan Desa Cilame
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
        <li><a href="/">Dasbor</a></li>
        <li><a href="/dasbor/pelayanan/permintaan-surat">Pelayanan - Permintaan Surat</a></li>
        <li class="active">Form Proses</li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Form Proses
        </div>
        <div class="panel-body">
          <h4>
            Identitas Permintaan Surat
          </h4>
          <hr />
          <div class="row">
              <div class="col-lg-12">
                <form action="/dasbor/pelayanan/permintaan-surat/proses/{{ $permintaanSurat->id }}" method="post">
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
                    name="pengguna_id"
                    value="{{ Auth::guard('pengguna')->User()->id }}"
                  />
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-12">
                      <div class="form-group">
                        <label
                          class="control-label"
                          for="nik"
                        >
                          NIK <small class="text-danger">*</small>
                        </label>
                        <input
                          type="text"
                          class="form-control"
                          value="{{ $permintaanSurat->nik }}"
                          readonly
                        />
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                      <div class="form-group">
                        <label
                          class="control-label"
                          for="nama"
                        >
                          Nama Lengkap <small class="text-danger">*</small>
                        </label>
                        <input
                          type="text"
                          class="form-control"
                          value="{{ $permintaanSurat->nama }}"
                          readonly
                        />
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                      <div class="form-group">
                        <label
                          class="control-label"
                          for="nama"
                        >
                          Nomor Telepon <small class="text-danger">*</small>
                        </label>
                        <input
                          type="text"
                          class="form-control"
                          value="{{ $permintaanSurat->nomor_telepon }}"
                          readonly
                        />
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                      <div class="form-group">
                        <label
                          class="control-label"
                          for="nama"
                        >
                          Surat <small class="text-danger">*</small>
                        </label>
                        <input
                          type="text"
                          name="surat"
                          class="form-control"
                          value="{{ $permintaanSurat->surat }}"
                          readonly
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-xs-12">
                        <label
                          class="control-label"
                          for="alamat"
                        >
                          Alamat <small class="text-danger">*</small>
                        </label>
                        <textarea
                          class="form-control"
                          rows="5"
                          readonly
                        >{{ $permintaanSurat->alamat }}</textarea>
                      </div>
                    </div>
                  </div>
                  <hr />
                  @include('layouts.partials.identitas_penduduk')
                  <h4>
                    Keterangan Surat
                  </h4>
                  <hr />
                  @if($permintaanSurat->surat == 'Keterangan Usaha')
                    @include('layouts.partials.form_surat.keterangan_usaha')
                  @endif
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group {{ $errors->has('tanggal_pengambilan') ? 'has-error has-feedback' : '' }}">
                        <label
                          class="control-label"
                          for="tanggal-pengambilan"
                        >
                          Tanggal Pengambilan <small class="text-danger">*</small>
                        </label>
                        <div
                          class="input-group date"
                          id="tanggal-pengambilan"
                        >
                          <input
                            type="text"
                            name="tanggal_pengambilan"
                            class="form-control"
                            value="{{ old('tanggal_lahir') }}"
                          />
                          <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                          </span>
                        </div>
                        @if($errors->has('tanggal_lahir'))
                          <p class="text-danger">
                            {{ $errors->first('tanggal_lahir') }}
                          </p>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label
                          for=""
                        >
                          Ditanda Tangani Oleh <small class="text-danger">*</small>
                        </label>
                        <select
                          name="perangkat_id"
                          class="form-control"
                        >
                          <option value="0">
                            -
                          </option>
                          @foreach($perangkat as $item)
                            <option
                              value="{{ $item->id }}"
                              {{ old('perangkat_id') == $item->id ? 'selected' : '' }}
                            >
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
    src="/assets/js/bootstrap-typehead.min.js"
  ></script>
  <script
    type="text/javascript"
    src="/assets/js/moment.min.js"
  ></script>
  <script
    type="text/javascript"
    src="/assets/js/moment.with-locales.js"
  ></script>
  <script
    type="text/javascript"
    src="/assets/js/bootstrap-datetimepicker.min.js"
  ></script>
  <script>
    $('#tanggal-pengambilan').datetimepicker({
      format: 'DD-MM-YYYY'
    });

    $('#nik').typeahead({
      source: function(query, process) {
        $.ajax({
            url: '/dasbor/kependudukan/penduduk/api/data-nik',
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
          url: '/dasbor/kependudukan/penduduk/api/data/'+nik,
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
            url: '/dasbor/kependudukan/penduduk/api/data-nama',
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
          url: '/dasbor/kependudukan/penduduk/api/data-by-nama/'+nama,
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
    $('#tanggal-lahir-anak').datetimepicker({
      format: 'DD-MM-YYYY',
      viewMode: 'years'
    });
    $('#tanggal-meninggal').datetimepicker({
      format: 'DD-MM-YYYY',
      locale: 'id',
    }).on('dp.change', function(e){
      // console.log(e.date);
      console.log(e.date._d.getDay());
      var day = e.date._d.getDay();

      if (day == 1) {
        $('#hari-meninggal').val('Senin');
      }else if(day == 2){
        $('#hari-meninggal').val('Selasa');
      }else if(day == 3){
        $('#hari-meninggal').val('Rabu');
      }else if(day == 4){
        $('#hari-meninggal').val('Kamis');
      }else if(day == 5){
        $('#hari-meninggal').val('Jumat');
      }else if(day == 6){
        $('#hari-meninggal').val('Sabtu');
      }else if(day == 0){
        $('#hari-meninggal').val('Minggu');
      }
    });
    // $('#penghasilan-mask').mask('000.000.000', {
    //   reverse: true,
    //   onChange: function(result){
    //     console.log(Math.trunc(result));
    //   }
    // });
    $('#ubah-keterangan-redaksi').click(function(e){
      e.preventDefault();
      $('#redaksi').prop('readonly', false);
      $('#redaksi').focus();
      $('#ubah-keterangan-redaksi').attr('disabled', true);
    });
  </script>
@endsection