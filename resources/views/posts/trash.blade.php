@extends('admin.index')
@section('content')

<!-- [ breadcrumb ] start -->
<div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Master Data</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Master Data</a></li>
                            <li class="breadcrumb-item"><a href="#!">Trash</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Baru Saja Dihapus</h6>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

    <div class="container">
        <div class="row">
            <div class="table-responsive">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{  Str::limit( strip_tags( $item->desc ), 60 ) }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <form method="POST"  action="{{route('posts.restore', $item->id)}}" class="d-inline">
                                    @csrf
                                    <button type="submit" value="Restore" class="btn btn-success btn-sm">
                                    RESTORE
                                    </button>
                                    </form>

                                    <form method="POST" id="formHapus" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" value="Delete" class="btn btn-danger btn-sm btnHapus"
                                        data-action="{{route('posts.deletePermanent', $item->id)}}">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('body').on('click', '.btnHapus', function (e) {
        e.preventDefault();
        var action = $(this).data('action');
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan",
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