<?php
session_start();
require_once './database/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nights = $_POST['nights'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT status FROM rooms WHERE id=:id");
    $stmt->execute([':id'=>$roomId]);
    $room = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$room || $room['status'] != 'available') {
        die("This room is already booked!");
    }

    $stmt = $conn->prepare("INSERT INTO bookings (room_id, customer_name, customer_email, nights, guests, checkin_date) 
                            VALUES (:room_id, :name, :email, :nights, :guests, :date)");
    $stmt->execute([
        ':room_id'=>$roomId,
        ':name'=>$name,
        ':email'=>$email,
        ':nights'=>$nights,
        ':guests'=>$guests,
        ':date'=>$date
    ]);

    $stmt = $conn->prepare("UPDATE rooms SET status='unavailable' WHERE id=:id");
    $stmt->execute([':id'=>$roomId]);

    header("Location: Rooms.php?booked=success");
    exit;
}
?>
