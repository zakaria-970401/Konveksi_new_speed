@extends('layout.master')


@section('judul', 'Halaman Utama')

@section('konten')
<div class="row">
    <div class="col-md-2 col-6">
      <div class="small-box bg-dark">
          <div class="inner">
            <?php 
            use App\OrderModel;
            use App\StokModel; 
              $hitung_orderan = OrderModel::select('no_po')->count();
              $belum_produksi = OrderModel::where('status', 0)->count();
              $proses_produksi = OrderModel::where('status', 1)->count();
              $siap_dikirim = OrderModel::where('status', 2)->count();
              $selesai_dikirim = OrderModel::where('status', 3)->count();
              $stok = StokModel::select('nama_loker')->count();

              ?>
            <h3>{{$hitung_orderan}}</h3>
              <p>Orderan</p>
         </div>
          <div class="icon">
            <i class="fas fa-cart-plus"></i>
        </div>
         <a href="/lihat_orderan" class="small-box-footer"> Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
     </div>
    <div class="col-md-2 col-6">
      <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$belum_produksi}}</h3>
              <p>Belum Diproses </p>
         </div>
          <div class="icon">
            <i class="fas fa-clock"></i>
        </div>
         <a href="/orderan/belum_proses" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
     </div>
    <div class="col-md-2 col-6">
      <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$proses_produksi}}</h3>
              <p>Proses Produksi </p>
         </div>
          <div class="icon">
            <i class="	fas fa-cut"></i>
        </div>
         <a href="/on_proses" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
     </div>
    <div class="col-md-2 col-6">
      <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$siap_dikirim}}</h3>
              <p>Siap Dikirim </p>
         </div>
          <div class="icon">
            <i class="fas fa-truck"></i>
        </div>
         <a href="/siap_kirim" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
     </div>
    <div class="col-md-2 col-6">
      <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$selesai_dikirim}}</h3>
              <p>Selesai Dikirim</p>
         </div>
          <div class="icon">
            <i class="fas fa-check"></i>
        </div>
         <a href="/orderan_selesai" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
     </div>
    <div class="col-md-2 col-6">
      <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{$stok}}</h3>
              <p>Stok Barang</p>
         </div>
          <div class="icon">
            <i class="fas fa-clipboard-list"></i>
        </div>
         <a href="/master_stok" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
     </div>
  </div>


    
@endsection