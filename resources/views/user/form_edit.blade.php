@extends('admin.index')
@section('content')
@php
$ar_status = ['ketua', 'sekretaris', 'bendahara', 'staff'];
$ar_role = ['admin', 'pengurus'];
@endphp
<div class="col-md-12">
    <h5 class="mt-5">Form User</h5>
    <hr>
    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Terjadi kesalahan saat Input data<br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{route('user.update', $row->id)}}"
    enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="nama" value="{{$row->nama}}" placeholder="Nama">
            </div>
        </div>
        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">No Handphone</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="no_hp" value="{{$row->no_hp}}" placeholder="No HP">
            </div>
        </div>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="email" value="{{$row->email}}" placeholder="email">
            </div>
        </div>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="password" value="{{$row->password}}" placeholder="password">
            </div>
        </div>

        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
            <div class="col-sm-10">
                <div class="form-check ml-6" style="margin-left: 7%">
                    @foreach($ar_status as $status)
                    @php $check = ($status == $row->status) ? 'checked' : ''; @endphp
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="{{ $status }}" {{$check}}>
                        <label class="form-check-label" for="gridRadios1">
                            {{ $status }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </fieldset>

        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
            <div class="col-sm-10">
                <div class="form-check ml-6" style="margin-left: 8%">
                    @foreach($ar_role as $role)
                    @php $check = ($role == $row->role) ? 'checked' : ''; @endphp
                    <div class="col-lg-7">
                        <input class="form-check-input" type="radio" name="role" value="{{ $role }}" {{$check}}>
                        <label class="form-check-label" for="gridRadios1">
                            {{ $role }}
                        </label>
                    </div>
                     @endforeach
                </div>
        </fieldset>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Foto</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="foto">
                @if(!empty($row->foto)) <img src="{{url('admin/images')}}/{{$row->foto}}" alt="Profile" class="img-panel mt-2" style="width: 20%">
                <br/>{{$row->foto}}
                @endif
            </div>
        </div>
</div>
        <div class="text-left">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a class="btn btn-secondary" href="{{url('user')}}">Cancel</a>
        </div>
@endsection