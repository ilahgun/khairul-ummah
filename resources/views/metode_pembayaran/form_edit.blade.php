@extends('admin.index')
@section('content')
    <div class="col-md-12">
        <h5 class="mt-5">Form Metode Pembayaran</h5>
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
        <form method="POST" action="{{route('metode_pembayaran.update', $row->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Icon</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="icon">
                    @if(!empty($row->icon)) <img src="{{url('admin/images')}}/{{$row->icon}}" alt="Profile" class="img-panel mt-2" style="width: 20%">
                    <br/>{{$row->icon}}
                    @endif
                </div>
            </div><br>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" value="{{$row->nama}}" placeholder="Nama Metode Pembayaran">
                </div>
            </div><br>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nomor</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="nomor" value="{{$row->nomor}}" placeholder="Nomor Metode Pembayaran">
                </div>
            </div><br>
            <div class="text-left">
                <button type="submit" class="btn btn-success">Ubah</button>
                <a class="btn btn-secondary" href="{{url('metode_pembayaran')}}">Cancel</a>
            </div>
        </form>
    </div>
@endsection