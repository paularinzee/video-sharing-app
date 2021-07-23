<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Log in | {{config('app.site_name')}}</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{url('vendor/adminlte/css/AdminLTE.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{url('vendor/plugins/iCheck/square/blue.css')}}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"> <a href="#">{{config('app.site_name')}} <b>Admin</b></a> </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in</p>
    <form action="" method="post">
      {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Email address">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span> </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span> </div>
      @if ($errors->any())
      <div class="form-group">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {!! implode('', $errors->all('
          <li>:message</li>
          ')) !!} </div>
      </div>
      @endif
      
      @if(session('success'))
      <div class="form-group">
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{session('success')}} </div>
      </div>
      @endif
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember">
              Remember Me </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 2.2.3 --> 
<script src="{{url('vendor/plugins/jQuery/jquery-2.2.3.min.js')}}"></script> 
<!-- Bootstrap 3.3.6 --> 
<script src="{{url('vendor/bootstrap/js/bootstrap.min.js')}}"></script> 
<!-- iCheck --> 
<script src="{{url('vendor/plugins/iCheck/icheck.min.js')}}"></script> 
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
