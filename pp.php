
<?php
// Simulate data storage (in a real app, use a database)
session_start();
if (!isset($_SESSION['requests'])) {
    $_SESSION['requests'] = [
        'Downtown' => [
            ['house_no' => 101, 'time' => '19:22', 'priority' => 'Urgent', 'instructions' => 'Empty the blue bin', 'completed' => false],
            ['house_no' => 102, 'time' => '14:15', 'priority' => 'Soon', 'instructions' => '-', 'completed' => false],
        ],
        'Northside' => [
            ['house_no' => 123, 'time' => '16:45', 'priority' => 'Urgent', 'instructions' => 'Collect cardboard boxes', 'completed' => false],
        ],
    ];
}
// Handle form submission: mark request as complete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['area']) && isset($_POST['house_no'])) {
    $area = $_POST['area'];
    $house_no = intval($_POST['house_no']);
    foreach ($_SESSION['requests'][$area] as &$request) {
        if ($request['house_no'] === $house_no) {
            $request['completed'] = true;
            break;
        }
    }
    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
// Function to color priority
function priorityLabel($priority) {
    switch (strtolower($priority)) {
        case 'urgent':
            return "<span style='color:red;'>⚐ $priority</span>";
        case 'soon':
            return "<span style='color:#cc9900;'>⚐ $priority</span>";
        default:
            return $priority;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>SmartWaste Requests</title>
<style>
    body { background: #171926; color: #eee; font-family: Arial, sans-serif; }
    table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
    th, td { padding: 10px; border: 1px solid #444; text-align: left; }
    th { background: #222533; }
    tbody tr:nth-child(odd) { background: #ffffff10; }
    tbody tr.completed { background: #b7d7a8; color: #444; text-decoration: line-through; }
    button.complete-btn { background: #4CAF50; border: none; border-radius: 5px; color: white; padding: 7px 12px; cursor: pointer; font-weight: bold; }
    button.complete-btn:disabled { background: #888; cursor: default; }
    h3 { color: #49a349; }
    .info-icon {
        font-weight: bold; 
        border: 2px solid #000; 
        background: #eee; 
        color: #000; 
        border-radius: 50%; 
        width: 20px; 
        height: 20px; 
        display: inline-block; 
        text-align: center; 
        line-height: 18px;
        cursor: pointer;
    }
</style>
</head>
<body>
<?php foreach ($_SESSION['requests'] as $area => $requests): ?>
    <h3>📍 <strong><?= htmlspecialchars($area) ?></strong></h3>
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
        <?php foreach ($requests as $request): ?>
            <tr class="<?= $request['completed'] ? 'completed' : '' ?>">
                <td>🏠 <?= htmlspecialchars($request['house_no']) ?></td>
                <td><?= htmlspecialchars($request['time']) ?></td>
                <td><?= priorityLabel($request['priority']) ?></td>
                <td><?= htmlspecialchars($request['instructions']) ?></td>
                <td>
                    <?php if (!$request['completed']): ?>
                    <form method="post" style="margin:0;">
                        <input type="hidden" name="area" value="<?= htmlspecialchars($area) ?>">
                        <input type="hidden" name="house_no" value="<?= htmlspecialchars($request['house_no']) ?>">
                        <button type="submit" class="complete-btn">✔ Complete</button>
                    </form>
                    <?php else: ?>
                    Completed
                    <?php endif; ?>
                </td>
                <td><span class="info-icon" title="More info">i</span></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>
</body>
</html>

<?php


