<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/pengajuan.css') }}">

    <!-- Form Wizard -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <style>
        .scrolling-container {
            max-height: 400px;
            /* Atur tinggi maksimum sesuai kebutuhan Anda */
            overflow-y: scroll;
            /* Aktifkan penggulungan vertikal */
            padding-right: 15px;
            /* Tambahkan padding kanan untuk ruang penggulungan */
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .upload-box:hover {
            background-color: #f5f5f5;
        }

        .pdf-icon {
            color: #e74c3c;
            /* Warna PDF */
            font-size: 36px;
        }

        .remove-file {
            color: red;
            cursor: pointer;
        }

        /* Gaya lainnya sesuai kebutuhan Anda */
    </style>
</head>

<body>
    <!-- Header -->
    @include('mahasiswa.layouts.headerupload')

    <!-- Body -->
    @include('sweetalert::alert')
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/pengajuan.js') }}"></script>

    <!-- JS Form Wizard -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        const leftBox = document.getElementById('left-box');
        const rightBox = document.getElementById('right-box');
        const proposalInfo = document.getElementById('proposal-info');
        const pengantarInfo = document.getElementById('pengantar-info');

        leftBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            leftBox.style.border = '2px dashed #007bff';
        });

        leftBox.addEventListener('dragleave', () => {
            leftBox.style.border = '2px dashed #ccc';
        });

        leftBox.addEventListener('drop', (e) => {
            e.preventDefault();
            leftBox.style.border = '2px dashed #ccc';
            const file = e.dataTransfer.files[0];
            handleUploadedFile(file, proposalInfo, 'proposal');
        });

        rightBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            rightBox.style.border = '2px dashed #007bff';
        });

        rightBox.addEventListener('dragleave', () => {
            rightBox.style.border = '2px dashed #ccc';
        });

        rightBox.addEventListener('drop', (e) => {
            e.preventDefault();
            rightBox.style.border = '2px dashed #ccc';
            const file = e.dataTransfer.files[0];
            handleUploadedFile(file, pengantarInfo, 'pengantar');
        });

        // Trigger file input when the box is clicked
        leftBox.addEventListener('click', () => {
            document.getElementById('proposal').click();
        });

        rightBox.addEventListener('click', () => {
            document.getElementById('pengantar').click();
        });

        function handleUploadedFile(file, infoContainer, type) {
            if (file.type === 'application/pdf') {
                infoContainer.innerHTML = `<p><i class="fas fa-file-pdf pdf-icon"></i> ${file.name} <span class="remove-file" onclick="removeFile('${type}')">×</span></p>`;
            } else {
                infoContainer.innerHTML = '<p>File Harus Berformat PDF.</p>';
            }
        }

        function removeFile(type) {
            const infoContainer = document.getElementById(type + '-info');
            infoContainer.innerHTML = '';
            const fileInput = document.getElementById(type);
            fileInput.value = ''; // Reset the input element
        }

        // Handle file selection through file input
        document.getElementById('proposal').addEventListener('change', function(e) {
            const file = e.target.files[0];
            handleUploadedFile(file, proposalInfo, 'proposal');
        });

        document.getElementById('pengantar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            handleUploadedFile(file, pengantarInfo, 'pengantar');
        });
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>

</html>