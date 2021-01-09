<?php

namespace App\Http\Controllers;

use App\GajiKaryawanModel;

class GajiKaryawanController extends Controller
{

    public function sudah_di_bayar()
    {
        $data = GajiKaryawanModel::where('keterangan', 'sudah_di_bayar')->orderBy('tanggal', 'DESC')->get();

        return view('admin.penggajian.sudah_di_bayar', compact('data'));
    }
    
    public function belum_di_bayar()
    {
        $data = GajiKaryawanModel::where('keterangan', 'belum_di_bayar')->orderBy('tanggal', 'DESC')->get();
        return view('admin.penggajian.belum_di_bayar', compact('data'));        
    }
    
    public function history()
    {

    $data = GajiKaryawanModel::orderBy('id', 'DESC')->get();
    return view('admin.penggajian.all_list', compact('data'));
    
    }
}
