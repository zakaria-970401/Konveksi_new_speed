<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    protected $table = "tbl_stok";
    protected $fillable = 
    [
    'id_loker', 
    'nama_loker', 
    'nama_vendor', 
    'nama_barang', 
    'qty', 
    'warna', 
    'bahan', 
    'size', 
    'pemeriksa', 
    'tgl_pemeriksaan'];
    public $timestamps = false;
    
}
