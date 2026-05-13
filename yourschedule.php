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
            'house_no' => 8865972582,
            'time' => '19:22',
            'priority' => 'Urgent',
            'instructions' => 'Empty the blue bin',
            'action' => 'Complete',
        ],
        [
            'house_no' => 9527091727,
            'time' => '14:15',
            'priority' => 'Soon',
            'instructions' => '',
            'action' => 'Complete',
        ],
    ],
    'Northside' => [
        [
            'house_no' =>8308946572,
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
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>Smart Waste Dashboard</title>
  <link href="base.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="spreadsheet" href="base.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="base.css" rel="stylesheet">
<style>
    body {
        background-color: #181a23;
        color: #ddd;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    .logo {
        font-weight: bold;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        color: white;
    }
    .logo::before {
        content: "♻️";
        margin-right: 10px;
    }
    .nav-links {
        font-size: 0.9rem;
    }
    .nav-links a {
        color: #bbb;
        text-decoration: none;
        margin-left: 20px;
    }
    .nav-links a:hover {
        color: white;
    }
    .dashboard-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    .card {
        background-color: #50b972;
        padding: 20px;
        border-radius: 8px;
        flex: 1;
        color: white;
    }
    .card strong {
        font-size: 2rem;
        display: block;
    }
    .card-text {
        margin-top: 5px;
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .section {
        margin-bottom: 40px;
    }
    .section-title {
        margin-bottom: 15px;
        font-weight: 600;
        font-size: 1.2rem;
        color: white;
    }
    .location-box {
        background-color: #1f2233;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
    }
    .location-header {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        color: #50b972;
    }
    .location-header::before {
        content: '📍';
        margin-right: 8px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        color: black;
        border-radius: 6px;
        overflow: hidden;
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
    }
    thead {
        background-color: #242833;
        color: #a5aabc;
    }
    tbody tr:nth-child(even) {
        background-color: #f8f8f8;
    }
    tbody tr:hover {
        background-color: #d3e8cb;
        cursor: pointer;
    }
    .priority-urgent {
        display: flex;
        align-items: center;
        color: #c43636;
        font-weight: 600;
    }
    .priority-urgent::before {
        content: "🚩";
        margin-right: 6px;
    }
    .priority-soon {
        display: flex;
        align-items: center;
        color: #c4a236;
        font-weight: 600;
    }
    .priority-soon::before {
        content: "🚩";
        margin-right: 6px;
    }
    .home-icon::before {
        content: "<i class="fas fa-phone"></i>";
        margin-right: 6px;
    }
    .btn-complete {
        background-color: #50b972;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-complete:hover {
        background-color: #3a874d;
    }
    form {
        background: #1f2233;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 40px;
    }
    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }
    input, select, textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: none;
        border-radius: 4px;
    }
    button[type=submit] {
        background-color: #50b972;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        width: 100%;
        font-weight: bold;
        cursor: pointer;
    }
    
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
        <i class="fas fa-home"></i> <span data-translate="home">Home</span>
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
        <li><a class="dropdown-item" href="#" >profile</a></li>
        <li><a class="dropdown-item" href="yourschedule.php" >your schedule</a></li>
        <li><a class="dropdown-item" href="#" >Settings</a></li>
        <li><a class="dropdown-item" href="createprofile.php" style="color:red">logout</a></li>
    </ul>

</div>

</div>

        </div>
            </button>
        
        
            
            
        </div>
</nav>



<!-- Dashboard Cards -->
<div class="dashboard-cards">
    <div class="card">
        <strong><?php echo $dashboardStats['pending_requests']; ?></strong>
        <div class="card-text"><span style="vertical-align: middle;">⏳</span> Pending Requests</div>
    </div>
    <div class="card">
        <strong><?php echo $dashboardStats['completed_today']; ?></strong>
        <div class="card-text"><span style="vertical-align: middle;">✔️</span> Completed Today</div>
    </div>
    <div class="card">
        <strong><?php echo $dashboardStats['urgent_requests']; ?></strong>
        <div class="card-text"><span style="vertical-align: middle;">⚠️</span> Urgent Requests</div>
    </div>
</div>

<!-- Pending Requests Section -->
<div class="section">
    <div class="section-title">Pending Pickup Requests</div>
    
    <?php foreach ($pendingPickupRequests as $location => $requests): ?>
    <div class="location-box">
        <div class="location-header"><?php echo htmlspecialchars($location); ?></div>
        <table>
            <thead>
                <tr>
                    <th><i class="fas fa-phone"></i>Phone No</th>
                    <th>Time</th>
                    <th>Priority</th>
                    <th>Instructions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($requests as $request): ?>
                <tr>
                    <td><span class="home-icon"></span><?php echo htmlspecialchars($request['house_no']); ?></td>
                    <td><?php echo htmlspecialchars($request['time']); ?></td>
                    <td>
                      <?php
                        if (strtolower($request['priority']) === 'urgent') {
                            echo '<span class="priority-urgent">Urgent</span>';
                        } else {
                            echo '<span class="priority-soon">Soon</span>';
                        }
                      ?>
                    </td>
                    <td><?php echo htmlspecialchars($request['instructions'] ?: '-'); ?></td>
                    <td><button class="btn-complete">✔ Complete</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>
