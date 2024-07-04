@extends('admin.index')
@section('content')

<div class="jumbotron">
    <h1 class="display-4">Selamat Datang di Halaman Admin</h1>
    <p class="lead"></p>
    <hr class="my-4">

    <p>Rumah Yatim adalah Lembaga Amil Zakat sekaligus lembaga sosial tingkat nasional yang berkhidmat secara professional dalam membantu meningkatkan kualitas IPM umat dan menjadi lembaga sosial terdepan dalam pengasuhan dan pemberdayaan anak yatim dan dhuafa di Indonesia.</p>
    <!--
    <a class="btn btn-primary btn-lg" href="{{ url('/anak_asuh') }}" role="button">Anak Asuh</a>&emsp;
    <a class="btn btn-primary btn-lg" href="{{ url('/donatur') }}" role="button">Donatur</a>&emsp;
    <a class="btn btn-primary btn-lg" href="{{ url('/donasi') }}" role="button">Donasi</a>    <br/>
    -->

</div> &emsp;&emsp;&emsp;&emsp;

<div class="card" style="width: 18rem;">
  <img src="{{ url ('admin/images/anak.JPG') }}">
    <div class="card-body">
        <h5 class="card-title">Anak Yatim</h5>
        <p class="card-text">Detail anak Yatim yang di beri bantuan melaui kita dari donatur</p>
        <a href="{{ url('/anak_asuh') }}" class="btn btn-primary">Ke Halaman</a>
    </div>
</div>&emsp;&emsp;&emsp;&emsp;

<div class="card" style="width: 18rem;">
  <img src="{{ url ('admin/images/donatur.JPG') }}">
    <div class="card-body">
        <h5 class="card-title">Donatur</h5>
        <p class="card-text">Detail pemberi dana santunan kepada anak asuh</p>
        <a href="{{ url('/donatur') }}" class="btn btn-primary">Ke Halaman</a>
    </div>
</div>&emsp;&emsp;&emsp;&emsp;

<div class="card" style="width: 18rem;">
  <img src="{{ url ('admin/images/donasi.JPG') }}">
    <div class="card-body">
        <h5 class="card-title">Donasi</h5>
        <p class="card-text">Detail dana yang terkumpul dari donatur sebagai bantuan kepada anak asuh</p>
        <a href="{{ url('/donasi') }}" class="btn btn-primary">Ke Halaman</a>
    </div>
</div>
{{-- <div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h5>Pie Charts donut</h5>
        </div>
        <div class="card-body">
            <div id="pie-chart-2" style="width:100%"></div>
        </div>
    </div>
</div> --}}
@endsection
