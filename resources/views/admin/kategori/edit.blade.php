@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
                <div class="container-fluid">
                        <h1 class="mt-4">Halaman Kategori</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Edit Kategori</li>
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
                            <div class="col-md-5">
                                <form enctype="multipart/form-data" method="post" action="{{ url('') }}/dashboard/kategori/update">
                                @csrf                                
                                <div class="form-group ">
                                        <input type="hidden" name="id" value="{{$kategori['id']}}">
                                        <label for="lokasiTempat">Nama Kategori:</label>
                                        <input type="text" class="form-control" id="lokasiTempat" placeholder="Masukan Nama Kategori" name="nama" required value = "{{$kategori['nama']}}">
                                       
                                </div>
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

                                    <img id="blah" class = "rounded mx-auto d-block" height="200px" src="@if($kategori['gambar'] != null ){{ url('') }}/{{$kategori['gambar']}}@else {{ url('') }}/asset/default.png @endif" alt="your image" />
                                <button type="submit" class="btn btn-primary mb-2">Update</button>                                                                                
                            </div>
                                </form>
                        </div>
                      
                </div>
@endsection

@section('js-ajax')
    
@endsection