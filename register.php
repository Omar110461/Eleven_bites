<?php 

include(dirname(__FILE__) . '/uitility/inputCheck.php');
include(dirname(__FILE__) . '/db/index.php');

$errorMessage ;
$username = $password = $email = $user_type = "";
$validated = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST["password"]) ) {
        $errorMessage['password'] = "Password is required";
        $validated = false;
      } else { $validated = true; }

      if (empty($_POST["username"])) {    
        $validated = false;
        $errorMessage['username'] = "Username is required";
      }{ $validated = true;}

      if (empty($_POST["email"])) {    
        $validated = false;
        $errorMessage['email'] = "Email is required";
       
      }{ $validated = true;}
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage['email']= "Invalid email format";
      }{ $validated = true;}

      if (empty($_POST["user_type"])) {    
        $validated = false;
        $errorMessage['user_type'] = "User type is required";
      }{ $validated = true;}
      
      
      if($validated){

        $password  = validat_input($_POST["password"]);
        $username  = validat_input($_POST["username"]);
        $user_type = validat_input($_POST["user_type"]);
        $email     = validat_input($_POST["email"]);

        $sql = 'SELECT * FROM users where username= :username and email = :email  ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['username' => $username, 'email' => $email]);
        $user = $stmt->fetch();

        if ($user){
          $errorMessage['username'] = "Username not valid";
        }
        if (!$user){
        
                $hashPassword =  password_hash($password, PASSWORD_DEFAULT);
           
                $createSql = 'INSERT into users (username, password, email, user_type ) Value (:username, :password, :email, :user_type )';

                $stmtDB = $conn->prepare($createSql);
                $stmtDB->execute(['username' => $username, 'email' => $email, 'user_type'=> $user_type, 'password' => $hashPassword  ]);

         
                if ($stmtDB) {
                    $sql = 'SELECT * FROM users where username= :username and email = :email  ';
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(['username' => $username, 'email' => $email]);
                    $userDB = $stmt->fetch();
            
                    if ($userDB){
                      $_SESSION['user'] = $userDB;
                      header('Location: home.php');
                    }
                }
              }
        // }
   
    }


}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link  href="" rel="stylesheet"    />
    <script src="https://cdn.tailwindcss.com"></script>
    <title></title>
  </head>
  <body>

<div class="max-w-screen h-screen mx-auto">

  <div class="grid md:grid-cols-2 items-center gap-12  h-screen">

  <?php include(dirname(__FILE__) .'/component/authSideBg.php'); ?>



    <div class="relative ">

      <div class="flex flex-col border rounded-xl p-4 sm:p-6 lg:p-10 ">
        <h2 class="text-xl font-semibold text-gray-800 ">
         Register 
        </h2>

        <form action="register.php" method="post">
          <div class="mt-6 grid gap-4 lg:gap-6">

     
              <div>
                <label for="hs-firstname-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">User Name</label>
                <input type="text" name="username" id="hs-firstname-hire-us-1"
                 class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
          
      
                 <p class='text-red-500'>  <?php echo $errorMessage['username'] ?? ''?></p>
                </div>

                <div>
                <label for="hs-firstname-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">Email</label>
                <input type="text" name="email" id="hs-firstname-hire-us-1"
                 class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
          
                 <p class='text-red-500'>  <?php echo $errorMessage['email'] ?? ''?></p>
                </div>

              <div>
                <label for="hs-lastname-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">Password</label>
                <input type="password" name="password" id="hs-lastname-hire-us-1" 
                class="py-3 px-4 block border w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
           
              <p class='text-red-500'>  <?php echo $errorMessage['password'] ?? ''?></p>
            </div>
    
      

        <div>
              <label for="hs-work-email-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">User type</label>
              <select  name="user_type" required class="py-3 px-4 border block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                  <option value="chef">Chef</option>
                  <option value="learner">Learner</option>
              </select>

              <p class='text-red-500'>  <?php echo $errorMessage['user_type'] ?? ''?></p>
            </div> 

       

       
          </div>
          <div class="mt-3 flex">
         
            <div class="">
              <label for="remember-me" class="text-sm text-gray-600 dark:text-gray-400">
                  If you have an account
                   <a class="text-blue-600 decoration-2 hover:underline font-medium" href="login.php">Login</a></label>
            </div>
          </div>

          <div class="mt-6 grid">
            <button type="submit" 
            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold
             rounded-lg border border-transparent 
            bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none ">Submit</button>
          </div>
        </form>

        <div class="mt-3 text-center">
          <p class="text-sm text-gray-500">
   .
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
</html>