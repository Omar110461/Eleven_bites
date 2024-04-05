<?php

session_start();

session_destroy();


// if (!isset($_SESSION['user'])){
 header("Location: login.php");
// }

?>