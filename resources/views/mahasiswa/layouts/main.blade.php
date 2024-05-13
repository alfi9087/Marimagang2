<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="MariMagang">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Mari Magang</title>

    <!-- File Boostrap -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/landingpage/bootstrap/css/bootstrap.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- File CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">

    <style>
        .card-title.text-center {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .log-list {
            list-style-type: none;
            padding: 0;
            overflow-y: auto;
            max-height: 300px;
        }

        .log-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .log-item:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .steps-section {
            padding: 50px 0;
            background-color: #f9f9f9;
            text-align: center;
        }

        .steps-wrapper {
            background-color: #ffffff;
            padding: 20px 20px 0px 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .step-box {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .step {
            flex: 0 0 calc(25% - 40px);
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 5px solid #DC143C;
            border-radius: 50% 0px 50% 10px;
            position: relative;
        }

        .step-number {
            font-size: 30px;
            font-weight: bold;
            color: #DC143C;
            margin-bottom: 10px;
        }

        .step-content h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #DC143C;
            font-weight: bold;
        }

        .step-content p {
            font-size: 14px;
            color: #DC143C;
        }

        .step-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .step-nav button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 40px;
            color: #DC143C;
        }

        .step-nav button:hover {
            color: #000;
        }

        .step-nav-right {
            right: -50px;
        }

        .step-nav-left {
            left: -50px;
        }
    </style>

</head>

<body>

    <!-- Header -->
    @include('mahasiswa.layouts.header')

    <!-- Body -->
    @include('sweetalert::alert')
    @yield('content')

    <!-- Footer -->
    @include('mahasiswa.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/landingpage/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/landingpage/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox.js') }}"></script>
    <script src="{{ asset('assets/js/tabs.js') }}"></script>
    <script src="{{ asset('assets/js/video.js') }}"></script>
    <script src="{{ asset('assets/js/slick-slider.js') }}"></script>
    <script src="{{ asset('assets/js/custompage.js') }}"></script>

    <script>
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }
        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
            e.preventDefault();
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>

    <!-- JS Untuk Preview Foto (Tambah Profil) -->
    <script>
        function preview(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarPreview = document.getElementById("add");
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- JS Untuk Preview Foto -->
    <script>
        function previewFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#photo-preview').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#foto').change(function() {
            previewFoto(this);
        });
    </script>

    <script>
        function showNextSteps() {
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'none';
            document.getElementById('step4').style.display = 'none';
            document.getElementById('step5').style.display = 'block';
            document.getElementById('step6').style.display = 'block';
            document.getElementById('step7').style.display = 'block';
            document.getElementById('step8').style.display = 'block';
        }

        function showPreviousSteps() {
            document.getElementById('step1').style.display = 'block';
            document.getElementById('step2').style.display = 'block';
            document.getElementById('step3').style.display = 'block';
            document.getElementById('step4').style.display = 'block';
            document.getElementById('step5').style.display = 'none';
            document.getElementById('step6').style.display = 'none';
            document.getElementById('step7').style.display = 'none';
            document.getElementById('step8').style.display = 'none';
        }
    </script>

</body>

</body>

</html>