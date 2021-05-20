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
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js"></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" />
        <style>    
          
        </style>
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
                    <h1 class="mx-auto my-0 text-uppercase">{{ $detail[0]->nama }}</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Posted {{ date('F j, Y, g:i a', strtotime($detail[0]->created_at)) }} <br> {{$detail[0]->kategoris[0]->nama}} </h2>
                    <a class="btn btn-primary js-scroll-trigger" href="#detail">Detail</a>
                </div>
            </div>
        </header>
        

        <section class="bg-light projects-section" id="detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <h4>{!! $detail[0]->nama !!}</h4>
                        <hr>
                        <h5>Lokasi: <span class="badge bg-primary">{!! $detail[0]->lokasi !!} </span></h5>
                        <p>{!! $detail[0]->keterangan !!}</p>
                    </div>
                    <div class="col-lg-6 col-md-4 w-100">
                        <div id="map" class="map w-100" style=" height: 400px; " ></div>   

                        <div class="card-header text-center my-3"><i class="fas fa-images mr-1"></i>Galleri Foto</div>                    
                        <div class="row d-flex flex-nowrap overflow-auto">
                         
                        @if(empty($detail[0]->galeries->count()))                      
                            <div class="col-md-6">
                                <img src="{{asset('asset/default.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('asset/default.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('asset/default.png')}}" alt="" class="img-fluid">
                            </div>
                        @else
                        @foreach($detail[0]->galeries as $g)
                        <div class="col-md-6">
                            <a href="" type="button" id="popup" data-toggle="modal" data-target="#exampleModal" data-image="{{url('/').'/'.$g->gambar}}" data-hidden="{{$g->deskripsi}}">
                                <img id="imageSource" src="{{url('/').'/'.$g->gambar}}" alt="{{$g->deskripsi}}" class="img-fluid">
                            </a>
                        </div>
                        
                        @endforeach 
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Image Preview </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-2">
                                    <img src="" id="image" class="img-fluid">
                                    <h5 class="text-dark-50 mt-3 mb-0">Keterangan :</h5>
                                    <p class="text-dark-50"> </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                   
                                </div>
                                </div>
                            </div>
                        </div>  
                        @endif
                     
                        </div>
                        
                    </div>
                    
                </div>

                <div class="row justify-content-between my-5">
                @if(empty($lokasi->count()))
                    <div class="col-6">
                        <div class="card" style="">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @else
                    @foreach($lokasi as $l)
                    <div class="col-6">
                        <div class="card" style="">
                            <img class="card-img-top" src="{{ asset($l->gambar) }}" alt="{{ asset($l->nama) }}">
                            <div class="card-body">
                                <h5 class="card-title">{{Str::limit($l->nama, 30)}}</h5>
                                <p class="card-text">{!! Str::limit($l->keterangan, 60) !!}</p>
                                <small>{{ $l->kategoris->first()->nama }}</small>
                                <a class="mb-0 d-block text-primary-50" href="{{url('lokasi/detail').'/'. $l['slug'] }}">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
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
        <p id="long_or" class="d-none"></p>
        <p id="lat_or" class="d-none"></p>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © Your Website 2020</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/js/scripts.js') }}"></script>

        <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var image = button.data('image')
        var text = button.data('hidden') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.    
        var modal = $(this)
        modal.find('.modal-body #image').attr('src',image)
        modal.find('.modal-body p').text(text)
})
        </script>

        <script>
        
        $(document).ready(function(){
        var lat_des = '{{$detail[0]->lat}}';
        var long_des = '{{$detail[0]->long}}';
        var x = document.getElementById("long_or");
        var y = document.getElementById("lat_or");
        function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          alert("Geolocation is not supported by this browser.");
        }

        }
        function showPosition(position) {
            $( "#lat_or" ).text(position.coords.latitude) ;
            $( "#long_or" ).text(position.coords.longitude) ;
            
        }

            getLocation();
            console.log(long_des,lat_des)
            setTimeout(function(){ console.log($( "#long_or" ).text(),$( "#lat_or" ).text()) }, 1000);               
       
        mapboxgl.accessToken = 'pk.eyJ1IjoieGlhb2thbmciLCJhIjoiY2lqc2d2NXlyMGhkbHU0bTVtcGNiOWxseCJ9.J5qsX13KKNT1slMGS-MOLg';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [112.01120512940906, -7.823820147958699],
            zoom: 14.15
        });
        map.on('load', function() {
        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken
        });
        map.addControl(directions, 'top-left');

         directions.setOrigin([$( "#long_or" ).text(),$( "#lat_or" ).text()]);
        directions.setDestination([long_des,lat_des]);
        });
        });
        
        </script>       
    </body>
</html>
