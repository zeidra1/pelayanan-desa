<html>
<head>
  <meta
    http-equiv="Content-Type"
    content="text/html; charset=utf-8"
  />
  <style>
    @font-face {
      font-family: 'Times New Roman';
      src: url({{ storage_path('fonts/times-new-roman.ttf') }}) format("truetype");
    }
    body{
      font-family: 'Times New Roman';
      margin-left: 45px;
      margin-right: 45px;
    }
    .header {
      text-align: center;
      position: relative;
    }
    .header img {
      position: absolute;
      margin-top: 3px;
    }
    .title {
      text-align: center;
    }
    .underline {
      text-decoration: underline;
      text-transform: uppercase;
    }
    .redaksi-awal {
      /*text-indent: 2.5%;*/
    }
    .text-redaksi-awal{
      text-indent: 2.5%;
    }
    .muatan-data {

    }
    .redaksi-akhir{

    }
  </style>
  <title>Surat Keterangan Janda Duda - {{ $keteranganJandaDuda->penduduk->nama }}</title>
</head>
<body>
  <div class="header">
    <img
      src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/uploads/img/'.$profil->logo ?>"
      height="75"
      style=""
    />
    <h3 style="margin: 0; padding: 0; text-transform: uppercase;">
      Pemerintahan Kabupaten {{ $profil->kabupaten }} <br />
      Kecamatan {{ $profil->kecamatan }}<br />
      Desa {{ $profil->desa }}
    </h3>
    <small style="margin: 0; padding: 0;">
      <b>
        {{ $profil->alamat }}
      </b>
    </small>
  </div>
  <hr size="4" style="margin: 0; padding: 0;"/>
  <div class="title">
    <h4 class="underline" style="margin: 0; padding: 10;">
       surat keterangan kematian
    </h4>
    <p style="margin: 0; padding: 0;">
      <b>
        Nomor : 400/{{ $total }}/Ds./{{ $romawi }}/2019
      </b>
    </p>
  </div>
  <div class="muatan-data">
    <p style="text-indent: 2.5%; margin: 0; padding: 0;">
      Kepala Desa Cilame Kecamatan Ngamprah Kabupaten Bandung Barat dengan ini menerangkan bahwa :
    </p>
    <table style="padding-left: 5%;">
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td style="text-transform: uppercase;"><b>{{ $keteranganJandaDuda->penduduk->nama }}</b></td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->penduduk->jenis_kelamin }}</td>
      </tr>
      <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->penduduk->tempat_lahir }}, {{ $keteranganJandaDuda->penduduk->tanggal_lahir }}</td>
      </tr>
      <tr>
        <td>Status Perkawinan</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->penduduk->status_perkawinan }}</td>
      </tr>
      <tr>
        <td>Agama</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->penduduk->agama }}</td>
      </tr>
      <tr>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->penduduk->pekerjaan }}</td>
      </tr>
      <tr>
        <td>No. KK / NIK</td>
        <td>:</td>
        <td>- / {{ $keteranganJandaDuda->penduduk->nik }}</td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->penduduk->alamat }}</td>
      </tr>
    </table>
    <p style="text-indent: 2.5%; margin: 0; padding: 0;">
      Tersebut di atas adalah benar penduduk / warga Desa {{ $profil->desa }} dan sebagai {{ $keteranganJandaDuda->status }} dari :
    </p>
    <table style="padding-left: 5%;">
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td style="text-transform: uppercase;" width="200"><b>{{ $keteranganJandaDuda->nama }}</b></td>
      </tr>
      <tr>
        <td>No. Pensiun</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->nomor_pensiun }}</td>
      </tr>
      <tr>
        <td>Meninggal Dunia Pada Tanggal</td>
        <td>:</td>
        <td>{{ $keteranganJandaDuda->tanggal_meninggal }}</td>
      </tr>
    </table>
    <p style="text-indent: 2.5%; margin: 0; padding: 0;">
      Almarhum semasa hidupnya sebagai penerima pensiun dari Departemen / Instansi : {{ $keteranganJandaDuda->pensiunan }}
    </p>
  </div>
  <div class="keterangan">
    <p style="text-indent: 2.5%;">
      Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya dan akan diadakan perubahan atau pembatalan jika terdapat kekeliruan.
    </p>
  </div>
  <div class="tanda-tangan">
    <table align="right">
      <tr>
        <td><center>Cilame, {{ $date }}</center></td>
      </tr>
      <tr>
        <td>
          @if($keteranganJandaDuda->perangkat_id != 0)
            <center>
              <b style="text-transform: uppercase;">
                {{ $keteranganJandaDuda->profil_perangkat->jabatan }}
              </b>
            </center>
          @else
            <center>
              <b style="text-transform: uppercase;">
                {{ $profil->nama_kepala_desa }}
              </b>
            </center>
          @endif
        </td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td style="text-transform: uppercase;" width="200">
          <center>
            <b>
              @if($keteranganJandaDuda->perangkat_id != 0)
                <u>
                  {{ $keteranganJandaDuda->profil_perangkat->nama }}
                </u>
              @else
                <hr style="width: 200px;" />
              @endif
            </b>
          </center>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
