@extends('admin.index')
@section('content')
{{-- @php 
$ar_kategori = App\Models\Kategori_Kegiatan::all();
@endphp --}}
    <div class="col-md-12">
        <h5 class="mt-5">Form Donasi</h5>
        <hr>
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Terjadi kesalahann saat Input data<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{route('donasi.update', $row->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="keterangan" style="height: 100px">{{$row->keterangan}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Tanggal Donasi</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="tgl_donasi" value="{{$row->tgl_donasi}}" placeholder="Tanggal Donasi">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Jumlah Donasi</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="jml_donasi" value="{{$row->jml_donasi}}" placeholder="Jumlah Donasi">
                </div>
            </div>
            
            <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Bukti Transfer</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="bukti_transfer">
                @if(!empty($row->bukti_transfer)) <img src="{{url('admin/images/bukti_transfer')}}/{{$row->bukti_transfer}}" alt="Profile" class="img-panel mt-2" style="width: 20%">
                <br/>{{$row->bukti_transfer}}
                @endif
            </div>
            </div>

            <div class="form-group row">
            <label class="col-sm-3 col-form-label">Donatur</label>
            <div class="col-sm-5">
                <select class="form-select" name="donatur_id">
                    <option selected class="text-center">-- Pilih Donatur --</option>
                    @foreach($ar_donatur as $don)
                    @php $sel = ($don->id == $row->donatur_id) ? 'selected' : ''; @endphp
                    <option value="{{ $don->id }}" {{ $sel }}>{{ $don->nama }}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <div class="form-group row">
            <label class="col-sm-3 col-form-label">Metode Pembayaran</label>
            <div class="col-sm-5">
                <select class="form-select" name="metode_pembayaran_id">
                    <option selected class="text-center">-- Pilih Metode Pembayaran --</option>
                    @foreach($ar_metode_pembayaran as $mepem)
                    @php $sel = ($mepem->id == $row->metode_pembayaran_id) ? 'selected' : ''; @endphp
                    <option value="{{ $mepem->id }}" {{ $sel }}>{{ $mepem->nama }}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <div class="text-left">
                <button type="submit" title="Simpan Donasi" class="btn btn-success">Ubah</button>
                <a class="btn btn-secondary" title="Kembali" href="{{url('donasi')}}">Cancel</a>
            </div>
        </form>
    </div>
@endsection