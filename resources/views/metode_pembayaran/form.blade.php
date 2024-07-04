@extends('admin.index')
@section('content')
<div class="col-md-12">
        <h5 class="mt-5">Form Metode Pembayaran</h5>
        <hr>
        {{--  @if($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terjadi kesalahann saat Input data<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif  --}}
        <form method="POST" action="{{route('metode_pembayaran.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Icon</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{old('icon')}}" placeholder="Icon Metode Pembayaran">
                    @error('icon')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div><br>
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}" placeholder="Nama Metode Pembayaran">
                    @error('nama')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div><br>
                <label for="nama" class="col-sm-3 col-form-label">Nomor</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor" value="{{old('nomor')}}" placeholder="Nomor Metode Pembayaran">
                    @error('nomor')
                    <div class="invalid-feedback">
                    {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="text-left">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a class="btn btn-secondary" href="{{url('metode_pembayaran')}}">Cancel</a>
            </div>
        </form>
    </div>
@endsection