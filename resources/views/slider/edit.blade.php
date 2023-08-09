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
                <h3 class="card-title text-white">{{ ($breadcumb ?? '') }} Edit</h3>
            </div>
            <form action="{{ route('slider-update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    @include('components.form-message')

                    <div class="form-group mb-3">
                        <label for="name">Foto</label>
                        <img src="{{ asset('img/slider/'.($slider->foto ?? 'user.png')) }}" width="110px"
                        class="image img" />
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" value="{{ old('foto') }}"  placeholder="Enter ">

                        @error('foto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Aktif</label>
                        <select name="aktif" id="" class="form-control @error('aktif') is-invalid @enderror">
                            <option value="Ya" {{ $slider->aktif == 'Ya' ? 'selected' : '' }}>Ya</option>
                            <option value="No" {{ $slider->aktif == 'No' ? 'selected' : '' }}>No</option>
                        </select>

                        @error('aktif')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Save</button>
                    <a href="{{ route('slider-list') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection

@section('script')

@endsection