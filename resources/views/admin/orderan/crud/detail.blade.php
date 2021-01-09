@extends('layout.master')

@section('judul', 'Detail Orderan')

@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header bg-info">
              <h3 class="card-title">FORM DETAIL ORDERAN</h3>
              <div class="card-tools">
                <a href="javascript:window.history.go(-1);" class="btn btn-warning btn-sm" style="border-radius: 15px"><i class="fa fa-arrow-left"> Kembali</i></a>  
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <h4 class="text-center">Detail Vendor</h4>
            <hr>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No.PO</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control text-center" value="{{$data->no_po}}" name="no_po" disabled>
                        </div>
                      </div>        
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Vendor</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value="{{$data->nama_vendor}}" name="nama_vendor" disabled>
                        </div>
                      </div> 
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">NO.HP</label>
                            <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{$data->no_hp}}" id="no_hp" disabled>
                                  </div>                       
                               </div>
                            </div>
                           <div class="col-md-6">
                              <div class="form-group row mt-1">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" value="{{$data->alamat}}" id="alamat" disabled>
                                    </div>                       
                                </div>
                              <div class="form-group row mt-4">
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">Pesanan</label>
                                     <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{$data->pesanan_untuk}}" id="pesanan_untuk" disabled>
                                      </div>                       
                                  </div>
                              </div>
                          </div>
                        <hr>
                        <h4 class="text-center">TOTAL DP</h4>
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Rp.</label>
                              @if ($data->dp == NULL)
                                 <div class="col-sm-10">
                                   <input type="text" class="form-control bg-warning" value="Tidak Ada DP" id="jumlah_dp" disabled>
                                   @else     
                                  <div class="col-sm-10">
                                   <input type="text" class="form-control bg-warning" value="{{number_format($data->dp),2, '.'.'.'}}" id="jumlah_dp" disabled>
                                    @endif
                                  </div>                       
                                </div>
                              </div>
                          </div>
                          <hr>
                          <h4 class="text-center">DEADLINE PENGERJAAN</h4>
                          <div class="col-md-12">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Deadline </label>
                                 <div class="col-sm-10">
                                   <input type="text" class="form-control bg-danger" value="{{Carbon\carbon::parse($data->deadline)->format('d-M-Y')}}" id="dealine" disabled>
                                  </div>                       
                                </div>
                              </div>
                          </div>
                        <hr>
                        <h4 class="text-center">Detail Orderan</h4>
                        <div class="row">
                          <div class="col-md-12">
                              <div class="card">
                                  <div class="card-header">
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">

                                    @if ($hitung_data == 2)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <tr>
                                          <th class="text-center bg-dark">Jenis Orderan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="text-center">
                                            {{$jenis_orderan[0]}}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            <input type="hidden" name="qty[]" value="{{$qty[0]}}">{{$qty[0]}} Pcs
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            Rp. {{number_format($harga_satuan[0]),2, '.'.'.'}}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            <strong> Subtotal </strong> 
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">
                                            <strong> Rp. {{$jumlah1}} </strong> 
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group" id="catatan1">
                                          <label>Catatan</label>
                                          <input type="text" class="form-control" placeholder="Masukan Catatan.." name="catatan[]" value="{{$catatan[0]}}" readonly>
                                        </div>
                                      </div>
                                    </div>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Jumlah HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Jumlah Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor1),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp1),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp1),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor1),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <input type="text" hidden value="{{$profit_value1}}">
                                        <th scope="col">Rp. {{number_format($profit_value1),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit1),2, '.'.'.'}}</strong></h4></th>
                                        <input type="text" hidden value="{{$total_profit1}}">
                                      </tr>
                                    </thead>
                                    @endif

                                    {{-- 2 DATA ORDERAN--}}
                                    @if ($hitung_data == 3)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1 + $x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <input type="hidden" name="qty[]" value="{{$qty[$x]}}"> <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                        </tr>
                                        @endif
                                        @endfor
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor2),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp2),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp2),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor2),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value2),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit2),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif

                                    {{-- 3 DATA ORDERAN--}}
                                    @if ($hitung_data == 4)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1 + $x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                        </tr>
                                        @endif
                                        @endfor
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor3),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp3),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp3),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor3),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value3),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit3),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif

                                    {{-- 4 DATA ORDERAN--}}
                                    @if ($hitung_data == 5)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1 +$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor4),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp4),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp4),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor4),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value4),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit4),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif
                            
                                    {{-- 5 DATA ORDERAN--}}
                                    @if ($hitung_data == 6)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1+$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor5),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp5),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp5),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor5),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value5),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit5),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif
           
                                    {{-- 6 DATA ORDERAN--}}
                                    @if ($hitung_data == 7)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1+$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor6),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp6),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp6),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor6),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value6),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit6),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif
                     
                                    {{-- 7 DATA ORDERAN--}}
                                    @if ($hitung_data == 8)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1+$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor7),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp7),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp7),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor7),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value7),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit7),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif

                                    {{-- 8 DATA ORDERAN--}}
                                    @if ($hitung_data == 9)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1+$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor8),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp8),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp8),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor8),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value8),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit8),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif

                                    {{-- 9 DATA ORDERAN--}}
                                    @if ($hitung_data == 10)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1+$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor9),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp9),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp9),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor9),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value9),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit9),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif

                                    {{-- 10 DATA ORDERAN--}}
                                    @if ($hitung_data == 11)                                        
                                    <table class="table table-bordered">                                    
                                      <thead>
                                        <th class="text-center bg-dark" colspan="7">Detail Orderan</th>
                                        <tr>
                                          <th class="text-center bg-info">No.</th>
                                          <th class="text-center bg-info">Jenis Orderan</th>
                                          <th class="text-center bg-info">QTY</th>
                                          <th class="text-center bg-info">Harga Satuan</th>
                                          <th class="text-center bg-info">Bahan</th>
                                          <th class="text-center bg-info">Warna</th>
                                          <th class="text-center bg-info">Catatan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @for($x = 0; $x < count($jenis_orderan); $x++)
                                        @if(!empty($jenis_orderan[$x]))
                                        <tr>
                                          <td class="text-center">
                                            <?php echo 1+$x."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $jenis_orderan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $qty[$x].' '.' PCS'."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $bahan[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $warna[$x]."<br>" ?>
                                          </td>
                                          <td class="text-center">
                                            <?php echo $catatan[$x]."<br>" ?>
                                          </td>
                                          @endif
                                          @endfor
                                        </tr>
                                      </tbody>
                                    </table>
                                 </div>
                              <hr>
                          <div id="rincian_biaya">
                          <h4 class="text-center">RINCIAN BIAYA</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th class="text-center">Jenis Bahan</th>
                                            <th class="text-center">HPP Bahan</th>
                                            <th class="text-center">HPP CMT</th>
                                            <th class="text-center">HPP Bordir</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="text-center">{{$data->pembelanjaan_bahan}}</td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bahan),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_cmt),2, '.'.'.'}}
                                            </td>
                                            <td class="text-center">
                                            Rp. {{number_format($data->hpp_bordir),2, '.'.'.'}}
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total HPP
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. {{number_format($total_hpp),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" class="text-center bg-dark">
                                              Total Vendor
                                            </td>
                                            <td colspan="" class="text-center">
                                              <strong>
                                                Rp. 
                                                  {{number_format($total_vendor10),2, '.'.'.'}}
                                               </strong>
                                            </td>
                                            <tr>
                                              <td colspan="3" class="text-center bg-dark">
                                                Subtotal
                                              </td>
                                              <td class="text-center">
                                                 <strong>
                                                  Rp. 
                                                    {{number_format($subtotal_vendor_hpp10),2, '.'.'.'}}
                                                 </strong>
                                              </td>
                                            </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <h4 class="text-center">RINCIAN OMSET</h4>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th scope="col">Total HPP</th>
                                        <th scope="col">Rp. {{number_format($omset_hpp10),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Total Vendor</th>
                                        <th scope="col">Rp. {{number_format($total_vendor10),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col">Profit Value</th>
                                        <th scope="col">Rp. {{number_format($profit_value10),2, '.'.'.'}}</th>
                                      </tr>
                                      <tr>
                                        <th scope="col" class="text-center bg-success"><h3> SUBTOTAL PROFIT</h3></th>
                                        <th scope="col" class="bg-success"><strong><h4>Rp. {{number_format($total_profit10),2, '.'.'.'}}</strong></h4></th>
                                      </tr>
                                    </thead>
                                    @endif
                                </table>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                              </div>
                              <div class="col-md-3">
                              </div>
                              <div class="col-md-3">
                                <a href="#modal_edit" data-toggle="modal" class="btn btn-outline-info"><i class="fas fa-edit"> Edit</i></a>
                                <a href="/lihat_orderan" class="btn btn-outline-success"><i class="fas fa-check"> Oke</i></a>
                              </div>
                          </div>
                          <br>
                      </div>
                  

              <!-- Modal -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Konfirmasi Edit Data??</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a href="/edit_orderan/{{$data->id}}" class="btn btn-outline-success"><i class="fas fa-edit"> Ya, Edit</i></a>
            </div>
          </div>
        </div>
      </div>

@endsection