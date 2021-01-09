@extends('layout.master')

@section('judul', 'Orderan On Proses')

@section('konten')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="far fa-clipboard"> DAFTAR ORDERAN SIAP DI KIRIM</i></h3>
      </div>
      <!-- ./card-header -->
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">NO.</th>
              <th class="text-center">No. PO</th>
              <th class="text-center">Vendor</th>
              <th class="text-center">Tanggal Pemesanan</th>
              <th class="text-center">Deadline</th>
              <th class="text-center">Status</th>
              <th class="text-center">Opsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)                  
            <tr data-widget="expandable-table" aria-expanded="false">
              <td class="text-center">{{$loop->iteration}}</td>
              <td class="text-center">{{$item->no_po}}</td>
              <td class="text-center">{{$item->nama_vendor}}</td>
              <td class="text-center">{{Carbon\Carbon::parse($item->tgl_order)->format('d-M-Y')}}</td>
              <td class="text-center"><span class="badge badge-danger">{{Carbon\Carbon::parse($item->deadline)->format('d-M-Y')}}</span></td>
              <td class="text-center"><span class="badge badge-success">Menunggu Diantar</td>
          <td class="text-center">
            <a href="/lihat_orderan/detail/{{$item->id}}" class="btn btn-success btn-sm"><i class="fas fa-eye"> Detail</i></a>
            <a href="/orderan/cetak_invoice/{{$item->id}}" class="btn btn-outline-success btn-sm "><i class="fas fa-truck"> Antar & Print Invocie</i></a>
          </td>
            </tr>
            <tr class="expandable-body">
              <td colspan="5">
                <p>
                  <ul>
                    @if ($item->sistem_dp == 'YA')                        
                      <li>
                          <span>Total DP, Rp. {{number_format($item->dp),2, ',', '.'}}</span> 
                        </li>
                        @else
                        <span>Tidak Ada DP</span>   
                    @endif
                  </ul>
                </p>
            </tr>
            @endforeach
 
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>



    
@endsection