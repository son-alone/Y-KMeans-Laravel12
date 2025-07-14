<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Aplikasi Pemeriksaan Persyaratan Yudisium LLDIKTI Wilayah II</title>

  <!-- Google Fonts: Poppins & Nunito -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #6c63ff;
      --secondary-color: #3f3da1;
      --accent-color: #2b2a82;
      --light-bg: #f9f9f9;
      --text-color: #333;
    }
    body {
      font-family: 'Poppins', 'Nunito', sans-serif;
      background: var(--light-bg);
      color: var(--text-color);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    /* HERO SECTION */
    .hero {
      min-height: 100vh;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 20px;
      color: #fff;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.25rem;
      margin-bottom: 30px;
      max-width: 600px;
    }

    .btn-cta {
      background-color: #fff;
      color: var(--secondary-color);
      padding: 12px 40px;
      border: none;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-cta:hover {
      background-color: var(--accent-color);
      color: #fff;
      transform: scale(1.05);
    }

    /* FEATURE CARDS */
    .feature-card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background-color: #fff;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .feature-card i {
      font-size: 3rem;
      color: var(--primary-color);
      margin-bottom: 15px;
    }

    /* CONTRIBUTORS */
    .contributors img {
      border-radius: 50%;
      border: 4px solid #fff;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contributors img:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* FOOTER */
    footer {
      background: var(--secondary-color);
      color: #fff;
      text-align: center;
      padding: 30px 20px;
    }

    /* INSTALL BANNER */
    #installBanner {
      display: none;
      position: fixed;
      bottom: 20px;
      left: 20px;
      z-index: 9999;
      background-color: #fff;
      border-radius: 10px;
      padding: 10px 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      border: 2px solid var(--primary-color);
    }

    #installBanner button {
      margin-left: 10px;
    }
  </style>
</head>
<body>

  <!-- INSTALL BANNER -->
  <div id="installBanner">
    <span>Install this app?</span>
    <button id="btnInstall" class="btn btn-sm btn-primary">Install</button>
    <button id="btnCloseInstall" class="btn btn-sm btn-secondary">Close</button>
  </div>

  <!-- HERO SECTION -->
  <section class="hero">
    <h1 class="animate__animated animate__fadeInDown">SIKSPEK Yudisium</h1>
    <p class="animate__animated animate__fadeInUp">
      Sistem Pemeriksaan Persyaratan Kelulusan Yudisium
    </p>
    <a href="{{ route('login') }}" class="btn btn-cta animate__animated animate__zoomIn">Login</a>
    <p></p>
    <a href="{{ route('register') }}" class="btn btn-cta animate__animated animate__zoomIn">Register</a>
  </section>

  <!-- FEATURES SECTION -->
  <section class="section bg-light" id="features">
    <div class="container">
      <h2 class="section-title text-center" data-aos="fade-up">Features</h2>
      <div class="row g-4">
        <!-- Feature Cards -->
        <!-- ... -->
      </div>
    </div>
  </section>

  <!-- CONTRIBUTORS SECTION -->
  <section class="section" id="contributors">
    <div class="container">
      <h2 class="section-title text-center" data-aos="fade-up">Contributors</h2>
      <div class="row justify-content-center g-4 contributors">
        @php
          $contributors = [
            ['name' => 'M. Husaini Hasyim', 'img' => 'https://github.com/son-alone.png', 'link' => 'https://github.com/son-alone'],
            // (daftar lengkap contributor)
          ];
        @endphp

        @foreach($contributors as $index => $contributor)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center" data-aos="flip-up" data-aos-delay="{{ $index * 50 }}">
          <a href="{{ $contributor['link'] }}" target="_blank" class="text-decoration-none text-dark">
            <img src="{{ $contributor['img'] }}" alt="{{ $contributor['name'] }}" class="img-fluid mb-2" width="100" height="100">
            <h6>{{ $contributor['name'] }}</h6>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <p class="mb-1">&copy; {{ date('Y') }} laravel 12 Modern. All Rights Reserved.</p>
      <p class="mb-0">Contributors: Muhammad Husaini Hasyim and LLDIKTI 2 Division of Information System Development Interns.</p>
    </div>
  </footer>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, duration: 800 });

    let deferredPrompt;
    const installBanner = document.getElementById('installBanner');
    const btnInstall = document.getElementById('btnInstall');
    const btnClose = document.getElementById('btnCloseInstall');

    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      deferredPrompt = e;
      installBanner.style.display = 'block';
    });

    btnInstall.addEventListener('click', () => {
      if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then(() => {
          installBanner.style.display = 'none';
          deferredPrompt = null;
        });
      }
    });

    btnClose.addEventListener('click', () => {
      installBanner.style.display = 'none';
    });
  </script>
</body>
</html>
