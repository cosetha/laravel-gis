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
.fa-heart:hover {
    color: red;
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
                <div class="row mx-auto justify-content-center">
                    <div class="col-lg-12 col-md-12">
                       <div class="row">
                       @if(count($lokasi) < 1)
                        <div class="col-md-12 col-lg-12 mx-auto shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="media">
                                <img class="align-self-start mr-3" src="{{asset('asset/default.png')}}" width="128" height="128" alt="Generic placeholder image">
                                    <div class="media-body">
                                    <a href="" class="nav-link p-0">                                   
                                        <h4 class="mt-0">List Favorite</h4>
                                    </a>
                                        <h1 class="text-cente">Belum ada Lokasi Favorit yang ditambahkan</h1>                                                      
                                    </div>
                            </div>
                        </div>
                        @else
                        @foreach($lokasi as $l)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="">
                                <img class="card-img-top" src="{{ asset($l->gambar) }}" alt="{{ asset($l->nama) }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{Str::limit($l->nama, 30)}} <div class="favorite d-inline">@if($l->favorited()) <a  class="favorite-remove " href="#" data-id="{{$l->id}}"><i class="fa fa-heart"></i></a> @else <a class="favorite-add" href="#" data-id="{{$l->id}}"><i  class="far fa-heart"></i> </a> @endif</div></h5>
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
                </div>
                <div class="social d-flex justify-content-center my-3">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
@endsection
@section('script')
<script>
  $(document).ready(function () {

    $('.favorite-add').click(function(e){
        e.preventDefault();
        Swal.fire({
			title: 'Daftar Favorit',
			text: 'Tambahkan ke Daftar Favorit ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					accepts: 'application/json',
					type: 'get',
                    url: "/favorite-add/"+ $(this).data('id'),
					success: function(response) {
						if (response.hasOwnProperty('error')) {
							Swal.fire({
								icon: 'error',
								title: 'Ooopss...',
								text: response.error,
								timer: 1200,
								showConfirmButton: false
							});
						} else {
							Swal.fire({
								icon: 'success',
								title: response.message,
								text: 'Berhasil Menambahkan ke Favorit',
								timer: 2000,
								showConfirmButton: false
							});
						}
						location.reload();
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});
    
    });
    
    $('.favorite-remove').click(function(e){
        e.preventDefault();
        Swal.fire({
			title: 'Daftar Favorit',
			text: 'Hapus dari Daftar Favorit ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					accepts: 'application/json',
					type: 'get',
                    url: "/favorite-remove/"+ $(this).data('id'),
					success: function(response) {
						if (response.hasOwnProperty('error')) {
							Swal.fire({
								icon: 'error',
								title: 'Ooopss...',
								text: response.error,
								timer: 1200,
								showConfirmButton: false
							});
						} else {
							Swal.fire({
								icon: 'success',
								title: response.message,
								text: 'Berhasil Mengahpus dari daftar Favorit',
								timer: 2000,
								showConfirmButton: false
							});
						}
						location.reload();
					},
					error: function(err) {
						console.log(err);
					}
				});
			}
		});
    
    });
});
</script>
@endsection