<?php
require_once 'Database.php';

class Room {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Get all rooms
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM rooms ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get one room by ID
    public function getRoomById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM rooms WHERE id=:id");
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add room
    public function addRoom($name, $description, $price, $status, $is_featured, $image = null) {
        $stmt = $this->conn->prepare("INSERT INTO rooms (name, description, price_per_night, status, is_featured, image)
                                      VALUES (:name, :desc, :price, :status, :featured, :image)");
        return $stmt->execute([
            ':name'=>$name,
            ':desc'=>$description,
            ':price'=>$price,
            ':status'=>$status,
            ':featured'=>$is_featured,
            ':image'=>$image
        ]);
    }

    // Update room
    public function updateRoom($id, $name, $description, $price, $status, $is_featured, $image = null) {
        $sql = "UPDATE rooms SET name=:name, description=:desc, price_per_night=:price, status=:status, is_featured=:featured";
        if ($image) $sql .= ", image=:image";
        $sql .= " WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        $params = [
            ':name'=>$name,
            ':desc'=>$description,
            ':price'=>$price,
            ':status'=>$status,
            ':featured'=>$is_featured,
            ':id'=>$id
        ];
        if ($image) $params[':image'] = $image;

        return $stmt->execute($params);
    }

    // Delete room
    public function deleteRoom($id) {
        $stmt = $this->conn->prepare("DELETE FROM rooms WHERE id=:id");
        return $stmt->execute([':id'=>$id]);
    }
}
?>
