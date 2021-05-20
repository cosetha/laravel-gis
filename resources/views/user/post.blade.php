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
        
        <section class="bg-light projects-section" id="projects">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                       <div class="row">
                       @if(empty($lokasi->count()))
                        <div class="col-md-12 col-lg-12 mx-auto">
                            <div class="media">
                                <img class="align-self-start mr-3" src="{{asset('asset/default.png')}}" width="128" height="128" alt="Generic placeholder image">
                                    <div class="media-body">
                                    <a href="" class="nav-link p-0">                                   
                                        <h4 class="mt-0">Top-aligned media</h4>
                                    </a>
                                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                        <p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>                                    
                                    </div>
                            </div>
                        </div>
                        @else
                        @foreach($lokasi as $l)
                        <div class="col-md-12 col-lg-12 mx-auto my-2">
                            <div class="media">
                                <img class="align-self-start mr-3" src="{{asset($l->gambar)}}" width="128" height="128" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h4 class="text-dark">{{ Str::limit($l->nama, 30) }}</h4>
                                        <p class="mb-0 text-dark-50">{{ Str::limit($l->lokasi, 30) }}</p>
                                        <hr class="d-none d-lg-block mb-0 mr-0" />
                                        <small class="text-dark">{{ $l->kategoris->first()->nama}}</small>
                                        <a class="mb-0 d-block text-primary-50" href="{{url('lokasi/detail').'/'. $l->slug }}">read more</a>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        {{$lokasi->links("pagination::bootstrap-4")}}                                                                      
                    </div>           
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
                                                </a>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam, enim?
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
            </div>
            <hr class="d-none d-lg-block mb-0 mr-0" />
        </section>
        <!-- Contact-->
        <section class="signup-section bg-black" id="signup">
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
                <div class="social d-flex justify-content-center my-3">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
@endsection
