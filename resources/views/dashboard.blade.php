<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dark User Dashboard</title>
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <!-- Font Awesome -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet"
  />
  <style>
    body {
      background-color: #0f0f10;
      color: #e0e0e0;
      font-family: 'Segoe UI', sans-serif;
    }
    .sidebar {
      background-color: #1a1a1d;
      padding: 1rem;
      height: 100vh;
    }
    .sidebar a {
      color: #c5c6c7;
      display: block;
      padding: 0.75rem 1rem;
      margin-bottom: 0.5rem;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
      background-color: #29292c;
      color: #00ffe7;
    }
    .main-content {
      padding: 2rem;
    }
    .card-dark {
      background-color: #1f1f22;
      border: 1px solid #2c2c2e;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }
    .btn-custom {
      background-color: #00ffe7;
      color: #111;
      border: none;
    }
    .btn-custom:hover {
      background-color: #00cfc0;
    }
    .dashboard-section {
      display: none;
    }
    .dashboard-section.active {
      display: block;
    }
    .logout-footer {
      margin-top: 2rem;
      text-align: center;
    }
    @media (max-width: 991.98px) {
      .main-wrapper {
        margin-left: 0 !important;
      }
    }
    @media (min-width: 992px) {
      .main-wrapper {
        margin-left: 270px;
      }
    }
  </style>
</head>
<body>
  <!-- Toggle button for sidebar (mobile) -->
  <nav class="navbar navbar-dark bg-dark d-lg-none">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebarMobile"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <span class="navbar-brand">Dashboard</span>
    </div>
  </nav>

  <!-- Sidebar for desktop -->
  <div
    class="d-none d-lg-block position-fixed h-100 sidebar"
    style="width: 250px"
  >
    <div class="sidebar-nav">
      <h4 class="text-white mb-4">Dashboard</h4>
      <a href="#profile" class="active"><i class="fas fa-user-circle"></i> Profile Info</a>
      <a href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
      <a href="#billing"><i class="fas fa-credit-card"></i> Billing</a>
      <a href="#notifications"><i class="fas fa-bell"></i> Notifications</a>
      <a href="#settings"><i class="fas fa-cog"></i> Preferences</a>
      <a href="#support"><i class="fas fa-headset"></i> Support</a>
      <a href="#security"><i class="fas fa-shield-alt"></i> Security</a>
      <a href="#password-change"><i class="fas fa-key"></i> Change Password</a>
      <a href="#" id="logout-link-desktop"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  <!-- Sidebar for mobile (offcanvas) -->
  <div
    class="offcanvas offcanvas-start bg-dark text-white"
    tabindex="-1"
    id="sidebarMobile"
  >
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Dashboard</h5>
      <button
        type="button"
        class="btn-close btn-close-white"
        data-bs-dismiss="offcanvas"
      ></button>
    </div>
    <div class="offcanvas-body sidebar">
      <a href="#profile" class="active"><i class="fas fa-user-circle"></i> Profile Info</a>
      <a href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
      <a href="#billing"><i class="fas fa-credit-card"></i> Billing</a>
      <a href="#notifications"><i class="fas fa-bell"></i> Notifications</a>
      <a href="#settings"><i class="fas fa-cog"></i> Preferences</a>
      <a href="#support"><i class="fas fa-headset"></i> Support</a>
      <a href="#security"><i class="fas fa-shield-alt"></i> Security</a>
      <a href="#password-change"><i class="fas fa-key"></i> Change Password</a>
      <a href="#" id="logout-link-mobile"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>

  <!-- Main content -->
  <div class="main-content main-wrapper">

    <!-- Flash messages -->
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if(session('status_password'))
      <div class="alert alert-success">{{ session('status_password') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Profile Section -->
    <div id="profile" class="dashboard-section active card-dark">
      <div class="d-flex align-items-center mb-3">
        <img
          src="{{ $user->profile_photo_url ?? 'https://via.placeholder.com/80' }}"
          alt="Profile Picture"
          class="rounded-circle me-3 border border-2 shadow"
          style="width: 80px; height: 80px; object-fit: cover"
        />
        <div>
          <h5 class="card-title mb-0">
            <i class="fas fa-user-circle"></i> Profile Information
          </h5>
          <small class="text-muted">Manage your personal details</small>
        </div>
      </div>
      <hr class="border-secondary" />

      <div class="row">
        <div class="col-md-6">
          <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label text-light"><strong>Name:</strong></label>
              <input
                type="text"
                name="name"
                class="form-control form-control-sm"
                value="{{ old('name', $user->name) }}"
                required
              />
              @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label text-light"><strong>Email:</strong></label>
              <input
                type="email"
                name="email"
                class="form-control form-control-sm"
                value="{{ old('email', $user->email) }}"
                required
              />
              @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label text-light"><strong>Phone:</strong></label>
              <input
                type="text"
                name="phone"
                class="form-control form-control-sm"
                value="{{ old('phone', $user->phone) }}"
              />
              @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-custom btn-sm" type="submit">Update Profile</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Orders Section -->
    <div id="orders" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Orders / Purchases</h5>
      <hr class="border-secondary" />

      @if($orders->isEmpty())
        <p>No orders found.</p>
      @else
        <ul class="list-group mb-3">
          @foreach($orders as $order)
            <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
              Order #{{ $order->order_number }}
              <span class="badge 
                @if($order->status==='pending') bg-warning 
                @elseif($order->status==='completed') bg-success 
                @elseif($order->status==='cancelled') bg-danger 
                @endif">
                {{ ucfirst($order->status) }}
              </span>
            </li>
          @endforeach
        </ul>
      @endif

      <button class="btn btn-custom btn-sm">View All Orders</button>
      <div class="logout-footer">
        <form id="logout-form-orders" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Billing Section -->
    <div id="billing" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-credit-card"></i> Payment & Billing Info</h5>
      <hr class="border-secondary" />

      @if($transactions->isEmpty())
        <p>No billing transactions yet.</p>
      @else
        <ul class="list-group mb-3">
          @foreach($transactions as $tx)
            <li class="list-group-item bg-dark text-white d-flex justify-content-between">
              BDT {{ number_format($tx->amount, 2) }}
              <small class="text-muted">{{ $tx->created_at->format('Y-m-d') }}</small>
            </li>
          @endforeach
        </ul>
      @endif

      <div class="logout-footer">
        <form id="logout-form-billing" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Notifications Section -->
    <div id="notifications" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-bell"></i> Notifications</h5>
      <hr class="border-secondary" />

      @if($notifications->isEmpty())
        <p>No new notifications.</p>
      @else
        <ul class="list-group mb-3">
          @foreach($notifications as $note)
            <li class="list-group-item bg-dark text-white">
              {{ $note->data['message'] ?? $note->data['title'] }}
              <br>
              <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
            </li>
          @endforeach
        </ul>
      @endif

      <div class="logout-footer">
        <form id="logout-form-notifications" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Settings Section -->
    <div id="settings" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-cog"></i> Settings / Preferences</h5>
      <hr class="border-secondary" />

      <p>Customize your dashboard preferences here.</p>

      <div class="logout-footer">
        <form id="logout-form-settings" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Support Section -->
    <div id="support" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-headset"></i> Support / Contact</h5>
      <hr class="border-secondary" />

      <p>Contact our support team for assistance.</p>

      <div class="logout-footer">
        <form id="logout-form-support" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Security Section -->
    <div id="security" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-shield-alt"></i> Security Settings</h5>
      <hr class="border-secondary" />

      <p>Manage your security preferences here.</p>

      <div class="logout-footer">
        <form id="logout-form-security" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Password Change Section -->
    <div id="password-change" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-key"></i> Change Password</h5>
      <hr class="border-secondary" />

      <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
        @csrf

        <div class="mb-3">
          <label for="current_password" class="form-label text-light">Current Password</label>
          <input
            type="password"
            name="current_password"
            id="current_password"
            class="form-control form-control-sm"
            required
            autocomplete="new-password"
          />
          @error('current_password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label text-light">New Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="form-control form-control-sm"
            required
            autocomplete="new-password"
          />
          @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label text-light">Confirm New Password</label>
          <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control form-control-sm"
            required
            autocomplete="new-password"
          />
        </div>

        <button type="submit" class="btn btn-custom btn-sm">Update Password</button>
      </form>

      <div class="logout-footer mt-3">
        <form id="logout-form-password" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

  </div>

  <!-- Logout form for sidebar links (hidden) -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>

  <!-- Bootstrap JS and dependencies -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>

  <script>
    // Sidebar navigation link active toggle and section display
    document.querySelectorAll('.sidebar a[href^="#"]').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        const target = link.getAttribute('href').substring(1);

        // Hide all sections
        document.querySelectorAll('.dashboard-section').forEach(section => {
          section.classList.remove('active');
        });

        // Remove active class from all sidebar links
        document.querySelectorAll('.sidebar a').forEach(nav => {
          nav.classList.remove('active');
        });

        // Show target section and highlight link
        document.getElementById(target).classList.add('active');
        link.classList.add('active');

        // Close offcanvas on mobile after clicking a link
        const offcanvasEl = document.getElementById('sidebarMobile');
        if (offcanvasEl.classList.contains('show')) {
          const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
          bsOffcanvas.hide();
        }
      });
    });

    // Logout links (desktop & mobile)
    document.getElementById('logout-link-desktop').addEventListener('click', e => {
      e.preventDefault();
      document.getElementById('logout-form').submit();
    });

    document.getElementById('logout-link-mobile').addEventListener('click', e => {
      e.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
</body>
</html>
