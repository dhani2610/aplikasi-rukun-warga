@extends('layouts.app')

@section('style')
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
{{-- disini view form parkir mausk  --}}

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white"> Parkir Masuk</h3>
            </div>

            {{-- form action untuk parkit masuk ke route parkit-masuk-store --}}
            <form action="{{ route('parkir-masuk-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')

                <div class="card-body hide-after-print">

                    <div class="form-group mb-3">
                        <label for="name">Kode Parkir</label>
                        <input type="text" class="form-control @error('no_parkir') is-invalid @enderror" id="no_parkir" name="no_parkir" value="{{ $no_parkir }}" readonly  placeholder="Enter ">

                        @error('no_parkir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                

                    <div class="form-group mb-3">
                        <label for="name">Jenis Kendaraan</label>
                        <select name="jenis_id" id="" class="form-control @error('jenis_id') is-invalid @enderror">
                            @foreach ($jenis as $item)
                                <option value="{{$item->id}}">{{ $item->nama_kendaraan }}</option>
                            @endforeach
                        </select>
                        @error('jenis_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               

                

                    <div class="form-group mb-3">
                        <label for="name">Plat Nomor Kendaraan</label>
                        <input type="text" class="form-control @error('plat_nomor') is-invalid @enderror" id="plat_nomor" name="plat_nomor" value="{{ old('plat_nomor') }}"  placeholder="Tuliskan Plat Nomor Kendaraan (Contoh: DB 9429 12) ">

                        @error('plat_nomor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               

                

                    <div class="form-group mb-3">
                        <label for="name">Tipe/Merek Kendaran</label>
                        <input type="text" class="form-control @error('merek_kendaraan') is-invalid @enderror" id="merek_kendaraan" name="merek_kendaraan" value="{{ old('merek_kendaraan') }}"  placeholder="Tuliskan Tipe/Merek Kendaraan (Contoh: Avanza/Toyota)">

                        @error('merek_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Warna Kendaran</label>
                        <input type="text" class="form-control @error('warna_kendaraan') is-invalid @enderror" id="warna_kendaraan" name="warna_kendaraan" value="{{ old('warna_kendaraan') }}"  placeholder="Tuliskan Warna Kendaraan (Contoh: Hijau Daun)">

                        @error('warna_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
               
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-primary btn-footer hide-after-print">Simpan</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-danger btn-footer hide-after-print">Back</a>
                </div>
            </form>
        </div>
    </div>
    {{-- disini view untuk table data parkir masuk  --}}
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white hide-after-print">Data Parkir Masuk Hari Ini</h3>
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
                        </tr>
                      </thead>
                      <tbody>
                        {{-- disini kita lakukan perulangan untuk data parkir masuk  --}}
                        @foreach ($parkirMasuk as $item)
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
                                    <button type="button" class="" onclick="printDiv('{{$idPrint}}')"  >
                                        PRINT
                                    </button>
                                  </a>
                                </div>
                                    <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Parkir Masuk {{ $item->nama_kendaraan }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('parkir-masuk-update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @include('components.form-message')
                                
                                                <div class="card-body">
                                                    <div class="form-group mb-3">
                                                        <label for="name">Kode Parkir</label>
                                                        <input type="text" class="form-control @error('no_parkir') is-invalid @enderror" id="no_parkir" name="no_parkir" value="{{ $item->no_parkir }}" readonly  placeholder="Enter ">
                                
                                                        @error('no_parkir')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                
                                                
                                                
                                                    <div class="form-group mb-3">
                                                        <label for="name">Jenis Kendaraan</label>
                                                        <select name="jenis_id" id="" class="form-control @error('jenis_id') is-invalid @enderror">
                                                            @foreach ($jenis as $item2)
                                                                <option value="{{$item2->id}}" {{ $item2->id == $item->jenis_id ? 'selected' : '' }}>{{ $item2->nama_kendaraan }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('jenis_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                               
                                
                                                
                                
                                                    <div class="form-group mb-3">
                                                        <label for="name">Plat Nomor Kendaraan</label>
                                                        <input type="text" class="form-control @error('plat_nomor') is-invalid @enderror" id="plat_nomor" name="plat_nomor" value="{{ old('plat_nomor') ?? $item->plat_nomor }}"  placeholder="Tuliskan Plat Nomor Kendaraan (Contoh: DB 9429 12) ">
                                
                                                        @error('plat_nomor')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                               
                                
                                                
                                
                                                    <div class="form-group mb-3">
                                                        <label for="name">Tipe/Merek Kendaran</label>
                                                        <input type="text" class="form-control @error('merek_kendaraan') is-invalid @enderror" id="merek_kendaraan" name="merek_kendaraan" value="{{ old('merek_kendaraan') ?? $item->merek_kendaraan }}"  placeholder="Tuliskan Tipe/Merek Kendaraan (Contoh: Avanza/Toyota)">
                                
                                                        @error('merek_kendaraan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                
                                                    <div class="form-group mb-3">
                                                        <label for="name">Warna Kendaran</label>
                                                        <input type="text" class="form-control @error('warna_kendaraan') is-invalid @enderror" id="warna_kendaraan" name="warna_kendaraan" value="{{ old('warna_kendaraan') ?? $item->warna_kendaraan }}"  placeholder="Tuliskan Warna Kendaraan (Contoh: Hijau Daun)">
                                
                                                        @error('warna_kendaraan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                
                                                </div>
                                                
                                                <!-- /.card-body -->
                                
                                                <div class="card-footer " style="border-radius:0px 0px 10px 10px;">
                                                    <button type="submit" class="btn btn-primary btn-footer">Simpan</button>
                                                    <a href="#" data-bs-dismiss="modal" class="btn btn-danger btn-footer">Back</a>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <center>
                                                    <h5>Yakin Ingin Hapus data Parkir Masuk {{ $item->plat_nomor }} ?</h5>
                                                    <br>
                                                    <a style="width:45%" class="btn btn-primary" href="{{ route('parkir-masuk-destroy',$item->id) }}">Hapus</a>
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
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y H:i') }}<br><br>
                            </td>
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
<script>
    $('#example').dataTable();

    function printDiv(divId) {
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head><title></title></head><body><center>" + printContents + "</center></body>";
       window.print();
       document.body.innerHTML = originalContents;
   }
</script>
@endsection