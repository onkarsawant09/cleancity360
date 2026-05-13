<?php
// Sample data for the dashboard
$dashboardStats = [
    'pending_requests' => 3,
    'completed_today' => 1,
    'urgent_requests' => 2,
];

$pendingPickupRequests = [
    'Downtown' => [
        [
            'house_no' => 101,
            'time' => '19:22',
            'priority' => 'Urgent',
            'instructions' => 'Empty the blue bin',
            'action' => 'Complete',
        ],
        [
            'house_no' => 102,
            'time' => '14:15',
            'priority' => 'Soon',
            'instructions' => '',
            'action' => 'Complete',
        ],
    ],
    'Northside' => [
        [
            'house_no' => 123,
            'time' => '16:45',
            'priority' => 'Urgent',
            'instructions' => 'Collect cardboard boxes',
            'action' => 'Complete',
        ]
    ]
];

// Capture form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $service = $_POST['service'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $message = $_POST['message'] ?? '';

    // Add submitted request into the "Downtown" location for demo
    $pendingPickupRequests['Downtown'][] = [
        'house_no' => htmlspecialchars($phone), // using phone as unique placeholder
        'time' => htmlspecialchars($time),
        'priority' => 'Soon',
        'instructions' => htmlspecialchars($service . ' - ' . $message),
        'action' => 'Complete',
    ];

    // Update dashboard stats
    $dashboardStats['pending_requests']++;
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
        <i class="fas fa-recycle icon"></i> <span data-translate="brand">SmartWaste</span>
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
         <li><a class="dropdown-item" href="#" >Your Schedule</a></li>
        <li><a class="dropdown-item" href="#" >settings</a></li>
   <li><a class="dropdown-item" href="#" style="color:red">logout</a></li>
    </ul>

</div>
</nav>

<!-- Form Section -->
<div class="container">
  <div class="form-header">
    <h1>Request a Cleaner</h1>
    <p>Fill out the form below to request a cleaning service.</p>
  </div>

  <?php if (isset($response_message)): ?>
    <div class="alert alert-<?php echo $response_status; ?>" role="alert">
      <?php echo $response_message; ?>
    </div>
  <?php endif; ?>

<form action="yourschedule.php" method="POST">
  <!-- 1. Name -->
  <div class="mb-3">
    <label for="name" class="form-label">Your Name</label>
    <input type="text" class="form-control" id="name" name="name" required 
           value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
  </div>

  <!-- 2. Phone -->
  <div class="mb-3">
    <label for="phone" class="form-label">Your Phone Number</label>
    <input type="tel" class="form-control" id="phone" name="phone" required 
           value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
  </div>

  <!-- 3. Cleaner Gender -->
  <div class="mb-3">
    <label for="gender" class="form-label">Cleaner Gender</label>
    <select class="form-select" id="gender" name="gender" required>
      <option value="" disabled selected>Select Gender</option>
      <option value="Male" <?php echo (isset($gender) && $gender == 'Male') ? 'selected' : ''; ?>>Male</option>
      <option value="Female" <?php echo (isset($gender) && $gender == 'Female') ? 'selected' : ''; ?>>Female</option>
    </select>
  </div>

  <!-- 4. Priority -->
  <div class="mb-3">
    <label for="priority" class="form-label">Priority</label>
    <select class="form-select" id="priority" name="priority" required>
      <option value="" disabled selected>Select Priority</option>
      <option value="Normal" <?php echo (isset($priority) && $priority == 'Normal') ? 'selected' : ''; ?>>Normal</option>
      <option value="Urgent" <?php echo (isset($priority) && $priority == 'Urgent') ? 'selected' : ''; ?>>Urgent</option>
    </select>
  </div>

  <!-- 5. Address -->
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" required 
           value="<?php echo isset($address) ? htmlspecialchars($address) : ''; ?>">
  </div>

  <!-- 6. Property Type -->
  <div class="mb-3">
    <label for="property_type" class="form-label">Property Type</label>
    <select class="form-select" id="property_type" name="property_type" required onchange="togglePropertyName()">
      <option value="" disabled selected>Select Property</option>
      <option value="Hotel">Hotel</option>
      <option value="College">College</option>
      <option value="Temple">Temple</option>
      <option value="Private Property">Private Property</option>
      <option value="Society">Society</option>
      <option value="Other">Other</option>
    </select>
  </div>

  <!-- 7. Dynamic Property Name -->
  <div class="mb-3" id="propertyNameField" style="display:none;">
    <label for="property_name" class="form-label" id="propertyNameLabel">Property Name</label>
    <input type="text" class="form-control" id="property_name" name="property_name">
  </div>

  <!-- 8. Service -->
  <div class="mb-3">
    <label for="service" class="form-label">Type of Cleaning Service</label>
    <select class="form-select" id="service" name="service" required>
      <option value="" disabled selected>Select a service</option>
      <option value="Home Cleaning">Home Cleaning</option>
      <option value="Drain Cleaning">Drain Cleaning</option>
      <option value="Event Cleaning">Event Cleaning</option>
      <option value="Other Cleaning">Other Cleaning</option>
    </select>
  </div>

  <!-- 9. Preferred Date -->
  <div class="mb-3">
    <label for="date" class="form-label">Preferred Date</label>
    <input type="date" class="form-control" id="date" name="date" required 
           value="<?php echo isset($date) ? htmlspecialchars($date) : ''; ?>">
  </div>

  <!-- 10. Preferred Time -->
  <div class="mb-3">
    <label for="time" class="form-label">Preferred Time</label>
    <input type="time" class="form-control" id="time" name="time" required 
           value="<?php echo isset($time) ? htmlspecialchars($time) : ''; ?>">
  </div>

  <!-- Submit -->
  <button type="submit" class="btn btn-success w-100">Request Cleaner</button>
</form>

<script>
function togglePropertyName() {
    const propertyType = document.getElementById("property_type").value;
    const field = document.getElementById("propertyNameField");
    const label = document.getElementById("propertyNameLabel");

    if (propertyType) {
        field.style.display = "block";
        label.textContent = propertyType + " Name";
    } else {
        field.style.display = "none";
    }
}
</script>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>