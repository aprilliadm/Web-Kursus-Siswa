<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LBB | Bina Kusuma</title>
  <link rel="icon" href="{{ asset('storage/file/img/default/logo_lbb.png') }}" sizes="32x32" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    .btn-warning {
      color: #ffffff!important;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-warning p-3">
    <div class="card-header text-center">
      <!--<a href="{{ url('/') }}">
        <img src="{{ asset('storage/file/img/default/logo_lbb.png') }}" sizes="45x45" alt="Logo" style="cursor: pointer;">
      </a> -->     
    </div>
    <div class="card-body">
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input name="username" type="text" class="form-control" placeholder="Username" required>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-warning btn-block">Login</button>
        <div class="text-center mt-2" style="opacity: 0.75;">
          <small>Masukkan Username dan Password (Menggunakan username & password)</small>
        </div>
      </form>
    </div>    
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@if ($errors->any())
  <script>
    toastr.error('Username dan Password yang kamu masukkan SALAH');
  </script>
@endif
</body>
</html>