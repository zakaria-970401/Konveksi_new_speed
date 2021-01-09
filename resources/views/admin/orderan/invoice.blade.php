@extends('layout.master')


@section('judul', 'Invoice')


@section('konten')
<div class="row">
    <div class="col-md-12">
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <img src="/assets/dist/img/AdminLTELogo.png" style="width: 190px; border-radius: 8px">
                  <small class="float-right">Tanggal: <b>{{Carbon\Carbon::now()->format('d/M/Y')}}</b></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Hormat Kami,
                <address>
                  <strong>CV. TIFA CEMERLANG ABADI</strong><br>
                  Perumahan Mutiara Gading Timur II Blok N.11 no.25<br>
                  Bekasi Timur. Tlp.26755780 -29081127<br>
                  Fax : 021- 29081127<br>
                  Email: newspeedkoneveksi@gmail.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Kepada Yth,
                <address>
                  <strong>{{$data->nama_vendor}}</strong><br>
                  {{$data->alamat}} <br>
                  {{$data->no_hp}}<br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                 Invoice No: <b>{{$no_invoice}}</b><br>
                 Nomor Pemesanan: <b>{{$data->no_po}}</b><br>
                 Pesanan a/n: <b>{{$data->pesanan_untuk}}</b><br>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">

                  <table class="table table-bordered">                                    
                    <thead>
                      <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Jenis Orderan</th>
                        <th class="text-center">QTY</th>
                        <th class="text-center">Bahan</th>
                        <th class="text-center">Warna</th>
                        <th class="text-center">Harga Satuan</th>
                        <th class="text-center">Total Harga</th>
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
                          <?php echo $bahan[$x]."<br>" ?>
                        </td>
                        <td class="text-center">
                          <?php echo $warna[$x]."<br>" ?>
                        </td>
                        <td class="text-center">
                          <?php echo "Rp.".' '.number_format($harga_satuan[$x])."<br>" ?>
                        </td>
                        <td class="text-center">
                          <?php echo "Rp.".' '.number_format($harga_satuan[$x] * $qty[$x])."<br>" ?>
                        </td>
                      </tr>
                      @endif
                      @endfor                      
                </table>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
              </div>
              <div class="col-6">
                <p class="lead"> Rincian Harga Pemesanan : <b>{{Carbon\carbon::parse($data->tgl_order)->format('d/M/Y')}}</b></p>
                <div class="table-responsive">
                  <table class="table">

                    {{-- 1 DATA --}}
                  @if($hitung_data == 2 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 2 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] @endphp                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
                  
                    {{-- 2 DATA --}}
                  @if($hitung_data == 3 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 3 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] @endphp                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
         
                    {{-- 3 DATA --}}
                  @if($hitung_data == 4 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 4 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] @endphp                      
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
               
                    {{-- 4 DATA --}}
                  @if($hitung_data == 5 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 5 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] @endphp                   
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
           
                    {{-- 5 DATA --}}
                  @if($hitung_data == 6 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 6 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] @endphp                 
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
         
                    {{-- 6 DATA --}}
                  @if($hitung_data == 7 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 7 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] @endphp               
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
        
                    {{-- 7 DATA --}}
                  @if($hitung_data == 8 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 8 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] @endphp              
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif

                    {{-- 8 DATA --}}
                  @if($hitung_data == 9 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] + $harga_satuan[7] * $qty[7] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 9 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] + $harga_satuan[7] * $qty[7] @endphp            
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif

                    {{-- 9 DATA --}}
                  @if($hitung_data == 10 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] + $harga_satuan[7] * $qty[7] + $harga_satuan[8] * $qty[8] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 10 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] + $harga_satuan[7] * $qty[7] + $harga_satuan[8] * $qty[8] @endphp          
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif

                    {{-- 10 DATA --}}
                  @if($hitung_data == 11 && $data->sistem_dp == 'YA')                        
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                          {{-- PERHITUNGAN GRAND TOTAL --}}
                        @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] + $harga_satuan[7] * $qty[7] + $harga_satuan[8] * $qty[8] + $harga_satuan[8] * $qty[8] @endphp
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                      <tr>
                      <th style="width:50%">Pembayaran DP :</th>
                      <th style="width:50%">
                        Rp. {{number_format($dp),2, '.'. '.'}}
                      </th>
                    </tr>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal - $data->dp),2, '.'. '.'}}
                      </th>
                    </tr>
                  @elseif($hitung_data == 11 && $data->sistem_dp == 'TIDAK')
                    {{-- PERHITUNGAN GRAND TOTAL --}}
                    @php $grandtotal = $harga_satuan[0] * $qty[0] + $harga_satuan[1] * $qty[1] + $harga_satuan[2] * $qty[2] + $harga_satuan[3] * $qty[3] + $harga_satuan[4] * $qty[4] + $harga_satuan[5] * $qty[5] + $harga_satuan[6] * $qty[6] + $harga_satuan[7] * $qty[7] + $harga_satuan[8] * $qty[8] + $harga_satuan[8] * $qty[8] @endphp          
                    <tr>
                      <th style="width:50%">Subtotal Pesanan :</th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    <tr>
                      <th style="width:50%">
                        Total Tagihan :
                      </th>
                      <th style="width:50%">
                        Rp. {{number_format($grandtotal),2, '.'. '.'}}
                      </th>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
        <strong> Di Transfer Ke Rekening :<br>
            Bank        : BCA Cab. Ruko Kalimas<br>
            A / N        : AMIRULLAH<br>
            A / C        : 5780-5515-87</strong><br>
              <!-- /.col -->
            </div>
            <br>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <button onclick="window.print()"rel="noopener" target="_blank" class="btn btn-info btn-xl"><i class="fas fa-print"></i> Print Invoice</button>

              </div>
            </div>
          </div>
          <!-- /.invoice -->
    </div>
</div>
<script>
  window.addEventListener("load", window.print());
</script>

@endsection
