@extends('landingpage.index')
@section('content')
<section class="donate-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form donate-form" action="{{route('donet.store')}}" method="POST" enctype="multipart/form-data" role="form">
                        @csrf
                            <h3 class="mb-4">Donasi</h3>

                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <h5 class="mt-1">Personal Info</h5>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <input type="text" name="nama" value="{{ old('nama') }}" id="donation-name" class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Nama">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="col-lg-6 col-12">
                                    <input type="text" name="no_hp"  value="{{ old('no_hp') }}"
                                         class="form-control @error('no_hp') is-invalid @enderror" placeholder="No HP">
                                        @error('no_hp')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="col-lg-12 col-12 mt-3">
                                    <h5 class="mt-1">Keterangan</h5>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" id="donation-name" class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Harapan Donasi" >
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                {{-- <div class="col-lg-6 col-12 mt-2">
                                    <input type="date" name="tgl_donasi" value="{{ old('tgl_donasi') }}"
                                        class="form-control" required>
                                </div> --}}

                                <div class="col-lg-12 col-12 mt-3">
                                    <h5 class="mt-2 mb-3">Masukan jumlah</h5>
                                </div>

                                {{-- @foreach ($ar_jml as $jml_donasi)
                                @php
                                $cek = (old('jml_donasi') == $jml_donasi)? 'checked':'';
                                @endphp                                
                                <div class="col-lg-3 col-md-6 col-6 form-check-group">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="jml_donasi" value="{{ old('jml_donasi') }}" >
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Rp.{{ $jml_donasi }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach --}}

                                <div class="col-lg-12 col-12 form-check-group">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">Rp.</span>

                                        <input type="text" class="form-control @error('jml_donasi') is-invalid @enderror" placeholder="Masukan Jumlah Donasi"
                                            aria-label="Username" aria-describedby="basic-addon1" name="jml_donasi" value="{{ old('jml_donasi') }}">
                                            @error('jml_donasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <h5 class="mt-4 pt-1">Metode Pembayaran</h5>
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                        @foreach($ar_metode_pembayaran as $mepem)
                                        @php
                                        $cek = (old('metode_pembayaran_id') == $mepem->id) ? 'checked': '';
                                        @endphp
                                        <div class="form-check ms-2">
                                        <div class="d-flex align-items-center pb-2">
                                            <input class="form-check-input checkk  @error('metode_pembayaran_id') is-invalid @enderror" type="radio" 
                                            name="metode_pembayaran_id" value="{{ $mepem->id }}" {{ $cek }}>
                                            <label class="form-check-label mb-auto" for="gridRadios1">
                                                &nbsp;&nbsp;<img src="{{url('admin/images/icon_pembayaran')}}/{{$mepem->icon}}" width="50px" alt="Profile" class="rounded-circle">{{$mepem->nama}}
                                            </label>
                                        </div>
                                        </div>
                                        @endforeach
                                        @error('metode_pembayaran_id')
                                        <div class="invalid-feedback d-inline" style="margin-left: 9%">
                                            {{$message}}
                                        </div>
                                        @enderror

                                        <div class="Box" style="display:none">
                                            <div class="col-lg-12 col-12">
                                                <h5 class="mt-4 pt-1">Lakukan Transfer</h5>
                                                    <p>Silahkan melakukan transfer ke nomor <span id="test" class="fw-semibold"></span> </p>
                                            </div>
                                            

                                            <div class="col-lg-12 col-12">
                                                <h5 class="mt-4 pt-1">Upload Bukti Transfer</h5>
                                            </div>

                                            <div class="col-sm-9">
                                                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer" value="{{old('bukti_transfer')}}">
                                                @error('bukti_transfer')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        

                                    <button type="submit" class="form-control mt-4">Submit Donasi</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
@endsection
@section('logic')
<script> 

$('input[type="radio"]').click(function(){
    @foreach ( $ar_metode_pembayaran as $mepem )
        
        if($(this).attr("value")== {{ $mepem->id }} ){
            $(".Box").show('slow');

            $('#test') . html('{{ $mepem->nomor }}');
        }

    @endforeach           
});
</script>
@endsection