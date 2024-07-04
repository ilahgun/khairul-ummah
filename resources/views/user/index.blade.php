@extends('admin.index')
@section('content')

 <!-- [ breadcrumb ] start -->
 <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Setting</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Setting</a></li>
                            <li class="breadcrumb-item"><a href="#!">Kelola User</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Data User</h6>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="mt-3">
            <div class="row">
                <div class="col-6">
                    <a class="btn btn-info btn-sm ml-4" title="Tambah User" href="{{route('user.create')}}">
                        <i class="bi bi-file-plus-fill"></i>Tambah</a></a> 

                    <a class="btn btn-danger btn-sm" title="Export to PDF User" href="{{url('user-pdf')}}">
                        <i class="fas fa-file-pdf"></i></a>
                   
                    <a class="btn btn-success btn-sm" title="Export to Excel User" href="{{url('user-excel')}}">
                        <i class="fas fa-file-excel"></i></a>
                </div>
                &emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <div class="col-4">
                <nav class="justify-content-between mr-4" style="width: 100%">
                        <form class="form-inlinee" action="{{url('user-cari')}}" method="GET">
                            <input class="form-controll mr-sm-2 form-sm" type="text" name="cari" 
                            placeholder="Search" aria-label="Search" value="{{ old('cari') }}">
                            <button class="btn btn-outline-success" type="submit" value="Cari">
                            <i class="bi bi-search"></i></button>
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
                                <th>No Handphone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Active</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no= 1; @endphp
                            @foreach ($user as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->no_hp }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->role }}</td>
                                <td>
                                @livewire('user-isactive', ['model' => $row, 'field' => 'isactive'], key($row->id))
                                </td>
                                <td>
                                    @empty($row->foto)
                                    <img src="{{url('admin/images/nophotos.png')}}" width="80px" alt="Profile" class="rounded-circle"
                                        >
                                    @else
                                    <img src="{{url('admin/images')}}/{{$row->foto}}" width="80px" alt="Profile"
                                        class="rounded-circle">
                                    @endempty
                                </td>
                                <td>
                                    {{-- <form method="POST" action="{{route('user.destroy', $row->id)}}"> --}}
                                        <form method="POST" id="formHapus">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-info btn-sm" title="Detail User"
                                                href="{{route('user.show', $row->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-warning btn-sm" title="Ubah User"
                                                href="{{url('user-edit', $row->id)}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm btnHapus"
                                                title="Hapus User" data-action="{{route('user.destroy', $row->id)}}"
                                                {{-- onclick="return confirm('Anda yakin data dihapus?')"> --}}>
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
                Halaman : {{ $user->currentPage() }} <br />
                Jumlah Data : {{ $user->total() }} <br />
                Data Per Halaman : {{ $user->perPage() }} <br/>
                {{--  {{ $kategori_kegiatan->links() }}  --}}
            </div>
        </div>
    </div>
    {{--  //ini mengambil dari kelas di (show-alert-delete-box)  --}}
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

        $('body').on('change', '.btnIsActive', function(e) {
        e.preventDefault();
        var action = $(this).data('action');
        Swal.fire({
            title: 'Status Active Berhasil Di ubah',
            icon: 'success',
            showConfirmButton: true,
            timer: 3000
        })
        })
    </script>
    @endsection