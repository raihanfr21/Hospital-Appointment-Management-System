<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Janji Temu Dokter</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tambah_janji.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lihat_janji.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="header-left">
        <div class="logo">
            <img src="{{ asset('assets/logo umri png.png') }}" alt="Logo Rumah Sakit">
        </div>
        <p>Rumah Sakit Universitas Muhammadiyah Riau</p>
    </div>

    <nav>
        <a href="{{ route('dashboard.patient') }}">Dashboard</a>
        <a href="{{ route('appointments.create') }}">Buat Janji Temu</a>
        <a href="{{ route('appointments.index') }}">Lihat Janji Temu</a>
        <a href="{{ route('logout') }}" style="color: #e53e3e;">Logout</a>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-content">
        <div class="footer-section brand-section">
            <div class="footer-logo">
                <img src="{{ asset('assets/logo umri png.png') }}" alt="Logo Footer">
            </div>
            
            <h3>RS Universitas Muhammadiyah Riau</h3>
            <p>Memberikan pelayanan kesehatan islami, profesional, dan terpercaya untuk masyarakat Riau.</p>
        </div>

        <div class="footer-section">
            <h3>Hubungi Kami</h3>
            <p>Jl. Tuanku Tambusai, Pekanbaru, Riau</p>
            <p>Telp: (0761) 123456</p>
            <p>Email: info@rs.umri.ac.id</p>
        </div>

        <div class="footer-section">
            <h3>Media Sosial</h3>
            <div class="social-links">
                <a href="#">Website Resmi</a>
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2024 Rumah Sakit Universitas Muhammadiyah Riau. All rights reserved.</p>
    </div>
</footer>

</body>
</html>