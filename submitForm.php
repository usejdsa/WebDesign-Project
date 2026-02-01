<?php
require_once './database/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->getConnection();

    $type = $_POST['type'] ?? 'contact';
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email";
        exit;
    }

    if ($type === 'newsletter') {
        $stmt = $conn->prepare("INSERT INTO submissions (type, email) VALUES ('newsletter', :email)");
        try {
            $stmt->execute([':email' => $email]);
            echo "Subscribed successfully!";
        } catch (PDOException $e) {
            echo "Already subscribed or error.";
        }
    } else {
        $first_name = $_POST['first_name'] ?? null;
        $last_name = $_POST['last_name'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $subject = $_POST['subject'] ?? null;
        $message = $_POST['message'] ?? null;

        $stmt = $conn->prepare("
            INSERT INTO submissions 
            (type, first_name, last_name, email, phone, subject, message) 
            VALUES 
            ('contact', :first_name, :last_name, :email, :phone, :subject, :message)
        ");
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message
        ]);
        echo "Message sent successfully!";
    }
    exit;
}
?>
