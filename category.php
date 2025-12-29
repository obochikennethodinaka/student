<?php

require "header.php";
session_start();
$msg = "";

// category sesion
if (!isset($_SESSION['id'])) {
    header("location: register.php");
    exit;
}

// select category
$catpost = "SELECT * FROM category";
$catpost_exc = mysqli_query($conn, $catpost);

// add category
if (isset($_POST['save'])) {
    $image = mysqli_real_escape_string($conn,$_FILES['image']['name']);
    $imgTmp = $_FILES['image']['tmp_name'];
    $imgFolder = "images/" . $image;

    if (move_uploaded_file($imgTmp, $imgFolder)) {
        $error = "image uploaded successfully".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    } else {
       $error = "image not uploaded successfully".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);

    $insert_cat = "INSERT INTO category (image, title) VALUES ('$image', '$title')";
    $insert_cat_exc = mysqli_query($conn, $insert_cat);

    if ($insert_cat_exc) {
        $error = "category added".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    } else {
        $error = "category not added".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    }
    
}


// edit cat
if (isset($_POST['edit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $image = mysqli_real_escape_string($conn,$_POST['image']['name']);
    $imgTmp = $_FILES['image']['tmp_name'];
    $imgFolder = "images/" . $image;

    if (move_uploaded_file($imgTmp, $imgFolder)) {
        $error = "image uploaded successfully".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    } else {
        $error = "image not uploaded successfully".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);

    $edi_cat = "UPDATE category SET image = '$image', title = '$title' WHERE id = '$id'";
    $edi_cat_exc = mysqli_query($conn, $edi_cat);

    if ($edi_cat_exc) {
        $error = "category edited".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    } else {
        $error = "category not edited".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    }
    
    
}

// DELETE
if (isset($_GET['delete_id'])) {
   $id = intval($_GET['delete_id']);

   $delete_product = "DELETE FROM category WHERE id ='$id' ";
   $delete_product_exc = mysqli_query($conn, $delete_product);

   if ($delete_product_exc) {
    $error = "Your Data is Succesfully Deleted".mysqli_error($conn);
    $msg = "<div class='alert alert-danger'>$error</div>";
   } else {
    $error = "Your Data is not Succesfully Deleted".mysqli_error($conn);
    $msg = "<div class='alert alert-danger'>$error</div>";
   }
   


}; 



// counter
$count = "SELECT 
         (SELECT COUNT(*) FROM user_reg1) AS users,
         (SELECT COUNT(*) FROM category) AS cat,
         (SELECT COUNT(*) FROM product) AS product

";

$count_exc = mysqli_query($conn, $count);
$row = mysqli_fetch_assoc($count_exc);

$user = $row['users'];
$cat = $row['cat'];
$product = $row['product'];


?>



<div class="navbar bg-primary"></div>

    <div class="row justify-content-around bg-primary">
        <!-- SIDE BAR -->
        <div class="sidebar col-2 d-block navbar bg-primary fw-bold my-3">
            <div class="col-12">
                <h3 class="text-warning fw-bold mb-4">CozaStore <br> <span class=" text-black">Category</span></h3>
                <a href="dashboard.php" class="active nav-link strong text-white">Users/Overview</a><br>
                <a href="category.php" class="my-2 nav-link strong text-white">Category</a><br>
                <a href="product.php" class="my-2 nav-link strong text-white">Prodoct</a><br>
                  <a href="register.php" class="my-2 nav-link strong text-white">Register</a><br>
                    <a href="login.php" class="my-2 nav-link strong text-white">LogIn</a><br>
                <a href="login.php" class="nav-link strong text-white">Logout</a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="content col-9 bg-white my-3">

            <h4>Welcome, KENNETH</h4>

            <!-- TOP SECTION -->
            <div class=" d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex justify-content-between align-items-center" >
                    <h3>All Users</h3>
                    <!-- ADD NEW BUTTON -->
                    <button class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#addNewModal" >Add User</button>
                </div>
                <a href="cozastore.php" class="btn btn-primary">Back To Home</a>

                <!-- ADD NEW MODAL -->
                 <div class="modal fade" id="addNewModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Add New Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="category.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3" id=""></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Upload Image</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>

                        </div>
                    </div>
                 </div>
            </div>

            <div class="row g-4 mb-4">

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5>Total Users</h5>
                            <h2 class="fw-bold"> <?= $user ?> </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5>Total Categories</h5>
                            <h2 class="fw-bold"> <?= $cat ?> </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5>Total Products</h5>
                            <h2 class="fw-bold"> <?= $product ?> </h2>
                        </div>
                    </div>
                </div>

            </div>

            <!--CATEGORY TABLE -->
             <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive w-100">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">TITLE</th>
                                <!-- <th scope="col">DESCRIPTION</th> -->
                                <th scope="col">DATE CREATED</th>
                                <th scope="col" class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>

                         <?php while ($row = mysqli_fetch_assoc($catpost_exc)) {
                            $row['id'];
                        ?>
                            <tr>
                                <th scope="row"> <?= $row['id'] ?></th>
                                <td class="col-md-1"> <?= $row['image'] ?> </td>
                                <td class="col-md-1"> <?= $row['title'] ?> </td>
                                <!-- <td class="col-md-1"> <?= $row['description'] ?> </td> -->
                                <td class="col-md-1"> <?= $row['date_created'] ?> </td>
                                <td class="text-center d-flex justify-content-center align-items-center">
                                    <a href="#" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#addNewModals<?= $row['id'] ?>">Edit</a>
                                    <a href="category.php?delete_id= <?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>

                             

                            <!-- Edit Modal -->
                             <div class="modal fade" id="addNewModals<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                         <div> <?= $msg ?> </div>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="category.php" method="POST" >
                                            <div class="modal-body">

                                                



                                                <div class="mb-3">
                                                    <!-- hidden id -->
                                                     <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                </div>

                                                  <div class="mb-3">
                                                    <label class="form-label">Upload Image</label>
                                                    <input type="file" name="image" class="form-control" value="<?= $row['image'] ?>" >
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="title" class="form-control"
                                                    value="<?= $row['title'] ?>" >
                                                </div>
                                                  <!-- <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" name="discription" class="form-control" 
                                                    value="<?= $row['discription'] ?>" required>
                                                </div> -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="save">Add Category</button>
                                                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                             </div>

                             <?php } ?>

                        </tbody>
                    </table>
                </div>
             </div>


        </div>

    </div>





<?php

require "footer.php";

?>
