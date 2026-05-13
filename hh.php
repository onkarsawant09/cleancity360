<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/icons/bootstrap-icons.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>

  <style>
        :root {
    --primary-color: #28a745;
    --secondary-color: #007bff;
    --warning-color: #ffc107;
    --danger-color: #f11d32ff;
    --text-color: #e0e0e0;
    --light-bg: #171718ff;
    --card-bg: #111111ff;
    --form-bg: #2a2a2a;
    --border-color: #4caf50;
    --btnborder-color: #000000ff;
    --emojibtn-color: #ffffffff;
}

body {
    background: var(--light-bg);
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    color: var(--text-color);
    line-height: 1.6;
}

/* Navbar */
.navbar {
    padding: 1rem 1.5rem;
    background-color: var(--card-bg) !important;
    box-shadow: 0 2px 10px rgba(240, 14, 14, 0.05) !important;
}
.navbar-brand {
    font-weight: bold;
    font-size: 1.7rem;
    color: var(--primary-color) !important;
}
.navbar-brand .icon {
    margin-right: 8px;
}
.navbar .btn-outline-success {
    border-color: var(--btnborder-color);
    color: var(--emojibtn-color);
}
.navbar .btn-outline-success:hover {
    background-color: var(--primary-color);
    color: white;
}
.navbar .btn-outline-primary {
    border-color: var(--btnborder-color);
    color: var(--emojibtn-color);
}
.navbar .btn-outline-primary:hover {
    background-color: var(--primary-color);
    color: white;
}

/* Logout dropdown link styling */
.custom-dropdown {
    background-color: black;
}
.custom-dropdown .dropdown-item {
    color: white;
}
.custom-dropdown .dropdown-item:hover {
    background-color: #333;
    color: #ddd;
}
.custom-dropdown .logout-link {
    color: red !important;
    font-weight: bold;
}
.custom-dropdown .logout-link:hover {
    background-color: #333;
    color: darkred !important;
}

/* Form container */
.container .bg-white {
    background: var(--form-bg) !important;
    color: var(--text-color);
    border: 1px solid var(--border-color);
}
.form-control {
    background: #1e1e1e;
    color: var(--text-color);
    border: 1px solid #444;
}
.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
}
label {
    color: #ccc;
}
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}
.btn-primary:hover {
    background-color: #218838;
    border-color: #1e7e34;
}
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm px-4">
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
          <i class="fas fa-home"></i> <span data-translate="home"></span>
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
          <ul class="dropdown-menu custom-dropdown" aria-labelledby="settingsDropdown">
            <li><a class="dropdown-item" href="myprofile.php">Profile</a></li>
            <li><a class="dropdown-item" href="yourschedule.php">Your Schedule</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item logout-link" href="createprofile.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container col-9 rounded-0 d-flex justify-content-between">
    <div class="col-12 bg-white border rounded p-4 mt-4 shadow-sm">
      <form>
        <h1 class="h5 mb-3 fw-normal">Edit Profile</h1>
        <div class="form-floating mt-1 col-6">
          <img src="C:\social_frontend_part1\img\ptiger\tuserp.jpg" class="img-thumbnail my-3" style="height:150px;" alt="...">
          <div class="mb-3">
            <label for="formFile" class="form-label">Change Profile Picture</label>
            <input class="form-control" type="file" id="formFile">
          </div>
        </div>
        <div class="d-flex">
          <div class="form-floating mt-1 col-6">
            <input type="text" class="form-control rounded-0" placeholder="First Name">
            <label for="floatingInput">First Name</label>
          </div>
          <div class="form-floating mt-1 col-6">
            <input type="text" class="form-control rounded-0" placeholder="Last Name">
            <label for="floatingInput">Last Name</label>
          </div>
        </div>
        <div class="d-flex gap-3 my-3">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="male" checked>
            <label class="form-check-label">Male</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="female">
            <label class="form-check-label">Female</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="other">
            <label class="form-check-label">Other</label>
          </div>
        </div>
        <div class="form-floating mt-1">
          <input type="email" class="form-control rounded-0" placeholder="Email">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mt-1">
          <input type="text" class="form-control rounded-0" placeholder="Username">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mt-1">
          <input type="password" class="form-control rounded-0" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>

        <div class="mt-3 d-flex justify-content-between align-items-center">
          <button class="btn btn-primary" type="submit">Update Profile</button>
        </div>
      </form>
    </div>
  </div>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
