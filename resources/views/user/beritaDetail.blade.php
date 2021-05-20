<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GIS-Kediri Detail </title>
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
        <header class="masthead" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000000 100%), url('../../{{ $detail[0]->gambar }}');">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">{{ $detail[0]->judul }}</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">{{ date('F j, Y, g:i a', strtotime($detail[0]->created_at)) }}</h2>
                    <a class="btn btn-primary js-scroll-trigger" href="#detail">Detail</a>
                </div>
            </div>
        </header>
        

        <section class="bg-light projects-section" id="detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <p>{!! $detail[0]->deskripsi !!}</p>
                        <small>Posted by: {{$detail[0]->users[0]->name}}</small>
                    </div>
                    <div class="col-lg-4 col-md-4">
                    <div class="row">
                        <div class="alert alert-dark w-100" role="alert">
                            <h5 class="text-center" >Other <span class="badge bg-light ">News</span> check it out! </h5>
                        </div>
                                @if(empty($berita->count()))                            
                                    <div class="col-md-12 col-lg-12 mx-auto">
                                        <div class="media">
                                            <img class="align-self-start mr-3" src="{{asset('asset/default.png')}}" width="64" height="64" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <a href="" class="nav-link p-0">                                   
                                                <h4 class="mt-0">Top-aligned media</h4>
                                                </a>
                                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi ipsam dignissimos tempora consequuntur ipsa illum.</p>                       
                                            </div>
                                        </div>
                                    </div> 
                                @else
                                @foreach($berita as $b)
                                    <div class="col-md-12 col-lg-12 mx-auto my-2">
                                        <div class="media">
                                            <img class="align-self-start mr-3" src="{{asset($b->gambar)}}" width="64" height="64" alt="Generic placeholder image">
                                            <div class="media-body">
                                            <h4>{{ Str::limit($b->judul, 40) }}</h4>
                                            <p class="text-black-50 mb-0">{!!Str::limit($b->deskripsi, 50) !!}</p>
                                            <a class="mb-0 text-primary-50 nav-link" href="{{url('berita/detail').'/'. $b->slug }}">Read More</a>
                                            <hr class="d-none d-lg-block mb-0 ml-0" />                   
                                            </div>
                                        </div>
                                    </div> 
                            @endforeach
                            @endif                               
                            </div>
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
                                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50"><a href="#!">hello@yourdomain.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4" />
                                <div class="small text-black-50">+1 (555) 902-8832</div>
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
