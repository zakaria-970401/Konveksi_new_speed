@extends('layout.master')
@section('judul', 'List Pembayaran Gaji')
@section('konten')
    
<div class="card">
      <div class="card-header">
        <h3 class="card-title">DAFTAR KARYAWAN YANG BELUM DIBAYAR </h3>
        <div class="card-tools">
          <a href="javascript:window.history.go(-1);" class="btn btn-outline-dark btn-sm" style="border-radius: 15px"><i class="fa fa-arrow-left"> Kembali</i></a>
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="mytable" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Nama Vendor</th>
            <th class="text-center">Nama Pekerja</th>
            <th class="text-center">Target</th>
            <th class="text-center">Penyelesaian</th>
            <th class="text-center" style="width: 10%">Harga Jasa</th>
            <th class="text-center" style="width: 10%">Total</th>
            <th class="text-center">Update Terakhir</th>
            <th class="text-center" style="width: 15%">Ubah Status</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)                
          <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$item->vendor}}</td>
            <td class="text-center">{{$item->nama_pekerja}}</td>
            <td class="text-center"><?php echo $item->qty_barang." "."Pcs"?></td>
            <td class="text-center"><?php echo $item->qty_pekerjaan." "."Pcs"?></td>
            <td class="text-center"><?php echo "Rp.".' '.number_format($item->harga_jasa)?></td>
            <td class="text-center"><?php echo "Rp.".' '.number_format($item->total)?></td>
            <td class="text-center">{{Carbon\Carbon::parse($item->tgl_pemeriksaan)->format('d-M-Y')}}</td>
            <td class="text-center">
              <a href="/penggajian/ubah_status_pembayaran/{{$item->id}}" class="btn btn-success btn-sm"><i class="fas fa-check"> Sudah Dibayar</i></a>
            </td>
          </tr>
          @endforeach
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
    
@endsection