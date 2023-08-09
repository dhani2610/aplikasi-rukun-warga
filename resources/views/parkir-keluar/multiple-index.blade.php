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
{{-- disini adalah view untuk parkir keluar  --}}
{{-- view untuk modal input manual  --}}
<div class="modal fade" id="INPUT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
            <form action="{{ route('parkir-keluar-store') }}" method="POST" enctype="multipart/form-data" id="parkir-masuk-store">
              @csrf
              @include('components.form-message')

              <center>
                  <h5>Pilih Plat Nomor Atau Kode Parkir</h5>
                  <br>
                  <select name="no_parkir" class="form-control" id="get_no_parkir">
                    @foreach ($parkirMasuk as $item)
                        <option value="{{ $item->no_parkir }}">{{ $item->no_parkir.' | '.$item->plat_nomor }}</option>
                    @endforeach
                  </select>
                  <br>
                  <br>
                  <button type="submit" class="btn btn-primary" style="width:45%">Kirim</button>
                  <br>
                  <br>
                  <button  style="width:45%"type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</button>
              </center>
            </form>
          </div>
      </div>
  </div>
</div>


{{-- disni view untuk scan barcode  --}}
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white"> Parkir Keluar</h3>
            </div>

              <form action="{{ route('parkir-keluar-store') }}" method="POST" enctype="multipart/form-data" id="parkir-masuk-store">
                @csrf
                @include('components.form-message')

                  <div class="card-body hide-after-print">

                      <div class="form-group mb-3">
                          <div id="reader" width="600px"></div>
                          
                      </div>
                      <input type="text" name="no_parkir" id="get_no_parkir" class="form-control mb-2" readonly>
                      <button type="button" class="btn btn-primary mb-2" style="float:right" data-bs-toggle="modal"  data-bs-target="#INPUT" >Input Manual</button>
                  </div>
              </form>
              
        </div>
    </div>

    {{-- disini view untuk table data parkir keluar  --}}
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white hide-after-print">Data Parkir Keluar Hari Ini</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive hide-after-print">
                    <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Action</th>
                          <th>QR Code</th>
                          <th>Parkir Code</th>
                          <th>Plat Nomor</th>
                          <th>Jenis Kendaraan</th>
                          <th>Waktu Masuk</th>
                          <th>Waktu Keluar</th>
                          <th>Nominal</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          {{-- disini seperti yg saya jelaskan tadi..melooping variable yg sudah kita dapat dari controller  --}}
                        @foreach ($parkirKeluar as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                        <i class="far fa-edit" style="color:green"></i>
                                    </button>
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modalhapus{{ $item->id }}">
                                        <i class="far fa-trash-alt" style="color:red"></i>
                                    </button>
                                    @php
                                        $idPrint = 'print'.$item->id;
                                    @endphp
                                    <button type="button" class="" data-bs-toggle="modal"  data-bs-target="#QRCODE{{ $item->id }}" >
                                        QR
                                    </button>
                                  </a>
                                </div>
                                    <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <center>
                                                    <h5>Ingin Melihat Detail Parkir {{ $item->no_parkir }} ?</h5>
                                                    <br>
                                                    <a style="width:45%" class="btn btn-primary" href="{{ route('detail-parkir',$item->id) }}">Ya</a>
                                                    <br>
                                                    <br>
                                                    <button  style="width:45%"type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <center>
                                                    <h5>Yakin Ingin Hapus data Parkir Keluar {{ $item->plat_nomor }} ?</h5>
                                                    <br>
                                                    <a style="width:45%" class="btn btn-primary" href="{{ route('parkir-keluar-destroy',$item->id) }}">Hapus</a>
                                                    <br>
                                                    <br>
                                                    <button  style="width:45%"type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="QRCODE{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <center>
                                                    <div class="contenido">
                                                        <div class="ticket">
                                                          <div class="hqr">
                                                            <div class="column left-one"></div>
                                                            <div class="column center">
                                                                {!! QrCode::size(50)->generate($item->no_parkir ); !!}
                                                            </div>
                                                            <div class="column right-one"></div>
                                                          </div>
                                                          </div>
                                                          <div class="details">
                                                                <div class="tinfo" style="color:black!important">
                                                                No Parkir
                                                                </div>
                                                                <div class="tdata name">
                                                                {{ $item->no_parkir }}
                                                                </div>
                                                                <div class="tinfo" style="color:black!important">
                                                                Alamat
                                                                </div>
                                                                <div class="tdata">
                                                                Bekasi Utara
                                                                </div>      
                                                              </div>
                                                            </div>
                                                            <br>
                                                            <button  style="width:45%"type="button" class="btn btn-danger hide-after-print" data-bs-dismiss="modal"> Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      
                                                  
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </td>
                            <td>
                                {!! QrCode::size(50)->generate($item->no_parkir ); !!}
                            </td>
                            <td>{{ $item->no_parkir }}</td>
                            <td>{{ $item->plat_nomor }}</td>
                            <td>{{ $item->nama_kendaraan }}</td>
                            <td>        
                                {{ \Carbon\Carbon::parse($item->jam_masuk)->translatedFormat('l, d F Y H:i') }}<br><br>
                            </td>
                            <td>        
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y H:i') }}<br><br>
                            </td>
                            <td>@currency($item->nominal)</td>
                            <td>{{ $item->status }}</td>

                          </tr>

                        @endforeach
                      </tbody>
                    </table>

                    @foreach ($parkirMasuk as $item)
                         
                    <center>
                        <div class="contenido printme" id="print{{ $item->id }}">
                            <div class="ticket">
                              <div class="hqr">
                                <div class="column left-one"></div>
                                <div class="column center">
                                    {!! QrCode::size(50)->generate($item->no_parkir ); !!}
                                </div>
                                <div class="column right-one"></div>
                              </div>
                              </div>
                              <div class="details">
                                    <div class="tinfo" style="color:black!important">
                                    No Parkir
                                    </div>
                                    <div class="tdata name">
                                    {{ $item->no_parkir }}
                                    </div>
                                    <div class="tinfo" style="color:black!important">
                                    Alamat
                                    </div>
                                    <div class="tdata">
                                    Bekasi Utara
                                    </div>      
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </center>
                    @endforeach
                </div>
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
// {{-- disini script js untuk scanning qr code  --}}

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
  //  disini bacaan nya jika scanning berhail maka lakukan submit form 
   

function onScanSuccess(decodedText, decodedResult) {
    $('#get_no_parkir').val(decodedText);       
    $('#parkir-masuk-store').submit();       
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  // console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

</script>
@endsection