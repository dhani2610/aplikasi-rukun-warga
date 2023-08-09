@extends('layouts.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.contenido {
  margin: 30px auto;
  max-height: 430px;
  max-width: 245px;
  overflow: hidden;
  box-shadow: 0 0 10px rgb(202, 202, 204);
  background-color:;
  border-radius: 2px;
}
.details {
  padding: 26px;
  background:white;
  border-top: 1px dashed #c3c3c3;
}
.tinfo {
  font-size: 0.5em;
  font-weight: 300;
  color: #c3c3c3;
  font-family: 'Roboto', sans-serif;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin:7px 0;
}

.tdata {
  font-size: 0.7em;
  font-weight: 400;
  font-family: 'Roboto', sans-serif;
  letter-spacing: 0.5px;
  margin:7px 0;
}

.name {
  font-size: 1.3em;
  font-weight: 300;
}

.link {
  text-align: center;
  margin-top:10px;
}

a {
  text-decoration: none;
  color:#55C9E6;  
  font-weight: 400;
  font-family: 'Roboto', sans-serif;
  letter-spacing: 0.7px;
  font-size: 0.7em;
}
.hqr{
  display: table;
  width: 100%;
  table-layout: fixed;
  margin: 0px auto;
}
  .left-one{
  background-repeat: no-repeat;
  background-image: radial-gradient(circle at 0 96% , rgba(0,0,0,0) .2em, gray .3em, white .1em);
}
  .right-one{
  background-repeat: no-repeat;
  background-image: radial-gradient(circle at 100% 96% , rgba(0,0,0,0) .2em, gray .3em, white .1em);
}
.column
{
    display: table-cell;
    padding: 37px 0px;
}
.center{
  background:white;
}

#qrcode img{
  height:70px;
  width:70px;
  margin: 0 auto;
}
.masinfo{
  display:block;
}
.left,.right{
  width:49%;
  display:inline-table;
}

.nesp{
  letter-spacing: 0px;
}
.printme {
	display: none;
}
@media print {
	.no-printme  {
		display: none;
	}
	.printme  {
        display: block;
	}
    .hide-after-print{

        display: none;
    }
}
</style>
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
@include('sweetalert::alert')

{{-- disni view untuk halaman detail parkir keluar  --}}
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white"> Parkir Keluar</h3>
            </div>

              <div class="card-body hide-after-print">

                  <div class="form-group mb-3">
                    {{-- disini fungsi untuk menampilkan qr code data perkir tersebut  --}}
                    <center>
                      {!! QrCode::size(400)->generate($parkirKeluar->no_parkir ); !!}
                      <h5 class="mt-2">{{ $parkirKeluar->no_parkir }}</h5>
                    </center>
                  </div>
                  
              </div>
              
        </div>
    </div>

    {{-- disini view untuk detail data parkir --}}
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white hide-after-print">Detail Data Parkir</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  Kode Parkir
                </div>
                <div class="col-sm-9">
                  {{$parkirKeluar->no_parkir}}
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Plat Nomor
                </div>
                <div class="col-sm-9">
                  {{$parkirKeluar->plat_nomor}}
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Jenis Kendaraan
                </div>
                <div class="col-sm-9">
                  {{$parkirKeluar->nama_kendaraan}}
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Merek Kendaraan
                </div>
                <div class="col-sm-9">
                  {{$parkirKeluar->merek_kendaraan}}
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Waktu Masuk
                </div>
                <div class="col-sm-9">
                  <span class="badge bg-success">
                    {{ \Carbon\Carbon::parse($parkirKeluar->jam_masuk)->translatedFormat('l, d F Y H:i') }}
                  </span>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Waktu Keluar
                </div>
                <div class="col-sm-9">
                  <span class="badge bg-warning">
                    {{ \Carbon\Carbon::parse($parkirKeluar->created_at)->translatedFormat('l, d F Y H:i') }}
                  </span>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Nominal
                </div>
                <div class="col-sm-9">
                  @currency($parkirKeluar->nominal)
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-3">
                  Status
                </div>
                <div class="col-sm-9">
                  <span class="badge  @if ($parkirKeluar->status == 'Belum Bayar')bg-danger @else bg-primary @endif" >
                    {{ $parkirKeluar->status }}
                  </span>
                </div>
              </div>
              {{-- disini kita melakukan validasi jika data detail parkir ini blm berstatus sudah bayar maka munculkan button bayar akan fungsikan ke form tersebut  --}}
              @if ($parkirKeluar->status != 'Sudah Bayar')
                <div class="row mt-2">
                  <div class="col-sm-6">
                    <form action="{{ route('parkir-keluar-bayar',$parkirKeluar->id ) }}" method="post" id="form-bayar">
                      @csrf
                    </form>
                    <button type="submit" class="btn btn-primary" onclick="bayar()" style="width:100%">Bayar</button>
                  </div>
                  <div class="col-sm-6">
                    <a href="{{ route('parkir-keluar-list') }}" class="btn btn-danger" style="width:100%">Kembali</a>
                  </div>
                </div>
              @else
              {{-- jika statusnya sudah bayar maka yg tampil hanya button kembali --}}
              <div class="row mt-2">
                <div class="col-sm-12">
                  <a href="{{ route('parkir-keluar-list') }}" class="btn btn-danger" style="width:100%">Kembali</a>
                </div>
              </div>
              @endif
            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
    $('#example').dataTable();

    function printDiv(divId) {
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head><title></title></head><body><center>" + printContents + "</center></body>";
       window.print();
       document.body.innerHTML = originalContents;
   }

   
function onScanSuccess(decodedText, decodedResult) {
    $('#get_no_parkir').val(decodedText);       
    $('#parkir-masuk-store').submit();       
}

function onScanFailure(error) {
  
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);


function bayar(){
  $('#form-bayar').submit();
}
</script>
@endsection