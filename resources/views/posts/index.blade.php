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
                            <li class="breadcrumb-item"><a href="#!">Kegiatan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Data Kegiatan</h6>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="mt-3">
            <div class="row">
                <div class="col-8"> 
                <a href="{{ route('posts.create') }}" class="btn btn-info btn-sm ml-4">
                <i class="bi bi-file-plus-fill"></i>Tambah</a></a>
                    &nbsp;
                </div>
                
                <div class="col-4">
                <nav class="justify-content-between mr-4" style="width: 100%">
                        <form class="form-inlinee" action="{{url('post-cari')}}" method="GET">
                            <input class="form-controll mr-sm-2 form-sm" type="text" name="cari" placeholder="Search"
                                aria-label="Search" value="{{ old('cari') }}">
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
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{ Str::limit( strip_tags( $item->desc ), 60 ) }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('posts.edit', $item->id) }}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form id="formHapus" method="POST" action="{{route('posts.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Move post to trash ?')">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" value="Delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
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
@endsection