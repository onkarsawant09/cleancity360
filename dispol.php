<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Special Disposal Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="base.css" rel="stylesheet">
 <link href="createprofile.css" rel="stylesheet">
   <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand" href="#">
    <i class="fas fa-recycle icon"></i> <span data-translate="brand">SmartWaste</span>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <div class="d-flex gap-2 mt-2 mt-lg-0 align-items-center">

      <!-- Home Button -->
      <a href="backup.php" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-home"></i> <span data-translate="home">Home</span>
      </a>

      <!-- Language Dropdown -->
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-success dropdown-toggle" id="languageDropdown" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="fas fa-globe"></i> <span data-translate="language"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
          <li><a class="dropdown-item" href="#" onclick="setLanguage('en')">English</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('hi')">हिंदी</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('mr')">मराठी</a></li>
        </ul>
      </div>

      <!-- Profile Dropdown -->
      <div class="dropdown">
        <a class="btn btn-sm btn-outline-primary dropdown-toggle" href="#" role="button" id="settingsDropdown"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-cog"></i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
          <li><a class="dropdown-item" href="myprofile.php">Profile</a></li>
           <li><a class="dropdown-item" href="yourschedule.php">Your Schedule</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item text-danger" href="createprofile.php">Logout</a></li>
        </ul>
      </div>

    </div>
  </div>
</nav>



<!-- Pickup Request Form -->
<section id="pickup" class="container my-5">
  <h2 class="text-center mb-4" >Request a Pickup</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form class="p-4 rounded card">
        <div class="mb-3">
          <label class="form-label" style="color:white" >Full Name</label>
          <input type="text" class="form-control" placeholder="Enter your name" required>
        </div>
        <div class="mb-3">
          <label class="form-label" style="color:white">Phone</label>
          <input type="tel" class="form-control" placeholder="Enter phone number" required>
        </div>
        <div class="mb-3">
          <label class="form-label" style="color:white">Address</label>
          <textarea class="form-control" rows="2" placeholder="Pickup address" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label" style="color:white">Waste Type</label>
          <select class="form-select" id="service" name="service" required>
            <option selected disabled>Select Type</option>
            <option>Household Waste</option>
            <option>E-Waste</option>
             <option>Recycle waste</option>
            <option>Medical Waste</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Submit Request</button>
      </form>
    </div>
  </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
