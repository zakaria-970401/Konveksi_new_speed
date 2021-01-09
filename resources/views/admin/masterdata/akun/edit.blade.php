@extends('layout.master')
@section('judul', 'Edit Halaman Akun')
@section('konten')
<div class="card">
   <div class="row">
      <div class="col-md-12">
            <form action="/master_akun/update/{{$data->id}}" method="POST" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
            <div class="card-header">
                  <h3 class="card-title">LIST DAFTAR AKUN</span></b></h3>
                  <div class="card-tools">
                    <a href="/print_akun/" class="btn btn-info btn-sm" style="border-radius: 15px"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Nama</label>
                        <div class="col-sm-11">
                        <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="name" value="{{$data->name}}">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">E-mail</label>
                        <div class="col-sm-11">
                        <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="email" value="{{$data->email}}">
                        </div>
                  </div>
                  <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Password</label>
                        <div class="col-sm-11">
                        <input type="password" class="form-control" placeholder="Silahkan Di isi.." name="password" value="{{$data->password}}">
                        </div>
                  </div>
                  <hr>
                  <div class="form-group">
                        <img class="profile-user-img img-fluid img-circle"
                        src="{{asset('foto_akun/'.$data->foto)}}"
                        alt="User profile picture">
                  </div>
                  <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-1 col-form-label">Foto</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control" placeholder="Silahkan Di isi.." name="foto">
                        <span class="text-danger">*JPEG,PNG</span>
                        </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                  <a href="#update_pw" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fas fa-cogs"> Ubah Password</i></a>
                  </div>
                  <hr>
                  <a href="javascript:window.history.go(-1);" class="btn btn-outline-dark btn-sm" style="border-radius: 15px"><i class="fa fa-arrow-left"> Kembali</i></a>  
                  <button type="submit" class="btn btn-success btn-sm" style="border-radius: 13px"><i class="fas fa-save"> Update</i></button>
                </div>
              </form>
            </div>
      </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="update_pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Ubah Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/master_akun/update_pw/{{$data->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')      
          <div class="modal-body">
                <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Masukan Password Baru.." name="password">
                              </div>
                        </div>         
                  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="border-radius: 13px" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="border-radius: 13px"><i class="fas fa-save"> Update</i></button>
                  </div>
            </form>
         </div>
      </div>
   </div>
  </div>
  </div>


    
@endsection