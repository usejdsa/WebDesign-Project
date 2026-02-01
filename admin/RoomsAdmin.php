<?php
session_start();
if (!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role'] !== 'admin') {
    header('Location: ../Sign-in.php');
    exit;
}

require_once '../database/Database.php';

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT * FROM rooms ORDER BY id DESC");
$stmt->execute();
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="../css/admin-room.css"> 
<title>Admin Panel - Rooms</title>
</head>
<body>
<header>
    <h2>Admin Panel - Rooms</h2>
    
    <div class="seperate">
    <a href="AdminDashboard.php">Dashboard</a> 
    <a href="../Home.php">Back to Home</a>
    </div>

    <div class="seperate">
        <span>Signed in as <strong><?= htmlspecialchars($_SESSION['logged_in_user']['username']) ?></strong></span>  | 
        <a href="../Logout.php">Logout</a>
    </div>
</header>

<main>
<h3>Add New Room</h3>
<form action="add_room.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Room Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price_per_night" placeholder="Price per night" step="0.01" required>
    <input type="file" name="image" accept="image/*" required>
    <div class="room-status">
        <label class="checkbox">
             Featured<input type="checkbox" name="is_featured" value="1">
        </label>
        <label>
            Status:
            <select name="status">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </label>
    </div>
    <button type="submit" class="btn btn-red">Add Room</button>
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
        <td>
            <?= $room['status'] ?>
            <?php if ($room['status'] === 'unavailable'): ?>
                | <a href="make_available.php?id=<?= $room['id'] ?>" onclick="return confirm('Make this room available?')">Make Available</a>
            <?php endif; ?>
        </td>
        <td><?= $room['is_featured'] ? 'Yes' : 'No' ?></td>
        <td>
            <a href="javascript:void(0)" onclick='openEditModal(<?= json_encode($room) ?>)'>Edit</a> | 
            <a href="delete_room.php?id=<?= $room['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>

    </tr>
    <?php endforeach; ?>
</table>

<!-- EDIT ROOM MODAL -->
<div id="editRoomModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h3>Edit Room</h3>
        <form id="editRoomForm" action="edit_room.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="editRoomId">

            <label for="editRoomName">Room Name</label>
            <input type="text" name="name" id="editRoomName" required>

            <label for="editRoomDescription">Description</label>
            <textarea name="description" id="editRoomDescription" required></textarea>

            <label for="editRoomPrice">Price per Night</label>
            <input type="number" name="price_per_night" id="editRoomPrice" step="0.01" required>

            <label for="editRoomImage">Image (leave blank to keep current)</label>
            <input type="file" name="image" id="editRoomImage" accept="image/*">

            <label for="editRoomFeatured">
                <input type="checkbox" name="is_featured" id="editRoomFeatured"> Featured
            </label>

            <label for="editRoomStatus">Status</label>
            <select name="status" id="editRoomStatus">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>

            <button type="submit" class="btn btn-red">Save Changes</button>
        </form>
    </div>
</div>

</main>

<script>
    function openEditModal(room) {
        document.getElementById('editRoomModal').style.display = 'block';

        document.getElementById('editRoomId').value = room.id;
        document.getElementById('editRoomName').value = room.name;
        document.getElementById('editRoomDescription').value = room.description;
        document.getElementById('editRoomPrice').value = room.price_per_night;
        document.getElementById('editRoomFeatured').checked = room.is_featured == 1;
        document.getElementById('editRoomStatus').value = room.status;
    }

    function closeEditModal() {
        document.getElementById('editRoomModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('editRoomModal');
        if (event.target == modal) modal.style.display = 'none';
    }
</script>

</body>
</html>
