@extends('admin.index')
@section('content')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Donatur</h6>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="mt-3">
            {{-- <a class="bn btn-info btn" title="Tambah Donatur" href="{{route('donatur.create')}}"><i
                    class="bi bi-file-plus-fill"></i></a>
            &nbsp; --}}
            <div class="row">
                <div class="col-6">
                    <a class="btn btn-info btn-sm ml-4" title="Tambah Donatur" href="{{route('donatur.create')}}"><i
                            class="bi bi-file-plus-fill"></i>Tambah</a>
                    &nbsp;
                    <a class="btn btn-danger btn-sm" title="Export to PDF Donatur" href="{{url('donatur-pdf')}}"><i
                            class="fas fa-file-pdf"></i></a>
                    &nbsp;
                    <a class="btn btn-success btn-sm" title="Export to Excel Donatur" href="{{url('donatur-excel')}}"><i
                            class="fas fa-file-excel"></i></a>

                </div>
                <div class="col-6">
                    {{-- <form action="{{url('donatur-cari')}}" method="GET" class="mr-2">
                        <input type="text" name="cari" placeholder="Cari Donatur .." value="{{ old('cari') }}">
                        <input type="submit" value="Cari" class="bg-success">
                    </form>
                </div> --}}

                <nav class="justify-content-between mr-4" style="width: 70%">
                    <form class="form-inline" action="{{url('donatur-cari')}}" method="GET">
                        <input class="form-control mr-sm-2 form-sm" type="text" name="cari" placeholder="Search"
                            aria-label="Search" value="{{ old('cari') }}">
                        <input class="btn btn-outline-success" type="submit" value="Cari">
                    </form>
                </nav>
            </div>

        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($donatur as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->no_hp }}</td>
                            <td>
                                {{-- <form method="POST" action="{{route('donatur.destroy', $row->id)}}"> --}}
                                    <form method="POST" id="formHapus">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-warning btn-sm" title="Ubah Donatur"
                                            href="{{route('donatur.edit', $row->id)}}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger btn-sm btnHapus"
                                            title="Hapus Donatur" data-action="{{route('donatur.destroy', $row->id)}}"
                                            {{-- onclick="return confirm('Anda yakin data dihapus?')" --}}>
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br />
            Halaman : {{ $donatur->currentPage() }} <br />
            Jumlah Data : {{ $donatur->total() }} <br />
            Data Per Halaman : {{ $donatur->perPage() }} <br/>
             {{-- {{ $donatur->links() }}  --}}
        </div>
    </div>
</div>
{{-- //ini mengambil dari kelas di (show-alert-delete-box) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('body').on('click', '.btnHapus', function (e) {
        e.preventDefault();
        var action = $(this).data('action');
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan lagi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formHapus').attr('action', action);
                $('#formHapus').submit();
            }
        })
    })
</script>
@endsection