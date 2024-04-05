<?php


include('../uitility/inputCheck.php');
include('../db/index.php');
$_SESSION['selecedPage'] = 'profile';

$uploadDir = '../uploads/';
$errorMessage ;
$img_url = $title = $desciption = $category =  "";
$validated =  false;


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['recipe_id'])) {

  
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $title = validat_input($_POST["title"]);
    $description = validat_input($_POST["description"]);
    $category = validat_input($_POST["category"]);

    $fileName = $uploadDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $fileName)) {
      $img_url = $fileName;
      // echo "File successfully uploaded $fileName";
    } else {
      echo "there was an error with the file"; 
    }


    $createSql = 'INSERT into recipe (title, description, category, chef_id , img_url) Value (:title, :description, :category, :chef_id , :img_url)';
    $stmtDB = $conn->prepare($createSql);
    $stmtDB->execute([
      'title'=> $title, 'description' => $description, 
      'category' => $category , 'chef_id' => $_SESSION['user']['id'],
      'img_url' => $img_url
     ]);
    $stmtRes = $stmtDB->fetch();
   
    var_dump( $stmtRes );
  

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
    echo '<a href="/profile/recipeList.php"  class="tab-btn ">
        Recipe
      </a>
      <a href=""   class="tab-btn bg-green-600 px-3 text-white p-1 rounded">
        Create Recipe
      </a>
      ';
  }
  ?>

        </div>
        <section class='w-1/2'>
            <form method="POST" enctype="multipart/form-data"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mt-6 grid gap-4 lg:gap-6">


                    <div>
                        <label for="hs-firstname-hire-us-1"
                            class="block mb-2 text-sm text-gray-700 font-medium ">Title</label>
                        <input type="text" name="title" value='<?php echo  $title?>' id="hs-firstname-hire-us-1"
                            required class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500
                  focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">

                    </div>

                  

                    <select  name="category"
                        class="py-3 px-4 border pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                       
                        <?php  foreach ($recipeCategories as $categorie  ) : ?>
                          
                             <option value =' <?php echo $categorie  ?>'> <?php echo $categorie  ?></option>
                        
                        <?php  endforeach ?>
                    </select>

                    <div>

                        <label for="hs-firstname-hire-us-1"
                            class="block mb-2 text-sm text-gray-700 font-medium ">Description</label>
                        <textarea type="text" name="description" rows="4" required value='<?php echo  $description?>'
                            class="py-3 px-4  border block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 
                focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">

                </textarea>

                    </div>

                    <div>
                        <label for="hs-firstname-hire-us-1"
                            class="block mb-2 text-sm text-gray-700 font-medium ">Image</label>
                        <input type="file" name="file" id="file" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500
                  focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">

                    </div>




                    <!-- <div>
              <label for="hs-work-email-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">User type</label>
              <select  name="user_type" required 
          
              class="py-3 px-4 border block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                  <option value="chef">Chef</option>
                  <option value="learner">Learner</option>
              </select>

            </div>  -->




                    <div class="mt-6 grid">
                        <button type="submit" name="submit" class="
            w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold
            rounded-lg border border-transparent   bg-green-600 text-white hover:bg-green-700 
            disabled:opacity-50 disabled:pointer-events-none ">submit</button>
                    </div>
            </form>

        </section>
</body>



</html>