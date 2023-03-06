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
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
        <div class="row">
          <div class="col-6 mt-1">
            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
              <i class="far fa-user text-lg"></i> 
              Aktifitas List
            </span>
          </div>

          <div class="col-6 d-flex justify-content-end">
            <a href="{{ route('aktifitas-create') }}" class="btn btn-md btn-info">
              <i class="fa fa-plus"></i> 
              Add New
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Aktifitas</th>
              <th>Tanggal</th>
              <th>Foto</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          

            @foreach ($aktifitas as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_aktifitas }}</td>
                <td>{{ $item->tanggal }}</td>
                <td ><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">Lihat Foto</button></td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('aktifitas-edit', $item->id) }}" class="btn btn-warning text-white">
                      <i class="far fa-edit"></i>
                      Edit
                    </a>
                    <a href="{{ route('aktifitas-destroy', $item->id) }}" class="btn btn-danger f-12">
                      <i class="far fa-trash-alt"></i>
                      Delete
                    </a>
                  </div>
                </td>
              </tr>


              {{-- modal foto awal  --}}

              <div class="modal fade " id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Foto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5>Foto Awal</h5>
                        <img src="{{ asset('img/foto_awal/'.($item->foto_awal ?? 'user.png')) }}" style="width: 100%">
                        <br>
                      <h5>Foto Progres</h5>
                        <img src="{{ asset('img/foto_progress/'.($item->foto_progress ?? 'user.png')) }}" style="width: 100%">
                        <br>
                      <h5>Foto Akhir</h5>
                        <img src="{{ asset('img/foto_akhir/'.($item->foto_akhir ?? 'user.png')) }}" style="width: 100%">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          </tbody>
        </table>
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