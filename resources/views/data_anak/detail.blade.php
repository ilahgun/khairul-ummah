@extends('landingpage.index')
@section('content')
<section style="background-color: #eee;" class="col-md-12">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            @empty($row->foto)
            <img src="{{ url('admin/images/nophotos.png') }}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            @else
            <img src="{{ url('admin/images')}}/{{$row->foto}}" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            @endempty
            <h5 class="my-3">{{ $row->nama }}</h5>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->nama }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tempat Lahir</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->tmp_lahir }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tanggal Lahir</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->tgl_lahir }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->gender }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Pendidikan</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ $row->pendidikan }}</p>
              </div>
            </div>
          </div>
        </div>
    <a class="btn btn-success btn-sm" href="{{url('data_anak')}}">Back</a>
      </div>
    </div>
  </div>
</section>
@endsection