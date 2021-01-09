<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\StokModel;
use App\OrderModel;
use App\GajiKaryawanModel;
use App\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MasterDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function master_stok()
    {
        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');
        // dd($tanggal);
        
        $data = DB::table('tbl_stok')->orderBy('nama_loker', 'ASC')->get();
        $loker = DB::table('tbl_loker')->orderBy('nama_loker', 'ASC')->get();

        return view('admin.masterdata.stok.index', compact('data', 'loker', 'tanggal'));
    }
    
    public function input_master_stok(Request $request)
    {
        $nama_vendor = $request->nama_vendor;

        for ($i=0; $i < count($nama_vendor); $i++) { 
            if(!empty($nama_vendor[$i])){
                $data = StokModel::create([
                'nama_loker' => $request->nama_loker[$i],
                'nama_vendor' => $request->nama_vendor[$i],
                'nama_barang' => $request->nama_barang[$i],
                'qty' => $request->qty[$i],
                'warna' => $request->warna[$i],
                'bahan' => $request->bahan[$i],
                'size' => $request->size[$i],
                'pemeriksa' => Auth::user()->name,
                'tgl_pemeriksaan' => $request->tgl_pemeriksaan
            ]);
        }
    }
    Alert::success('Berhasil', 'Stok Barang Berhasil Di Buat');
        return redirect()->back();
    }

    public function show_stok($nama_loker)
    {
        $data = StokModel::find($nama_loker);
        // dd($data);

        $join = DB::table('tbl_stok')
        ->join('tbl_loker', 'tbl_loker.nama_loker', '=', 'tbl_stok.nama_loker')
        ->select('tbl_stok.id', 'tbl_stok.nama_loker', 'tbl_stok.nama_vendor', 'tbl_stok.nama_barang', 'tbl_stok.warna', 'tbl_stok.bahan', 'tbl_stok.size', 'tbl_stok.qty', 'tbl_stok.tgl_pemeriksaan')
        ->where('tbl_stok.nama_loker', '=', $nama_loker)
        ->get();
        // dd($join[0]->nama_loker);

        return view('admin.masterdata.stok.show_stok', compact('data', 'join'));
    }

    public function edit_stok($id)
    {
        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');

        $data = StokModel::find($id);
        // dd($data);

        $loker = DB::table('tbl_loker')->get();


        return view('admin.masterdata.stok.edit', compact('data', 'tanggal', 'loker'));
    }


    public function update_stok(Request $request, $id)
    {
        $data = StokModel::find($id);

        $result =  StokModel::where('id', $id)->update([
        'nama_loker' => $request->nama_loker,
        'nama_vendor' => $request->nama_vendor,
        'nama_barang' => $request->nama_barang,
        'qty' => $request->qty,
        'warna' => $request->warna,
        'bahan' => $request->bahan,
        'size' => $request->size,
        'pemeriksa' => Auth::user()->name,
        'tgl_pemeriksaan' => $request->tgl_pemeriksaan
        ]);
        Alert::success('Berhasil', 'Stok Berhasil Di Update');
        return redirect('/master_stok');
    }

    public function destroy_stok($id)
    {
            $data = StokModel::find($id); 
            $data->delete();
            Alert::success('Berhasil', 'Stok Barang Berhasil Di Hapus');
            return redirect('/master_stok');
    }

    public function master_gaji()
    {
        $belum_di_bayar = GajiKaryawanModel::where('keterangan', 'belum_di_bayar')->count();
        $sudah_di_bayar = GajiKaryawanModel::where('keterangan', 'sudah_di_bayar')->count();
        $all_list = GajiKaryawanModel::count();
        return view('admin.masterdata.penggajian.dashboard', compact('belum_di_bayar', 'sudah_di_bayar', 'all_list'));

    }

    public function sudah_di_bayar()
    {
        $data = GajiKaryawanModel::where('keterangan', 'sudah_di_bayar')->orderBy('id', 'DESC')->get();

        return view('admin.masterdata.penggajian.history.sudah_di_bayar', compact('data'));
    }
    
    public function belum_di_bayar()
    {
        $data = GajiKaryawanModel::where('keterangan', 'belum_di_bayar')->orderBy('id', 'DESC')->get();

        return view('admin.masterdata.penggajian.history.belum_di_bayar', compact('data'));
    }
  
    public function all_list()
    {
        $data = GajiKaryawanModel::all();
        // dd($data);
        return view('admin.masterdata.penggajian.history.all_list', compact('data'));
    }
  
    public function edit_pembayaran($id)
    {
        $data = GajiKaryawanModel::find($id);
        $vendor = OrderModel::select('status', 'nama_vendor')->get();

        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');

        return view('admin.masterdata.penggajian.history.edit', compact('data', 'tanggal', 'vendor'));
    }
    
    public function update_pembayaran(Request $request, $id)
    {
        $data = GajiKaryawanModel::find($id);

        GajiKaryawanModel::where('id', $id)->update([
            'deskripsi' => $request->deskripsi,
            'qty_barang' => $request->qty_barang,
            'nama_pekerja' => $request->nama_pekerja,
            'harga_jasa' => $request->harga_jasa,
            'qty_pekerjaan' => $request->qty_pekerjaan,
            'total' => $request->harga_jasa,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'vendor' => $request->vendor,
        ]);
        Alert::success('Berhasil', 'Data Berhasil Di Update');
        return redirect('/penggajian/masterdata/all_list');
    }

    public function destroy_pembayaran($id)
    {
            $data = GajiKaryawanModel::find($id); 
            $data->delete();
            Alert::success('Berhasil', 'Data Berhasil Di Hapus');
            return redirect('/penggajian/masterdata/all_list');
    }


    public function add_potong()
    {
        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');

        $vendor = OrderModel::select('nama_vendor')->where('status', 1)->get();
        // dd($status_vendor);

        return view('admin.masterdata.penggajian.potong.add', compact('tanggal', 'vendor'));
    }

    public function store_potong(Request $request)
    {
        
        $deskripsi = $request->deskripsi;

        // dd($deskripsi);
            for ($i=0; $i < count($deskripsi); $i++) { 
                if(!empty($deskripsi[$i])){
                    $data = GajiKaryawanModel::create([
                    'deskripsi' => $request->deskripsi[$i],
                    'qty_barang' => $request->qty_barang[$i],
                    'nama_pekerja' => $request->nama_pekerja[$i],
                    'harga_jasa' => $request->harga_jasa[$i],
                    'qty_pekerjaan' => $request->qty_pekerjaan[$i],
                    'total' => $request->harga_jasa[$i] * $request->qty_pekerjaan[$i] ,
                    'keterangan' => $request->keterangan[$i],
                    'tanggal' => $request->tanggal,
                    'jenis_pekerjaan' => $request->jenis_pekerjaan,
                    'vendor' => $request->vendor,
                ]);
            }
        }
        // dd($data);
        
        Alert::success('Berhasil', 'Pembayaran Berhasil Di Buat');
        return redirect('/penggajian/dashboard')->back();
    }
    
    public function add_jahit()
    {
        date_default_timezone_set('asia/jakarta');
        $tanggal = date('Y-m-d');

        $vendor = OrderModel::select('nama_vendor')->where('status', 1)->get();
        // dd($status_vendor);

        return view('admin.masterdata.penggajian.jahit.add', compact('tanggal', 'vendor'));
    }

    public function store_jahit(Request $request)
    {
        
        $deskripsi = $request->deskripsi;

            for ($i=0; $i < count($deskripsi); $i++) { 
                if(!empty($deskripsi[$i])){
                    $data = GajiKaryawanModel::create([
                    'deskripsi' => $request->deskripsi[$i],
                    'qty_barang' => $request->qty_barang[$i],
                    'nama_pekerja' => $request->nama_pekerja[$i],
                    'harga_jasa' => $request->harga_jasa[$i],
                    'qty_pekerjaan' => $request->qty_pekerjaan[$i],
                    'total' => $request->harga_jasa[$i] * $request->qty_pekerjaan[$i] ,
                    'keterangan' => $request->keterangan[$i],
                    'tanggal' => $request->tanggal,
                    'jenis_pekerjaan' => $request->jenis_pekerjaan,
                    'vendor' => $request->vendor,
                ]);
            }
        }

        Alert::success('Berhasil', 'Pembayaran Berhasil Di Buat');
        return redirect('/penggajian/dashboard');
    }

    public function ubah_status_pembayaran($id){
        $data = GajiKaryawanModel::find($id);
        GajiKaryawanModel::where('id', $id)->update([
            'keterangan' => 'sudah_di_bayar'
        ]);
        Alert::success('Berhasil', 'Pembayaran Atas Nama'.' '.$data->nama_pekerja.' '. 'Berhasil');
        return redirect()->back();
    }

    public function master_orderan(){
        $data = OrderModel::all();
        return view('admin.masterdata.orderan.index', compact('data'));
    }
    
    public function destroy_orderan($id)
    {
            $data = OrderModel::find($id); 
            // dd($data);
            $data->delete();
            Alert::success('Berhasil', 'Orderan Berhasil Di Hapus');
            return redirect('/master_orderan');
    }
    public function master_akun(){
        $data = User::all();
        return view('admin.masterdata.akun.index', compact('data'));
    }
 
    public function edit_akun($id){
        $data = User::find($id);
        // dd($data);
        return view('admin.masterdata.akun.edit', compact('data'));
    }
   
    public function update_akun(Request $request, $id){
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        if ($request->has('foto')) {
            $request->file('foto')->move('foto_akun/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        Alert::success('Sukses', 'Akun Berhasil Di Edit');
        return redirect('/master_akun');
    }

    public function update_pw(Request $request, $id){
        $data = User::find($id);
        $data->password = bcrypt($request->password);
        $data->save();

        Alert::success('Sukses', 'Password Berhasil Di Ubah Menjadi' .' '. $request->password);
        return redirect('/master_akun');
    }
    
    public function add_akun(Request $request){
         $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'foto' => $request->foto,
        ]);
        if ($request->has('foto')) {
            $request->file('foto')->move('foto_akun/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        Alert::success('Sukses', 'Akun Berhasil Di Simpan');
        return redirect('/master_akun');
    }
    
    public function destroy_akun($id)
    {
            $data = User::find($id); 
            // dd($data);
            $data->delete();
            Alert::success('Berhasil', 'Akun Berhasil Di Hapus');
            return redirect('/master_akun');
    }
}
