<?php

include('../uitility/inputCheck.php');
include('../db/index.php');
$_SESSION['selecedPage'] = 'profile';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>
  <title>Document</title>
</head>
<body>

<?php  include('../component/navBar.php'); ?>

<div class="sm:ml-24 sm:p-4">
  <div class="flex-shrink-0 group block my-4">
  <div class="flex items-center">
    <img class="inline-block flex-shrink-0 size-[62px] rounded-full" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80" alt="Image Description" />
    <div class="ms-3">
      <h3 class="font-semibold text-gray-800 ">   <?php echo $_SESSION["user"]['username'] ?>   </h3>
      <p class="text-sm font-medium text-gray-400">   <?php echo $_SESSION["user"]['email'] ?>   </p>
    </div>
  </div>
</div>

  <div class="flex flex-col sm:flex-row gap-5 item-center">
  <a  class="tab-btn bg-green-600 px-3 text-white p-1 rounded"> Profil </a>

  <?php 
  if (($_SESSION['user']['user_type']  == "chef")) {
    echo '<a href="/profile/recipeList.php"  class="tab-btn ">
        Recipe
      </a>
      <a href="/profile/createRecipe.php"   class="tab-btn">
        Create Recipe
      </a>
      ';
  }
  ?>
 
</div>

<?php include('./editeProfile.php'); ?>


  </div>


  


</body>
</html>