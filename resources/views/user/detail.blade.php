@extends('admin.index')
@section('content')
<section style="background-color: #eee;" class="col-md-12">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
        @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
          <div class="card-body text-center">
            @empty($row->foto)
              <img src="{{url('admin/images/nophotos.png')}}" alt="Profile" class="rounded-circle" style="width:40%; margin-top: 10%;">
            @else
              <img src="{{url('admin/images')}}/{{$row->foto}}" alt="Profile" class="rounded-circle" style="width:40%; margin-top: 10%">
            @endempty
            <h5 class="my-1">{{ $row->nama }}</h5>
            <p class="text-muted">{{$row->status}}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <h5>Details</h5>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">No. Handphone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->no_hp }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->email }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Password</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->password }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->role }}</p>
              </div>
            </div>
            <hr>
          </div>
        </div>
    <div>
          <a class="bn btn-info btn-lg" href="{{url('user')}}">Back</a>
        </div>
      </div>
    </div>
  </div>
@endsection
