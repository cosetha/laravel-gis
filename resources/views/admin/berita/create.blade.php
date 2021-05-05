@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
                <div class="container-fluid">
                        <h1 class="mt-4">Halaman Berita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tambah Berita</li>
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
                                    <li class="m-0 p-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row m-0">                        
                            <div class="col-md-6 h-100 m-0 p-0">
                            <form enctype="multipart/form-data" method="post" action="{{ url('') }}/dashboard/berita/store">
                                @csrf
                              
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="namaTempat">Judul Berita</label>
                                        <input type="text" class="form-control" id="namaTempat" placeholder="Judul Berita" name="judul" required value = "{{ old('nama') }}">
                                    </div> 
                                </div>                                                          
                                <div class="form-group">                                    
                                    <label for="beritaTempat">Status Headline : </label>                            
                                    <select class="custom-select custom-select-lg mb-2 w-50" name="status" id="status">                                        
                                        <option value="on">Active</option>
                                        <option value="off" selected >Non-Active</option>                                                
                                    </select>
                                    
                                    <label for="file" class="mt-2 mr-4 mb-3 d-block">Gambar</label>
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

                                    <img id="blah" class = "rounded mx-auto d-block" height="200px" src="{{ url('') }}/asset/default.png" alt="your image" />                                                                                                           
                                    <input type="hidden" id="penulis" class="form-control" name="penulis" value="{{ auth()->user()->id }}" readonly>
                                </div>
                                
                            </div>                                               
                            <div class="col-md-6 m-0 p-0">
                                <div class="form-group">
                                <label for="deskripsi">Deskripsi :</label>
                                    <textarea type="text" id="deskripsi" name="deskripsi">{{ old('deskripsi') }} </textarea>
                                </div>
                                <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary m-2">Tambahkan</button>
                                </div>
                               
                            </div>
                        </form>
                        </div>
                </div>
@endsection

@section('js-ajax')
    <script>
        
    </script>
@endsection