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

  <ul class="flex flex-col sm:flex-row ">
  <li 
  onclick="openTab(event, 'tab1')" 
  class=" tab-btn  ">
  
  Profile
  </li>
  <?php 
 
  if (($_SESSION['user']['user_type']  == "chef")) {

    echo '<li 
    onclick="openTab(event, "tab2")"
     class="tab-btn inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border border-gray-200
      text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none
        sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg ">
        Recipe
      </li>
      <li  onclick="openTab(event, "tab3")" 
      class="tab-btn inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border border-gray-200 text-gray-800 -mt-px first:rounded-t-lg 
      first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none 
      sm:last:rounded-se-lg ">
        Create Recipe
      </li>
      ';
  }


  ?>
  
 
</ul>


    <div>
        <div id="tab1" class="tab-content block">
           <?php include('./editeProfile.php'); ?>
        </div>
  
        <div id="tab2" class="tab-content hidden">
           <?php include('./recipeList.php'); ?>
        </div>
   
        <div id="tab3" class="tab-content hidden">
           <?php include('./createRecipe.php'); ?>
   
        </div>
    </div>
  </div>

</body>
</html>