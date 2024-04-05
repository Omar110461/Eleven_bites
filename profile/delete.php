<?php

include('../db/index.php');
include('../uitility/inputCheck.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int) validat_input($_POST["id"]);

    $sqlDelete =  "DELETE FROM recipe WHERE recipe_id = :id";
    
    $stmtDB = $conn->prepare($sqlDelete);

    $stmtDB->execute(['id' => $id ]);

    if ($stmtDB->rowCount() > 0) {
        echo 'Records deleted successfully';
        header("Location: /profile/recipeList.php");
        exit(); 
    } else {
        echo "No records deleted.";
    }

    


}

?>
