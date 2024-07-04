@extends('admin.index')
@section('content')
@php
$ar_status = ['ketua', 'sekretaris', 'bendahara', 'staff'];
$ar_role = ['admin', 'pengurus'];
@endphp
<div class="col-md-12">
    <h5 class="mt-5">Form User</h5>
    <hr>
    {{--  @if($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Terjadi kesalahan saat Input data<br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif  --}}
    <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                placeholder="Nama" value="{{old('nama')}}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">No Handphone</label>
            <div class="col-sm-9">
                <input type="text" class="form-control
                @error('no_hp') is-invalid @enderror" name="no_hp" 
                placeholder="No HP" value="{{old('no_hp')}}">
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control
                @error('email') is-invalid @enderror" name="email" 
                placeholder="email" value="{{old('email')}}">
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
                <input type="text" class="form-control
                @error('nama') is-invalid @enderror" name="password" 
                placeholder="password" value="{{old('password')}}">
                @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>

        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
            <div class="col-sm-10">
                @foreach($ar_status as $status)
                @php
                $cek = (old('status') == $status) ? 'checked': '';
                @endphp
                <div class="form-check ml-6">
                    <div class="col-lg-7 ">
                        <input class="form-check-input  @error('status') is-invalid @enderror" type="radio" 
                        name="status" value="{{ $status }}" style="margin-left: 10%" {{ $cek }}>
                        <label class="form-check-label" for="gridRadios1">
                            {{$status}}
                        </label>
                    </div>
                </div>
                @endforeach
                @error('status')
                <div class="invalid-feedback d-inline" style="margin-left: 9%">
                    {{$message}}
                </div>
                @enderror
            </div>
        </fieldset>

        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
            <div class="col-sm-10">
            @foreach($ar_role as $role)
            @php
            $cek2 = (old('role') == $role) ? 'checked': '';
            @endphp
                <div class="form-check ml-6">
                    <div class="col-lg-7">
                        <input class="form-check-input @error('role') is-invalid @enderror" type="radio" 
                        name="role" style="margin-left: 10%"  value="{{ $role }}" {{ $cek2 }}>
                        <label class="form-check-label" for="gridRadios1">
                            {{$role}}
                        </label>
                    </div>
                </div>
            @endforeach
            @error('role')
            <div class="invalid-feedback d-inline" style="margin-left: 9%">
                    {{$message}}
            </div>
            @enderror
                    {{--  <div class="col-lg-7">
                        <input class="form-check-input" type="radio" name="role" value="admin">
                        <label class="form-check-label" for="gridRadios1">
                            Admin
                        </label>
                    </div>
                    <div class="col-sm-9">
                        <input class="form-check-input" type="radio" name="role" value="pengurus">
                        <label class="form-check-label" for="gridRadios1">
                            Pengurus
                        </label>
                    </div>  --}}
            </div>
        </fieldset>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Foto</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="foto">
            </div>
        </div>
</div>
<div class="text-left">
    <button type="submit" class="btn btn-success">Simpan</button>
    <a class="btn btn-secondary" href="{{url('user')}}">Cancel</a>
</div>
@endsection