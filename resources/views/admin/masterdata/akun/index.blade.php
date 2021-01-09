@extends('layout.master')
@section('judul', 'Master Akun')

@section('konten')
<div class="card">
  <div class="row">
      <div class="col-md-12">
            <div class="card-header">
                  <h3 class="card-title">LIST DAFTAR AKUN</span></b></h3>
                  <div class="card-tools">
                    <a href="#tambah_akun" data-toggle="modal" class="btn btn-warning btn-sm" style="border-radius: 15px"><i class="fas fa-plus"></i> Tambah Akun</a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <table id="mytable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Foto</th>
                      <th class="text-center">Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $item)                
                    <tr>
                      <td class="text-center">{{$loop->iteration}}</td>
                      <td class="text-center">{{$item->name}}</td>
                      <td class="text-center">{{$item->email}}</td>
                      <td class="text-center">
                        <img class="profile-user-img img-fluid img-circle" style="width: 65px"
                              src="{{asset('foto_akun/'.$item->foto)}}">
                      </td>
                      <td class="text-center">
                        <a href="/master_akun/edit/{{$item->id}}" class="btn btn-info btn-sm"><i class="fas fa-edit"> Edit</i></a>
                        <a href="/master_akun/hapus_akun/{{$item->id}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"> Hapus</i></a>
                      </td>
                    </tr>
                    @endforeach
                    </tfoot>
                  </table>
                </div>
            </div>
      </div>
    </div>

      <!-- Modal -->
      <div class="modal fade" id="tambah_akun" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content modal-md">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Akun</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/master_akun/add" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="modal-body">
                  <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="name">
                                </div>
                          </div>
                          <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Silahkan Di isi.." name="email">
                                </div>
                          </div>
                          <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                <input type="file" class="form-control" placeholder="Silahkan Di isi.." name="foto">
                                <span class="text-danger">*JPEG,PNG</span>
                                </div>
                          </div>
                    <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" style="border-radius: 13px" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success" style="border-radius: 13px"><i class="fas fa-save"> Simpan</i></button>
                    </div>
              </form>
           </div>
        </div>
     </div>
  </div>
  </div>

 
@endsection
