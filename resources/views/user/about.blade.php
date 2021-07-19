<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GIS-Kediri About</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}">GIS Kediri</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger " href="{{url('post')}}">Posts</a></li>                                                                      
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif 
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link js-scroll-trigger active dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @if(Auth::user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                       Dashboard
                                    </a>
                                    @endif
                                </div>
                            </li>
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000000 100%), url('../../asset/assets/img/bg-masthead.jpg');">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">About Us</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam eligendi adipisci ipsum ullam laborum obcaecati veniam nostrum voluptatibus mollitia deserunt.</h2>
                    <a class="btn btn-primary js-scroll-trigger" href="#about">Get Started</a>
                </div>
            </div>
        </header>
        <section class="bg-light projects-section">
            <div class="container">
            <h1 class="text-center text-primary"> PROFIL GIS KEDIRI</h1>
                <div class="row mt-5">
                    <div class="col-lg-8 col-md-8">
                        <p> <strong>Profil Wilayah</strong>
        Kota Kediri ”berumah” nan jauh arah barat daya Ibu Kota Provinsi Jawa Timur, Surabaya. Jarak dari Kota Pahlawan sekitar 130 km. Untuk catatan jumlah penduduk, Kota Kediri adalah kota terbesar nomor 3 (tiga) di Jawa Timur. Kota nomor satu diduduki Surabaya. Disusul di nomor urut 2 (dua) Kota Malang. Menurut Badan Pusat Statistik (BPS) Jawa Timur, sampai 2018 penduduk Kota Kediri berjumlah 292.768 orang/jiwa. Seluruh wilayah kota ibarat dalam kepungan Kabupaten Kediri. Ini karena seluruh wilayahnya berbatasan dengan Kabupaten Kediri. Baik sebelah utara, barat, selatan, maupun timur berbatasan dengan Kabupaten Kediri. Kota Kediri juga terbelah oleh sungai tua dengan histori dan heroisme besar Kali Brantas.

        <p><strong>Posisi Geografis</strong>
        Kota Kediri eksis pada posisi antara 111º05´ – 112º03´ Bujur Timur dan 7º45´ – 7º55´ Lintang Selatan. Adapun dari aspek topografi, Kota Kediri terletak pada ketinggian rata-rata 67 meter di atas permukaan laut. Tingkat kemiringannya 0-40 persen.</p> 

        <p><strong>Luas Kota</strong>

        Luas wilayah Kota Kediri adalah 63,404 km2, secara administratif terbagi menjadi tiga Kecamatan, yaitu Kecamatan Mojoroto, Kecamatan Kota dan Kecamatan Pesantren, dan 46 Kelurahan. Kecamatan Mojoroto dengan luas wilayah 24,6 km2 terdiri dari 14 Kelurahan, Kecamatan Kota terdiri dari 17 Kelurahan dengan luas wilayah 14,9 km2, dan Kecamatan Pesantren dengan luas wilayah 23,9 km2  terdiri dari 15 Kelurahan.</p>                        
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <p><strong>Perekonomian</strong>
Kota ini berkembang seiring meningkatnya kualitas dalam berbagai aspek, yaitu pendidikan, pariwisata, perdagangan, birokrasi pemerintah, hingga olahraga. Pusat perbelanjaan dari pasar tradisional hingga pusat perbelanjaan modern sudah beroperasi di kota ini.

Industri rokok Gudang Garam yang berada di kota ini, menjadi penopang mayoritas perekonomian warga Kediri, yang sekaligus merupakan perusahaan rokok terbesar di Indonesia. Sekitar 16.000 warga kediri menggantungkan hidupnya kepada perusahaan ini. </p> <p> Gudang Garam menyumbangkan pajak dan cukai yang relatif besar kepada pemerintah kota.

Di bidang pariwisata, kota ini mempunyai beragam tempat wisata, seperti Kolam Renang Pagora, Water Park Tirtayasa, Dermaga Jayabaya, Goa Selomangleng, dan Taman Sekartaji. Di area sepanjang Jalan Dhoho menjadi pusat pertokoan terpadat di Kediri. Beberapa sudut kota juga terdapat minimarket, cafe, hotel, hiburan malam dan banyak tempat lain yang menjadi penopang ekonomi sekaligus memenuhi kebutuhan masyarakat.

Kota Kediri menerima penghargaan sebagai kota yang paling kondusif untuk berinvestasi dari sebuah ajang yang berkaitan dengan pelayanan masyarakat dan kualitas otonomi. Kota Kediri menjadi rujukan para investor yang ingin menanamkan modalnya di kota ini. Beberapa perguruan tinggi swasta, pondok pesantren, dan lain sebagainya juga memberi dampak ke sektor perekonomian kota ini.</p>
                       
                    </div>
                </div>
            </div>
            <hr class="d-none d-lg-block mb-0 mr-0" />
        </section>

        <section class="contact-section bg-black" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">Jalan Kota Kediri</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50"><a href="#!">cosethapun@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">+6285735808835</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © Your Website 2020</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/js/scripts.js') }}"></script>       
    </body>
</html>
