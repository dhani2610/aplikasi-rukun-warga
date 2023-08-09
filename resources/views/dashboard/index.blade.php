@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datepicker/bootstrap-datepicker3.min.css') }}">
<style>
@use postcss-color-function;
@use postcss-nested;
@import url('https://fonts.googleapis.com/css?family=Raleway:400,700,900');
<style>
       .master-data {
           cursor: pointer;
       }

       .master-data:hover {
            box-shadow: 0px 0px 33px -14px rgba(0,0,0,0.75);
            -webkit-box-shadow: 0px 0px 33px -14px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 33px -14px rgba(0,0,0,0.75);
            border-right: 4px solid rgb(0, 98, 128);";
       }
       .info-box {
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            border-radius: 0.50rem;
            background-color: #fff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            position: relative;
            width: 100%;
        }

        .info-box .info-box-icon {
            border-radius: 0.50rem 0 0 0.50rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }

        .info-box .info-box-icon > img {
            max-width: 100%;
        }

        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 15px;
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
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    
@endsection

@section('content')
{{-- ini adalah view dashboard  --}}
<div class="row mt-4">
    <div class="col-lg-12 col-md-6">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 p-1">
                <div class="info-box bg-gradient-info master-data">

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Sepeda Motor</span>
                        <h5>{{ $countMotor }}</h5>
                    </div>
                   <span class="info-box-icon" style="background-color:#000080; "><i class="fas fa-building text-white"></i></span>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 p-1">
                <div class="info-box bg-gradient-info master-data">

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Mobil</span>
                        <h5>{{ $countMobil }}</h5>
                    </div>
                   <span class="info-box-icon" style="background-color:#000080; "><i class="fas fa-building text-white"></i></span>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 p-1">
                <div class="info-box bg-gradient-info master-data">

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Truck</span>
                        <h5>{{ $countTruck }}</h5>
                    </div>
                   <span class="info-box-icon" style="background-color:#000080; "><i class="fas fa-building text-white"></i></span>

                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 p-1">
                <div class="info-box bg-gradient-info master-data">

                    <div class="info-box-content">
                        <span class="info-box-text font-size-18 text-bold" style="color: black">Pendapatan</span>
                        <h5>@currency($pendapatan)</h5>
                    </div>
                   <span class="info-box-icon" style="background-color:#000080; "><i class="fas fa-building text-white"></i></span>

                </div>
            </div>


        </div>
    </div>
</div>
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
    
                @foreach ($parkirKeluar as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                <i class="far fa-edit" style="color:green"></i>
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

        </div>
    </div>
</div>
<div class="row">
    <div class="col-8">

    </div>
    <div class="col-4">
        <a href="{{ route('export') }}" class="btn btn-success" style="float: right">Excel Laporan Parkir</a>
    </div>
</div>
@endsection

@section('script')

@endsection