@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
                <div class="container-fluid">
                        <h1 class="mt-4">Halaman Galeri</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Edit Galeri</li>
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
                            <div class="col-md-7">
                            <form enctype="multipart/form-data" method="post" action="{{ url('') }}/dashboard/galeri/update">
                                @csrf
                                <input type="hidden" name="id" value="{{$galeri['id']}}">                          
                                <div class="form-group ">                        
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" class="form-control" id="deskripsi" placeholder="Masukan Deskripsi" name="deskripsi" required value = "{{ $galeri->deskripsi }}">                                       
                                </div>
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label for="lokasi">Lokasi</label>
                                            <select class="custom-select custom-select-lg mb-2" name="lokasi" id="lokasi">                                            
                                                @foreach($kategori as $category)
                                                <option value="{{ $category->id }}" @foreach( $galeri->locations as $k) @if($k->id == $category->id) selected @endif @endforeach >{{ $category->nama }}</option>
                                                @endforeach
                                            </select> 
                                    </div>                                       
                                        <label for="file" class="mt-2 mr-4 mb-3">Gambar</label>
                                        <input input id="file" type="file" name="gambar" accept="image/*" onchange="readURLa(this);" aria-describedby="inputGroupFileAddon01">
                                        <script>
                                            function readURLa(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();

                                                    reader.onload = function(e) {
                                                    $('#blah').attr('src', e.target.result);
                                                    }

                                                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                                                }
                                            }
                                            </script>

                                        <img id="blah" class = "rounded mx-auto d-block" height="200px" src="{{ asset($galeri->gambar) }}" alt="your image" /> 
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">update</button>                                                                                
                            </div>
                                </form>
                        </div>                      
                </div>
@endsection

@section('js-ajax')
    
@endsection