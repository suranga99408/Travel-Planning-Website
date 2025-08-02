<div class="card shadow-sm mb-4">
    <div class="card-body">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('user.dashboard') }}" class="nav-link active">Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('user.dashboard.profile') }}" class="nav-link">Edit Profile</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{ route('bookings.index') }}">
                  <i class="fas fa-calendar-check me-1"></i> My Bookings
               </a>
              </li>
              <li class="nav-item">
    <a class="nav-link" href="{{ route('vehicle-bookings.history') }}">
        <i class="bi bi-car-front me-1"></i> My Vehicle Bookings
    </a>
</li>


<li class="nav-item">
    <a class="nav-link" href="{{ route('hotel-bookings.index') }}">
        <i class="bi bi-building"></i> My Hotel Bookings
    </a>
</li>
            <li class="nav-item mb-2">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>