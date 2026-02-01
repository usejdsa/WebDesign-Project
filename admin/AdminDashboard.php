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

include_once '../database/Database.php';
include_once '../database/User.php';
include_once 'Booking.php';


$bookingObj = new Booking();
$bookings = $bookingObj->getAllBookings();

$db = new Database();
$conn = $db->getConnection();

// Get all submissions (newsletter + contact form)
$stmt2 = $conn->prepare("SELECT * FROM submissions ORDER BY created_at DESC");
$stmt2->execute();
$submissions = $stmt2->fetchAll(PDO::FETCH_ASSOC);


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

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="admin-layout">

    <aside class="admin-sidebar">
        <h2>Admin Panel</h2>
        <a href="AdminDashboard.php" class="active">Dashboard</a>
        <a href="../Home.php">View Website</a>
        <a href="RoomsAdmin.php">Rooms</a>
        <a href="../Logout.php">Logout</a>
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

        <section class="admin-card bookings-table">
            <h3>Bookings</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Nights</th>
                        <th>Guests</th>
                        <th>Check-in</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $b): ?>
                    <tr>
                        <td><?= $b['id'] ?></td>
                        <td><?= htmlspecialchars($b['room_name']) ?></td>
                        <td><?= htmlspecialchars($b['customer_name']) ?></td>
                        <td><?= htmlspecialchars($b['customer_email']) ?></td>
                        <td><?= $b['nights'] ?></td>
                        <td><?= $b['guests'] ?></td>
                        <td><?= $b['checkin_date'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

       <section class="admin-card  bookings-table">
            <h3>Form Submissions</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $s): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($s['type']); ?></td>
                            <td><?php echo $s['type'] === 'contact' ? htmlspecialchars($s['first_name']) : '-'; ?></td>
                            <td><?php echo $s['type'] === 'contact' ? htmlspecialchars($s['last_name']) : '-'; ?></td>
                            <td><?php echo htmlspecialchars($s['email']); ?></td>
                            <td><?php echo $s['type'] === 'contact' ? htmlspecialchars($s['phone']) : '-'; ?></td>
                            <td><?php echo $s['type'] === 'contact' ? htmlspecialchars($s['subject']) : '-'; ?></td>
                            <td><?php echo $s['type'] === 'contact' ? htmlspecialchars($s['message']) : '-'; ?></td>
                            <td><?php echo $s['created_at']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>



    </main>

</div>

</body>
</html>
