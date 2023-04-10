<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Student Portal</title>
   <!-- favicon -->
  <link rel="shortcut icon" href="" type="image/x-icon">
  <!-- bootstrap 5-->
  <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">
  <!-- custom css -->
  <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
  @stack('website-css')
</head>

<body>

  <!-- website content -->
    @yield('website-content')
  <!-- close website content -->

  <!-- bootstrap js -->
  <script src="{{ asset('website/js/bootstrap.bundle.min.js') }}"></script>
  <!-- jquery -->
  <script src="{{ asset('website/js/jquery.min.js') }}"></script>
  <!-- jquery validation-->
  <script src="{{ asset('website/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('website/js/additional-method.js') }}"></script>
  <!-- script js -->
  <script src="{{ asset('website/js/script.js') }}"></script>
  <!-- font awsome 6-->
  <script src="{{ asset('website/js/all.min.js') }}"></script>
  <!-- jquery validate js -->
  @stack('website-js')

</body>
</html>
