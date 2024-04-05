<?php


include('./uitility/inputCheck.php');
include('./db/index.php');

// $_SESSION['selecedPage'] = 'home';
if (!isset($_SESSION['user'])){
    header("Location: login.php");
  }
  
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['recipe_id'])) {

    $recipe_id = $_GET['recipe_id'];

    $sqlRecipes = 'SELECT * FROM recipe INNER JOIN users  ON recipe.chef_id = users.id where recipe_id = :recipe_id';
    $stmt = $conn->prepare($sqlRecipes);
    $stmt->execute([':recipe_id' =>  $recipe_id]);
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);



}else{
    header("Location: home.php" );
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php  include(dirname(__FILE__) . '/component/navBar.php');?>


    <div class="max-w-3xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-2xl">
    
            <div class="flex justify-between items-center mb-6">
                <div class="flex w-full sm:items-center gap-x-5 sm:gap-x-3">
                    <div class="flex-shrink-0">
                        <img class="size-12 rounded-full"
                        src="<?php echo $recipe['img_url'] ? $recipe['img_url'] :
                     'https://site-images.similarcdn.com/url?url=https%3A%2F%2Fplay-lh.googleusercontent.com%2FuaTwQIlEjPHHsqdpnmxLoT_XAgFtLXCYFncGAc85xs0hoEnYqLiANRwjnQXzgLcDHxs%3Ds180&h=dcada0611cfbc2d0b01d7c854d6e3b7938d541940a571d06fe0dea864a91c260'?>"
                         alt="Image Description">
                    </div>

                    <div class="grow">
                        <div class="flex justify-between items-center gap-x-2">
                            <div>
                            
                                <div class="hs-tooltip inline-block [--trigger:hover] [--placement:bottom]">
                                    <div class="hs-tooltip-toggle sm:mb-1 block text-start cursor-pointer">
                                        <span class="font-semibold text-gray-800 ">
                                            <?php  echo $recipe['username'] ?>

                                        </span>

                                    </div>
                                </div>
                           

                                <ul class="text-xs text-gray-500">
                                    <li
                                        class="inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:size-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
                                        <?php  echo $recipe['email'] ?>
                                    </li>
                                    <!-- <li class="inline-block relative pe-6 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:size-1 before:bg-gray-300 before:rounded-full dark:text-gray-400 dark:before:bg-gray-600">
               
                                    8 min read
              
                                  </li> -->
                                </ul>
                            </div>

                       
                            <div>
                                <button type="button" class="py-1.5 px-2.5 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none
   ">

                                    <?php  echo $recipe['user_type'] ?>
                                </button>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="space-y-5 md:space-y-8">
                <div class="space-y-3">
                    <h2 class="text-2xl font-bold md:text-3xl "> <?php  echo $recipe['title'] ?></h2>

                    <p class="text-lg text-gray-800 "> <?php  echo $recipe['description'] ?></p>
                </div>

            

                <figure>
                    <img class="w-full object-cover rounded-xl"
                    src="<?php echo $recipe['img_url'] ? $recipe['img_url'] :
                     'https://site-images.similarcdn.com/url?url=https%3A%2F%2Fplay-lh.googleusercontent.com%2FuaTwQIlEjPHHsqdpnmxLoT_XAgFtLXCYFncGAc85xs0hoEnYqLiANRwjnQXzgLcDHxs%3Ds180&h=dcada0611cfbc2d0b01d7c854d6e3b7938d541940a571d06fe0dea864a91c260'?>"
                      alt="Image Description">
                    <!-- <figcaption class="mt-3 text-sm text-center text-gray-500">
                         A woman sitting at a table.
                        </figcaption> 
                    -->
                </figure>



                <div>
                    <a class="m-1 inline-flex items-center gap-1.5 py-2 px-3 rounded-full text-sm bg-gray-100 text-gray-800 hover:bg-gray-200 "
                        href="#">
                        <?php echo $recipe['category'] ?>
                    </a>


                </div>
            </div>
 
        </div>
    </div>



</body>

</html>