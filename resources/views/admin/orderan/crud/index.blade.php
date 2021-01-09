@extends('layout.master')

@section('judul', 'Input Orderan')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header bg-info">
              <h3 class="card-title">FORM INPUT ORDERAN</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="/input_orderan" method="POST">
                {{ csrf_field() }}   
                <input type="text" class="form-control" value="{{$tanggal}}" name="tgl_order" hidden>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NO.PO Terakhir</label>
                        <div class="col-sm-10">
                          @if($po_terakhir != NULL)
                          <input type="text" class="form-control" value="{{$po_terakhir->no_po}}" disabled>
                          @else
                          Belum Ada
                          @endif
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NO.PO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="no_po">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Vendor</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="nama_vendor">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No. HP</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" placeholder="Silahkan Di isi.." name="no_hp">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="alamat">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pesanan Untuk</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="pesanan_untuk">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">SISTEM DP</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="sistem_dp" name="sistem_dp">
                                <option selected="selected" disabled>Silahkan Pilih..</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                              </select>                        
                            </div>
                         </div>
                      <div class="form-group row" id="total_dp">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">TOTAL DP</label>
                        <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Masukan Nominal DP.." name="dp">
                              </div>                       
                         </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Deadline Pengerjaan</label>
                        <div class="col-sm-10">
                              <input type="date" class="form-control" placeholder="Masukan Tanggal.." name="deadline">
                            </div>                       
                        </div>
                      <hr>

                    </div>
                    </div>
                    <h4 class="text-center">Detail Orderan</h4>
                    <div class="kolom_asli">
                      <div class="row mt-4">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Orderan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Masukan Detail Orderan.." name="jenis_orderan[]">
                                <span class="text-danger">*Seragam Kotak-kotak</span>
                                </div>
                              </div> 
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Bahan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Masukan Detail Bahan.." name="bahan[]">
                                </div>
                              </div> 
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-1 col-form-label">Warna</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Masukan Detail Warna.." name="warna[]">
                                </div>
                              </div> 
                              <div div class="form-group row" id="harga">
                                <label for="" class="col-sm-1 col-form-label">Harga Satuan</label>
                                  <div class="col-sm-10">
                                   <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga_satuan[]">
                                </div>
                              </div>
                              <div class="form-group row" id="qty1">
                                <label for="" class="col-sm-1 col-form-label">QTY</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" placeholder="Satuan Pcs.." name="qty[]">
                                </div>
                                <h4>Pcs</h4>
                              </div> 
                              <div class="form-group" id="catatan1">
                                <label>Catatan</label>
                                <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]">
                                <span class="text-danger">*Baju= L:10, M:5, Celana= 27:1, 32:15 </span>
                              </div>
                            </div>
                           </div>
                           
                         <a href="javascript:void(0)" class="btn btn-info btn-xl BtnTambah"><i class="fa fa-plus"> Tambah</a></i>
                         <hr>
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
                            
                            <a href="javascript:void(0)" class="btn btn-danger btn-xl" id="BtnHapus"><i class="fa fa-trash"> Hapus</a></i>
                            <hr>
                          </div>
                          <hr>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Pembelanjaan Bahan</label>
                                    <select class="form-control" name="pembelanjaan_bahan">
                                      <option>Silahkan Pilih..</option>
                                      <option value="eceran">Eceran</option>
                                      <option value="roll">Roll/Gulungan</option>
                                    </select>
                                  </div> 
                                  <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Rp.</label>
                                    <div class="col-sm-6">
                                      <input type="number" class="form-control" placeholder="Masukan Harga.." name="harga">
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <h4 class="text-center"><strong><u>HPP</u></strong></h4>
                                <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label">CMT</label>
                                  <div class="col-sm-6">
                                    <input type="number" class="form-control" placeholder="Masukan Harga.." name="hpp_cmt">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label">Bordir</label>
                                  <div class="col-sm-6">
                                    <input type="number" class="form-control" placeholder="Masukan Harga.." name="hpp_bordir">
                                  </div>
                                </div>
                              </div>
                            </div>                          
                        <div class="row">
                          <div class="col-md-6">
                            
                          </div>
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block btn-xl"><i class="fa fa-calculator"> Hitung Orderan</i></button>                           
                          </div>
                        </div>
                      </form>
                     </div>




    
@endsection