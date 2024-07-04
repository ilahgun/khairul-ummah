@extends('landingpage.index')
@section('content')
		<div class="row">
		@foreach ($kegiatan as $row)
			<div class="col-md-6 col-xl-4">
				<h5>{{ $row->kategori->nama}}</h5>
				<hr>
				<div class="card mb-3" style="height:450px">
					<img class="img-fluid card-img-top">
					 @empty($row->foto)
                                <img src="{{url('admin/images/nophotos.png')}}" alt="Profile">
                                @else
                                <img src="{{url('admin/img')}}/{{$row->foto}}" alt="Profile">
                                @endempty
					<div class="card-body">
						<h5 class="card-title">{{ $row->nama }}</h5>
						<p class="card-text">{{ $row->deskripsi }}</p>
						<p class="card-text"><small class="text-muted">{{ $row->tgl_kegiatan }}</small></p>
					</div>
				</div>
			</div>
		@endforeach
		</div>
@endsection