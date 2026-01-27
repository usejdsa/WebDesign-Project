<?php
require 'db.php';

// Marrim të gjithë user-at
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

// Shfaqim në browser
echo "<h2>Users nga databaza:</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Password (hashed)</th><th>Role</th></tr>";

foreach ($users as $user) {
    echo "<tr>";
    echo "<td>{$user['id']}</td>";
    echo "<td>{$user['username']}</td>";
    echo "<td>{$user['email']}</td>";
    echo "<td>{$user['password']}</td>";
    echo "<td>{$user['role']}</td>";
    echo "</tr>";
}

echo "</table>";
?>