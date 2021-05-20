@extends('layouts.app')
@section('title', 'GIS-Kediri')
@section('content')
<!-- Masthead-->

<style>
hr.hr-text {
  position: relative;
    border: none;
    height: 1px;
    background: #64a19d;
}

hr.hr-text::before {
    content: attr(data-content);
    display: inline-block;
    background: #fff;
    font-weight: bold;
    font-size: 0.85rem;
    color: #212529;
    border-radius: 30rem;
    padding: 0.2rem 2rem;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

h4,h5,h6{
    font-family: 'Lato', sans-serif;
    font-family: 'Montserrat', sans-serif;
}

</style>
<header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h1 class="mx-auto my-0 text-uppercase">GIS KEDIRI</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam, enim?</h2>
                    <a class="btn btn-primary js-scroll-trigger" href="{{url('about')}}">Get Started</a>
                </div>
            </div>
        </header>
        
        <!-- Projects-->
        <section class="projects-section bg-light" id="projects">
        
            <div class="container">
            <hr data-content="HEADLINE" class="hr-text my-2 p-1 text-primary-60">
                <!-- Featured Project Row-->
                @if(empty($berita->count()))
                <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{ url('') }}/asset/assets/img/bg-masthead.jpg" alt="" /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Lorem ipsum dolor sit amet.</h4>
                            <p class="text-black-50 mb-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate quibusdam incidunt porro sit omnis repudiandae, nisi maxime molestiae!</p>
                        </div>
                    </div>
                </div>
                @else
                  
                <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{ asset($berita[0]['gambar']) }} " /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>{{ Str::limit($berita[0]['judul'], 30) }}</h4>
                            <p class="text-black-50 mb-0">{!!Str::limit($berita[0]['deskripsi'], 50) !!}</p>
                            <a class="mb-0 text-primary-50" href="{{url('berita/detail').'/'. $berita[0]['slug'] }}">Read More</a>
                            <hr class="d-none d-lg-block mb-0 ml-0" />
                        </div>
                       
                    </div>
                </div>
                <hr data-content="Locations" class="hr-text my-2 p-1 text-primary-60">
                @endif
                @if(empty($lokasi->count()))<!-- Project One Row-->
                <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                    <div class="col-lg-6"><img class="img-fluid" src="{{ url('') }}/asset/assets/img/demo-image-01.jpg" alt="" /></div>
                    <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae, iste!</h4>
                                    <p class="mb-0 text-white-50">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, veritatis sint maiores reiciendis voluptates totam accusamus ad ipsum?</p>
                                    <hr class="d-none d-lg-block mb-0 ml-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project Two Row-->
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6"><img class="img-fluid" src="{{ url('') }}/asset/assets/img/demo-image-02.jpg" alt="" /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati, delectus.</h4>
                                    <p class="mb-0 text-white-50">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita, asperiores debitis! Fugit illo accusantium, minima nulla dignissimos aperiam iste reprehenderit!</p>
                                    <hr class="d-none d-lg-block mb-0 mr-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                @foreach($lokasi as $l)
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-6"><img class="img-fluid" src="{{ asset($l->gambar) }}" alt="" /></div>
                    <div class="col-lg-6 @if($loop->iteration % 2 ==0 ) order-lg-first @endif">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">{{ Str::limit($l->nama, 30) }}</h4>
                                    <p class="mb-0 text-white-50">{{ Str::limit($l->lokasi, 30) }}</p>
                                    <hr class="d-none d-lg-block mb-0 mr-0" />
                                    <small class="text-white">{{ $l->kategoris->first()->nama }}</small>
                                    <a class="mb-0 d-block text-primary-50" href="{{url('lokasi/detail').'/'. $l['slug'] }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </section>
        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container">
                <div class="row">                       
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                    @if(Auth::user())
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Isi Form untuk FeedBack</h2>
                        <form class="form-inline d-flex">
                            <input class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" type="text" placeholder="Isi Masukan..." />
                            <button class="btn btn-primary mx-auto" type="submit">Subscribe</button>
                        </form>
                    @endif
                        
                    </div>
                </div>
                <div class="row w-100 mt-5">
                    <div class="col-md-12">
                        <div id="map" class="map w-100" style=" height: 500px;" >

                        </div>
                    </div>
                </div>
                <div class="row mt-5 p-4">
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
@endsection
@section('script')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,100&family=Montserrat:wght@300&display=swap" rel="stylesheet">
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoieGlhb2thbmciLCJhIjoiY2lqc2d2NXlyMGhkbHU0bTVtcGNiOWxseCJ9.J5qsX13KKNT1slMGS-MOLg';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [112.01120512940906, -7.823820147958699],
    zoom: 14.15
});
$(document).ready(function(){
    $.get('/post-data', function(data){
       
        var result = data.data;
        for (let index = 0; index < result.length; index++) {
            var popup = new mapboxgl.Popup().setHTML(
                '<h4 class="text-primary p-1">'+result[index].nama+'</h4>'+'<br>'+'<h6 class="text-dark-50 p-1">'+result[index].lokasi+'</h6>'+'<p class="text-dark-50 p-1">'+result[index].kategoris[0].nama+'</p>'+'<br>'+'<a href="lokasi/detail/'+result[index].slug+'" class="text-center btn-warning" style="font-size: 18pt; color:white; text-decoration: none;" class="mr-3">Detail <i class="fas fa-info-cicle"></i> </a>'
            );

             new mapboxgl.Marker().setLngLat([result[index].long, result[index].lat])
            .setPopup(popup).addTo(map);
            console.log(result[index].long)
        }
  });
});
</script>
@endsection