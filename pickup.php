<?php 
session_start();  
if (!isset($_SESSION['user'])) {     
  $_SESSION['user'] = 'Omkar_Sawant';  
}  

$response_message = ''; 
$response_status = ''; 
$priority = 'Normal'; 
$preferred_time = '14:00'; 
$instructions = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
  $priority = htmlspecialchars($_POST['priority'] ?? 'Normal');     
  $preferred_time = htmlspecialchars($_POST['time'] ?? '14:00');     
  $instructions = htmlspecialchars($_POST['instructions'] ?? '');     
  $date = htmlspecialchars($_POST['date'] ?? '');     

  if (empty($priority) || empty($preferred_time) || empty($date)) {         
    $response_message = "Please fill out all required fields.";         
    $response_status = "danger";     
  } else {         
    $response_message = "Pickup request submitted successfully for user " . $_SESSION['user'] . "!";         
    $response_status = "success";     
  } 
} 
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request Pickup - Smart Waste</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- ✅ Dark Theme -->
  <style>
    :root {
      --primary-color : #28a745;
     --btnborder-color : #000000ff;
      --card-bg: #111111ff;
      --form-bg: #2a2a2a;
      --text-color: #e0e0e0;
      --light-bg: #171718ff;
    }

    body {
      background: var(--light-bg);
      color: var(--text-color);
      font-family: 'Poppins', sans-serif;
    }

    .form-container {
      max-width: 500px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      background: var(--card-bg);
    }

    .btn-success {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      color: white;
    }

    .btn-outline-success {
      color: var(--text-color);
      border-color: var(--primary-color);
    }

    .btn-outline-success:hover {
      background-color: var(--primary-color);
      color: white;
    }

    .form-control, .form-select {
      background-color: var(--form-bg);
      color: var(--text-color);
      border: 1px solid var(--primary-color);
    }

    .offcanvas {
      background-color: #1c1c1c;
      color: var(--text-color);
    }

    #reader {
      width: 100%;
      height: 320px;
      border: 2px dashed #28a745;
      border-radius: 10px;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<!-- ✅ Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm px-4" style="background: var(--card-bg);">
  <a class="navbar-brand text-light" href="#">
    <i class="fas fa-recycle text-success"></i> SmartWaste
  </a>
  <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <div class="d-flex gap-2 mt-2 mt-lg-0 align-items-center">

      <a href="backup.php" class="btn btn-sm btn-outline-success">
        <i class="fas fa-home"></i> 
      </a>

      <!-- ✅ Scanner Button -->
      <button class="btn btn-sm btn-outline-success" data-bs-toggle="offcanvas" data-bs-target="#scannerPanel">
        <i class="fas fa-qrcode"></i> 
      </button>

      <!-- Language Dropdown -->
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-success dropdown-toggle" id="languageDropdown" data-bs-toggle="dropdown">
          <i class="fas fa-globe"></i> 
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
          <li><a class="dropdown-item" href="#" onclick="setLanguage('en')">English</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('hi')">हिंदी</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('mr')">मराठी</a></li>
        </ul>
      </div>

      <!-- Profile -->
      <div class="dropdown">
        <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" id="settingsDropdown" data-bs-toggle="dropdown">
          <i class="fas fa-cog"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark">
          <li><a class="dropdown-item" href="myprofile.php">Profile</a></li>
          <li><a class="dropdown-item" href="yourschedule.php">Your Schedule</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item text-danger" href="createprofile.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- ✅ Pickup Form -->
<div class="form-container shadow">
  <h3 class="text-center mb-4">Request Pickup</h3>

  <?php if ($response_message): ?>
    <div class="alert alert-<?php echo $response_status; ?> alert-dismissible fade show">
      <?php echo $response_message; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label for="priority" class="form-label">Priority</label>
      <select id="priority" name="priority" class="form-select" required>
        <option value="Urgent" <?php echo ($priority == 'Urgent') ? 'selected' : ''; ?>>Urgent</option>
        <option value="Normal" <?php echo ($priority == 'Normal') ? 'selected' : ''; ?>>Normal</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="time" class="form-label">Preferred Time</label>
      <input type="time" id="time" name="time" class="form-control" value="<?php echo $preferred_time; ?>" required>
    </div>

    <div class="mb-3">
      <label for="date" class="form-label">Preferred Date</label>
      <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <button type="submit" class="btn btn-success w-100 mb-2">Submit Request</button>
    <a href="backup.php" class="btn btn-secondary w-100">Cancel</a>
  </form>
</div>

<!-- ✅ Sliding Scanner Section -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="scannerPanel" aria-labelledby="scannerPanelLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="scannerPanelLabel"><i class="fas fa-qrcode"></i> QR Scanner</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <p>Align the QR code within the frame to scan.</p>
    <div id="reader"></div>
    <p class="mt-3 text-success" id="scan-result"></p>
  </div>
</div>

<!-- ✅ Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
  const startScanner = () => {
    const html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: 250 },
      qrCodeMessage => {
        document.getElementById("scan-result").innerText = "✅ Scanned: " + qrCodeMessage;
        html5QrCode.stop();
      },
      error => {}
    ).catch(err => {
      document.getElementById("scan-result").innerText = "Camera access denied or unavailable.";
    });
  };

  const scannerPanel = document.getElementById('scannerPanel');
  scannerPanel.addEventListener('shown.bs.offcanvas', startScanner);
</script>

</body>
</html>
