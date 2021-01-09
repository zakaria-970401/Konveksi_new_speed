<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\StokModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $join = DB::table('tbl_stok')
        ->join('tbl_loker', 'tbl_loker.nama_loker', '=', 'tbl_stok.nama_loker')
        ->select('tbl_stok.id','tbl_loker.id_loker', 'tbl_stok.nama_loker', 'tbl_stok.nama_vendor', 'tbl_stok.nama_barang', 'tbl_stok.warna', 'tbl_stok.bahan', 'tbl_stok.size', 'tbl_stok.qty', 'tbl_stok.tgl_pemeriksaan', 'tbl_stok.pemeriksa')
        ->get();
        // dd($join[0]->id_loker);
        return view('admin.stok.crud.index', compact('join'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = StokModel::find($id);
        // dd($data);

        $join = DB::table('tbl_stok')
        ->join('tbl_loker', 'tbl_loker.nama_loker', '=', 'tbl_stok.nama_loker')
        ->select('tbl_stok.id', 'tbl_stok.nama_loker', 'tbl_stok.nama_vendor', 'tbl_stok.nama_barang', 'tbl_stok.warna', 'tbl_stok.bahan', 'tbl_stok.size', 'tbl_stok.qty', 'tbl_stok.tgl_pemeriksaan', 'tbl_stok.pemeriksa')
        ->where('tbl_stok.id', '=', $id)
        ->get();
        // dd($join[0]->items);

        return view('admin.stok.crud.show_stok', compact('data', 'join', 'cek_null'));
     
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print_stok($nama_loker)
    {
        $data = StokModel::find($nama_loker);
        $join = DB::table('tbl_stok')
        ->join('tbl_loker', 'tbl_loker.nama_loker', '=', 'tbl_stok.nama_loker')
        ->select('tbl_stok.id', 'tbl_stok.nama_loker', 'tbl_stok.nama_vendor', 'tbl_stok.nama_barang', 'tbl_stok.warna', 'tbl_stok.bahan', 'tbl_stok.size', 'tbl_stok.qty', 'tbl_stok.tgl_pemeriksaan', 'tbl_stok.pemeriksa')
        ->where('tbl_stok.nama_loker', '=', $nama_loker)
        ->get();
        // dd($join[0]->nama_loker);
        return view('admin.stok.crud.print_stok', compact('data', 'join'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
