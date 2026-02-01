<?php
session_start();
if(!isset($_SESSION['logged_in_user']) || $_SESSION['logged_in_user']['role']!=='admin'){
    header('Location: ../Sign-in.php');
    exit;
}

require_once '../database/Room.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $image = null;
    if(isset($_FILES['image']) && $_FILES['image']['error']===0){
        $image = time().'_'.basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/'.$image);
    }

    $room = new Room();
    $room->updateRoom($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price_per_night'],
                      $_POST['status'], isset($_POST['is_featured'])?1:0, $image);

    header('Location: RoomsAdmin.php');
    exit;
}
