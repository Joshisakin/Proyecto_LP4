<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Panel de Administración</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom styles -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* Sidebar */
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
            color: #fff;
            transition: all 0.3s;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
        }

        .sidebar.collapsed {
            margin-left: -250px;
        }

        .sidebar .sidebar-brand {
            padding: 1.5rem 1rem;
            font-size: 1.2rem;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: .05rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .sidebar .nav-link {
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,.8);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,.1);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.2);
        }

        .sidebar .nav-link i {
            margin-right: 1rem;
            width: 1.25rem;
            text-align: center;
        }

        /* Main Content */
        .main {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
            background-color: #f8f9fc;
        }

        .main.expanded {
            margin-left: -250px;
        }

        /* Topbar */
        .topbar {
            background-color: #fff;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
            height: 70px;
        }

        .topbar .nav-item .nav-link {
            position: relative;
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }

        .topbar-divider {
            width: 0;
            border-right: 1px solid #e3e6f0;
            height: 2rem;
            margin: auto 1rem;
        }

        /* Cards */
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .35rem;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
        }

        .card-header:first-child {
            border-radius: calc(.35rem - 1px) calc(.35rem - 1px) 0 0;
        }

        /* Tables */
        .table {
            margin-bottom: 0;
        }

        .table > :not(caption) > * > * {
            padding: 1rem;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #e3e6f0;
            font-weight: 700;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            background-color: #f8f9fc;
        }

        /* Buttons */
        .btn-primary {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #2653d4;
            border-color: #244ec9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main {
                margin-left: 0;
            }
            .main.active {
                margin-left: 250px;
            }
        }

        /* Utilities */
        .shadow {
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
        }

        .rounded-circle {
            border-radius: 50%!important;
        }

        .dropdown-menu {
            font-size: .85rem;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: .5rem 1rem;
        }

        .dropdown-item i {
            margin-right: .5rem;
            width: 1rem;
            text-align: center;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-ship"></i>
                <span>AmazonRiver</span>
            </div>
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.rutas.*') ? 'active' : '' }}" href="{{ route('admin.rutas.index') }}">
                            <i class="fas fa-route"></i>
                            <span>Rutas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}" href="{{ route('admin.reservations.index') }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Reservaciones</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-cog"></i>
                            <span>Configuración</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Begin Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom scripts -->
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggleTop').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main').classList.toggle('expanded');
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>

    @stack('scripts')
</body>
</html>
