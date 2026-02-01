<?php
session_start();
require_once './database/Database.php';

if (!isset($_SESSION['logged_in_user'])) {
    header('Location: Sign-in.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $nights = (int)$_POST['nights'];
    $guests = (int)$_POST['guests'];
    $date = $_POST['date'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<script>alert('Invalid email address!'); window.history.back();</script>");
    }

    // Validate date is not in the past
    $checkinDate = new DateTime($date);
    $today = new DateTime();
    $today->setTime(0, 0, 0);
    
    if ($checkinDate < $today) {
        die("<script>alert('Check-in date cannot be in the past!'); window.history.back();</script>");
    }

    // Validate date is within reasonable range (next 2 years)
    $maxDate = new DateTime();
    $maxDate->modify('+2 years');
    
    if ($checkinDate > $maxDate) {
        die("<script>alert('Check-in date must be within the next 2 years!'); window.history.back();</script>");
    }

    // Validate nights
    if ($nights < 1 || $nights > 365) {
        die("<script>alert('Number of nights must be between 1 and 365!'); window.history.back();</script>");
    }

    $db = new Database();
    $conn = $db->getConnection();

    // Check if room exists
    $stmt = $conn->prepare("SELECT id FROM rooms WHERE id=:id");
    $stmt->execute([':id'=>$roomId]);
    $room = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$room) {
        die("<script>alert('Room not found!'); window.history.back();</script>");
    }

    // Check if room is available for the requested dates
    $checkoutDate = clone $checkinDate;
    $checkoutDate->modify("+{$nights} days");
    
    $stmt = $conn->prepare("
        SELECT COUNT(*) as conflicts 
        FROM bookings 
        WHERE room_id = :room_id 
        AND (
            (checkin_date <= :checkin AND DATE_ADD(checkin_date, INTERVAL nights DAY) > :checkin)
            OR (checkin_date < :checkout AND DATE_ADD(checkin_date, INTERVAL nights DAY) >= :checkout)
            OR (checkin_date >= :checkin AND DATE_ADD(checkin_date, INTERVAL nights DAY) <= :checkout)
        )
    ");
    $stmt->execute([
        ':room_id' => $roomId,
        ':checkin' => $date,
        ':checkout' => $checkoutDate->format('Y-m-d')
    ]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['conflicts'] > 0) {
        die("<script>alert('This room is already booked for the selected dates!'); window.history.back();</script>");
    }

    // Insert booking
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

    // Mark room as unavailable
    $stmt = $conn->prepare("UPDATE rooms SET status='unavailable' WHERE id=:id");
    $stmt->execute([':id'=>$roomId]);

    header("Location: Rooms.php?booked=success");
    exit;
}
?>
