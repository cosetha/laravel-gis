<?php

namespace App\Models;

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

    public function galeries()
    {
        return $this->belongsToMany(Galeri::class, 'galeri_lokasi');
    }

   
}
