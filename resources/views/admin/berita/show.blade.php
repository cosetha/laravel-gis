@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
                <div class="container-fluid">
                        <h1 class="mt-4">Halaman Berita</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Detail Berita</li>
                        </ol>
                        <div class="row m-0">                        
                            <div class="col-md-6 h-100 m-0 p-0">
                              
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="namaTempat">Judul Berita</label>
                                        <input type="text" class="form-control" id="namaTempat" placeholder="Judul Berita" name="judul" readonly required value = "{{ $berita->judul }}">
                                    </div> 
                                </div>                                                          
                                <div class="form-group">                                    
                                    <label for="beritaTempat">Status Headline : </label>                            
                                    <select class="custom-select custom-select-lg mb-2 w-50" name="status" id="status" disabled>                                        
                                        <option value="on" @if($berita->headline == 'on') selected  @endif >Active</option>
                                        <option value="off" @if($berita->headline == 'off') selected  @endif >Non-Active</option>                                                
                                    </select>
                                    
                                    <label for="file" class="mt-2 mr-4 mb-3 d-block">Gambar</label>                                   
                                    <img id="blah" class = "rounded mx-auto d-block" height="200px" src="{{ url('') }}/{{$berita->gambar}}" alt="your image" />  
                                    <label for="penulis">Penulis : </label>                                                                                                      
                                    <input type="text" id="penulis" class="form-control w-50" name="penulis" value="{{ auth()->user()->name }}" readonly>
                                </div>
                                
                            </div>                                               
                            <div class="col-md-6 m-0 p-0">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi :</label>
                                        <textarea type="text" id="deskripsi" name="deskripsi">{{ $berita->deskripsi }} </textarea>
                                    </div>
                                   

                                </div>                               
                            </div>
                        
                        </div>
                </div>
@endsection

@section('js-ajax')
    <script>
          $(document).ready(function(){
            tinymce.get('deskripsi').setMode('readonly');
        })
    </script>
@endsection