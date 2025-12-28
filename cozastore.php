<?php
require "header.php";
// FOR CATEGORY
$catpost = "SELECT * FROM category";
$catpost_exc = mysqli_query($conn,$catpost);

// FOR PRODUCT
$productpost = "SELECT * FROM product";
$productpost_exc = mysqli_query($conn,$productpost);


session_start();
// category sesion
if (!isset($_SESSION['id'])) {
    header("location: register.php");
    exit;
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../php_class/bootstrap5/bootstrap.min.css">
    <link rel="stylesheet" href="../php_class/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../php_class/bootstrap5/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/cozastore.css">
    <title>Document</title>
</head>
<body>
    


<a href="#" class="anchor"><i class="fa fa-arrow-up" style="color: black;"></i></a>
<!-- <a href="#" class="anchor"><i class="fa fa-arrow-up" style="color: black;"></i></a> -->

  <!-- top nav -->
     <div class="container-fluid bg-black lg-5  text-light w-100 d-flex align-items-center justify-content-center" style="height: 60px; overflow: hidden;">
    <div class="container-fluid w-90 ms-3" style="font-size: 12px;">
        Free Shipping For Standard Order Over $600
    </div>
    <span class="container-fluid d-flex align-items-center justify-content-center mt-3" style="font-size: 12px;">
        <p class="me-4"> HELP AND FAQ</p>
         <p class="me-4">My Accounts</p>
          <p class="me-4">USD</p>
           <p class="me-4">NAIRA</p>
    </span>
</div>


<!-- <img
                            src="../images/image-removebg-preview (18).png" height="20" width="20" class="mb-2" alt=""> -->

<!-- navigation bar -->
         <div class="container-fluid " style="background-color:lightgray;">
            <div class="navbar navbar-expand-md bg-sm-primary">
                <div class="navbar-brand">
                    <p class=" text-dark fw-bold f2 px-5 text-uppercase">
                        COZASTORE</p>
                </div>
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#demo">
                    <span class="navbar-toggler-icon bg-light rounded"></span>
                </button>
                <div class=" collapse navbar-collapse" id="demo">
                    <ul class="navbar-nav d-flex justify-content-end  w-100">
                        <li class="nav-item text-center fw-bold mb-3">
                            <a href="" class="nav-link text-danger">HOME</a>
                        </li>
                        <li class="nav-item text-center fw-lighter">
                            <a href="" class="nav-link text-darkt">SHOP</a>
                        </li>

                        <li class="nav-item text-center fw-lighter">
                            <a href="" class="nav-link text-dark">FEATURES</a>
                        </li>
                        <li class="nav-item text-center fw-lighter">
                            <a href="" class="nav-link text-dark">BLOG</a>
                        </li>
                        <li class="nav-item text-center fw-lighter">
                            <a href="category.php" class="nav-link text-dark">CATEGORY</a>
                        </li>
                            <li class="nav-item text-center fw-lighter">
                            <a href="dashboard.php" class="nav-link text-dark">DASHBOARD</a>
                        </li>
                          <li class="nav-item text-center fw-lighter">
                            <a href="product.php" class="nav-link text-dark">PRODUCT</a>
                        </li>
                        <li class="nav-item text-center fw-lighter">
                            <a href="" class="nav-link text-dark">ABOUT</a>
                        </li>
                          <li class="nav-item text-center fw-lighter">
                            <a href="" class="nav-link text-dark">CONTACT</a>
                        </li>
                        

                </div>
                 <div class="container-fluid d-flex justify-content-end ">
                    <span class="d-flex justify-content-end me-3">
                        <img src="../php_class/images1/image-removebg-preview (17).png" style="height: 30px; width: 30px;" alt=""><span
                                class="badge position-absolute top-0-start-100 translate-middle badge rounded-pill bg-danger">20</span>
                            <span class="visually-hidden">unread message</span></a>
                    </span>
                     <span class="d-flex justify-content-end me-3">
                        <img src="../php_class/images1/image-removebg-preview (20).png" style="height: 30px; width: 30px;" alt=""><span
                                class="badge position-absolute top-0-start-100 translate-middle badge rounded-pill bg-danger">20</span>
                            <span class="visually-hidden">unread message</span></a>
                    </span>
                     <span class="d-flex justify-content-end me-3">
                        <img src="../php_class/images1/image-removebg-preview (18).png" style="height: 30px; width: 30px;" alt=""><span
                                class="badge position-absolute top-0-start-100 translate-middle badge rounded-pill bg-danger">20</span>
                            <span class="visually-hidden">unread message</span></a>
                    </span>
                    
                    </div>
            </div>


            <!-- content -->
            <div class="row justify-content-center align-items-center mt-4">
                <div class="col-md-5">
                    <h5 class="text-dark text-capitalize creat">Men New-Season</h5>
                    <h1>JACKETS & COATS</h1>
                    <!-- <p>Lorem ipsum dolor sit, amet consectetur commodi ullam a tempora deserunt labore quam cumque
                        magnam. Minus officiis voluptas voluptatum placeat animi! Sapiente in voluptates debitis.</p> -->
                    <a class="btn btn-primary" href="#">LEARN MORE</a>
                    <!-- <button class="btn btn-white text-black log1 log">SIGNUP</button> -->
                </div>


                <div class="col-md-5 ">
                    <img src="../images1/IMG_E1691.JPG" class="img-fluid" width="300" height="300" alt="">
                </div>
            </div>



            
        </div>

  <div class="container my-5">
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($catpost_exc)) { ?>
            <div class="col-sm-6 col-md-4" >
                <div class="card">
                    <img src="images/<?= $row['image'] ?>" style="height: 300px;" class="img-fluid img" alt="">
                    <div class="card-img-overlay">
                        <h2 class="fw-bold"><?= $row['title'] ?></h3>
                        <!-- <p class="fw-bold"><?= $row['description'] ?></p>     -->
                    </div>
                </div>
            </div>
            <?php  } ?>
        </div>
    </div>
        

        <!-- product review -->
    <div class="">
        <div class="row me-5">
            <div class="col-md-5 ms-1 mt-5">
                <h1 class="fw-bold text-center ms-4" style="overflow: hidden; font-size: 30px;">PRODUCT OVERVIEW</h1>
            </div>

        </div>
    </div>


    <!-- product review navbar -->
    <div class="navbar navbar-expand-md navbar-dark   ">
        <div class="container justify-content-start d-flex align-items-center">
            <ul class="navbar-nav ms-4">
                <li class="navbar-item" style="text-decoration: underline;">
                    <a href="" class="nav-link text-black text-uppercase text-center ms-5">all products</a>
                </li>
                <li class="navbar-item">
                    <a href="" class="nav-link text-black text-uppercase text-center ">women</a>
                </li>
                <li class="navbar-item">
                    <a href="" class="nav-link text-black text-uppercase text-center">men</a>
                </li>
                <li class="navbar-item">
                    <a href="" class="nav-link text-black text-uppercase text-center">blog</a>
                </li>
                 <li class="navbar-item">
                    <a href="" class="nav-link text-black text-uppercase text-center">shoes</a>
                </li>
                  <li class="navbar-item">
                    <a href="" class="nav-link text-black text-uppercase text-center">watches</a>
                </li>
            </ul>


        </div>

        <div class="row justify-content-around align-items-center w-25 container me-5">
            <button style="width: 100px;" class="btn btn-light mt-1 ms-5">filter</button>
            <button style="width: 100px;" class="btn btn-light mt-2 ms-5">filter</button>

        </div>
        <!-- <div class="row justify-content-between d-flex align-items-center me-5">
            <button style="width: 100px;" class="btn btn-primary">filter</button>

        </div> -->
    </div>
    </div>




      <div class="container my-5">
        <div class="row d-flex">
            <?php while ($row = mysqli_fetch_assoc($productpost_exc)) { ?>
            <div class="col-sm-6 col-md-3 my-3" >
                <div class="card">
                    <img src="images/<?= $row['image'] ?>" style="height: 300px;" class="img-fluid img" alt="">
                    
                            <h6 class=" text-center"><?= $row['header'] ?></h6>
                        <h6 class="fw-bold text-center"><?= $row['title'] ?></h6>
                             <h6 class="fw-bold text-center"><?= $row['content'] ?></h6>
                                   <h6 class="fw-bold text-center"><a href="" class="btn btn-light"><?= $row['footer'] ?></a></h6>
                        <!-- <p class="fw-bold"><?= $row['description'] ?></p>     -->
                    
                </div>
            </div>
            <?php  } ?>
        </div>
    </div>

        <!-- <div class="container my-5">
        <div class="row">
              <?php while ($row = mysqli_fetch_assoc($productpost_exc)) { ?>
            <div class="p-4 shadow col-md-3">
                <div class="col-sm-6 col-md-4" >
                <div class="card">
                    <img src="photos/<?= $row['image'] ?>" style="height: 300px;" class="img-fluid" alt="">
                    <div class="card-img-overlay">
                         <h6 class="fw-bold"><?= $row['header'] ?></h6>
                        <h6 class="fw-bold"><?= $row['title'] ?></h6>
                             <h6 class="fw-bold"><?= $row['content'] ?></h6>
                                 <h6 class="fw-bold"><a class="btn btn-light" href="#"><?= $row['footer'] ?></a></h6> -->
                        <!-- <p class="fw-bold"><?= $row['description'] ?></p>     -->
                    <!-- </div>
                </div>
            </div>
            </div>

            <?php   }; ?>
        </div>
    </div> -->

            <!-- button after product review -->
        <div class="d-flex justify-content-center  align-items-center text-black container mb-5">
            <div class=" row">
                <div class="col-md-12 text-center">
                    <button style="width: 150px; background: gray;" class="btn text-white fw-bold  rounded-5 //">LOAD
                        MORE</button>


                </div>
            </div>
        </div>

     <footer class="bg-black text-light">
        <div class="container">

            <div class="row">

                <div class="col-md-4 mb-3 text-center">
                    <h5 class="mb-3">About Us</h5>
                    <p class="mb-0">
                        we build mordern web solutions with speed, performance
                    </p>
                </div>

                <div class="col-md-4 mb-3 text-center">
                    <h5 class="mb-3 ms-5 text-center">Quick Links</h5>
                    <ul class="list-unstyles">
                        <b><a href="#" class="text-light  text-decoration-none">Home</a></b> <br>
                        <b><a href="#" class="text-light  text-decoration-none">Home</a></b> <br>
                         <b><a href="#" class="text-light  text-decoration-none">Home</a></b> <br>
                        <b><a href="#" class="text-light  text-decoration-none">Home</a></b>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h5 class="text-center">Contact Us</h5>
                    <ul class="list-unstyles text-center">
                        <b>Email: example@email.com</b> <br>
                        <b>Phone: +123 456 7890</b> <br>
                        <b>location: Lagos, Nigeria</b>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary">

                        <div class="text-center w-100" style="">
                <small><i class="fa fa-instagram" style="background: red;"></i> <i class="fa fa-facebook" style="background: blue;"></i><i class="fa fa-whatsapp" style="background: greenyellow;"></i><i class="fa fa-telegram" style="background: blue;"></i><i class="fa fa-youtube" style="background: red;"></i></small>
            </div>
            <div class="text-center">
                <small>@ 2025 your company, all rights reserved.</small>
            </div>
        </div>
     </footer>
    

    
</body>
</html>