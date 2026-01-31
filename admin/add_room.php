<?php
session_start();
if (!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role'] !== 'admin') {
    header('Location: ../Sign-in.php');
    exit;
}

require_once '../database/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price_per_night'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $status = $_POST['status'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imgName = time() . '_' . basename($_FILES['image']['name']);
        $target = '../assets/images/' . $imgName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $db = new Database();
            $conn = $db->getConnection();

            $stmt = $conn->prepare("INSERT INTO rooms (name, description, price_per_night, image, is_featured, status) 
                                    VALUES (:name, :desc, :price, :image, :featured, :status)");
            $stmt->execute([
                ':name' => $name,
                ':desc' => $description,
                ':price' => $price,
                ':image' => $imgName,
                ':featured' => $is_featured,
                ':status' => $status
            ]);
            header('Location: RoomsAdmin.php');
            exit;
        } else {
            echo "Error uploading image.";
        }
    }
}
?>
