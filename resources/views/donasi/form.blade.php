@extends('admin.index')
@section('content')
<div class="col-md-12">
    <h5 class="mt-5">Form donasi</h5>
    <hr>
    {{--  @if($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Terjadi kesalahann saat Input data<br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif  --}}
    <form method="POST" action="{{route('donasi.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-9">
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" style="height: 100px">{{old('keterangan')}}</textarea>
                @error('keterangan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Tanggal Donasi</label>
            <div class="col-sm-9">
                <input type="date" class="form-control @error('tgl_donasi') is-invalid @enderror" name="tgl_donasi"
                    value="{{old('tgl_donasi')}}" placeholder="Tanggal donasi">
                @error('tgl_donasi')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Jumlah Donasi</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('jml_donasi') is-invalid @enderror" name="jml_donasi"
                    value="{{old('jml_donasi')}}" placeholder="Jumlah donasi">
                @error('jml_donasi')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="no_hp" class="col-sm-3 col-form-label">Bukti Transfer</label>
            <div class="col-sm-9">
                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer" value="{{old('bukti_transfer')}}">
                @error('bukti_transfer')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Donatur</label>
            <div class="col-sm-5">
                <select class="form-select @error('donatur_id') is-invalid @enderror" name="donatur_id">
                    <option selected class="text-center" value="" disabled>-- Pilih Donatur --</option>
                    @foreach($ar_donatur as $don)
                    @php
                    $sel = (old('donatur_id') == $don->id)? 'selected':'';
                    @endphp
                    <option value="{{ $don->id }}" {{ $sel }}>{{ $don->nama }}</option>
                    @endforeach
                </select>
                @error('donatur_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Metode Pembayaran</label>
            <div class="col-sm-5">
                <select class="form-select @error('metode_pembayaran_id') is-invalid @enderror" name="metode_pembayaran_id">
                    <option selected class="text-center" value="" disabled>-- Pilih Metode Pembayaran --</option>
                    @foreach($ar_metode_pembayaran as $mepem)
                    @php
                    $sel = (old('metode_pembayaran_id') == $mepem->id)? 'selected':'';
                    @endphp
                    <option value="{{ $mepem->id }}" {{ $sel }}>{{ $mepem->nama }}</option>
                    @endforeach
                </select>
                @error('metode_pembayaran_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="text-left">
            <button type="submit" title="Simpan Donasi" class="btn btn-success">Simpan</button>
            <a class="btn btn-secondary" title="Kembali" href="{{url('donasi')}}">Cancel</a>
        </div>
    </form>
</div>
@endsection