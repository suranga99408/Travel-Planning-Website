<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} Admin</title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9fc; 
        }

        /* Navbar */
        .main-header.navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-nav .nav-link {
            color: #333;
        }

        .navbar-nav .nav-link:hover {
            color: #2ECC71;
        }

        /* Sidebar */
        .main-sidebar {
            background-color: #ffffff;
            border-right: 1px solid #e0e0e0;
        }

        .brand-link {
            text-align: center;
            padding: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #2C3E50 !important;
            border-bottom: 1px solid #eee;
        }

        .nav-sidebar .nav-link.active,
        .nav-sidebar .nav-link:hover {
            background-color: #DFF9FB;
            color: #2C3E50 !important;
            border-left: 3px solid #3498DB;
        }

        .nav-icon {
            color: #3498DB;
        }

        /* Content Wrapper */
        .content-wrapper {
            background-color: #f9f9fc;
            padding-top: 20px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Tables */
        .table-hover tbody tr:hover {
            background-color: #F1F2F6;
        }

        /* Buttons */
        .btn-success {
            background-color: #2ECC71;
            border: none;
            border-radius: 30px;
        }

        .btn-success:hover {
            background-color: #27AE60;
        }

        .btn-primary {
            background-color: #3498DB;
            border: none;
            border-radius: 30px;
        }

        .btn-primary:hover {
            background-color: #2980B9;
        }

        /* Footer */
        .main-footer {
            background-color: #fff;
            border-top: 1px solid #eee;
            color: #aaa;
            font-size: 0.9rem;
            text-align: center;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Scrollbars */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .brand-text {
                display: none;
            }
        }

    </style>

    <!-- Optional: Load custom styles -->
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper fade-in-up">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-globe"></i> View Site
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-2">
            <a href="#" class="brand-link text-center">
                <span class="brand-text font-weight-bold text-dark">
                    Gamanak Admin
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-4">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.plans.index') }}" class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>Plans</p>
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.hotels.index') }}" class="nav-link {{ request()->routeIs('admin.hotels.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-hotel"></i>
                                <p>Hotels</p>
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.vehicles.index') }}" class="nav-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-car-side"></i>
                                <p>Vehicles</p>
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-shopping-bag"></i>
                                <p>Store Products</p>
                            </a>
                        </li>

                        <li class="nav-item mb-2">
    <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-ticket-alt"></i>
        <p>User Bookings</p>
    </a>
</li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">@yield('header')</h1>
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <strong>&copy; {{ date('Y') }} {{ config('app.name') }}.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> 

    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>