<section class='w-1/2'>
    <form action="register.php" method="post">
        <div class="mt-6 grid gap-4 lg:gap-6">


            <div>
                <label for="hs-firstname-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">User
                    Name</label>
                <input type="text" name="username" id="hs-firstname-hire-us-1"
                    value='<?php echo $_SESSION["user"]['username'] ?> ' 
                    class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500
                  focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">



            </div>

            <div>
                <label for="hs-firstname-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">Email</label>
                <input type="text" name="email" id="hs-firstname-hire-us-1"
                    value='<?php echo $_SESSION["user"]['email'] ?> '
                    class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">


            </div>

            <!-- <div>
                <label for="hs-lastname-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">Password</label>
                <input type="password" name="password" id="hs-lastname-hire-us-1"   value=''
                class="py-3 px-4 block border w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
           
           
            </div> -->



            <div>
                <label for="hs-work-email-hire-us-1" class="block mb-2 text-sm text-gray-700 font-medium ">User
                    type</label>
                <select name="user_type" required value='<?php echo $_SESSION["user"]['user_type'] ?> '
                    class="py-3 px-4 border block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                    <option value="chef">Chef</option>
                    <option value="learner">Learner</option>
                </select>

                <p class='text-red-500'> <?php echo $errorMessage['user_type'] ?? ''?></p>
            </div>




            <!-- <div class="mt-6 grid">
                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold
             rounded-lg border border-transparent 
            bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none ">Submit</button>
            </div> -->
    </form>

</section>