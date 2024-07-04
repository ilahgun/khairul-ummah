@extends('admin.index')
@section('content')
@php
$ar_gender = ['Laki-Laki','Perempuan'];
@endphp
<div class="col-md-12">
        <h5 class="mt-5">Form Anak Asuh</h5>
        <hr>
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terjadi kesalahann saat Input data<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('anak_asuh.update',$row->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" value="{{ $row->nama }}" placeholder="Nama">
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Tempat Lahir</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="tmp_lahir" value="{{ $row->tmp_lahir }}" placeholder="Tempat Lahir">
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tgl_lahir" value="{{ $row->tgl_lahir }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-9">
                    <div class="col-sm-10">
                        @foreach($ar_gender as $gender)
                        @php $cek = ($gender == $row->gender) ? 'checked' : ''; @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="{{ $gender }}" {{ $cek }}>
                            <label class="form-check-label" for="gridRadios1">
                                {{ $gender }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-3 col-form-label">Pendidikan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="pendidikan" value="{{ $row->pendidikan }}" placeholder="Pendidikan">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <input class="form-control" type="file" name="foto">
                    @if(!empty($row->foto)) <img src="{{ url('admin/images')}}/{{$row->foto}}" width="10%" class="img-thumbnail">
                    <br/>{{$row->foto}}
                    @endif
                </div>
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a type="reset" class="btn btn-secondary" href="{{ url('anak_asuh') }}">cancel</a>
            </div>
        </form>
    </div>
@endsection