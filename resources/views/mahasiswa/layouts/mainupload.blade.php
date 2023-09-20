<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FormWizard_v9</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">


    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">

    <!-- DATE-PICKER -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/pengajuan/date-picker/css/datepicker.min.css') }}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/pengajuan/style.css') }}">
</head>

<body>

    <!-- Body -->
    @include('sweetalert::alert')
    @yield('content')

    <script src="{{ asset('assets/js/pengajuan/jquery-3.3.1.min.js') }}"></script>

    <!-- JQUERY STEP -->
    <script src="{{ asset('assets/js/pengajuan/jquery.steps.js') }}"></script>

    <!-- DATE-PICKER -->
    <script src="{{ asset('assets/vendor/pengajuan/date-picker/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/pengajuan/date-picker/js/datepicker.en.js') }}"></script>

    <script src="{{ asset('assets/js/pengajuan/main.js') }}"></script>

    <!-- Template created and distributed by Colorlib -->
</body>

</html>