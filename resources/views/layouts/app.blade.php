<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Manajemen Pakan Ikan')</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  {{-- Bootstrap Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Custom Styles --}}
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    nav.navbar {
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .container {
      margin-top: 30px;
    }
    footer {
      margin-top: 40px;
      padding: 15px 0;
      background: #fff;
      border-top: 1px solid #eaeaea;
      text-align: center;
      color: #777;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">🐟 Manajemen Pakan Ikan</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('penggunaan.index') }}">Penggunaan Pakan</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('pakan.index') }}">Pakan</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('kolam.index') }}">Kolam</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('panen.index') }}">Panen</a></li>
        </ul>
      </div>
    </div>
  </nav>

  {{-- Content Section --}}
  <div class="container">
    @yield('content')
  </div>

  <footer>
    &copy; {{ date('Y') }} Sistem Manajemen Pakan Ikan - Universitas Pelita Harapan
  </footer>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @yield('scripts')


</body>
</html>
