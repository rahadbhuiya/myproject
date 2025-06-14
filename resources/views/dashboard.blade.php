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
    html {
      scroll-behavior: smooth;
    }
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
      <a href="/"><i class="fas fa-home"></i> Home</a>
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
      <a href="/"><i class="fas fa-home"></i> Home</a>
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
                value="{{ old('phone') ?? $user->phone }}"
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
        <div style="max-height: 500px; overflow-y: auto;">
          <ul class="list-group mb-3">
            @foreach($orders as $order)
              <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center flex-column flex-md-row">
                <div>
                  {{-- Order Number or ID --}}
                  <strong>Order #{{ $order->id }}</strong><br>
                  {{-- Product Name --}}
                  <small>Product: {{ $order->product->product_name ?? 'No product found' }}</small>
                </div>

                <span class="badge 
                  @if($order->status === 'pending') bg-warning 
                  @elseif($order->status === 'completed') bg-success 
                  @elseif($order->status === 'cancelled') bg-danger 
                  @else bg-secondary 
                  @endif
                  text-dark
                  ">
                  {{ ucfirst($order->status) }}
                </span>
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="logout-footer mt-3">
        <form id="logout-form-orders" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>

    <!-- Billing Section -->
    <div id="billing" class="dashboard-section card-dark">
      <h5 class="card-title">
        <i class="fas fa-credit-card"></i> Payment & Billing Info
      </h5>
      <hr class="border-secondary" />

      @if($transactions->isEmpty())
        <p class="text-muted">No billing transactions yet.</p>
      @else
        <div style="height: 500px; overflow-y: auto; border: 1px solid #666;">
          <ul class="list-group mb-3">
            @foreach($transactions as $tx)
              <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                <div>
                  {{ strtoupper($tx->currency) }} {{ number_format($tx->amount, 2) }}
                  @if(!empty($tx->description))
                    <small class="d-block text-muted">{{ $tx->description }}</small>
                  @endif
                </div>
                <small class="text-muted">{{ $tx->created_at->format('Y-m-d') }}</small>
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="logout-footer mt-3">
        <form id="logout-form-billing" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
      </div>
    </div>
 <!-- Notification Section -->
<div id="notifications"
     class="dashboard-section card-dark p-4 rounded shadow"
     style="background-color: #1e1e2f; max-height: 400px; overflow-y: auto;">
    <h5 class="card-title text-white mb-3">
        <i class="fas fa-bell me-2"></i> Notifications
        {{-- Red dot indicator for unread notifications --}}
        @if($notifications->whereNull('read_at')->isNotEmpty())
            <span style="
                display: inline-block;
                width: 10px;
                height: 10px;
                background-color: red;
                border-radius: 50%;
                margin-left: 8px;
                vertical-align: middle;
                animation: pulse 1.5s infinite;
            "></span>
        @endif
    </h5>
    <hr class="border-secondary" />

    @if($notifications->isEmpty())
        <div class="text-center py-4">
            <p class="text-muted">No new notifications.</p>
        </div>
    @else
        <ul class="list-group mb-3">
            @foreach($notifications as $note)
                <li class="list-group-item d-flex justify-content-between align-items-center 
                              bg-dark text-white mb-2 rounded shadow-sm"
                    style="border: 1px solid #333;">
                    <div class="notification-message flex-grow-1">
                        {{ $note->data['message'] ?? $note->data['title'] ?? 'New Notification' }}
                    </div>
                    <small class="text-muted ms-3 me-3" style="font-size: 0.8rem;">
                        {{ $note->created_at->diffForHumans() }}
                    </small>

                    {{-- Mark As Read Button only if unread --}}
                    @if(is_null($note->read_at))
                        <form action="{{ route('notifications.markRead', $note->id) }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm btn-outline-light"
                                    title="Mark as Read"
                                    style="font-size: 0.9rem; line-height: 1;">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                    @else
                        <span class="badge bg-success">Read</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <div class="logout-footer text-center mt-4">
        <form id="logout-form-notifications" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="btn btn-danger w-100 py-2 fw-semibold rounded-pill"
                    style="font-size: 1rem;">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(255, 0, 0, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
        }
    }

    /* Custom scrollbar styles for #notifications */
    #notifications {
        scrollbar-width: thin; /* Firefox */
        scrollbar-color: #ff4d4d #1e1e2f; /* thumb and track */
    }

    /* WebKit browsers */
    #notifications::-webkit-scrollbar {
        width: 8px;
    }

    #notifications::-webkit-scrollbar-track {
        background: #1e1e2f;
        border-radius: 8px;
    }

    #notifications::-webkit-scrollbar-thumb {
        background-color: #ff4d4d;
        border-radius: 8px;
        border: 2px solid #1e1e2f;
    }

    #notifications::-webkit-scrollbar-thumb:hover {
        background-color: #ff1a1a;
    }
</style>

    <!-- Settings Section -->
    <div id="settings" class="dashboard-section card-dark">
      <h5 class="card-title"><i class="fas fa-cog"></i> Settings / Preferences</h5>
      <hr class="border-secondary" />

       <p>Not available right now.</p>

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

       <p>Not available right now.</p>

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
        @method('PUT')

        {{-- Success Message --}}
        @if(session('status_password'))
          <div class="alert alert-success">
            {{ session('status_password') }}
          </div>
        @endif

        <div class="mb-3">
          <label for="current_password" class="form-label text-light">Current Password</label>
          <input
            type="password"
            name="current_password"
            id="current_password"
            class="form-control form-control-sm @error('current_password') is-invalid @enderror"
            required
            autocomplete="new-password"
          />
          @error('current_password')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label text-light">New Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="form-control form-control-sm @error('password') is-invalid @enderror"
            required
            autocomplete="new-password"
          />
          @error('password')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label text-light">Confirm New Password</label>
          <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
            class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
            required
            autocomplete="new-password"
          />
          @error('password_confirmation')
            <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-custom btn-sm">Update Password</button>
      </form>

      <div class="logout-footer mt-3">
        <form id="logout-form-password" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
      </div>
    </div>

  </div> <!-- /.main-content -->

  <!-- Logout form for sidebar links (hidden) -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>

  <!-- Bootstrap JS Bundle (Popper included) -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  ></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const links = document.querySelectorAll(".sidebar a[href^='#']");
      const sections = document.querySelectorAll(".dashboard-section");

      function showSection(id) {
        sections.forEach(sec => sec.classList.remove("active"));
        const target = document.querySelector(id);
        if (target) {
          target.classList.add("active");
        }
      }

      links.forEach(link => {
        link.addEventListener("click", e => {
          const href = link.getAttribute("href");
          if (href.startsWith("#")) {
            e.preventDefault();
            // Remove active class from all links
            links.forEach(l => l.classList.remove("active"));
            // Add active class to clicked link
            link.classList.add("active");
            showSection(href);

            // Update URL without page jump
            history.pushState(null, "", href);

            // Close offcanvas on mobile if open
            const offcanvasEl = document.getElementById('sidebarMobile');
            if (offcanvasEl.classList.contains('show')) {
              const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
              bsOffcanvas.hide();
            }
          }
        });
      });

      // Show the section based on current hash (or default to #profile)
      showSection(window.location.hash || "#profile");
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
