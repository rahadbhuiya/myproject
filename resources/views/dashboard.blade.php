<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dark User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
    .sidebar a:hover, .sidebar a.active {
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

<!-- Toggle button for sidebar -->
<nav class="navbar navbar-dark bg-dark d-lg-none">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
      <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand">Dashboard</span>
  </div>
</nav>

<!-- Sidebar for desktop -->
<div class="d-none d-lg-block position-fixed h-100 sidebar" style="width: 250px;">
  <div class="sidebar-nav">
    <h4 class="text-white mb-4">Dashboard</h4>
    <a href="#profile" class="active"><i class="fas fa-user-circle"></i> Profile Info</a>
    <a href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
    <a href="#billing"><i class="fas fa-credit-card"></i> Billing</a>
    <a href="#notifications"><i class="fas fa-bell"></i> Notifications</a>
    <a href="#settings"><i class="fas fa-cog"></i> Preferences</a>
    <a href="#support"><i class="fas fa-headset"></i> Support</a>
    <a href="#security"><i class="fas fa-shield-alt"></i> Security</a>
  </div>

</div>

<!-- Sidebar for mobile -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarMobile">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Dashboard</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body sidebar">
    <a href="#profile" class="active"><i class="fas fa-user-circle"></i> Profile Info</a>
    <a href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
    <a href="#billing"><i class="fas fa-credit-card"></i> Billing</a>
    <a href="#notifications"><i class="fas fa-bell"></i> Notifications</a>
    <a href="#settings"><i class="fas fa-cog"></i> Preferences</a>
    <a href="#support"><i class="fas fa-headset"></i> Support</a>
    <a href="#security"><i class="fas fa-shield-alt"></i> Security</a>
    <a href="#logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>

<!-- Main content -->
<div class="main-content main-wrapper">



<div id="profile" class="dashboard-section active card-dark">
  <div class="d-flex align-items-center mb-3">
    <img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTEyL3Jhd3BpeGVsb2ZmaWNlOF9ib3lfdmVjdG9yX2lsbHVzdHJhdGlvbl9kZXNpZ25faW5fdGhlX3N0eWxlX29mX18xNmFjZjk3YS03ZTM0LTRjNDktOTFmOC1jNzgzNGMxMzI5ZjgucG5n.png" alt="Profile Picture" class="rounded-circle me-3 border border-2 shadow" style="width: 80px; height: 80px; object-fit: cover;">
    <div>
      <h5 class="card-title mb-0"><i class="fas fa-user-circle"></i> Profile Information</h5>
      <small class="text-muted">Manage your personal details</small>
    </div>
  </div>
  <hr class="border-secondary">

  <div class="row">
    <!-- Left Column: Profile Details -->
    <div class="col-md-6">
      <div class="mb-3 profile-view">
        <p><strong>Name:</strong> Shoikat</p>
        <p><strong>Email:</strong> shoikat@example.com</p>
        <p><strong>Phone:</strong> +8801XXXXXXXXX</p>
      </div>
    </div>

    <!-- Right Column: Profile Edit -->
    <div class="col-md-6">
      <div class="mb-3 profile-edit d-none">
        <div class="mb-2">
          <label class="form-label text-light">Name</label>
          <input type="text" class="form-control form-control-sm" value="Shoikat">
        </div>
        <div class="mb-2">
          <label class="form-label text-light">Email</label>
          <input type="email" class="form-control form-control-sm" value="shoikat@example.com">
        </div>
        <div class="mb-2">
          <label class="form-label text-light">Phone</label>
          <input type="text" class="form-control form-control-sm" value="+8801XXXXXXXXX">
        </div>
        <button class="btn btn-success btn-sm mt-2">Save Changes</button>
        <button class="btn btn-secondary btn-sm mt-2 ms-2 cancel-edit">Cancel</button>
      </div>

      <div class="mb-3 change-password d-none">
        <div class="mb-2">
          <label class="form-label text-light">Current Password</label>
          <input type="password" class="form-control form-control-sm">
        </div>
        <div class="mb-2">
          <label class="form-label text-light">New Password</label>
          <input type="password" class="form-control form-control-sm">
        </div>
        <div class="mb-2">
          <label class="form-label text-light">Confirm New Password</label>
          <input type="password" class="form-control form-control-sm">
        </div>
        <button class="btn btn-warning btn-sm mt-2">Update Password</button>
        <button class="btn btn-secondary btn-sm mt-2 ms-2 cancel-password">Cancel</button>
      </div>
    </div>
  </div>

  <div class="d-flex flex-wrap gap-2">
    <button class="btn btn-custom btn-sm edit-btn"><i class="fas fa-edit"></i> Edit Profile</button>
    <button class="btn btn-outline-light btn-sm password-btn"><i class="fas fa-key"></i> Change Password</button>
  </div>
  <div class="logout-footer">
    <button class="btn btn-danger mt-4 w-100"><i class="fas fa-sign-out-alt"></i> Logout</button>
  </div>
</div>

<script>
  document.querySelector('.edit-btn').addEventListener('click', function() {
    document.querySelector('.profile-view').classList.remove('d-none');
    document.querySelector('.profile-edit').classList.remove('d-none');
    document.querySelector('.change-password').classList.add('d-none');
  });

  document.querySelector('.cancel-edit').addEventListener('click', function() {
    document.querySelector('.profile-edit').classList.add('d-none');
  });

  document.querySelector('.password-btn').addEventListener('click', function() {
    document.querySelector('.profile-view').classList.remove('d-none');
    document.querySelector('.change-password').classList.remove('d-none');
    document.querySelector('.profile-edit').classList.add('d-none');
  });

  document.querySelector('.cancel-password').addEventListener('click', function() {
    document.querySelector('.change-password').classList.add('d-none');
  });
</script>







  <div id="orders" class="dashboard-section card-dark">

    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Orders / Purchases</h5>
    <p>Total Orders: 20</p>
    <ul>
      <li>Order #1234 - <span class="text-warning">Pending</span></li>
      <li>Order #1229 - <span class="text-success">Completed</span></li>
      <li>Order #1220 - <span class="text-danger">Cancelled</span></li>
    </ul>
    <button class="btn btn-custom btn-sm">View All Orders</button>

    
    <button class="btn btn-secondary btn-sm">Download Invoices</button>
    <div class="logout-footer"><button class="btn btn-danger">Logout</button></div>
  </div>

  <div id="billing" class="dashboard-section card-dark">
    <h5 class="card-title"><i class="fas fa-credit-card"></i> Payment & Billing Info</h5>
    <p>Saved Method: Visa ending in 1234</p>
    <p>Billing Address: Dhaka, Bangladesh</p>
    <p>Recent Transactions:</p>
    <ul>
      <li>BDT 1000 - 2025-05-10</li>
      <li>BDT 500 - 2025-05-01</li>
    </ul>
    <div class="logout-footer"><button class="btn btn-danger">Logout</button></div>
  </div>

  <div id="notifications" class="dashboard-section card-dark">
    <h5 class="card-title"><i class="fas fa-bell"></i> Notifications</h5>
    <ul>
      <li>New top-up offer available</li>
      <li>Your order #1234 is pending confirmation</li>
    </ul>
    <div class="logout-footer"><button class="btn btn-danger">Logout</button></div>
  </div>

  <div id="settings" class="dashboard-section card-dark">
    <h5 class="card-title"><i class="fas fa-cog"></i> Settings / Preferences</h5>
    <p>Language: English</p>
    <p>Timezone: Asia/Dhaka</p>
    <p>Notifications: Enabled</p>
    <div class="logout-footer"><button class="btn btn-danger">Logout</button></div>
  </div>

  <div id="support" class="dashboard-section card-dark">
    <h5 class="card-title"><i class="fas fa-headset"></i> Support / Help</h5>
    <p><a href="#" class="text-info">Submit a support ticket</a></p>
    <p>Live Chat: <span class="text-success">Online</span></p>
    <div class="logout-footer"><button class="btn btn-danger">Logout</button></div>
  </div>

  <div id="security" class="dashboard-section card-dark">
    <h5 class="card-title"><i class="fas fa-shield-alt"></i> Activity Logs / Security</h5>
    <p>Last login: 2025-05-17, Device: Chrome on Windows</p>
    <p>IP: 192.168.1.100</p>
    <p>Active Sessions: 2</p>
    <div class="logout-footer"><button class="btn btn-danger">Logout</button></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $('.sidebar a').on('click', function(e){
    e.preventDefault();
    $('.sidebar a').removeClass('active');
    $(this).addClass('active');
    let target = $(this).attr('href');
    $('.dashboard-section').removeClass('active');
    $(target).addClass('active');
    if (window.innerWidth < 992) {
      const offcanvasEl = document.getElementById('sidebarMobile');
      const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
      bsOffcanvas.hide();
    }
  });
</script>
</body>
</html>
