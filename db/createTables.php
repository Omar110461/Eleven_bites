<?php 


$sql = "CREATE TABLE IF NOT EXISTS  users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(80) NOT NULL,
    email VARCHAR(50),
    img_url VARCHAR(50),
    user_type VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

$sqlRecipe = "CREATE TABLE IF NOT EXISTS recipe (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(30) NOT NULL,
    description  TEXT(5000) NOT NULL,
    category VARCHAR(50),
    img_url  TEXT(5000) NOT NULL,
    chef_id INT(6) UNSIGNED,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_Recipe_user FOREIGN KEY (chef_id) REFERENCES users(id)
    )";
    

       
    if ($conn->query($sql) === TRUE) {
      echo "Table users created successfully";
    } else {
      echo "Error creating table: users " . $conn->error;
    }

    if ($conn->query($sqlRecipe) === TRUE) {
        echo "Table Recipe created successfully";
      } else {
        echo "Error creating table: Recipe " . $conn->error;
      }
    $conn->close();

    
?>