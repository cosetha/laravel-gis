@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
<style>
.badge:after{
content:attr(value);
font-size:12px;
background: red;
border-radius:50%;
padding:3px;
position:relative;
left:-8px;
top:-10px;
opacity:0.9;
}
</style>
                <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Lokasi</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{url('dashboard/lokasi')}}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i> {{ $jumlah['lokasi'] }} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Kategori</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{url('dashboard/kategori')}}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i>{{ $jumlah['kategori'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">User</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{url('dashboard/feedback')}}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i>{{ $jumlah['user'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Berita</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{url('dashboard/berita')}}">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i>{{ $jumlah['berita'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                       Diagram Jumlah Lokasi berdasarkan Kategori
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Diagram Total Data Sesuai Tabel
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center d-flex justify-content-center">
                            <div class="col-md-8">
                            <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-map mr-1"></i>
                                       Peta Persebaran
                                    </div>
                                    <div class="card-body">  <div id="map" style="min-height:430px"></div></div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
             
@endsection
@section('js-ajax')
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
        }
  });
});
</script>
@endsection