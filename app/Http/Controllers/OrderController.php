<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');

        $data = OrderModel::all();
        $po_terakhir = OrderModel::select('no_po')->orderBy('no_po', 'DESC')->first();
        // dump($po_terakhir);
        return view('admin.orderan.crud.index', compact('data', 'tanggal', 'po_terakhir'));
    }

    public function lihat_orderan()
    {
        $data = OrderModel::orderBy('id', 'DESC')->get();
        return view('admin.orderan.crud.list', compact('data'));
    }

    public function belum_proses()
    {
        $data = OrderModel::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('admin.orderan.status.belum_proses', compact('data', 'catatan'));
    }

    public function mulai_produksi($id)
    {
        $data = OrderModel::find($id);
        $data->status = 1;
        $data->save();
        Alert::success('Berhasil', 'Orderan Berhasil Di Ubah');
        return redirect('/on_proses');
    }

    public function on_proses()
    {
        $data = OrderModel::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.orderan.status.onproses', compact('data', 'catatan'));
    }

    public function selesai_produksi($id)
    {
        $data = OrderModel::find($id);
        $data->status = 2;
        $data->save();
        Alert::success('Berhasil', 'Orderan Berhasil Di Ubah');
        return redirect('/siap_kirim');
    }

    public function siap_kirim()
    {
        $data = OrderModel::where('status', 2)->orderBy('id', 'DESC')->get();
        return view('admin.orderan.status.siapkirim', compact('data'));
    }
  
    public function orderan_selesai()
    {
        $data = OrderModel::where('status', 3)->orderBy('id', 'DESC')->get();
        return view('admin.orderan.status.orderan_selesai', compact('data'));
    }

    public function cetak_invoice($id)
    {
        $data = OrderModel::find($id);

        $dp = $data->dp;
        $data->status = 3;
        $data->save();

        
        // VALUE INVOICE //
        $catatan = json_decode($data->catatan, TRUE);

        $jenis_orderan = json_decode($data->jenis_orderan, TRUE);
        $hitung_data = count($jenis_orderan);

        $harga_satuan = json_decode($data->harga_satuan, true);
        
        $bahan = json_decode($data->bahan, true);
        $warna = json_decode($data->warna, true);
        $qty = json_decode($data->qty, true);
        
        $index = 1;
        $no_invoice = 'TF.00' . $index++;


        // dd($sub_total1);
        return view('admin.orderan.invoice', compact('data', 'no_invoice', 'catatan', 'jenis_orderan', 'harga_satuan', 'qty',  'bahan', 'warna', 'qty', 'harga_satuan', 'hitung_data', 'dp'));
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
        $hitung_data = count($request->jenis_orderan);
        // dd($hitung_data);

                // !! 1 DATA !! //
                if($hitung_data == 2) {
        
                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                
                    
                    $total_vendor1 = $request->qty[0] * $request->harga_satuan[0];
                    //HITUNG OMSET 1 DATA//
                    $omset_hpp1 = $request->qty[0] * $total_hpp;            
                    //HITUNG PROFIT //
                    $profit_value1 = ABS($total_hpp - $request->harga_satuan[0]);
                    //HITUNG TOTAL PROFIT //
                    $total_profit1 = ABS($omset_hpp1 - $total_vendor1);
                    // dd($request->harga_satuan);
                                        
            $data = OrderModel::create(
                [
                    'tgl_order' => $request->tgl_order,
                    'no_po' => $request->no_po,
                    'nama_vendor' => $request->nama_vendor,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'pesanan_untuk' => $request->pesanan_untuk,
                    'sistem_dp' => $request->sistem_dp,
                    'dp' => $request->dp,
                    'deadline' => $request->deadline,
                    'jenis_orderan' => collect($request->jenis_orderan),
                    'bahan' => collect($request->bahan),
                    'warna' => collect($request->warna),
                    'harga_satuan' => collect($request->harga_satuan),
                    'qty' => collect($request->qty),
                    'catatan' => collect($request->catatan),
                    'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                    'harga' => $request->harga,
                    'hpp_bahan' => $request->harga,
                    'hpp_cmt' => $request->hpp_cmt,
                    'hpp_bordir' => $request->hpp_bordir,
                    'profit_value' => $profit_value1,
                    'omset_total' => $total_profit1,
                    'pemeriksa' => Auth::user()->name,
                    'status' => 0
                ]
            );
            return redirect('/lihat_orderan/detail/' . $data->id);
            Alert::success('Berhasil', 'Orderan Berhasil Di Buat');             
        }        
                // !! 2 DATA !! //
                elseif($hitung_data == 3 ){

                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
        
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor2 = $request->qty[1] * $request->harga_satuan[1] + $request->qty[0] * $request->harga_satuan[0];

                     // HITUNG JUMLAH OMSET 2 DATA
                    $hpp2 = $request->qty[0] + $request->qty[1];
                    $omset_hpp2 = $total_hpp * $hpp2;
        
                    // hitung profit value 2 data //
                    $profit_value2 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] - $total_hpp);
                    
                    //TOTAL PROFIT //
                    $total_profit2 = ABS($omset_hpp2 - $total_vendor2);

                    $data = OrderModel::create(
                        [
                            'tgl_order' => $request->tgl_order,
                            'no_po' => $request->no_po,
                            'nama_vendor' => $request->nama_vendor,
                            'no_hp' => $request->no_hp,
                            'alamat' => $request->alamat,
                            'pesanan_untuk' => $request->pesanan_untuk,
                            'sistem_dp' => $request->sistem_dp,
                            'dp' => $request->dp,
                            'deadline' => $request->deadline,
                            'jenis_orderan' => collect($request->jenis_orderan),
                            'bahan' => collect($request->bahan),
                            'warna' => collect($request->warna),
                            'harga_satuan' => collect($request->harga_satuan),
                            'qty' => collect($request->qty),
                            'catatan' => collect($request->catatan),
                            'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                            'harga' => $request->harga,
                            'hpp_bahan' => $request->harga,
                            'hpp_cmt' => $request->hpp_cmt,
                            'hpp_bordir' => $request->hpp_bordir,
                            'profit_value' => $profit_value2,
                            'omset_total' => $total_profit2,
                            'pemeriksa' => Auth::user()->name,
                            'status' => 0
                        ]
                    );
                    return redirect('/lihat_orderan/detail/' . $data->id);
                    Alert::success('Berhasil', 'Orderan Berhasil Di Buat');             
                }

                // !! 3 DATA !! //        
                elseif($hitung_data == 4){
                
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                  
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor3 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2];
                 
                // HITUNG JUMLAH OMSET 3 DATA
                $hpp3 = $request->qty[0] + $request->qty[1] + $request->qty[2];
                $omset_hpp3 = $total_hpp * $hpp3;
                
                // hitung profit value //
                $profit_value3 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total3 = ABS($omset_hpp3 - $total_vendor3); 

                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value3,
                        'omset_total' => $omset_total3,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');                             
            }
                
                // !! 4 DATA !! //
                elseif($hitung_data == 5){
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                  
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor4 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3];
                
                // HITUNG JUMLAH OMSET 4 DATA
                $hpp4 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3];
                $omset_hpp4 = $total_hpp * $hpp4;
                
                // hitung profit value //
                $profit_value4 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total4 = ABS($omset_hpp4 - $total_vendor4); 

                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value4,
                        'omset_total' => $omset_total4,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');             
                }
        
                // !! 5 DATA !! //
                elseif($hitung_data == 6){
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;              
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor5 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4];
                
                // HITUNG JUMLAH OMSET 5 DATA
                $hpp5 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4];
                $omset_hpp5 = $total_hpp * $hpp5;
                
                // hitung profit value //
                $profit_value5 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total5 = ABS($omset_hpp5 - $total_vendor5); 

                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value5,
                        'omset_total' => $omset_total5,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');             
                }
                
                // !! 6 DATA !! //
                elseif($hitung_data == 7){
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                  
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor6 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5];
                
                // hitung sub total hpp //
                $subtotal_vendor_hpp6 = $total_hpp + $total_vendor6;
                
                // HITUNG JUMLAH OMSET 6 DATA
                $hpp6 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4] + $request->qty[5];
                $omset_hpp6 = $total_hpp * $hpp6;
                
                // hitung profit value //
                $profit_value6 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total6 = ABS($omset_hpp6 - $total_vendor6);
                
                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value6,
                        'omset_total' => $omset_total6,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');                             
            }
                
                // !! 7 DATA !! //
                elseif($hitung_data == 8){
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor7 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6];
                
                // hitung sub total hpp //
                $subtotal_vendor_hpp7 = $total_hpp + $total_vendor7;
                
                // HITUNG JUMLAH OMSET 7 DATA
                $hpp7 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6];
                $omset_hpp7 = $total_hpp * $hpp7;
                
                // hitung profit value //
                $profit_value7 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total7 = ABS($omset_hpp7 - $total_vendor7); 

                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value7,
                        'omset_total' => $omset_total7,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');                             
            }
             
                // !! 8 DATA !! //
                elseif($hitung_data == 9){

                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                  
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor8 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6] + $request->qty[7] * $request->harga_satuan[7];
                
                // HITUNG JUMLAH OMSET 8 DATA
                $hpp8 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6] + $request->qty[7];
                $omset_hpp8 = $total_hpp * $hpp8;
                
                // hitung profit value //
                $profit_value8 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6] + $request->harga_satuan[7]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total8 = ABS($omset_hpp8 - $total_vendor8); 

                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value8,
                        'omset_total' => $omset_total8,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');             
            }
               
                // !! 9 DATA !! //
                elseif($hitung_data == 10){
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;                                  
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor9 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6] + $request->qty[7] * $request->harga_satuan[7] + $request->qty[8] * $request->harga_satuan[8];
                
                // hitung sub total hpp //
                $subtotal_vendor_hpp9 = $total_hpp + $total_vendor9;
                
                // HITUNG JUMLAH OMSET 9 DATA
                $hpp9 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6] + $request->qty[7] + $request->qty[8];
                $omset_hpp9 = $total_hpp * $hpp9;
                
                // hitung profit value //
                $profit_value9 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6] + $request->harga_satuan[7] + $request->harga_satuan[8]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total9 = ABS($omset_hpp9 - $total_vendor9); 

                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value9,
                        'omset_total' => $omset_total9,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
                return redirect('/lihat_orderan/detail/' . $data->id);
                Alert::success('Berhasil', 'Orderan Berhasil Di Buat');             
            }
              
                // !! 10 DATA !! //
                elseif($hitung_data == 11){
                
                $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                  
                // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                $total_vendor10 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6] + $request->qty[7] * $request->harga_satuan[7] + $request->qty[8] * $request->harga_satuan[8] + $request->qty[9] * $request->harga_satuan[9];
                
                // HITUNG JUMLAH OMSET 10 DATA
                $hpp10 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6] + $request->qty[7] + $request->qty[8] + $request->qty[9];
                $omset_hpp10 = $total_hpp * $hpp10;
                
                // hitung profit value //
                $profit_value10 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6] + $request->harga_satuan[7] + $request->harga_satuan[8]  + $request->harga_satuan[9]  - $total_hpp);
        
                //TOTAL PROFIT //
                $omset_total10 = ABS($omset_hpp10 - $total_vendor10); 
                $data = OrderModel::create(
                    [
                        'tgl_order' => $request->tgl_order,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value10,
                        'omset_total' => $omset_total10,
                        'pemeriksa' => Auth::user()->name,
                        'status' => 0
                    ]
                );
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = OrderModel::find($id);

        $jenis_orderan = json_decode($data->jenis_orderan, true);
        // $array = ara($data->jenis_orderan, true);

        $bahan = json_decode($data->bahan, true);
        $warna = json_decode($data->warna, true);
        $qty = json_decode($data->qty, true);
        $harga_satuan = json_decode($data->harga_satuan, true);
        // dd($warna);
        $catatan = json_decode($data->catatan, true);

        // HITUNG DATA ARRAY JENIS ORDERAN
        $hitung_data = count($jenis_orderan);

        // HITUNG TOTAL HPP BERDASARKAN JUMLAH ORDERAN //
        $total_hpp = $data->hpp_bahan +   $data->hpp_cmt + $data->hpp_bordir;


        // !! 1 DATA !! //
        if($hitung_data == 2) {

            $jumlah1 = number_format($qty[0] * $harga_satuan[0], 2, ',', '.');

            $total_vendor1 = $qty[0] * $harga_satuan[0];

            // hitung sub total hpp //
            $subtotal_vendor_hpp1 = $total_hpp + $total_vendor1;
            //HITUNG OMSET 1 DATA//
            $omset_hpp1 = $qty[0] * $total_hpp;            
            
            //HITUNG PROFIT //
            $profit_value1 = ABS($total_hpp - $harga_satuan[0]);

            //HITUNG TOTAL PROFIT //
            $total_profit1 = ABS($omset_hpp1 - $total_vendor1); 

            return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan', 'jumlah1', 'jumlah2', 'hitung_data', 'total_vendor1', 'total_hpp', 'subtotal_vendor_hpp1', 'omset_hpp1', 'profit_value1', 'total_profit1','catatan', 'bahan', 'warna', 'hitung'));
        }

        // !! 2 DATA !! //
        elseif($hitung_data == 3 ){

            // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
            $total_vendor2 = $qty[1] * $harga_satuan[1] + $qty[0] * $harga_satuan[0];

            // hitung sub total hpp //
            $subtotal_vendor_hpp2 = $total_hpp + $total_vendor2;

             // HITUNG JUMLAH OMSET 2 DATA
            $hpp2 = $qty[0] + $qty[1];
            $omset_hpp2 = $total_hpp * $hpp2;

            // hitung profit value 2 data //
            $profit_value2 = ABS($harga_satuan[0] + $harga_satuan[1] - $total_hpp);
            
            //TOTAL PROFIT //
            $total_profit2 = ABS($omset_hpp2 - $total_vendor2);

            return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor2', 'total_hpp', 'subtotal_vendor_hpp2', 'omset_hpp2', 'profit_value2', 'total_profit2','catatan', 'bahan', 'warna', 'hitung'));
        }
        
        // !! 3 DATA !! //        
        elseif($hitung_data == 4){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor3 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp3 = $total_hpp + $total_vendor3;
        
        // HITUNG JUMLAH OMSET 3 DATA
        $hpp3 = $qty[0] + $qty[1] + $qty[2];
        $omset_hpp3 = $total_hpp * $hpp3;
        
        // hitung profit value //
        $profit_value3 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit3 = ABS($omset_hpp3 - $total_vendor3); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor3', 'total_hpp', 'subtotal_vendor_hpp3', 'omset_hpp3', 'profit_value3', 'total_profit3','catatan', 'bahan', 'warna', 'hitung'));
        }
        
        // !! 4 DATA !! //
        elseif($hitung_data == 5){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor4 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp4 = $total_hpp + $total_vendor4;
        
        // HITUNG JUMLAH OMSET 4 DATA
        $hpp4 = $qty[0] + $qty[1] + $qty[2] + $qty[3];
        $omset_hpp4 = $total_hpp * $hpp4;
        
        // hitung profit value //
        $profit_value4 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit4 = ABS($omset_hpp4 - $total_vendor4); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor4', 'total_hpp', 'subtotal_vendor_hpp4', 'omset_hpp4', 'profit_value4', 'total_profit4','catatan', 'bahan', 'warna', 'hitung'));
        }

        // !! 5 DATA !! //
        elseif($hitung_data == 6){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor5 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3] + $qty[4] * $harga_satuan[4];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp5 = $total_hpp + $total_vendor5;
        
        // HITUNG JUMLAH OMSET 5 DATA
        $hpp5 = $qty[0] + $qty[1] + $qty[2] + $qty[3] + $qty[4];
        $omset_hpp5 = $total_hpp * $hpp5;
        
        // hitung profit value //
        $profit_value5 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3] + $harga_satuan[4]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit5 = ABS($omset_hpp5 - $total_vendor5); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor5', 'total_hpp', 'subtotal_vendor_hpp5', 'omset_hpp5', 'profit_value5', 'total_profit5','catatan', 'bahan', 'warna', 'hitung'));
        }
        
        // !! 6 DATA !! //
        elseif($hitung_data == 7){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor6 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3] + $qty[4] * $harga_satuan[4] + $qty[5] * $harga_satuan[5];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp6 = $total_hpp + $total_vendor6;
        
        // HITUNG JUMLAH OMSET 6 DATA
        $hpp6 = $qty[0] + $qty[1] + $qty[2] + $qty[3] + $qty[4] + $qty[5];
        $omset_hpp6 = $total_hpp * $hpp6;
        
        // hitung profit value //
        $profit_value6 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3] + $harga_satuan[4] + $harga_satuan[5]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit6 = ABS($omset_hpp6 - $total_vendor6); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor6', 'total_hpp', 'subtotal_vendor_hpp6', 'omset_hpp6', 'profit_value6', 'total_profit6','catatan', 'bahan', 'warna', 'hitung'));
        }
        
        // !! 7 DATA !! //
        elseif($hitung_data == 8){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor7 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3] + $qty[4] * $harga_satuan[4] + $qty[5] * $harga_satuan[5] + $qty[6] * $harga_satuan[6];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp7 = $total_hpp + $total_vendor7;
        
        // HITUNG JUMLAH OMSET 7 DATA
        $hpp7 = $qty[0] + $qty[1] + $qty[2] + $qty[3] + $qty[4]  + $qty[5] + $qty[6];
        $omset_hpp7 = $total_hpp * $hpp7;
        
        // hitung profit value //
        $profit_value7 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3] + $harga_satuan[4] + $harga_satuan[5] + $harga_satuan[6]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit7 = ABS($omset_hpp7 - $total_vendor7); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor7', 'total_hpp', 'subtotal_vendor_hpp7', 'omset_hpp7', 'profit_value7', 'total_profit7','catatan', 'bahan', 'warna', 'hitung'));
        }
     
        // !! 8 DATA !! //
        elseif($hitung_data == 9){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor8 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3] + $qty[4] * $harga_satuan[4] + $qty[5] * $harga_satuan[5] + $qty[6] * $harga_satuan[6] + $qty[7] * $harga_satuan[7];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp8 = $total_hpp + $total_vendor8;
        
        // HITUNG JUMLAH OMSET 8 DATA
        $hpp8 = $qty[0] + $qty[1] + $qty[2] + $qty[3] + $qty[4]  + $qty[5] + $qty[6] + $qty[7];
        $omset_hpp8 = $total_hpp * $hpp8;
        
        // hitung profit value //
        $profit_value8 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3] + $harga_satuan[4] + $harga_satuan[5] + $harga_satuan[6] + $harga_satuan[7]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit8 = ABS($omset_hpp8 - $total_vendor8); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor8', 'total_hpp', 'subtotal_vendor_hpp8', 'omset_hpp8', 'profit_value8', 'total_profit8','catatan', 'bahan', 'warna', 'hitung'));
        }
       
        // !! 9 DATA !! //
        elseif($hitung_data == 10){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor9 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3] + $qty[4] * $harga_satuan[4] + $qty[5] * $harga_satuan[5] + $qty[6] * $harga_satuan[6] + $qty[7] * $harga_satuan[7] + $qty[8] * $harga_satuan[8];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp9 = $total_hpp + $total_vendor9;
        
        // HITUNG JUMLAH OMSET 9 DATA
        $hpp9 = $qty[0] + $qty[1] + $qty[2] + $qty[3] + $qty[4]  + $qty[5] + $qty[6] + $qty[7] + $qty[8];
        $omset_hpp9 = $total_hpp * $hpp9;
        
        // hitung profit value //
        $profit_value9 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3] + $harga_satuan[4] + $harga_satuan[5] + $harga_satuan[6] + $harga_satuan[7] + $harga_satuan[8]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit9 = ABS($omset_hpp9 - $total_vendor9); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor9', 'total_hpp', 'subtotal_vendor_hpp9', 'omset_hpp9', 'profit_value9', 'total_profit9','catatan', 'bahan', 'warna', 'hitung'));
        }
      
        // !! 10 DATA !! //
        elseif($hitung_data == 11){
                          
        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
        $total_vendor10 = $qty[0] * $harga_satuan[0] + $qty[1] * $harga_satuan[1] + $qty[2] * $harga_satuan[2] + $qty[3] * $harga_satuan[3] + $qty[4] * $harga_satuan[4] + $qty[5] * $harga_satuan[5] + $qty[6] * $harga_satuan[6] + $qty[7] * $harga_satuan[7] + $qty[8] * $harga_satuan[8] + $qty[9] * $harga_satuan[9];
        
        // hitung sub total hpp //
        $subtotal_vendor_hpp10 = $total_hpp + $total_vendor10;
        
        // HITUNG JUMLAH OMSET 10 DATA
        $hpp10 = $qty[0] + $qty[1] + $qty[2] + $qty[3] + $qty[4]  + $qty[5] + $qty[6] + $qty[7] + $qty[8] + $qty[9];
        $omset_hpp10 = $total_hpp * $hpp10;
        
        // hitung profit value //
        $profit_value9 = ABS($harga_satuan[0] + $harga_satuan[1] + $harga_satuan[2] + $harga_satuan[3] + $harga_satuan[4] + $harga_satuan[5] + $harga_satuan[6] + $harga_satuan[7] + $harga_satuan[8]  + $harga_satuan[9]  - $total_hpp);

        //TOTAL PROFIT //
        $total_profit10 = ABS($omset_hpp10 - $total_vendor10); 

        return view('admin.orderan.crud.detail', compact('data', 'jenis_orderan', 'qty', 'harga_satuan','hitung_data', 'total_vendor10', 'total_hpp', 'subtotal_vendor_hpp10', 'omset_hpp10', 'profit_value10', 'total_profit10','catatan', 'bahan', 'warna', 'hitung'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $po_terakhir = OrderModel::select('no_po')->orderBy('no_po', 'desc')->first();
        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');

        $data = OrderModel::find($id);
        
        $jenis_orderan = json_decode($data->jenis_orderan, true);
        
        $hitung_data = count($jenis_orderan);

        $bahan = json_decode($data->bahan, true);
        $warna = json_decode($data->warna, true);
        $qty = json_decode($data->qty, true);
        $catatan = json_decode($data->catatan, true);
        $harga_satuan = json_decode($data->harga_satuan, true);

        return view('admin.orderan.crud.edit', compact('data', 'po_terakhir', 'tanggal', 'hitung_data', 'jenis_orderan', 'qty', 'harga_satuan', 'catatan', 'bahan', 'warna'));
    }

    // public function list_orderan()
    // {
    //     $data = OrderModel::all();
    //     return view('admin.orderan.list');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = OrderModel::find($id);

        $hitung_data = count($request->jenis_orderan);
        // dd($hitung_data);

        // !! 1 DATA !! //
        if($hitung_data == 2) {

            $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
            
            $total_vendor1 = $request->qty[0] * $request->harga_satuan[0];
            //HITUNG OMSET 1 DATA//
            $omset_hpp1 = $request->qty[0] * $total_hpp;            
            //HITUNG PROFIT //
            $profit_value1 = ABS($total_hpp - $request->harga_satuan[0]);
            //HITUNG TOTAL PROFIT //
            $total_profit1 = ABS($omset_hpp1 - $total_vendor1);
            // dd($request->harga_satuan);
      
       $result =  DB::table('tbl_orderan')->where('id', $id)->update([
            'tgl_order' => $request->tanggal,
            'no_po' => $request->no_po,
            'nama_vendor' => $request->nama_vendor,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'pesanan_untuk' => $request->pesanan_untuk,
            'sistem_dp' => $request->sistem_dp,
            'dp' => $request->dp,
            'deadline' => $request->deadline,
            'jenis_orderan' => collect($request->jenis_orderan),
            'bahan' => collect($request->bahan),
            'warna' => collect($request->warna),
            'harga_satuan' => collect($request->harga_satuan),
            'qty' => collect($request->qty),
            'catatan' => collect($request->catatan),
            'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
            'harga' => $request->harga,
            'hpp_bahan' => $request->harga,
            'hpp_cmt' => $request->hpp_cmt,
            'hpp_bordir' => $request->hpp_bordir,
            'profit_value' => $profit_value1,
            'omset_total' => $total_profit1,
            'pemeriksa' => Auth::user()->name,
            'status' => $request->status
            ]); 
        Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
        return redirect('lihat_orderan/detail/'.$data->id);
    }

                    // !! 2 DATA !! //
                    elseif($hitung_data == 3 ){

                        $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
            
                        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                        $total_vendor2 = $request->qty[1] * $request->harga_satuan[1] + $request->qty[0] * $request->harga_satuan[0];
    
                         // HITUNG JUMLAH OMSET 2 DATA
                        $hpp2 = $request->qty[0] + $request->qty[1];
                        $omset_hpp2 = $total_hpp * $hpp2;
            
                        // hitung profit value 2 data //
                        $profit_value2 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] - $total_hpp);
                        
                        //TOTAL PROFIT //
                        $total_profit2 = ABS($omset_hpp2 - $total_vendor2);    

                        $result =  DB::table('tbl_orderan')->where('id', $id)->update([
                            'tgl_order' => $request->tanggal,
                            'no_po' => $request->no_po,
                            'nama_vendor' => $request->nama_vendor,
                            'no_hp' => $request->no_hp,
                            'alamat' => $request->alamat,
                            'pesanan_untuk' => $request->pesanan_untuk,
                            'sistem_dp' => $request->sistem_dp,
                            'dp' => $request->dp,
                            'deadline' => $request->deadline,
                            'jenis_orderan' => collect($request->jenis_orderan),
                            'bahan' => collect($request->bahan),
                            'warna' => collect($request->warna),
                            'harga_satuan' => collect($request->harga_satuan),
                            'qty' => collect($request->qty),
                            'catatan' => collect($request->catatan),
                            'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                            'harga' => $request->harga,
                            'hpp_bahan' => $request->harga,
                            'hpp_cmt' => $request->hpp_cmt,
                            'hpp_bordir' => $request->hpp_bordir,
                            'profit_value' => $profit_value2,
                            'omset_total' => $total_profit2,
                            'pemeriksa' => Auth::user()->name,
                            'status' => $request->status
                            ]); 
                        Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                        return redirect('lihat_orderan/detail/'.$data->id);
}
                // !! 3 DATA !! //        
                elseif($hitung_data == 4){
                
                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                      
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor3 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2];
                     
                    // HITUNG JUMLAH OMSET 3 DATA
                    $hpp3 = $request->qty[0] + $request->qty[1] + $request->qty[2];
                    $omset_hpp3 = $total_hpp * $hpp3;
                    
                    // hitung profit value //
                    $profit_value3 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2]  - $total_hpp);
            
                    //TOTAL PROFIT //
                    $omset_total3 = ABS($omset_hpp3 - $total_vendor3); 
                    $result =  DB::table('tbl_orderan')->where('id', $id)->update([
                        'tgl_order' => $request->tanggal,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value3,
                        'omset_total' => $omset_total3,
                        'pemeriksa' => Auth::user()->name,
                        'status' => $request->status
                        ]); 
                    Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                    return redirect('lihat_orderan/detail/'.$data->id);
}
                // !! 4 DATA !! //
                elseif($hitung_data == 5){
                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                      
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor4 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3];
                    
                    // HITUNG JUMLAH OMSET 4 DATA
                    $hpp4 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3];
                    $omset_hpp4 = $total_hpp * $hpp4;
                    
                    // hitung profit value //
                    $profit_value4 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3]  - $total_hpp);
            
                    //TOTAL PROFIT //
                    $omset_total4 = ABS($omset_hpp4 - $total_vendor4);

                    DB::table('tbl_orderan')->where('id', $id)->update([
                        'tgl_order' => $request->tanggal,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value4,
                        'omset_total' => $omset_total4,
                        'pemeriksa' => Auth::user()->name,
                        'status' => $request->status
                        ]); 
                    Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                    return redirect('lihat_orderan/detail/'.$data->id);
}
    
                // !! 5 DATA !! //
                elseif($hitung_data == 6){
                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;              
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor5 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4];
                    
                    // HITUNG JUMLAH OMSET 5 DATA
                    $hpp5 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4];
                    $omset_hpp5 = $total_hpp * $hpp5;
                    
                    // hitung profit value //
                    $profit_value5 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4]  - $total_hpp);
            
                    //TOTAL PROFIT //
                    $omset_total5 = ABS($omset_hpp5 - $total_vendor5);
                    DB::table('tbl_orderan')->where('id', $id)->update([
                        'tgl_order' => $request->tanggal,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value5,
                        'omset_total' => $omset_total5,
                        'pemeriksa' => Auth::user()->name,
                        'status' => $request->status
                        ]); 
                    Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                    return redirect('lihat_orderan/detail/'.$data->id);
                }

                      // !! 6 DATA !! //
                      elseif($hitung_data == 7){
                        $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                          
                        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                        $total_vendor6 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5];
                        
                        // hitung sub total hpp //
                        $subtotal_vendor_hpp6 = $total_hpp + $total_vendor6;
                        
                        // HITUNG JUMLAH OMSET 6 DATA
                        $hpp6 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4] + $request->qty[5];
                        $omset_hpp6 = $total_hpp * $hpp6;
                        
                        // hitung profit value //
                        $profit_value6 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5]  - $total_hpp);
                
                        //TOTAL PROFIT //
                        $omset_total6 = ABS($omset_hpp6 - $total_vendor6);
                        DB::table('tbl_orderan')->where('id', $id)->update([
                            'tgl_order' => $request->tanggal,
                            'no_po' => $request->no_po,
                            'nama_vendor' => $request->nama_vendor,
                            'no_hp' => $request->no_hp,
                            'alamat' => $request->alamat,
                            'pesanan_untuk' => $request->pesanan_untuk,
                            'sistem_dp' => $request->sistem_dp,
                            'dp' => $request->dp,
                            'deadline' => $request->deadline,
                            'jenis_orderan' => collect($request->jenis_orderan),
                            'bahan' => collect($request->bahan),
                            'warna' => collect($request->warna),
                            'harga_satuan' => collect($request->harga_satuan),
                            'qty' => collect($request->qty),
                            'catatan' => collect($request->catatan),
                            'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                            'harga' => $request->harga,
                            'hpp_bahan' => $request->harga,
                            'hpp_cmt' => $request->hpp_cmt,
                            'hpp_bordir' => $request->hpp_bordir,
                            'profit_value' => $profit_value6,
                            'omset_total' => $omset_total6,
                            'pemeriksa' => Auth::user()->name,
                            'status' => $request->status
                            ]); 
                        Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                        return redirect('lihat_orderan/detail/'.$data->id);
                    }
                     // !! 7 DATA !! //
                elseif($hitung_data == 8){
                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor7 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6];
                    
                    // hitung sub total hpp //
                    $subtotal_vendor_hpp7 = $total_hpp + $total_vendor7;
                    
                    // HITUNG JUMLAH OMSET 7 DATA
                    $hpp7 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6];
                    $omset_hpp7 = $total_hpp * $hpp7;
                    
                    // hitung profit value //
                    $profit_value7 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6]  - $total_hpp);
            
                    //TOTAL PROFIT //
                    $omset_total7 = ABS($omset_hpp7 - $total_vendor7); 

                    DB::table('tbl_orderan')->where('id', $id)->update([
                        'tgl_order' => $request->tanggal,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value7,
                        'omset_total' => $omset_total7,
                        'pemeriksa' => Auth::user()->name,
                        'status' => $request->status
                        ]); 
                    Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                    return redirect('lihat_orderan/detail/'.$data->id);
                }
                  // !! 8 DATA !! //
                  elseif($hitung_data == 9){

                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                      
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor8 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6] + $request->qty[7] * $request->harga_satuan[7];
                    
                    // HITUNG JUMLAH OMSET 8 DATA
                    $hpp8 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6] + $request->qty[7];
                    $omset_hpp8 = $total_hpp * $hpp8;
                    
                    // hitung profit value //
                    $profit_value8 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6] + $request->harga_satuan[7]  - $total_hpp);
            
                    //TOTAL PROFIT //
                    $omset_total8 = ABS($omset_hpp8 - $total_vendor8); 

                    DB::table('tbl_orderan')->where('id', $id)->update([
                        'tgl_order' => $request->tanggal,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value8,
                        'omset_total' => $omset_total8,
                        'pemeriksa' => Auth::user()->name,
                        'status' => $request->status
                        ]); 
                    Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                    return redirect('lihat_orderan/detail/'.$data->id);
                }
                      // !! 9 DATA !! //
                      elseif($hitung_data == 10){
                        $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;                                  
                        // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                        $total_vendor9 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6] + $request->qty[7] * $request->harga_satuan[7] + $request->qty[8] * $request->harga_satuan[8];
                        
                        // hitung sub total hpp //
                        $subtotal_vendor_hpp9 = $total_hpp + $total_vendor9;
                        
                        // HITUNG JUMLAH OMSET 9 DATA
                        $hpp9 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6] + $request->qty[7] + $request->qty[8];
                        $omset_hpp9 = $total_hpp * $hpp9;
                        
                        // hitung profit value //
                        $profit_value9 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6] + $request->harga_satuan[7] + $request->harga_satuan[8]  - $total_hpp);
                
                        //TOTAL PROFIT //
                        $omset_total9 = ABS($omset_hpp9 - $total_vendor9); 

                        DB::table('tbl_orderan')->where('id', $id)->update([
                            'tgl_order' => $request->tanggal,
                            'no_po' => $request->no_po,
                            'nama_vendor' => $request->nama_vendor,
                            'no_hp' => $request->no_hp,
                            'alamat' => $request->alamat,
                            'pesanan_untuk' => $request->pesanan_untuk,
                            'sistem_dp' => $request->sistem_dp,
                            'dp' => $request->dp,
                            'deadline' => $request->deadline,
                            'jenis_orderan' => collect($request->jenis_orderan),
                            'bahan' => collect($request->bahan),
                            'warna' => collect($request->warna),
                            'harga_satuan' => collect($request->harga_satuan),
                            'qty' => collect($request->qty),
                            'catatan' => collect($request->catatan),
                            'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                            'harga' => $request->harga,
                            'hpp_bahan' => $request->harga,
                            'hpp_cmt' => $request->hpp_cmt,
                            'hpp_bordir' => $request->hpp_bordir,
                            'profit_value' => $profit_value9,
                            'omset_total' => $omset_total9,
                            'pemeriksa' => Auth::user()->name,
                            'status' => $request->status
                            ]); 
                        Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                        return redirect('lihat_orderan/detail/'.$data->id);
                      }

                        // !! 10 DATA !! //
                elseif($hitung_data == 11){
                
                    $total_hpp = $request->harga +   $request->hpp_cmt + $request->hpp_bordir;
                                      
                    // HITUNG TOTAL VENDOR BERDASARKAN JUMLAH ORDERAN //
                    $total_vendor10 = $request->qty[0] * $request->harga_satuan[0] + $request->qty[1] * $request->harga_satuan[1] + $request->qty[2] * $request->harga_satuan[2] + $request->qty[3] * $request->harga_satuan[3] + $request->qty[4] * $request->harga_satuan[4] + $request->qty[5] * $request->harga_satuan[5] + $request->qty[6] * $request->harga_satuan[6] + $request->qty[7] * $request->harga_satuan[7] + $request->qty[8] * $request->harga_satuan[8] + $request->qty[9] * $request->harga_satuan[9];
                    
                    // HITUNG JUMLAH OMSET 10 DATA
                    $hpp10 = $request->qty[0] + $request->qty[1] + $request->qty[2] + $request->qty[3] + $request->qty[4]  + $request->qty[5] + $request->qty[6] + $request->qty[7] + $request->qty[8] + $request->qty[9];
                    $omset_hpp10 = $total_hpp * $hpp10;
                    
                    // hitung profit value //
                    $profit_value10 = ABS($request->harga_satuan[0] + $request->harga_satuan[1] + $request->harga_satuan[2] + $request->harga_satuan[3] + $request->harga_satuan[4] + $request->harga_satuan[5] + $request->harga_satuan[6] + $request->harga_satuan[7] + $request->harga_satuan[8]  + $request->harga_satuan[9]  - $total_hpp);
            
                    //TOTAL PROFIT //
                    $omset_total10 = ABS($omset_hpp10 - $total_vendor10); 
                    DB::table('tbl_orderan')->where('id', $id)->update([
                        'tgl_order' => $request->tanggal,
                        'no_po' => $request->no_po,
                        'nama_vendor' => $request->nama_vendor,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'pesanan_untuk' => $request->pesanan_untuk,
                        'sistem_dp' => $request->sistem_dp,
                        'dp' => $request->dp,
                        'deadline' => $request->deadline,
                        'jenis_orderan' => collect($request->jenis_orderan),
                        'bahan' => collect($request->bahan),
                        'warna' => collect($request->warna),
                        'harga_satuan' => collect($request->harga_satuan),
                        'qty' => collect($request->qty),
                        'catatan' => collect($request->catatan),
                        'pembelanjaan_bahan' => $request->pembelanjaan_bahan,
                        'harga' => $request->harga,
                        'hpp_bahan' => $request->harga,
                        'hpp_cmt' => $request->hpp_cmt,
                        'hpp_bordir' => $request->hpp_bordir,
                        'profit_value' => $profit_value10,
                        'omset_total' => $omset_total10,
                        'pemeriksa' => Auth::user()->name,
                        'status' => $request->status
                        ]); 
                    Alert::success('Berhasil', 'Pemesanan Berhasil Di Update');
                    return redirect('lihat_orderan/detail/'.$data->id);
                  }
}

    // public function update_omset(Request $request, $no_po){
    //     $data = DB::table('tbl_omset')->find($no_po);
    //     dd($data);
    // }

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
