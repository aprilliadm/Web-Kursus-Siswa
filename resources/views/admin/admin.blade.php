@extends('admin.layout.template')

@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>INPUT</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Input</a></li>
        <li class="breadcrumb-item active">Admin</li>
      </ol>
    </div>
  </div>
</div><!-- /.container-fluid -->
</section>

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Admin</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-success btn-sm float-right" onclick="tambahData()">
                  <i class="fa-solid fa-plus"></i>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="data_admin">
                  <thead>
                  <tr>
                    <th style="width: 10%;">No.</th>
                    <th style="width: 25%;">Username</th>
                    <th style="width: 50%;">Name</th>
                    <th style="width: 15%;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    {{-- @if ($admin->count() > 0)
                      @foreach ($admin as $i => $a)
                      <tr>
                        <td class="text-center">{{++$i}}</td>
                        <td>{{$a->username}}</td>
                        <td></td>
                        <td class="d-flex justify-content-around">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailAdmin">
                            <i class="fa-solid fa-circle-info"></i>
                          </button>
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAdminModal">
                            <i class="fa-solid fa-pen-to-square"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAdminModal">
                            <i class="fa-solid fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      @endforeach
                    @else
                      <tr><td colspan="6" class="text-center">No matching records found</td></tr>
                    @endif --}}
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div> 
  </div>
</section>
<!-- /.content -->

  <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdminModal-label"><strong>Tambah Admin</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-message"></div>
        <form id="AdminForm-add" method="POST" action="{{ url('admin/input-admin') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <div class="image-preview img-fluid rounded img-thumbnail">
                  <img id="photo-preview-add" src="{{ asset('storage/file/img/default/foto.png') }}" alt="Foto Profile">
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-add" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
                @error('name')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-add" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
                @error('email')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="foto">Foto Profile</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="photo-add" name="foto" accept="image/*" onchange="previewPhotoCreate()" style="padding: 0; height: 100%;">
                @error('foto')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>              
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" form="AdminForm-add"><i class="fa-solid fa-save"></i></button>
      </div>
    </div>
  </div>
</div>
                       
<div class="modal fade" id="detailAdmin" tabindex="-1" role="dialog" aria-labelledby="detailAdminLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailAdminLabel"><strong>Detail Admin</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="image-preview">
              <img id="show_foto" src="" alt="" class="img-fluid rounded img-thumbnail">
            </div>
          </div>
          <div class="col-md-8">
            <label><strong>Username</strong></label>
            <p id="show_username"></p>
            <label><strong>Name</strong></label>
            <p id="show_name"></p>
            <label><strong>Email</strong></label>
            <p id="show_email"></p> 
            <label><strong>User</strong></label>
            <p id="show_level_user"></p> 
          </div>                                
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAdminModal-label"><strong>Edit Admin </strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-message"></div>
        <form id="AdminForm-edit" method="POST" action="{{ url('admin/input-admin') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <div class="image-preview img-fluid rounded img-thumbnail">
                  <img id="photo-preview-edit" src="" alt="">
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username-edit" name="username" value="" placeholder="Masukkan Username">
                @error('username')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-edit" name="name" value="" placeholder="Masukkan Nama">
                @error('name')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-edit" name="email" value="" placeholder="Masukkan Email">
                @error('email')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password-edit" name="password" placeholder="Kosongkan Jika Tidak Ingin Merubah Password">
                @error('password')
                  <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="foto">Foto Profile</label>
                  <input type="file" class="form-control @error('foto') is-invalid @enderror" id="photo-edit" name="foto" accept="image/*" onchange="previewPhotoEdit()" style="padding: 0; height: 100%;">
                  @error('foto')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" form="AdminForm-edit"><i class="fa-solid fa-save"></i></button>
      </div>
    </div>                              
  </div>
</div>   

<div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminModal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteAdminModal-label"><strong>Hapus Admin </strong></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row form-message"></div>
            <form id="AdminForm-delete" method="POST" action="{{ url('admin/input-admin') }}" enctype="multipart/form-data">
              @csrf
              @method('DELETE')
              <p>Anda yakin ingin menghapus admin <strong><span id="show_nama"></span></strong> ?</p>
            </form>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-sm" form="AdminForm-delete"><i class="fa-solid fa-trash"></i></button>
          </div>
      </div>
  </div>
</div>      

@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function tambahData() {
        $('#addAdminModal').modal('show');

        $('#photo-preview-add').attr('src', '{{ asset('storage/file/img/default/foto.png') }}');
        $('#addAdminModal #name-add').val('');
        $('#addAdminModal #email-add').val('');
        $('#addAdminModal #photo-add').val('');
    }

    function updateData(th){
        $('#editAdminModal').modal('show');
        
        $('#photo-preview-edit').attr('src', '{{ asset('storage/') }}' + '/' + $(th).data('foto'));
        $('#photo-preview-edit').attr('alt', $(th).data('name'));
        $('#editAdminModal #username-edit').val($(th).data('username'));
        $('#editAdminModal #name-edit').val($(th).data('name'));
        $('#editAdminModal #email-edit').val($(th).data('email'));
        $('#editAdminModal #password-edit').val('');
        $('#editAdminModal #photo-edit').val('');
        $('#editAdminModal #AdminForm-edit').attr('action', $(th).data('url'));
        $('#editAdminModal #AdminForm-edit').append('<input type="hidden" name="_method" value="PUT">');
    }

        function showData(element) {
        $.ajax({
            url: '{{  url('admin/input-admin') }}' + '/' + element,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#detailAdmin').modal('show');

                $('#show_username').text(data.username);
                $('#show_name').text(data.name);
                $('#show_email').text(data.email);
                if (data.level_user === 0) {
                    $('#show_level_user').text('Admin');
                } else {
                    $('#show_level_user').text(data.level_user);
                }
                $('#show_foto').attr('src', '{{ asset('storage/') }}' + '/' + data.foto);
                $('#$show_foto').attr('alt', data.name);
            },
            error: function () {
                alert('Error occurred while retrieving data.');
            }
        });
    }

    function deleteData(th) {
        $('#deleteAdminModal').modal('show');
        $('#show_nama').text($(th).data('name'));
        $('#deleteAdminModal #AdminForm-delete').attr('action', $(th).data('url'));
    }

    $(document).ready(function (){
        var dataAdmin = $('#data_admin').DataTable({
            processing:true,
            serverSide:true,
            stateSave: true,
            ajax:{
                'url': '{{  url('admin/data-admin') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns:[
                {data:'nomor', name:'nomor', searchable:false, sortable:false},
                {data:'username',name:'username', sortable: false, searchable: true},
                {data:'name',name:'name', sortable: false, searchable: true},
                {data:'id',name:'id', sortable: false, searchable: false,
                render: function(data, type, row, meta) {
                    var btn = `<div class="d-flex justify-content-around">` +
                        `<button href="{{ url('/admin/input-admin/') }}/` + data + `" onclick="showData(` + data + `)" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa-solid fa-circle-info"></i></button>` +
                        `<button data-url="{{ url('/admin/input-admin/') }}/` + data + `" class="btn btn-info btn-sm" data-toggle="modal" onclick="updateData(this)" data-id="` + row.id + `" data-username="` + row.username + `" data-name="` + row.name + `" data-email="` + row.email + `" data-foto="` + row.foto + `" data-level_user="` + row.level_user + `"><i class="fa-solid fa-pen-to-square"></i></button>` +
                        `<button data-url="{{ url('/admin/input-admin/') }}/` + data + `" class="btn btn-danger btn-sm" data-toggle="modal" onclick="deleteData(this)" data-id="` + row.id + `" data-name="` + row.name + `"><i class="fa-solid fa-trash"></i></button>` +
                        `</div>`;
                    return btn;
                }
                },

            ]
        });

        $('#AdminForm-add').submit(function(e) {
            e.preventDefault();
            
            var formData = new FormData(this);  // Membuat objek FormData untuk mengirim data form, termasuk file
            
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: formData,  // Mengirimkan objek FormData sebagai data
                dataType: 'json',
                processData: false,  // Menonaktifkan pemrosesan data
                contentType: false,  // Menonaktifkan pengaturan tipe konten otomatis
                
                success: function(data) {
                    if (data.status) {
                      toastr.success(data.message);
                      $('#AdminForm-add')[0].reset();
                      dataAdmin.draw(false); // Reload tabel sesuai dengan halaman pagination yang sedang aktif
                      $('#AdminForm-add').attr('action');
                      $('#photo-preview-add').attr('src', '{{ asset('storage/file/img/default/foto.png') }}');
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        });

        $('#AdminForm-edit').submit(function(e) {
          e.preventDefault();

          var form = $(this);
          var formData = new FormData(form[0]);

          $.ajax({
              url: form.attr('action'),
              method: "POST",
              data: formData,
              dataType: 'json',
              processData: false,
              contentType: false,
              success: function(data) {
                  if (data.status) {
                    toastr.success(data.message);
                    dataAdmin.draw(false);
                    $('#AdminForm-edit').attr('action');
                  } else {
                      toastr.error(data.message);
                  }
              }
            });
        });

        $('#AdminForm-delete').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                      toastr.success(data.message);
                      dataAdmin.draw(false); // Reload tabel sesuai dengan halaman pagination yang sedang aktif
                      $('#AdminForm-delete').attr('action');
                      $('#deleteAdminModal').modal('hide');
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        });
    });
</script>
@endpush