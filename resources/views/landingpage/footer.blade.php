<footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 mb-4">
                    <img src="{{ url ('landingpage/images/logo_ryd.png') }}" class="logo img-fluid" alt="">
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <h5 class="site-footer-title mb-3">Quick Links</h5>

                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="{{ url('/about')}}" class="footer-menu-link">Tentang Kami</a></li>

                        <li class="footer-menu-item"><a href="{{ url('/kegiatanld')}}" class="footer-menu-link">Kegiatan</a></li>

                        <li class="footer-menu-item"><a href="{{ url('/donet')}}" class="footer-menu-link">Donasi</a></li>

                        {{-- <li class="footer-menu-item"><a href="#" class="footer-menu-link">Partner with us</a></li> --}}
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>

                        <a href="tel: 305-240-9671" class="site-footer-link">
                            0896-8099-4104
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <i class="bi-envelope me-2"></i>

                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                            khairulummah@gmail.com
                        </a>
                    </p>

                    <p class="text-white d-flex mt-3">
                        <i class="bi-geo-alt me-2"></i>
                        Ciriung, Cibinong, Kab.Bogor
                    </p>

                    <a href="#" class="custom-btn btn mt-3">Get Direction</a>
                </div>
            </div>
        </div>

        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-7 col-12">
                        <p class="copyright-text mb-0">Copyright © 2024 <a href="#">Rumah Yatim</a> </br>
                            Khairul Ummah</a>
                        </p>
                    </div>

                    {{-- <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-linkedin"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="https://youtube.com/templatemo" class="social-icon-link bi-youtube"></a>
                            </li>
                        </ul>
                    </div> --}}

                </div>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset ('landingpage/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('landingpage/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('landingpage/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset ('landingpage/js/click-scroll.js') }}"></script>
    <script src="{{ asset ('landingpage/js/counter.js') }}"></script>
    <script src="{{ asset ('landingpage/js/custom.js') }}"></script>
    @yield('logic')
    

</body>

</html>
