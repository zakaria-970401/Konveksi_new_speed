@extends('layout.master')
@section('judul', 'Halaman Profile')

@section('konten')
      <div class="row">
            <div class="col-md-6">
   <!-- Profile Image -->
   <div class="card card-primary">
      <div class="card-header">
            <h3 class="card-title">Informasi Profile</h3>
          </div>
   <div class="card card-primary">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"
               src="{{asset('foto_akun/'.Auth::user()->foto)}}"
               alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Nama Akun</b> <a class="float-right">{{Auth::user()->name}}</a>
          </li>
          <li class="list-group-item">
            <b>E-mail</b> <a class="float-right">{{Auth::user()->email}}</a>
          </li>
        </ul>

        <a href="#modal_edit" data-toggle="modal" class="btn btn-primary btn-block"><i class="far fa-edit"><b> Edit Akun</i></b></a>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            </div>
      </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-md">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Akun</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/update_profile/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')      
          <div class="modal-body">
                <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                              <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="name" value="{{Auth::user()->name}}">
                              </div>
                        </div>
                        <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
                              <div class="col-sm-10">
                              <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="email" value="{{Auth::user()->email}}">
                              </div>
                        </div>
                        <div class="form-group row">
                              <img class="profile-user-img img-fluid img-circle"
                              src="{{asset('foto_akun/'.Auth::user()->foto)}}"
                              alt="User profile picture">
                        </div>
                        <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">Foto</label>
                              <div class="col-sm-10">
                              <input type="file" class="form-control" placeholder="Silahkan Di isi.." name="foto">
                              <span class="text-danger">*JPEG,PNG</span>
                              </div>
                        </div>
                        <div class="form-group row">
                              <div class="col-sm-10">
                              <a href="#ubah_pw" data-toggle="modal" class="btn btn-warning btn-sm"><i class="fas fa-cogs"> Ubah Password</i  ></a>
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

    <!-- Modal -->
    <div class="modal fade" id="ubah_pw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Akun</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/update_profile/update_pw/{{Auth::user()->id}}" method="POST" enctype="multipart/form-data">
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