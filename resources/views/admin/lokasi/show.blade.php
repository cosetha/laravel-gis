@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
                <div class="container-fluid">
                        <h1 class="mt-4">Halaman Lokasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Detail Lokasi</li>
                        </ol>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row m-0">

                            <div class="col-md-5 p-2">
                                <div id="map" class="w-100" style="height:400px;"></div>
                                
                                <pre id="cordinate"> </pre>
                                
                            </div>

                            <div class="col-md-7 h-100">
                    
                                <div class="form-row">  
                                    <div class="form-group col-md-6">
                                        <label for="namaTempat">Nama Tempat:</label>
                                        <input type="text" class="form-control" id="namaTempat" placeholder="Nama Tempat" name="nama" readonly value = "{{$lokasi['nama']}}">
                                    </div> 
                                </div>
                                <div class="form-group ">
                                        <label for="lokasiTempat">Lokasi Tempat:</label>
                                        <input type="text" class="form-control" id="lokasiTempat" placeholder="Lokasi Tempat" name="lokasi" readonly value = "{{$lokasi['lokasi']}}">
                                    </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="long">Longitude</label>
                                        <input type="text" class="form-control" id="long" name="long"  readonly readonly value = "{{$lokasi['long']}}"> 
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="lat">Latitude</label>
                                        <input type="text" id="lat" class="form-control" name="lat"  readonly readonly value = "{{$lokasi['lat']}}">                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                    <label for="kategori">Kategori</label>
                                    <select class="custom-select custom-select-lg mb-2" name="kategori" id="kategori" disabled>                                      
                                        @foreach($kategori as $category)
                                        <option value="{{ $category->id }}" {{$lokasi->kategori_id == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="file" class="mt-2 mr-4 mb-3">Gambar</label>                                                               
                                    <img id="blah" class = "rounded mx-auto d-block" height="200px" src="{{ url('') }}/{{$lokasi['gambar']}}" alt="your image" />
                                    <label for="keterangan">Keterangan :</label>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        <div class="row justify-content-center m-0">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <textarea type="text" id="keterangan" name="keterangan">{{$lokasi['keterangan']}}</textarea>
                                </div>
                             
                            </div>
                        </div>
                </div>
@endsection

@section('js-ajax')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiY29zZXRoYSIsImEiOiJja2tkc2ptbjMwN3NxMm9qbjQ0dm9lYTlhIn0.ccYelknb7IvdgZWUMfzvsA';
        var lat = document.getElementById('lat');
        var long = document.getElementById('long');
        var coordinates = document.getElementById('cordinate');
        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        
        center: ["{{$lokasi['long']}}", "{{$lokasi['lat']}}"],
        zoom: 15
        });
        map.resize();
        var marker = new mapboxgl.Marker({
        draggable: false
        })
        .setLngLat(["{{$lokasi['long']}}", "{{$lokasi['lat']}}"],)
        .addTo(map);
        
        function onDragEnd() {
        var lngLat = marker.getLngLat();
        lat.value = lngLat.lat
        long.value = lngLat.lng
        // coordinates.style.display = 'block';
        // coordinates.innerHTML =
        // 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
        }
        
        marker.on('dragend', onDragEnd);
        $(document).ready(function(){
            tinymce.get('keterangan').setMode('readonly');
        })
       
    </script>
@endsection