@extends('layouts.app')

@section('style')

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

{{-- disini view untuk modal add jenis kendaraan  --}}
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Add Jenis Kendaraan</h3>
            </div>

            <form action="{{ route('jenis-kendaraan-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')

                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="name">Nama Kendaraan</label>
                        <input type="text" class="form-control @error('nama_kendaraan') is-invalid @enderror" id="nama_kendaraan" name="nama_kendaraan" value="{{ old('nama_kendaraan') }}"  placeholder="Enter ">

                        @error('nama_kendaraan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                

                    <div class="form-group mb-3">
                        <label for="name">Tarif 0 s/d 1 Jam Pertama</label>
                        <input type="number" class="form-control @error('tarif_1') is-invalid @enderror" id="tarif_1" name="tarif_1" value="{{ old('tarif_1') }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">

                        @error('tarif_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               

                

                    <div class="form-group mb-3">
                        <label for="name">Tarif 1 Jam s/d 2 Jam </label>
                        <input type="number" class="form-control @error('tarif_2') is-invalid @enderror" id="tarif_2" name="tarif_2" value="{{ old('tarif_2') }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">

                        @error('tarif_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               

                

                    <div class="form-group mb-3">
                        <label for="name">Tarif 2 Jam s/d 3 Jam</label>
                        <input type="number" class="form-control @error('tarif_3') is-invalid @enderror" id="tarif_3" name="tarif_3" value="{{ old('tarif_3') }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">

                        @error('tarif_3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               

                

                    <div class="form-group mb-3">
                        <label for="name">Tarif 4 s/d 24 Jam </label>
                        <input type="number" class="form-control @error('tarif_4') is-invalid @enderror" id="tarif_4" name="tarif_4" value="{{ old('tarif_4') }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">

                        @error('tarif_4')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               

                

                    <div class="form-group mb-3">
                        <label for="name">Keterangan Tarif Parkir Kendaraan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"  placeholder="Keterangan ">

                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
               
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-primary btn-footer">Simpan</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-danger btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
    {{-- end modal jenis kendaraan  --}}

    {{-- disini view untuk table data jenis kendaraan --}}
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Data Jenis Kendaraan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tarif 1</th>
                            <th>Tarif 2</th>
                            <th>Tarif 3</th>
                            <th>Tarif 4</th>
                            <th>Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        {{-- disini kita melakukan perulangan untuk ditampilkan di table jenis kendaraan --}}
                        @foreach ($jenis as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{-- disini column untuk mengatur button action edit dan delete  --}}
                                <div class="btn-group">
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                        <i class="far fa-edit" style="color:green"></i>
                                    </button>
                                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modalhapus{{ $item->id }}">
                                        <i class="far fa-trash-alt" style="color:red"></i>
                                    </button>
                                  </a>
                                </div>
                                    <!-- Modal -->
                                    {{-- disini untuk mengatur form edit jenis kendaraan  --}}
                                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Kendaraan {{ $item->nama_kendaraan }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('jenis-kendaraan-update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @include('components.form-message')
                                    
                                                    <div class="card-body">
                                    
                                                        <div class="form-group mb-3">
                                                            <label for="name">Nama Kendaraan</label>
                                                            <input type="text" class="form-control @error('nama_kendaraan') is-invalid @enderror" id="nama_kendaraan" name="nama_kendaraan" value="{{ old('nama_kendaraan') ?? $item->nama_kendaraan }}"  placeholder="Enter ">
                                    
                                                            @error('nama_kendaraan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                    
                                                    
                                    
                                                        <div class="form-group mb-3">
                                                            <label for="name">Tarif 0 s/d 2 Jam Pertama (Motor/Mobil)</label>
                                                            <input type="number" class="form-control @error('tarif_1') is-invalid @enderror" id="tarif_1" name="tarif_1" value="{{ old('tarif_1') ?? $item->tarif_1 }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">
                                    
                                                            @error('tarif_1')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                    
                                                    
                                    
                                                        <div class="form-group mb-3">
                                                            <label for="name">Tarif 2 Jam s/d 24 Jam (Motor) dan tarif 2 Jam (Mobil)</label>
                                                            <input type="number" class="form-control @error('tarif_2') is-invalid @enderror" id="tarif_2" name="tarif_2" value="{{ old('tarif_2') ?? $item->tarif_2 }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">
                                    
                                                            @error('tarif_2')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                    
                                                    
                                    
                                                        <div class="form-group mb-3">
                                                            <label for="name">Tarif 3 Jam Mobil</label>
                                                            <input type="number" class="form-control @error('tarif_3') is-invalid @enderror" id="tarif_3" name="tarif_3" value="{{ old('tarif_3') ?? $item->tarif_3 }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">
                                    
                                                            @error('tarif_3')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                    
                                                    
                                    
                                                        <div class="form-group mb-3">
                                                            <label for="name">Tarif 4 s/d 24 Jam Mobil</label>
                                                            <input type="number" class="form-control @error('tarif_4') is-invalid @enderror" id="tarif_4" name="tarif_4" value="{{ old('tarif_4') ?? $item->tarif_4 }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">
                                    
                                                            @error('tarif_4')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                   
                                    
                                                    
                                    
                                                        <div class="form-group mb-3">
                                                            <label for="name">Keterangan Tarif Parkir Kendaraan</label>
                                                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') ?? $item->keterangan }}"  placeholder="Tuliskan Tarif Kendaraan (Contoh: 3000) ">
                                    
                                                            @error('keterangan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                   
                                                    <!-- /.card-body -->
                                    
                                                    <div class="card-footer " style="border-radius:0px 0px 10px 10px;">
                                                        <button type="submit" class="btn btn-primary btn-footer">Simpan</button>
                                                        <a href="{{ route('dashboard.index') }}" class="btn btn-danger btn-footer">Back</a>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- disini untuk mengatur modal delete data jenis kendaraan  --}}
                                    <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center>
                                                        <h5>Yakin Ingin Hapus data jenis kendaraan {{ $item->nama_kendaraan }} ?</h5>
                                                        <br>
                                                        <a style="width:45%" class="btn btn-primary" href="{{ route('jenis-kendaraan-destroy',$item->id) }}">Hapus</a>
                                                        <br>
                                                        <br>
                                                        <button  style="width:45%"type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              </td>
                            <td>{{ $item->nama_kendaraan }}</td>
                            <td>@currency($item->tarif_1)</td>
                            <td>@currency($item->tarif_2)</td>
                            <td>@currency($item->tarif_3)</td>
                            <td>@currency($item->tarif_4)</td>
                            <td>{{ $item->keterangan }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#example').dataTable();
</script>
@endsection