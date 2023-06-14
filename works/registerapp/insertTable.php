<?php 
if(!isset($_SESSION['register'])){
  header('Location: index.php');
  exit();
}

require_once('database/dbConnect.php'); 
$insert = $db->prepare('INSERT INTO people SET lastName=?, middleName=?, firstName=?, email=?');
$insert->execute(array($_SESSION['register']['lastName'], $_SESSION['register']['middleName'], $_SESSION['register']['firstName'], $_SESSION['register']['email']));
