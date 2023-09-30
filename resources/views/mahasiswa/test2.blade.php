<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BootstrapDash Wizard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="{{ asset('assets/css/pengajuan.css') }}">
    
    <!-- Multi Select -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        input[type="month"]::before {
            content: attr(placeholder) !important;
            color: #aaa;
            width: 100%;
        }

        input[type="month"]:focus::before,
        input[type="month"]:active::before {
            content: "";
            width: 0%;
        }

        input[type="date"]::before {
            content: attr(placeholder) !important;
            color: #aaa;
            width: 100%;
        }

        input[type="date"]:focus::before,
        input[type="date"]:active::before {
            content: "";
            width: 0%;
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('mahasiswa.layouts.headerupload')

    <!-- Body -->
    @include('sweetalert::alert')
    @yield('content')

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/pengajuan.js') }}"></script>

    <!-- Multi Select -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".js-example-placeholder-multiple").select2({
                placeholder: "Pilih Skill"
            });
        });
    </script>
</body>

</html>