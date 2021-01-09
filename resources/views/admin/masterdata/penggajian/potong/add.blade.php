@extends('layout.master')

@section('judul', 'Halaman Penggajian Karyawan')

@section('konten')
<div class="row">
      <div class="col-md-12">
            <div class="card">
                  <div class="card-header bg-dark">
                        Pembayaran Gaji Karyawan 
                  </div>
                  <div class="card-body">
                    <form action="/penggajian/add_potong" method="POST">
                       {{ csrf_field() }} 
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{$tanggal}}" name="tanggal" readonly>
                        </div>
                      </div>
                      <hr>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="vendor" name="vendor">
                                    <option selected="selected" disabled>Silahkan Pilih..</option>
                                    @foreach ($vendor as $item)
                                    <option value="{{$item->nama_vendor}}">{{$item->nama_vendor}}</option>
                                    @endforeach
                              </select>                        
                            </div>
                          </div>
                          <div class="kolom_asli">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
                              <div class="col-sm-9">
                                  <select class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan">
                                      <option value="Potong" selected readonly>Potong</option>
                                    </select>                        
                                  </div>
                               </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="deskripsi[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">QTY</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" placeholder="Pcs.." name="qty_barang[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pekerja</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="nama_pekerja[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Jasa</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" placeholder="Silahkan Di isi.." name="harga_jasa[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">QTY Jasa</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" placeholder="Pcs.." name="qty_pekerjaan[]">
                                    </div>
                                  </div>
                              <div class="form-group row">
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="keterangan[]">
                                      <option selected="selected" disabled>Silahkan Pilih..</option>
                                      <option value="sudah_di_bayar">Sudah Dibayar</option>
                                      <option value="belum_di_bayar">Belum Dibayar</option>
                                    </select>                        
                                  </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-9">
                                    <a href="#" class="btn btn-success btn-sm BtnTambah"><i class="fas fa-plus"> Tambah</i></a>
                              </div>
                            </div>
                        </div>

                        <hr>

                              <div class="kolom_copy" style="display: none">
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="deskripsi[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">QTY</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" placeholder="Pcs.." name="qty_barang[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pekerja</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="nama_pekerja[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Jasa</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" placeholder="Silahkan Di isi.." name="harga_jasa[]">
                                    </div>
                                  </div>
                               <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">QTY Jasa</label>
                                    <div class="col-sm-9">
                                      <input type="number" class="form-control" placeholder="Pcs.." name="qty_pekerjaan[]">
                                    </div>
                                  </div>
                              <div class="form-group row">
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                    <select class="form-control" name="keterangan[]">
                                      <option selected="selected" disabled>Silahkan Pilih..</option>
                                      <option value="sudah_di_bayar">Sudah Dibayar</option>
                                      <option value="belum_di_bayar">Belum Dibayar</option>
                                    </select>                        
                                  </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-9">
                                    <a href="#" class="btn btn-danger btn-sm" id="BtnHapus"><i class="fas fa-trash"> Hapus</i></a>
                              </div>
                              </div>
                        </div>

                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                                <a href="javascript:window.history.go(-1);" class="btn btn-outline-dark btn-sm" style="border-radius: 15px"><i class="fa fa-arrow-left"> Kembali</i></a>  
                          </div>
                          <div class="col-md-4">
                          </div>
                          <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-block btn-xl" style="border-radius: 15px"><i class="fa fa-save"> Simpan</i></button>                           
                          </div>
                        </div>
                      </form>
                  </div>
                </div>



@endsection