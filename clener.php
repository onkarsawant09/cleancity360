<?php
// PHP backend for handling the form submission

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $name    = sanitize_input($_POST['name']);
    $email   = sanitize_input($_POST['email']);
    $phone   = sanitize_input($_POST['phone']);
    $service = sanitize_input($_POST['service']);
    $date    = sanitize_input($_POST['date']);
    $time    = sanitize_input($_POST['time']);
    $message = sanitize_input($_POST['message']);

    $errors = [];
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "A valid email is required.";
    if (empty($phone)) $errors[] = "Phone number is required.";
    if (empty($service)) $errors[] = "Please select a service.";
    if (empty($date)) $errors[] = "Preferred date is required.";
    if (empty($time)) $errors[] = "Preferred time is required.";

    if (empty($errors)) {
        $response_message = "✅ Thank you, $name! Your request for <b>$service</b> has been received for <b>$date</b> at <b>$time</b>. We will contact you soon.";
        $response_status  = "success";
    } else {
        $response_message = "❌ Please correct the following errors:<br>" . implode("<br>", $errors);
        $response_status  = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cleaner Man - SmartWaste</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="base.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #28a745;
      --secondary-color: #007bff;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --text-color: #e0e0e0;
      --light-bg: #171718ff;
      --card-bg: #111111ff;
      --form-bg: #2a2a2a;
      --border-color: #4caf50;
    }

    body {
      background-color: #121212;
      color: #ffffff;
      font-family: 'Segoe UI', 'Poppins', sans-serif;
      line-height: 1.6;
    }

    .container {
      margin-top: 60px;
      max-width: 700px;
      background: var(--card-bg);
      padding: 40px;
      border-radius: 18px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .form-header h1 {
      font-size: 2.5rem;
      color: var(--primary-color);
    }
    .form-header p {
      font-size: 1.1rem;
      color: #bbb;
    }

    .form-control, .form-select {
      background-color: #2a2a2a;
      color: white;
      border: none;
      transition: border-color 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
      background-color: #2a2a2a;
      color: white;
      border: 1px solid var(--border-color);
      box-shadow: none;
    }

    .btn-success {
      background-color: var(--primary-color);
      border: none;
    }
    .btn-success:hover {
      background-color: #45a049;
    }
    .btn-secondary {
      background-color: #333;
      color: #ccc;
      border: none;
    }

    /* Navbar */
   
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
    <a class="navbar-brand" href="#">
        <i class="fas fa-recycle icon"></i> <span data-translate="brand"> SmartWaste</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      
       <div class="d-flex gap-2 mt-2 mt-lg-0 align-items-center">
        <!-- Home Button -->
    <a href="backup.php" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-home"></i> <span data-translate="home"></span>
    </a>
    <!-- Language Dropdown -->
   <div class="dropdown">
    <!-- Language Dropdown Button -->
    <button class="btn btn-sm btn-outline-success dropdown-toggle" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-globe"><span data-translate="language"></i> </span>
    </button>
  
    <!-- Language Dropdown Menu -->
    <ul class="dropdown-menu" aria-labelledby="languageDropdown1">
        <li><a class="dropdown-item" href="#" onclick="setLanguage('en')">English</a></li>
        <li><a class="dropdown-item" href="#" onclick="setLanguage('hi')">हिंदी</a></li>
        <li><a class="dropdown-item" href="#" onclick="setLanguage('mr')">मराठी</a></li>
    </ul>
</div>

   

    <!-- Profile Button -->
    <div class="dropdown d-inline">
  <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-cog"></i>
  </a>

<ul class="dropdown-menu" aria-labelledby="languageDropdown1">
        <li><a class="dropdown-item" href="myprofile.php" >profile</a></li>
        <li><a class="dropdown-item" href="yourschedule.php" >Your Schedule</a></li>
        <li><a class="dropdown-item" href="#" >Settings</a></li>
   <li><a class="dropdown-item" href="#" style="color:red">logout</a></li>
    </ul>

</div>
</nav>

<!-- Form Section -->
<div class="container">
  <div class="form-header">
    <h1> Emergency Request </h1>
    <p>Fill out the form below to Emergency service.</p>
  </div>

  <?php if (isset($response_message)): ?>
    <div class="alert alert-<?php echo $response_status; ?>" role="alert">
      <?php echo $response_message; ?>
    </div>
  <?php endif; ?>

  <form action="" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="name" name="name" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Your Email</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Your Phone Number</label>
      <input type="tel" class="form-control" id="phone" name="phone" required value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="service" class="form-label">Type of Cleaning Service</label>
      <select class="form-select" id="service" name="service" required>
        <option value="" disabled selected>Select a service</option>
        <option value="Home Cleaning" <?php echo (isset($service) && $service == 'home_cleaning') ? 'selected' : ''; ?>>Home Cleaning</option>
        <option value="Drain Cleaning" <?php echo (isset($service) && $service == 'drain_cleaning') ? 'selected' : ''; ?>>Drain Cleaning</option>
        <option value="Event Cleaning" <?php echo (isset($service) && $service == 'event_cleanup') ? 'selected' : ''; ?>>Event Cleaning</option>
        <option value="Other Cleaning" <?php echo (isset($service) && $service == 'Other_Cleaning') ? 'selected' : ''; ?>>Other Cleaning</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="date" class="form-label">Preferred Date</label>
      <input type="date" class="form-control" id="date" name="date" required value="<?php echo isset($date) ? htmlspecialchars($date) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="time" class="form-label">Preferred Time</label>
      <input type="time" class="form-control" id="time" name="time" required value="<?php echo isset($time) ? htmlspecialchars($time) : ''; ?>">
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Additional Notes</label>
      <textarea class="form-control" id="message" name="message" rows="3"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
    </div>
    <button type="submit" class="btn btn-success w-100">Request Cleaner</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
