@extends('layout.master')

@section('judul', 'Edit Pesanan')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header bg-info">
              <h3 class="card-title">FORM EDIT PESANAN</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form action="/edit_orderan/{{$data->id}}" method="POST">
                @method('PATCH')
                @csrf
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NO.PO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="no_po" value="{{$data->no_po}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                        <div class="col-sm-10">
                         <input type="date" class="form-control" placeholder="Silahkan Di isi.." name="tanggal" value="{{$data->tgl_order}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Vendor</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="nama_vendor" value="{{$data->nama_vendor}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No. HP</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="no_hp" value="{{$data->no_hp}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="alamat" value="{{$data->alamat}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pesanan Untuk</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="pesanan_untuk" value="{{$data->pesanan_untuk}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">SISTEM DP</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="sistem_dp" name="sistem_dp">
                                <option value="{{$data->sistem_dp}}">{{$data->sistem_dp}}</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                              </select>                        
                            </div>
                         </div>
                         <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Deadline Pengerjaan</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" placeholder="Masukan Tanggal.." name="deadline" value="{{$data->deadline}}"
                           >
                            </div>                       
                        </div>
                         <h4 class="text-center">TOTAL DP</h4>
                         <div class="row">
                             <div class="col-md-12">
                               <div class="form-group row">
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Rp.</label>
                                 @if ($data->dp != NULL)
                                 <div class="col-sm-10">
                                  <input type="number" class="form-control" value="{{($data->dp)}}" id="jumlah_dp" name="dp">
                                  @else     
                                    <div class="col-sm-10">
                                      <input type="number" class="form-control" value="0" id="jumlah_dp" name="dp">
                                       @endif
                                     </div>                       
                                   </div>
                                 </div>
                             </div>
                             <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Status Orderan</label>
                              <div class="col-sm-10">
                                  <select class="form-control" id="status" name="status">
                                      @if ($data->status == 0)
                                      <option value="{{$data->status}}">Belum Di Produksi</option>                                         
                                      @elseif ($data->status == 1)
                                      <option value="{{$data->status}}">Proses Produksi</option>
                                      @elseif ($data->status == 2)
                                      <option value="{{$data->status}}">Siap Dikirim</option>
                                      @elseif ($data->status == 3)
                                      <option value="{{$data->status}}">Selesai</option>
                                      @endif
                                      <option value="0">Belum Di Produksi</option>
                                      <option value="1">Proses Produksi</option>
                                      <option value="2">Siap Dikirim</option>
                                      <option value="3">Selesai</option>
                                    </select>                        
                                  </div>
                               </div> 
                          </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                          <h4 class="text-center"><b>Detail Orderan</b></h4>
                        </div>
                          
                          @if ($hitung_data == 2)
                      <hr>
                      <div class="kolom_asli">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[0]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[0]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[0]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[0]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[0]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[0]}}">
                                </div>  
                            @endif

                          @if ($hitung_data == 3)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor

                        </div>
                        @endif

                        @if ($hitung_data == 4)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                        @endif

                        @if ($hitung_data == 5)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif
        
                        @if ($hitung_data == 6)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif
        
                        @if ($hitung_data == 7)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif
               
                        @if ($hitung_data == 8)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif

                          @if ($hitung_data == 9)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif

                          @if ($hitung_data == 10)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif

                          @if ($hitung_data == 11)
                          <hr>
                          <div class="kolom_asli">
                            <div class="row">
                          @for($x = 0; $x < count($jenis_orderan); $x++)
                          @if(!empty($jenis_orderan[$x]))
                          <div class="col-md-6">
                            <h4 class="text-center"><span class="badge badge-pill badge-warning">Item {{$jenis_orderan[$x]}} </span></h4>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Orderan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]" value="{{$jenis_orderan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Bahan</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]" value="{{$bahan[$x]}}">
                                  </div>
                                </div> 
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Warna</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]" value="{{$warna[$x]}}">
                                  </div>
                                </div> 
                                <div div class="form-group row" id="harga">
                                  <label for="" class="col-sm-2 col-form-label">Harga Satuan</label>
                                    <div class="col-sm-10">
                                     <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]" value="{{$harga_satuan[$x]}}">
                                  </div>
                                </div>
                                <div class="form-group row" id="qty1">
                                  <label for="" class="col-sm-2 col-form-label">QTY</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]" value="{{$qty[$x]}}">
                                  </div>
                                  <h4>Pcs</h4>
                                </div> 
                                <div class="form-group" id="catatan1">
                                  <label>Catatan</label>
                                  <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[$x]}}">
                                </div>
                                <hr>
                              </div>
                              @endif
                              @endfor
                            </div>
                        
                          </div>
                          @endif

                    <hr>
                    

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Pembelanjaan Bahan</label>
                                    <select class="form-control" name="pembelanjaan_bahan" value="{{$data->pembelanjaan_bahan}}">
                                      <option value="{{$data->pembelanjaan_bahan}}">{{$data->pembelanjaan_bahan}}</option>
                                      <option value="Eceran">Eceran</option>
                                      <option value="Roll/Gulungan">Roll/Gulungan</option>
                                    </select>
                                  </div> 
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Rp.</label>
                                    <div class="col-sm-6">
                                      <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga" value="{{$data->harga}}">
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <h4 class="text-center"><strong><u>HPP</u></strong></h4>
                                <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label">CMT</label>
                                  <div class="col-sm-6">
                                    <input type="number" class="form-control" placeholder="Masukan Harga.." name="hpp_cmt" value="{{$data->hpp_cmt}}">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label">Bordir</label>
                                  <div class="col-sm-6">
                                    <input type="number" class="form-control" placeholder="Masukan Harga.." name="hpp_bordir" value="{{$data->hpp_bordir}}">
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                                                        {{-- BATASAN --}}
                                                        <div class="kolom_copy" style="display: none">
                                                          <div class="col-md-12">
                                                            <h4 class="text-center"><b>Form Tambah Orderan</b></h4>
                                                          </div>
                                                          <div class="col-md-12">
                                                            <div class="form-group row">
                                                              <label for="inputEmail3" class="col-sm-1 col-form-label">Jenis Orderan</label>
                                                              <div class="col-sm-10">
                                                                <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]">
                                                                <span class="text-danger">*Seragam Kotak-kotak</span>
                                                                  </div>
                                                               </div> 
                                                               <div class="form-group row" id="bahan">
                                                                <label for="inputEmail3" class="col-sm-1 col-form-label">Bahan</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]">
                                                                    </div>
                                                                  </div> 
                                                              <div class="form-group row" id="warna">
                                                                <label for="inputEmail3" class="col-sm-1 col-form-label">Warna</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]">
                                                                    </div>
                                                                  </div> 
                                                              <div div class="form-group row" id="harga2">
                                                                <label for="" class="col-sm-1 col-form-label">Harga Satuan</label>
                                                                  <div class="col-sm-106">
                                                                   <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]">
                                                              </div>
                                                          </div> 
                                                          <div class="form-group row" id="qty2">
                                                            <label for="" class="col-sm-1 col-form-label">QTY</label>
                                                            <div class="col-sm-8">
                                                              <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]">
                                                            </div>
                                                            <h4>Pcs</h4>
                                                          </div> 
                                                          <div class="form-group" id="catatan2">
                                                            <label>Catatan</label>
                                                            <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]">
                                                            <span class="text-danger">*Baju= L:10, M:5, Celana= 27:1, 32:15 </span>
                                                          </div>
                                                        </div>
                                                        </div>
                            
                        <div class="row">
                          <div class="col-md-6">
                          </div>
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block btn-xl" style="border-radius: 15px"><i class="fa fa-save"> Update Orderan</i></button>                           
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  </div>
              </div>


@endsection