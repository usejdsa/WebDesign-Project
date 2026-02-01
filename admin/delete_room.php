<?php
session_start();
if(!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role']!=='admin'){
    header('Location: ../Sign-in.php');
    exit;
}

require_once '../database/Room.php';

if(isset($_GET['id'])){
    $room = new Room();
    $room->deleteRoom($_GET['id']);
    header('Location: RoomsAdmin.php');
    exit;
}
