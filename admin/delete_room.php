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

    // Fshij foto nga folderi
    $stmt = $conn->prepare("SELECT image FROM rooms WHERE id=:id");
    $stmt->execute([':id'=>$id]);
    $img = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($img) {
        @unlink('../assets/images/' . $img['image']);
    }

    // Fshij dhomën nga DB
    $stmt = $conn->prepare("DELETE FROM rooms WHERE id=:id");
    $stmt->execute([':id'=>$id]);
    header('Location: RoomsAdmin.php');
    exit;
}
?>
