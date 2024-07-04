@extends('landingpage.index')
@section('content')

<section class="section-padding section-bg" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="{{ url ('landingpage/images/orang.jpg') }}"
                            class="custom-text-box-image img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="custom-text-box">
                            <h2 class="mb-2">Our Story</h2>

                            <h5 class="mb-3">Rumah Yatim Khairul Ummah, Organisasi Non-Profit</h5>

                            <p class="mb-0">Merupakan lembaga yang ingin mewujudkan 
                                peningkatan IPM (Indeks Pembangunan Manusia) umat dan terunggul dalam 
                                penerimaan, pengadministrasian dan penyaluran dana.</p>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box mb-lg-0">
                                    <h5 class="mb-3">Missi Kami</h5>

                                    <ul class="custom-list mt-2">
                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Membantu meringani beban anak yatim piatu dan duafa.
                                        </li>

                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Membantu mencukupi kebutuhan anak yatim piatu dan duafa.
                                        </li>

                                        <li class="custom-list-item d-flex">
                                            <i class="bi-check custom-text-box-icon me-2"></i>
                                            Membantu meningkatkan kualitas anak yatim piatu dengan kegiatan positif.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="custom-text-box d-flex flex-wrap d-lg-block mb-lg-0">
                                    <div class="counter-thumb">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="2012"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text"></span>
                                        </div>

                                        <span class="counter-text">Didirikan</span>
                                    </div>

                                    <div class="counter-thumb mt-4">
                                        <div class="d-flex">
                                            <span class="counter-number" data-from="1" data-to="100"
                                                data-speed="1000"></span>
                                            <span class="counter-number-text">%</span>
                                        </div>

                                        <span class="counter-text">Amanah</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="{{ url ('landingpage/images/avatar/agus.jpg') }}"
                            class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">Agus Erwan Abidin</h2>

                            <p class="text-muted mb-lg-4 mb-md-4">Founder</p>

                            <p>Rumah Yatim ini didirikan oleh Agus Erwan Abidin pada tahun 2012 dimana bermula dari sebuah Majelis Ta’lim Baitu Khalifatillah yang tiap tahunnya menyantunin anak yatim.
                               </p>

                            <p>Akhirnya diberi nama Rumah Yatim piatu dan dhuafa Khoirul Ummah, dan kegiatan tersebut berjalan hingga sekarang.
                            </p>

                            <ul class="social-icon mt-4">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-facebook"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        @endsection