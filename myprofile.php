<?php
session_start();

// Initialize message
$popup = "";

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['profile'] = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name'  => $_POST['last_name'] ?? '',
        'gender'     => $_POST['gender'] ?? '',
        'email'      => $_POST['email'] ?? '',
        'username'   => $_POST['username'] ?? '',
        'password'   => $_POST['password'] ?? '',
        'phone'      => $_POST['phone'] ?? '',
        'address'    => $_POST['address'] ?? '',
        'bio'        => $_POST['bio'] ?? '',
    ];

    // Handle profile picture
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = uniqid("profile_") . "_" . basename($_FILES["profile_pic"]["name"]);
        $targetFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
            $_SESSION['profile']['profile_pic'] = $targetFile;
        }
    }

    $popup = "✅ Profile updated successfully!";
}

// Fetch saved data
$profile = $_SESSION['profile'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile | SmartWaste</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="createprofile.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
    }
    .form-control, .form-control:focus, textarea {
      background-color: #1e1e1e;
      border: 1px solid #28a745;
      color: #e0e0e0;
    }
    .form-control::placeholder, textarea::placeholder {
      color: #888;
    }
    .btn-success {
      background-color: #28a745;
      border: none;
    }
    .btn-danger {
      background-color: #dc3545;
      border: none;
    }
    .container h2 {
      color: #28a745;
    }
    .profile-pic img {
      border: 3px solid #28a745;
      padding: 2px;
    }
  </style>
</head>
<body>

<!-- ✅ SmartWaste Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm px-4">
  <a class="navbar-brand text-success" href="#">
    <i class="fas fa-recycle"></i> <span data-translate="brand">SmartWaste</span>
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <div class="d-flex gap-2 mt-2 mt-lg-0 align-items-center">
      <a href="backup.php" class="btn btn-sm btn-outline-success">
        <i class="fas fa-home"></i> <span data-translate="home"></span>
      </a>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-success dropdown-toggle" id="languageDropdown" data-bs-toggle="dropdown"
          aria-expanded="false">
          <i class="fas fa-globe"></i> <span data-translate="language"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="languageDropdown">
          <li><a class="dropdown-item" href="#" onclick="setLanguage('en')">English</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('hi')">हिंदी</a></li>
          <li><a class="dropdown-item" href="#" onclick="setLanguage('mr')">मराठी</a></li>
        </ul>
      </div>
      <div class="dropdown">
        <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" role="button" id="settingsDropdown"
          data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-cog"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="settingsDropdown">
          <li><a class="dropdown-item" href="myprofile.php">Profile</a></li>
          <li><a class="dropdown-item" href="yourschedule.php">Your Schedule</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item text-danger" href="createprofile.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- ✅ Profile Edit Form -->
<div class="container mt-4">
  <h2 style="color:white"><i class="fas fa-user-edit" ></i> Edit Profile</h2>

  <?php if (!empty($popup)): ?>
    <div class="alert alert-success text-center">
      <?= htmlspecialchars($popup) ?>
    </div>
  <?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data">
    <div class="profile-pic text-center mb-3">
      <img id="preview" 
           src="<?= htmlspecialchars($profile['profile_pic'] ?? 'default-profile.png') ?>" 
           alt="Profile Picture"
           style="width:150px; height:150px; border-radius:50%; object-fit:cover;">
    </div>
    <div class="mb-3">
      <label for="profile_pic" class="form-label">Change Profile Picture</label>
      <input type="file" class="form-control" name="profile_pic" id="profile_pic" accept="image/*" onchange="previewImage(event)">
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <input type="text" class="form-control" placeholder="First Name"
               name="first_name" id="first_name" value="<?= htmlspecialchars($profile['first_name'] ?? '') ?>" required>
      </div>
      <div class="col-md-6 mb-3">
        <input type="text" class="form-control" placeholder="Last Name"
               name="last_name" id="last_name" value="<?= htmlspecialchars($profile['last_name'] ?? '') ?>" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Gender</label><br>
      <label class="me-2"><input type="radio" name="gender" value="Male" <?= ($profile['gender'] ?? '')==='Male'?'checked':'' ?>> Male</label>
      <label class="me-2"><input type="radio" name="gender" value="Female" <?= ($profile['gender'] ?? '')==='Female'?'checked':'' ?>> Female</label>
      <label><input type="radio" name="gender" value="Other" <?= ($profile['gender'] ?? '')==='Other'?'checked':'' ?>> Other</label>
    </div>

    <input type="email" class="form-control mb-3" placeholder="Email" name="email" id="email" value="<?= htmlspecialchars($profile['email'] ?? '') ?>" required>
    <input type="text" class="form-control mb-3" placeholder="Username" name="username" id="username" value="<?= htmlspecialchars($profile['username'] ?? '') ?>" required>
    <input type="password" class="form-control mb-3" placeholder="Password (leave blank to keep current)" name="password" id="password" value="<?= htmlspecialchars($profile['password'] ?? '') ?>">
    <input type="tel" class="form-control mb-3" placeholder="Phone" name="phone" id="phone" value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
    <textarea class="form-control mb-3" placeholder="Address" name="address" id="address"><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
    <textarea class="form-control mb-3" placeholder="Bio" name="bio" id="bio"><?= htmlspecialchars($profile['bio'] ?? '') ?></textarea>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
      <button type="button" class="btn btn-danger" onclick="window.history.back();"><i class="fas fa-times"></i> Cancel</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = () => { document.getElementById('preview').src = reader.result; };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
</body>
</html>
