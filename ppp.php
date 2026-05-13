<?php
// Sample data
$dashboard = [
    'pending_requests' => 3,
    'completed_today' => 1,
    'urgent_requests' => 2,
];

$requests = [
    'Downtown' => [
        [
            'house_no' => 101,
            'time' => '19:22',
            'priority' => 'Urgent',
            'priority_color' => '#d9534f', // red
            'instructions' => 'Empty the blue bin',
            'completed' => false,
        ],
        [
            'house_no' => 102,
            'time' => '14:15',
            'priority' => 'Soon',
            'priority_color' => '#f0ad4e', // yellow/orange
            'instructions' => '-',
            'completed' => false,
        ],
    ],
    'Northside' => [
        [
            'house_no' => 123,
            'time' => '16:45',
            'priority' => 'Urgent',
            'priority_color' => '#d9534f',
            'instructions' => 'Collect cardboard boxes',
            'completed' => false,
        ]
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>SmartWaste Dashboard</title>
<style>
    body {
        margin: 0;
        background-color: #1e1f2f;
        font-family: Arial, sans-serif;
        color: #ddd;
    }
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #121212;
        padding: 12px 24px;
        color: #4caf50;
        font-weight: bold;
        font-size: 1.4rem;
    }
    header nav button {
        background-color: #222;
        border: 1px solid #333;
        color: #eee;
        cursor: pointer;
        margin-left: 12px;
        padding: 6px 12px;
        font-size: 0.85rem;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    header nav button:hover {
        background-color: #4caf50;
        color: #121212;
    }

    /* Dashboard Summary */
    .dashboard-summary {
        display: flex;
        gap: 12px;
        padding: 16px 24px;
    }
    .summary-box {
        flex: 1;
        border-radius: 8px;
        padding: 16px 20px;
        background-color: #4caf50;
        color: white;
        text-align: center;
    }
    .summary-box .number {
        font-size: 2.6rem;
        margin-bottom: 8px;
    }

    /* Sliding Tabs */
    .tabs-headings {
        display: flex;
        overflow-x: auto;
        white-space: nowrap;
        gap: 12px;
        padding: 12px 24px;
        background-color: #202238;
    }
    .tabs-headings div {
        flex: 0 0 auto;
        padding: 10px 16px;
        background: #292c3f;
        color: #fff;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }
    .tabs-headings div:hover {
        background: #4caf50;
        color: #121212;
    }

    /* Request Areas */
    .area {
        margin: 20px 24px;
        background-color: #202238;
        border-radius: 8px;
        padding: 12px 16px 16px 16px;
    }
    .area > h2 {
        color: #4caf50;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 4px;
    }
    thead tr th {
        padding: 12px 20px;
        background-color: #292c3f;
        color: #ccc;
        border-radius: 6px;
        text-align: left;
    }
    tbody tr {
        background: #fefefe;
        color: #222;
        font-weight: 600;
    }
    tbody tr:nth-child(even) {
        background-color: #d9f0d9;
    }
    tbody tr td {
        padding: 12px 20px;
    }

    .priority {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .complete-btn {
        background-color: #4caf50;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: 700;
        padding: 8px 14px;
        cursor: pointer;
    }
    .complete-btn:hover {
        background-color: #3a9e3a;
    }
    .info-btn {
        background: #2196f3;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 6px 10px;
        cursor: pointer;
        font-weight: 600;
    }
    .info-btn:hover {
        background: #1976d2;
    }
</style>
</head>
<body>

<header>
    <div class="logo">SmartWaste</div>
    <nav>
        <button>🏠 Home</button>
        <button>🌐 Language</button>
        <button>⚙️ Settings</button>
    </nav>
</header>

<!-- Dashboard summary -->
<section class="dashboard-summary">
    <div class="summary-box">
        <div class="number"><?= $dashboard['pending_requests'] ?></div>
        <div>⌛ Pending Requests</div>
    </div>
    <div class="summary-box">
        <div class="number"><?= $dashboard['completed_today'] ?></div>
        <div>✔️ Completed Today</div>
    </div>
    <div class="summary-box">
        <div class="number"><?= $dashboard['urgent_requests'] ?></div>
        <div>⚠️ Urgent Requests</div>
    </div>
</section>

<!-- Sliding Tabs -->
<section class="tabs-headings">
    <div>Pending Pickup Requests</div>
    <div>Your Schedule Requests</div>
    <div>Cleaner man Requests</div>
    <div>Waste pickup Requests</div>
    <div>Emergency Pickup Requests</div>
</section>

<!-- Request Lists -->
<?php foreach ($requests as $area => $items): ?>
<section class="area">
    <h2>📍 <?= htmlspecialchars($area) ?></h2>
    <table>
        <thead>
            <tr>
                <th>House No</th>
                <th>Time</th>
                <th>Priority</th>
                <th>Instructions</th>
                <th>Action</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $request): ?>
            <tr>
                <td>🏠 <?= htmlspecialchars($request['house_no']) ?></td>
                <td><?= htmlspecialchars($request['time']) ?></td>
                <td class="priority" style="color: <?= htmlspecialchars($request['priority_color']) ?>;">
                    🚩 <?= htmlspecialchars($request['priority']) ?>
                </td>
                <td><?= htmlspecialchars($request['instructions']) ?></td>
                <td><button class="complete-btn">✔ Complete</button></td>
                <td><button class="info-btn">ℹ Info</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?php endforeach; ?>

</body>
</html>
