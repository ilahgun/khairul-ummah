@extends('landingpage.index')
@section('content')

<body>

    <!-- Spinner Start -->
    {{-- <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only"></span>
        </div>
    </div> --}}
    <!-- Spinner End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center px-3">Data</h6>
                <h1 class="mb-5">Struktur</h1>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="col-lg-4">
                        <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                            <div class="input-group">
                                <form class="form-inline" action="{{url('data_struktur-cari')}}" method="GET">
                                    <div class="row">

                                        <div class="col-lg-9 col-md-9">
                                            <input class="form-control mr-sm-2 form-sm" type="text" name="cari"
                                                placeholder="Search" aria-label="Search" value="{{ old('cari') }}">
                                        </div>

                                        <div class="col-lg-3 col-md-3">
                                            <button class="btn btn-outline-success" type="submit" value="Cari">
                                                <i class="bi bi-search"></i></button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr bgcolor="#5bc1ac">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no= 1; @endphp
                                @foreach ($user as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        {{-- <form method="POST" action="{{route('user.destroy', $row->id)}}"> --}}
                                            <a class="btn btn-info btn-sm" title="Detail User"
                                                href="{{route('data_struktur.show', $row->id)}}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br />
                    Halaman : {{ $user->currentPage() }} <br />
                    Jumlah Data : {{ $user->total() }} <br />
                    Data Per Halaman : {{ $user->perPage() }} <br />
                    {{-- {{ $kategori_kegiatan->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- //ini mengambil dari kelas di (show-alert-delete-box) --}}
</body>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('landingpage/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('landingpage/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('landingpage/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('landingpage/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Template Javascript -->
<script src="{{url('landingpage/js2/main.js')}}"></script>
@endsection