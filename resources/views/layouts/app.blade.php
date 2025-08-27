<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Suhu Monitoring')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS (Animate on Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

</head>
<body>

<!-- Navbar -->
    {{-- NAVBAR UMUM (navigasi) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-navigasi sticky-top py-2">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="mainNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link fw-semibold text-white" href="#">HOME</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold text-white" href="iot">DEVICE MONITOR</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold text-white" href="suhu-monitor">SUHU MONITOR</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" data-bs-toggle="dropdown">MORE</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">LOG-IN</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



<!-- Konten -->
@yield('content')

<!-- footer -->
    <footer>
        <div class="footer" >
            <div class="container" data-aos="fade-up" data-aos-delay="200">
                <div class="row">
                    <div class="col-md-4">
                        <div class="infoma">
                            <h3>Contact Us</h3>
                            <ul class="conta">
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> Information Technology</li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i> +62 857 xxx xxx</li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i>
                                    <a href="javascript:void(0)">admin@gxxxx.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<footer class="text-center py-4 bg-dark text-white mt-5">
    <p>&copy; 2022 - {{ date('Y') }} All Rights Reserved. Design by Rio Khairul</p>
</footer>

<!-- js files -->
    <!-- Bootstrap Bundle (dengan Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom kategori-card -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @stack('scripts')
    @yield('scripts')
</script>
</body>
</html>
