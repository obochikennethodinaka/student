
    <?php

    require "header.php";

    $msg = "";


    if (isset($_POST['register'])) {
        $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $ConfirmPwd = mysqli_real_escape_string($conn,$_POST['ConfirmPwd']);


        if (strlen($firstName) >= 5) {
            if (strlen($lastName) >= 5) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if (strlen($phone) >= 5) {
                        if (strlen($password) >= 5) {
                            if ($ConfirmPwd == $password) {

                                // password hashing
                                $hash = password_hash($password, PASSWORD_DEFAULT);

                                // INSERTING FORM INTO TABLE users_reg
                                $user_insert = "INSERT INTO user_reg1 (firstName,lastName,email,phone,password) VALUE('$firstName', '$lastName', '$email','$phone', '$hash')";
                                $user_insert_exc = mysqli_query($conn,$user_insert);

                                if ($user_insert_exc) {
                                    $error = "Registration Successful";
                                    $msg = "<div class='alert alert-danger'>$error</div>";

                                


                                } else {
                                    $error = "Registration not Successful";
                                    $msg = "<div class='alert alert-danger'>$error</div>";

                                    
                                }
                                

                            } else {
                                $error = "Comfirm Password";
                                $msg = "<div class='alert alert-danger'>$error</div>";
                            }
                        } else {
                            $error = "Password must be more than 5 digits";
                            $msg = "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {
                        $error = "Invalid Email address";
                        $msg = "<div class='alert alert-danger'>$error</div>";
                    }
                    
                } else {
                    $error = "Phone Number must be 11 digits";
                    $msg = "<div class='alert alert-danger'>$error</div>";
                }
                
            } else {
                $error = "Last Name must be 5 character and above";
                $msg = "<div class='alert alert-danger'>$error</div>";
            }
            
        } else {
            $error = "First Name must be 5 character and above";
            $msg = "<div class='alert alert-danger'>$error</div>";
        }
        
    };

    ?>

   <div class="row container justify-content-around">
            <div class="col-11 text-center bg-prima ry d-flex justify-content-start align-items-center">
                <span style="font-size: 45px; font-weight: bolder; color: green;"> {CODE</span>
                <span style="font-size: 50px; font-weight: bolder; color: goldenrod;">HUB}</span>
            </div>
    </div>
    <div class="d-block justify-content-center align-items-center container-lg " style="width: 100%;">

     <div class="row container my-5 d-flex justify-content-center align-items-center form-control border-0 shadow-sm" style="background-color: rgba(207, 207, 211, 0.075);">
        <form action="register.php" method="POST" >
            <div><?= $msg ?></div>
            <div class="co l-md-8 mb-3 d-flex bg-pr imary gap-5 " style="width: 100%; border-bottom: 2px solid rgb(45, 94, 78);">
                <h1 style="font-size: 45px; font-weight: md; color: rgb(45, 94, 78);" class="text-center col-12">Registeration</h1>
            </div>

            <div class="d-flex flex-wrap justify-content-around align-items-center text-center" style="width: 100%;"> 

                <div class="co l-md-8 mb-3 d-flex bg- primary gap-5" style="width: 90%;">
                    <input type="text" class="form-control" placeholder="First Name" name="firstName" aria-label="First name">
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" aria-label="Last name">
                </div>

                <div class="co l-md-8 mb-3 d-flex bg- primary gap-5" style="width: 90%;">
                    <input type="text" class="form-control" placeholder="Last Name" name="lastName" aria-label="Last name">
                    <input type="text" class="form-control" placeholder="Email" name="email" aria-label="Last name">
                </div>

                <div class="co l-md-8 mb-3 d-flex bg- primary gap-5" style="width: 90%;">
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" aria-label="Last name">
                    <input type="text" class="form-control" placeholder="Password" name="password" aria-label="Last name">
                </div>
                <div class="co l-md-8 mb-3 d-flex bg- primary gap-5" style="width: 90%;">
                    <input type="text" class="form-control" placeholder="Confirm Pssword" name="ConfirmPwd" aria-label="Last name">
                    <input type="text" class="form-control" placeholder="Confirm Pssword" name="ConfirmPwd" aria-label="Last name">
                </div>
                
                <div class=" d-flex justify-content-center align-items-center mt-5 mb-3" style="width: 90%;">
                  
                    <div class="col-md-5 mb-3 d-flex justify-content-center align-items-center">
                        
                        <input type="submit" class="form-control b tn bt n-primary h2 text-white fw-bold d-flex justify-content-center align-items-center " style="background-color: crimson; height: 55px; font-size: 30px;" value="Register" name="register">
                    </div>
                </div>

                <div class=" d-block justify-content-center align-items-center m y-3 text-center" style="width: 90%;">
                      <h5>Already Have An Account <a class="btn btn-primary" href="login.php">LogIn</a></h5>
                    <h5><span style="background-color: crimson; height: 55px; color: white;" class="px-2 mx-2"  >@</span>Lorem ipsum dolor sit amet, consectetur adipisicing <br>elit. <span style="color: rgb(5, 189, 127);">Illo modi ex facere, quidem nisi sapiente.</span></h5>
                </div>


            </div>

        </form>
    </div>
   </div>
    


    <?php


    require "footer.php";
    
    
    ?>
