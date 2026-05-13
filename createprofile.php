<?php
session_start();
$message = "";
$popup = "";

// REGISTER
if (isset($_POST['register'])) {
    if ($_POST['reg_password'] !== $_POST['confirm_password']) {
        $popup = "❌ Passwords do not match!";
    } else {
        $_SESSION['user_email'] = $_POST['reg_email'];
        $_SESSION['user_password'] = $_POST['reg_password'];
        $_SESSION['user_phone'] = $_POST['reg_phone'] ?? '';
        $popup = "✅ Registration successful! Please login.";
    }
}

// LOGIN
if (isset($_POST['login'])) {
    $loginType = $_POST['loginType'];
    $password = $_POST['login_password'];

    if ($loginType === "email") {
        $loginValue = $_POST['login_email'];
        $isValid = (
            isset($_SESSION['user_email'], $_SESSION['user_password']) &&
            $loginValue === $_SESSION['user_email'] &&
            $password === $_SESSION['user_password']
        );
    } else {
        $loginValue = $_POST['login_phone'];
        $isValid = (
            isset($_SESSION['user_phone'], $_SESSION['user_password']) &&
            $loginValue === $_SESSION['user_phone'] &&
            $password === $_SESSION['user_password']
        );
    }

    if ($isValid) {
        $popup = " Login successful! Redirecting...";
        echo "<script>
                setTimeout(function(){
                    window.location.href='backup.php';
                }, 1500);
              </script>";
    } else {
        $popup = "Invalid login! Wrong email/phone or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SmartWaste - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="base.css" rel="stylesheet">
  <link href="createprofile.css" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
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
          <li><a class="dropdown-item" href="createprofile.php">Login</a></li>
           <li><a class="dropdown-item" href="createprofile.php">Sign up</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item text-danger" href="createprofile.php">Logout</a></li>
        </ul>
      </div>

    </div>
  </div>
</nav>
<!-- POPUP ALERT -->
<?php if (!empty($popup)): ?>
<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="popupToast" class="toast align-items-center text-white <?php echo (strpos($popup,'❌')!==false ? 'bg-danger' : 'bg-success'); ?> border-0 show" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        <?php echo $popup; ?>
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- LOGIN CARD WRAPPER -->
<div class="login-wrapper">
  <div class="card login-card">
    <!-- Dynamic heading -->
    <h4 class="text-center mb-4" id="cardTitle">
      <span class="text-success">Smart Waste Login</span>  
      <small class="text-muted"></small>
    </h4>

    <!-- Tabs -->
    <ul class="nav nav-pills mb-3 justify-content-center" id="formTabs">
      <li class="nav-item">
        <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login">Login</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register">Register</button>
      </li>
    </ul>

    <div class="tab-content">

      <!-- LOGIN TAB -->
      <div class="tab-pane fade show active" id="login">
        <form method="POST">
          <!-- Login Type -->
          <div class="mb-3 text-center">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="loginType" id="emailRadio" value="email" checked onclick="toggleField()">
              <label class="form-check-label" for="emailRadio">Email</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="loginType" id="phoneRadio" value="phone" onclick="toggleField()">
              <label class="form-check-label" for="phoneRadio">Phone</label>
            </div>
          </div>

          <!-- Email -->
          <div id="emailField" class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" class="form-control" name="login_email" placeholder="Enter your Email">
            </div>
          </div>

          <!-- Phone -->
          <div id="phoneField" class="mb-3 d-none">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
              <input type="tel" class="form-control" name="login_phone" placeholder="Enter your Phone Number">
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" id="loginPassword" name="login_password" class="form-control" placeholder="Enter your Password">
              <span class="input-group-text toggle-password" onclick="togglePassword('loginPassword','loginToggleIcon')">
                <i class="fas fa-eye" id="loginToggleIcon"></i>
              </span>
            </div>
          </div>

          <!-- Login button -->
          <div class="d-grid">
            <button type="submit" name="login" class="btn btn-success">Login</button>
          </div>
        </form>
      </div>

      <!-- REGISTER TAB -->
      <div class="tab-pane fade" id="register">
        <form method="POST">
          <!-- Full Name -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" name="reg_name" placeholder="Full Name" required>
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" class="form-control" name="reg_email" placeholder="Enter your Email" required>
            </div>
          </div>

          <!-- Phone -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
              <input type="tel" class="form-control" name="reg_phone" placeholder="Enter your Phone Number">
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" id="regPassword" name="reg_password" class="form-control" placeholder="Password" required>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-check"></i></span>
              <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            </div>
          </div>

          <!-- Register button -->
          <div class="d-grid">
            <button type="submit" name="register" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function toggleField() {
    const emailField = document.getElementById("emailField");
    const phoneField = document.getElementById("phoneField");
    if (document.getElementById("emailRadio").checked) {
      emailField.classList.remove("d-none");
      phoneField.classList.add("d-none");
    } else {
      emailField.classList.add("d-none");
      phoneField.classList.remove("d-none");
    }
  }

  function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
      passwordInput.type = "password";
      toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
    }
  }

  document.getElementById("login-tab").addEventListener("click", function() {
    document.title = "SmartWaste - Login";
    document.getElementById("cardTitle").innerHTML = `<span class="text-success">SmartWaste</span> <small class="text-muted">Login</small>`;
  });

  document.getElementById("register-tab").addEventListener("click", function() {
    document.title = "SmartWaste - Register";
    document.getElementById("cardTitle").innerHTML = `<span class="text-success">SmartWaste</span> <small class="text-muted">Register</small>`;
  });
</script>

</body>
</html>
