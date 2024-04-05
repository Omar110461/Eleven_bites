<?php 

    include('../uitility/inputCheck.php');
    include('../db/index.php');
    $_SESSION['selecedPage'] = 'profile';

    $chef =  $_SESSION['user']['id'];


    $limit = 10; 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $sqlRecipes = 'SELECT * FROM recipe where chef_id = :chef';
        $stmt = $conn->prepare($sqlRecipes);
        $stmt->execute(['chef' =>  $chef]);
        $recipes = $stmt->fetchAll();
        
        // var_dump($recipes)[0];

        $total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM recipe");
        $total_stmt->execute();
        $total_results = $total_stmt->fetch(PDO::FETCH_ASSOC)['total'];
        $total_pages = ceil($total_results / $limit);
    }
    
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
                <img class="inline-block flex-shrink-0 size-[62px] rounded-full"
                    src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
                    alt="Image Description" />
                <div class="ms-3">
                    <h3 class="font-semibold text-gray-800 "> <?php echo $_SESSION["user"]['username'] ?> </h3>
                    <p class="text-sm font-medium text-gray-400"> <?php echo $_SESSION["user"]['email'] ?> </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-5 item-center">
            <a class="tab-btn " href="/profile/index.php"> Profile </a>

            <?php 
  if (($_SESSION['user']['user_type']  == "chef")) {
    echo '<a href="/profile/recipeList.php"   class="tab-btn bg-green-600 px-3 text-white p-1 rounded">
        Recipe
      </a>
      <a href="/profile/createRecipe.php"   class="">
        Create Recipe
      </a>
      ';
  }
  ?>

        </div>

        <div class="max-w-[85rem] mt-5  mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden ">


                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 ">
                                                    Image
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 ">
                                                    Created by
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 ">
                                                    Content
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 ">
                                                    Date
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 ">
                                                    Status
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 ">
                                                    Action
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 ">
                                    <?php  foreach ($recipes as $recipeItmem ) : ?>


                                    <tr class="bg-white hover:bg-gray-50 ">
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="#">
                                                <div class="flex items-center gap-x-4">
                                                    <img class="flex-shrink-0 size-[38px] rounded-lg"
                                                        src="<?php echo  $recipeItmem['img_url'] ? $recipeItmem['img_url'] : 'https://t3.ftcdn.net/jpg/04/60/01/36/360_F_460013622_6xF8uN6ubMvLx0tAJECBHfKPoNOR5cRa.jpg'?>">
                                                    <!-- <div>
                        <span class="block text-sm font-semibold text-gray-800 ">
                         
                        </span>
                      </div> -->
                                                </div>
                                            </a>
                                        </td>

                                        <td class="h-px w-72 min-w-72 align-top">
                                            <a class="block p-6" href="#">

                                                <span class="block text-sm font-semibold text-gray-800 ">
                                                    <?php echo $recipeItmem['category'] ?></span>
                                            </a>
                                        </td>
                                        <td class="h-px w-72 min-w-72 align-top">
                                            <a class="block p-6" href="#">

                                                <span class="block text-sm font-semibold text-gray-800 ">
                                                    <?php echo $recipeItmem['title'] ?></span>
                                                <span class="block text-sm text-gray-500">
                                                    <?php echo $recipeItmem['description'] ?>.</span>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="#">
                                                <span class="text-sm text-gray-600 ">
                                                    <?php echo $recipeItmem['create_date'] ?></span>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="#">
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full ">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                    </svg>
                                                    Published
                                                </span>
                                            </a>
                                        </td>

                                        <td class="h-px w-fit align-top flex gap-1 item-center pt-6">


                                            <form method='POST' action='/profile/delete.php' class="block ">
                                                <input type="text" name='id' hidden
                                                    value='<?php echo $recipeItmem['recipe_id'] ?>'>
                                                <button type='submit'
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-700 text-white rounded-full ">
                                                    Delete
                                                </button>
                                            </form>
                                            <a class="block "
                                                href="/profile/editRecipe.php?recipe_id=<?php echo $recipeItmem['recipe_id'] ?>">
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-black text-white rounded-full ">
                                                    edit
                                                </span>
                                            </a>
                                        </td>
                                    </tr>


                                    <?php  endforeach ?>
                                </tbody>
                            </table>

                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 ">
                                <div class="max-w-sm space-y-3">
                                    <p
                                        class="py-2 px-3 pe-9 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 ">
                                   Total  <?php echo  $total_results  ?>
                                    </p>
                                </div>

                                <!-- <div>
                                    <div class="inline-flex gap-x-2">
                                        <button type="button"
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none  ">
                                            Next
                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
