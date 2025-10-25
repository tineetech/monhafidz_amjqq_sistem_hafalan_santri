<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name' . ' - Login', 'MONHAFIDZ AMJQQ - Login') }}</title>

    
    <!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ url('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ url('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ url('assets/dist/css/AdminLTE.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ url('assets/plugins/iCheck/square/blue.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
  
  @yield('content')
    
  <!-- jQuery 3 -->
<script src="{{ url('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('assets/plugins/iCheck/icheck.min.js') }}"></script>


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>