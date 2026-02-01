<?php
require_once '../database/Database.php';

class Booking {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllBookings() {
        $stmt = $this->conn->prepare("
            SELECT b.id, r.name AS room_name, b.customer_name, b.customer_email, 
                   b.nights, b.guests, b.checkin_date
            FROM bookings b
            JOIN rooms r ON b.room_id = r.id
            ORDER BY b.checkin_date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
