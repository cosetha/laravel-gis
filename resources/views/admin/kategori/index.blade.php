@extends('admin/layout/admin')
@section('title', 'Dashboard-Admin')

@section('content')
                <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Halaman kategori</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Tabel kategori
                            </div>
                            <div class="d-sm-flex align-items-center mt-3">
                                <a class="btn btn-primary ml-2" href="{{ url('dashboard/kategori/create') }}" >+
                                    Tambah kategori</a>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th>Gambar</th>   
                                                <th>Action</th>                                          
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th>Gambar</th>                                                
                                                <th>Action</th>    
                                            </tr>
                                        </tfoot>
                                        <tbody>                                                                        
                                        @foreach($kategori as $l)
                                            <tr>
                                                <td class="text-center" >{{ $loop->iteration }}</td>                                              
                                                <td>{{ $l->nama }}</td> 
                                                <td> <img src="@if($l->gambar != null ){{ url('') }}/{{$l->gambar}}@else {{ url('') }}/asset/default.png @endif" alt="{{ $l->nama }}" class = "thumbnail rounded mx-auto d-block" height="160px"> </td>                                                                                             
                                                <td>
                                                
                                                <a href="{{ url('') }}/dashboard/kategori/edit/{{$l->id}}" data-id="'{{$l->id}}'" data-nama="{{$l->nama}}" class="btn-edit" style="font-size: 18pt; text-decoration: none;" class="mr-3">
                                                    <i class="fas fa-pen-square"></i>
                                                </a>
                                                    
                                                <a href="javascript:void(0)" data-id="{{$l->id}}'" data-nama="{{$l->nama}}" class="btn-delete" style="font-size: 18pt; text-decoration: none; color:red;">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>                                  
                                </div>
                            </div>
                        </div>
                </div>
             
@endsection

@section('js-ajax')
<script>
$(document).ready(function() {

    
$(".btn-delete").click(function(e) {
    e.preventDefault();
		var id = $(this).attr('data-id');
		var nama = $(this).attr('data-nama');
		Swal.fire({
			title: 'Hapus ' + nama + '?',
			text: 'Anda tidak dapat mengurungkan aksi ini!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					accepts: 'application/json',
					type: 'get',
					url: '/dashboard/kategori/delete/' + id,
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
								text: 'Berhasil Menghapus kategori' + nama,
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