<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OmsetContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.omset.bulanan.index');   
    }
  
    public function cari_omset(Request $request)
    {
        $tahun = $request->tahun;

        $januari = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '1')->sum('omset_total');
        $februari = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '2')->sum('omset_total');
        $maret = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '3')->sum('omset_total');
        $april = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '4')->sum('omset_total');
        $mei = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '5')->sum('omset_total');
        $juni = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '6')->sum('omset_total');
        $juli = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '7')->sum('omset_total');
        $agustus = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '8')->sum('omset_total');
        $september = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '9')->sum('omset_total');
        $oktober = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '10')->sum('omset_total');
        $november = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '11')->sum('omset_total');
        $desember = OrderModel::whereYear('tgl_order', $request->tahun)->whereMonth('tgl_order', '12')->sum('omset_total');
        // dd($februari);
        return view('admin.omset.bulanan.index_req', compact(
            'januari',
            'februari',
            'maret',
            'april',
            'mei',
            'juni',
            'juli',
            'agustus',
            'september',
            'oktober',
            'november',
            'desember',
            'tahun'
        ));   
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
