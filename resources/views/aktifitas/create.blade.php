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
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Add User</h3>
            </div>

            <form action="{{ route('aktifitas-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')


                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="name">Aktifitas</label>
                        <input type="text" class="form-control @error('nama_aktifitas') is-invalid @enderror" id="nama_aktifitas" name="nama_aktifitas" value="{{ old('nama_aktifitas') }}"  placeholder="Enter ">

                        @error('nama_aktifitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"  placeholder="Enter ">

                        @error('tanggal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="avatar">Foto Awal</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="avatar" name="foto_awal">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="avatar">Foto Progres</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="avatar" name="foto_progress">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="avatar">Foto Akhir</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="avatar" name="foto_akhir">
                        </div>
                    </div>
               
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection