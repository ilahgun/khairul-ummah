@extends('admin.index')
@section('content')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Anak Asuh</h6>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="mt-3">
            <div class="row">
                <div class="col-6">
                    <a class="btn btn-info btn-sm ml-4" title="Tambah User" href="{{route('anak_asuh.create')}}"><i
                            class="bi bi-file-plus-fill"></i>Tambah</a>
                    &nbsp;
                    <a class="btn btn-danger btn-sm" title="Export to PDF User" href="{{url('anak_asuh-pdf')}}"><i
                            class="fas fa-file-pdf"></i></a>
                    &nbsp;
                    <a class="btn btn-success btn-sm" title="Export to Excel User" href="{{url('anak_asuh-excel')}}"><i
                            class="fas fa-file-excel"></i></a>
                </div>
                <div class="col-6">
                    <nav class="justify-content-between mr-4" style="width: 70%">
                        <form class="form-inline" action="{{url('anak_asuh-cari')}}" method="GET">
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
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Gender</th>
                            <th>Pendidikan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($anak_asuh as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->tmp_lahir }}</td>
                            <td>{{ $row->tgl_lahir }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>{{ $row->pendidikan }}</td>
                            <td>
                            {{-- <form method="POST" action="{{route('Kategori_Kegiatan.destroy', $row->id)}}"> --}}
                                <form method="POST" id="formHapus">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-info btn-sm" title="Detail Kategori Kegiatan"
                                        href="{{route('anak_asuh.show', $row->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm" title="Ubah Kategori Kegiatan"
                                        href="{{route('anak_asuh.edit', $row->id)}}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm btnHapus"
                                        title="Hapus Kategori Kegiatan" data-action="{{route('anak_asuh.destroy', $row->id)}}"
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
            Halaman : {{ $anak_asuh->currentPage() }} <br />
            Jumlah Data : {{ $anak_asuh->total() }} <br />
            Data Per Halaman : {{ $anak_asuh->perPage() }} <br/>
             {{-- {{ $anak_asuh->links() }} --}}
        </div>
    </div>
</div>
{{--  //ini mengambil dari kelas di (show-alert-delete-box) --}} 
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