<?php

require "header.php";
session_start();
// if (!isset($_SESSION['id']) == 'id') {
//     header("Location: login.php");
// }

$msg = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($password) >= 5) {
            
            // select front table user_reg
            $select_user = "SELECT * FROM user_reg1 WHERE email = '$email'";
            $select_user_exc = mysqli_query($conn, $select_user);

            // checking if the user exist
            if (mysqli_num_rows($select_user_exc) > 0) {
                
                // fetching form information per row
                $row = mysqli_fetch_assoc($select_user_exc);

                if (password_verify($password, $row['password'])) {
                    
                    // SESSION
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["firstName"] = $row["firstName"];

                    // YOU CAN ALSO ADD "lastName" by adding "$_SESSION" for "lastName"

                    // $_SESSION["lastName"] = $row["lastName"];

                    // taking to dashboard page
                    header("Location: dashboard.php");
                } else {
                    // taking to login page
                    header("Location: register.php");
                }
                


            } else {
                # code...
            }
            


        } else {
            $error = "Invalid Email or Password";
            $msg = "<div class=' alert alert-danger'>$error</div>";
        }
        
        

    }else {
        $error = "Invalid Email or Password";
        $msg = "<div class=' alert alert-danger'>$error</div>";
    }
    
} 


?>



<div class="row container justify-content-around">
    <div class="col-11 text-center bg-prima ry d-flex justify-content-center align-items-center">
        <span style="font-size: 45px; font-weight: bolder; color: green;"> {CODE</span>
        <span style="font-size: 50px; font-weight: bolder; color: goldenrod;">HUB}</span>
    </div>
</div>

<div class="container r ow my-5 d-flex justify-content-center align-items-center" style="height: 400px;">

    <div class="d-flex justify-content-center align-items-center form-control border-0 shadow-sm" style="width: 80%; background-color: rgba(207, 207, 211, 0.075); width: 90%;">
        <?= $msg?>
        <form action="" method="POST" class="w-75" >
            <div class="mb-5">
                <div style="font-size: 40px; font-weight: normal;">Log in</div>
                <p style="font-weight: normal;">to start learning</p>
            </div>
            <div class="col-md-3 mb-3 w-100">
                <input type="email" style="height: 55px; " class="form-control" placeholder="Email" name="email" aria-label="Last name"> 
            </div>
            <div class="col-md-3 mb-3 w-100">
                <input type="password" style="height: 55px; " class="form-control" placeholder="Password" name="password" aria-label="Last name"> 
            </div>
            <div class=" d-flex justify-content-center align-items-center mt-4 mb-1" style="width: 100%;">
                <div class="col-md-3 mb-3 w-50">
                    <input type="submit" class="form-control b tn bt n-primary h2 text-white fw-bold d-flex justify-content-center align-items-center " style="background-color: rgb(97, 20, 220); height: 55px; font-size: 30px;" value="Login" name="login"> 
                </div>
            </div>
            <div class="text-center" style="width: 100%;">
                <strong><span class="mx-2">Dont have an account?</span><a href="register.php">Sign up now!</a></strong>
            </div>
        </form>
    </div>


</div>


<?php


require "footer.php"


?>