<?php
session_start();
if (!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role'] !== 'admin') {
    header('Location: ../Sign-in.php');
    exit;
}

require_once '../database/Database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new Database();
    $conn = $db->getConnection();

    // Bëj dhomën available
    $stmt = $conn->prepare("UPDATE rooms SET status='available' WHERE id=:id");
    $stmt->execute([':id'=>$id]);

    header('Location: RoomsAdmin.php');
    exit;
}
?>
