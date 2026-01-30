<?php
session_start();
if (!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role'] !== 'admin') {
    header('Location: ../Sign-in.php');
    exit;
}

require_once '../database/Database.php';

$db = new Database();
$conn = $db->getConnection();

// Merr të gjitha dhomat
$stmt = $conn->prepare("SELECT * FROM rooms ORDER BY id DESC");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/admin-room.css"> 
<title>Admin Panel - Rooms</title>
</head>
<body>
<header>
    <h2>Admin Panel - Rooms</h2>
    <a href="../Home.php">Back to Home</a>
    <span>Signed in as <strong><?= htmlspecialchars($_SESSION['logged_in_user']['username']) ?></strong></span>
    <a href="../Logout.php">Logout</a>
</header>

<main>
<h3>Add New Room</h3>
<form action="add_room.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Room Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price_per_night" placeholder="Price per night" step="0.01" required>
    <input type="file" name="image" accept="image/*" required>
    <label>
        <input type="checkbox" name="is_featured" value="1"> Featured
    </label>
    <label>
        Status:
        <select name="status">
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select>
    </label>
    <button type="submit">Add Room</button>
</form>

<h3>All Rooms</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Status</th>
        <th>Featured</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
    <tr>
        <td><?= $room['id'] ?></td>
        <td><?= htmlspecialchars($room['name']) ?></td>
        <td><img src="../assets/images/<?= $room['image'] ?>" width="100"></td>
        <td>€<?= $room['price_per_night'] ?></td>
        <td><?= $room['status'] ?></td>
        <td><?= $room['is_featured'] ? 'Yes' : 'No' ?></td>
        <td>
            <a href="edit_room.php?id=<?= $room['id'] ?>">Edit</a> | 
            <a href="delete_room.php?id=<?= $room['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</main>
</body>
</html>
