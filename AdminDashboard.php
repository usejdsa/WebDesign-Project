<?php
session_start();

if (!isset($_SESSION['logged_in_user'])) {
    header("Location: Sign-in.php");
    exit;
}

if ($_SESSION['logged_in_user']['role'] !== 'admin') {
    header("Location: Home.php");
    exit;
}

include_once 'database/Database.php';
include_once 'database/User.php';

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT username, email, role FROM user");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalUsers = count($users);
$totalAdmins = count(array_filter($users, fn($u) => $u['role'] === 'admin'));
$totalRegular = count(array_filter($users, fn($u) => $u['role'] === 'user'));
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>

<div class="admin-layout">

    <aside class="admin-sidebar">
        <h2>Admin Panel</h2>
        <a href="AdminDashboard.php" class="active">Dashboard</a>
        <a href="Home.php">View Website</a>
        <a href="Logout.php">Logout</a>
    </aside>

    <main class="admin-content">

        <div class="admin-topbar">
            <h1>Dashboard</h1>
            <p>Welcome back, <?php echo htmlspecialchars($_SESSION['logged_in_user']['username']); ?></p>
        </div>

        <section class="admin-stats">
            <div class="admin-card">
                <h3>Total Users</h3>
                <p><?php echo $totalUsers; ?></p>
            </div>

            <div class="admin-card">
                <h3>Admins</h3>
                <p><?php echo $totalAdmins; ?></p>
            </div>

            <div class="admin-card">
                <h3>Users</h3>
                <p><?php echo $totalRegular; ?></p>
            </div>
        </section>

        <section class="admin-card">
            <h3>Registered Users</h3>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['username']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td class="<?php echo $u['role'] === 'admin' ? 'role-admin' : 'role-user'; ?>">
                            <?php echo strtoupper($u['role']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    </main>

</div>

</body>
</html>
