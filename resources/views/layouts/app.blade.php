<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Planner - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Travel Planner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plans.index') }}">Travel Plans</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="hotelsDropdown" role="button" data-bs-toggle="dropdown">
                            Hotels
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=Room only">Room only</a></li>
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=Bed & Breakfast">Bed & Breakfast</a></li>
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=Half Board">Half Board</a></li>
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?type=All Inclusive">All Inclusive</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?category=Honeymoon">Honeymoon</a></li>
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?category=Family">Family</a></li>
                            <li><a class="dropdown-item" href="{{ route('hotels.index') }}?category=Business">Business</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="vehiclesDropdown" role="button" data-bs-toggle="dropdown">
                            Rent Vehicles
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=Car">Cars</a></li>
                            <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=SUV">SUVs</a></li>
                            <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=Van">Vans</a></li>
                            <li><a class="dropdown-item" href="{{ route('vehicles.index') }}?type=Bike">Bikes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('products.index') }}">Store</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('cart.index') }}">
        Cart 
        @if(count(session('cart', [])) > 0)
            <span class="badge bg-primary">{{ array_sum(array_column(session('cart'), 'quantity')) }}</span>
        @endif
    </a>
</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                              
                                @if(auth()->check())
                           <a href="{{ route('user.dashboard') }}" class="nav-link">
                                  <i class="fas fa-user-circle"></i>Dashboard</a>
                                     @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Travel Planner</h5>
                    <p>Your perfect travel companion for planning amazing trips.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li><a href="{{ route('plans.index') }}" class="text-white">Travel Plans</a></li>
                        <li><a href="{{ route('about') }}" class="text-white">About Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@travelplanner.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; {{ date('Y') }} Travel Planner. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>