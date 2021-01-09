@extends('layout.master')
@section('judul', 'Halaman Stok Barang')

@section('konten')

<div class="card">
      <div class="card-header bg-dark">
            <center><h3 class="card-title">LIST LOKER STOK BARANG </h3></center>
      </div>
<div class="row ml-2 mt-4 mr-2">
      @foreach ($join as $item)          
      <div class="col-sm-3 col-sm-2">
            @if ($item->id_loker == 'L1')
            <div class="small-box bg-warning">
              @endif
            @if ($item->id_loker == 'L2')
            <div class="small-box bg-info">
              @endif
            @if ($item->id_loker == 'L3')
            <div class="small-box bg-dark">
              @endif
            @if ($item->id_loker == 'L4')
            <div class="small-box bg-danger">
              @endif
            @if ($item->id_loker == 'L5')
            <div class="small-box bg-primary">
              @endiF
            <div class="inner">
                  <h3>{{$item->nama_loker}}</h3>
                  <p>{{$item->nama_vendor}}</p>
              <p>{{$item->nama_barang}}, {{$item->size}}, {{$item->warna}}, {{$item->qty}} Pcs</p>
           </div>
            <div class="icon">
              <i class="fas fas fa-boxes"></i>
          </div>
           <a href="/show_stok/{{$item->id}}" class="small-box-footer"> Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
       </div>
      @endforeach
    </div>
</div>


@endsection