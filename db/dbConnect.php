<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$conn;

try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE  IF NOT EXISTS  umer_kichen";
  $conn->exec($sql);

  $conn->exec("USE umer_kichen");

  // echo "Database created successfully<br>";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

?>

