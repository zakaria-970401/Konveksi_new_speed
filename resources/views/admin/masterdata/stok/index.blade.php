@extends('layout.master')

@section('judul', 'Master Data Stok Barang')

@section('konten')
<div class="container">
<div class="row">
      <div class="col-sm-4 mt-2 mb-2">
            <button type="button" class="btn btn-info btn-xl" data-toggle="modal" data-target="#tambah_data"><i class="fas fa-plus">
                  Tambah Stok Barang
                  </i>
            </button>
      </div>
</div>
</div>  
<div class="card">
      <div class="card-header">
        <h3 class="card-title">MASTER DATA STOK BARANG </h3>
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
            <th class="text-center">Nama Loker</th>
            <th class="text-center">Nama Vendor</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Warna</th>
            <th class="text-center">Bahan</th>
            <th class="text-center">Size</th>
            <th class="text-center">Update Terakhir</th>
            <th class="text-center" style="width: 15%">Opsi</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)                
          <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-center">{{$item->nama_loker}}</td>
            <td class="text-center">{{$item->nama_vendor}}</td>
            <td class="text-center">{{$item->nama_barang}}</td>
            <td class="text-center"><?php echo $item->qty." "."Pcs"?></td>
            <td class="text-center">{{$item->warna}}</td>
            <td class="text-center">{{$item->bahan}}</td>
            <td class="text-center">{{$item->size}}</td>
            <td class="text-center">{{Carbon\Carbon::parse($item->tgl_pemeriksaan)->format('d-M-Y')}}</td>
            <td class="text-center">
              <a href="/edit_stok/{{$item->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
              <a href="/hapus_stok/{{$item->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
     
    <!-- Modal -->
<div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
                  <div class="col-md-12">
                      <div class="card card-default">
                          <div class="card-header bg-info">
                            <h3 class="card-title">FORM INPUT MASTER DATA STOK BARANG</h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <form action="/input_master_stok" method="POST">
                              {{ csrf_field() }}   
                              <input type="text" class="form-control" value="{{$tanggal}}" name="tgl_pemeriksaan" hidden>
                              <div class="kolom_asli">
                                <div class="row">
                                      <div class="col-md-12">
                                            <div class="form-group row">
                                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Loker</label>
                                                  <div class="col-sm-10">
                                                  <select class="form-control select2" name="nama_loker[]">
                                                        <option selected="selected" disabled>Silahkan Pilih..</option>
                                                        @foreach ($loker as $item)                                    
                                                        <option value="{{$item->nama_loker}}">{{$item->nama_loker}}</option>
                                                        @endforeach
                                                        </select>                        
                                                  </div>
                                                  </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                  <div class="col-md-6">
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Vendor</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Nama Vendor.." name="nama_vendor[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Barang</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Nama Barang.." name="nama_barang[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">QTY</label>
                                                        <div class="col-sm-10">
                                                        <input type="number" class="form-control" placeholder="Pcs .." name="qty[]">
                                                        </div>
                                                  </div>
                                            </div>
                                            <div class="col-md-6">
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Silahkan Di isi .." name="warna[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Silahkan Di isi .." name="bahan[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Size</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Silahkan Di isi .." name="size[]">
                                                        </div>
                                                  </div>
                                            </div>
                                      </div>
                                </div>
                              
                          {{-- BATAS --}}
                          <hr>
                          <div class="kolom_copy" style="display: none;">
                                <hr>
                                <center><span class="badge badge-pill badge-warning"><h5>Form Tambah Barang</h5></span>
                                <hr>
                                <div class="row">
                                      <div class="col-md-12">
                                            <div class="form-group row">
                                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Loker</label>
                                                  <div class="col-sm-10">
                                                  <select class="form-control" name="nama_loker[]">
                                                        <option selected="selected">Silahkan Pilih..</option>
                                                        @foreach ($loker as $item)                                    
                                                        <option value="{{$item->nama_loker}}">{{$item->nama_loker}}</option>
                                                        @endforeach
                                                        </select>                        
                                                  </div>
                                                  </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                  <div class="col-md-6">
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Vendor</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Nama Vendor.." name="nama_vendor[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Barang</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Nama Barang.." name="nama_barang[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">QTY</label>
                                                        <div class="col-sm-10">
                                                        <input type="number" class="form-control" placeholder="Pcs .." name="qty[]">
                                                        </div>
                                                  </div>
                                            </div>
                                            <div class="col-md-6">
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Silahkan Di isi .." name="warna[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Silahkan Di isi .." name="bahan[]">
                                                        </div>
                                                  </div>
                                                  <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Size</label>
                                                        <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Silahkan Di isi .." name="size[]">
                                                        </div>
                                                  </div>
                                            </div>
                                      </div>
                                      <a href="javascript:void(0)" class="btn btn-danger btn-xl" id="BtnHapus"><i class="fa fa-trash"> Hapus</a></i>
                                       <hr>
                                </div>             
                                       <a href="javascript:void(0)" class="btn btn-info btn-xl BtnTambah"><i class="fa fa-plus"> Tambah</a></i>
                                       <hr>          
                                      </div>       
                                   </div>       
                                </div>       
                          </div>  
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" style="border-radius: 15px" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success btn-xl" style="border-radius: 15px"><i class="fa fa-save"> Simpan</i></button>
                        </div>
                  </form>
                </div>
            </div>
      </div>
@endsection