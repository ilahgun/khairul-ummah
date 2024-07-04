@extends('admin.index')
@section('content')
<div class="col-md-12">
        <h5 class="mt-5">Form Anak Asuh</h5>
        <hr>
        {{-- @if($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terjadi kesalahann saat Input data<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form method="POST" action="{{route('anak_asuh.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}" placeholder="Nama">
                    @error('nama')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror" name="tmp_lahir" value="{{old('tmp_lahir')}}" placeholder="Tempat Lahir">
                    @error('tmp_lahir')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" value="{{old('tgl_lahir')}}" placeholder="Tanggal Lahir">
                    @error('tgl_lahir')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-9">
                <div class="col-sm-10">
                @foreach($ar_gender as $gender)
                @php
                    $cek = (old('gender') == $gender)? 'checked':'';
                @endphp
                <div class="form-check">
                    <input class="form-check-input @error('gender') is-invalid @enderror"  type="radio" name="gender" value="{{ $gender }}" {{ $cek }}>
                    <label class="form-check-label" for="gridRadios1">
                        {{ $gender }}
                    </label>
                </div>
                @endforeach
                @error('gender')
                    <div class="invalid-feedback d-inline">
                        {{ $message }}
                    </div>
                @enderror
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Pendidikan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" value="{{old('pendidikan')}}" placeholder="Pendidikan">
                    @error('pendidikan')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="foto">
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a type="reset" class="btn btn-secondary" href="{{ url('anak_asuh') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection