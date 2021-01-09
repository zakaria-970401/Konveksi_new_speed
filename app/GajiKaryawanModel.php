<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GajiKaryawanModel extends Model
{
    protected $table = "tbl_gaji_karyawan";
    protected $fillable = 
    [
    'tanggal',
    'jenis_pekerjaan', 
    'vendor', 
    'deskripsi', 
    'qty_barang', 
    'nama_pekerja', 
    'harga_jasa', 
    'qty_pekerjaan', 
    'total', 
    'keterangan'
    ];
    public $timestamps = false;
    
}
