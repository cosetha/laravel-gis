<?php

namespace App\Models;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Lokasi extends Model
{
    use HasFactory;
    protected $table = "lokasi";
    protected $guarded = ['id'];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class,'id','kategori_id');
    }

    public function favorit()
    {
        return $this->belongsToMany(User::class, 'tabel_favorit');
    }

    public function galeries()
    {
        return $this->belongsToMany(Galeri::class, 'galeri_lokasi');
    }

    public function favorited()
    {
        // $Lokasi = Lokasi::whereHas('favorit', function($q) {
        //     $q->where(['user_id', '=',Auth::id()],['lokasi_id', '=',$this->id] );
        // })->get();

        // return (bool) $Lokasi;
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('lokasi_id', $this->id)
                            ->first();
    }
}
