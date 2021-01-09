<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = "tbl_orderan";

    protected $fillable = [
        'tgl_order',
        'no_po',
        'nama_vendor',
        'no_hp',
        'alamat',
        'pesanan_untuk',
        'sistem_dp',
        'dp',
        'deadline',
        'jenis_orderan',
        'bahan',
        'warna',
        'harga_satuan',
        'qty',
        'catatan',
        'pembelanjaan_bahan',
        'harga',
        'hpp_bahan',
        'hpp_cmt',
        'hpp_bordir',
        'profit_value',
        'omset_total',
        'pemeriksa',
        'status',
    ];

    public $timestamps = false;
}
