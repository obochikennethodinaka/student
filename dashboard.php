<?php

require "header.php";
session_start();
// category sesion
if (!isset($_SESSION['id'])) {
    header("location: register.php");
    exit;
}


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

// SELECT ALL ROWS
$select_student = "SELECT * FROM user_reg1";
$select_student_exc = mysqli_query($conn, $select_student);
// if ($select_student_exc) {
//     echo "selected";
// } else {
//     echo "not selected";
// }



if (isset($_POST['update'])) {
    // SECURING THE FORM INPUT
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // HASH PASSWORD
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // UPDATE PER ROW
    $update_student = "UPDATE user_reg1 SET firstName ='$firstName', lastName ='$lastName', email ='$email', password ='$hash' WHERE id ='$id' ";
    $update_student_exc = mysqli_query($conn, $update_student);

    if ($update_student_exc) {
        $error = "Your Data is Succesfully changed".mysqli_error($conn);
        $msg = "<div class='alert alert-success'>$error</div>";
    } else {
        $error = "Your Data is not Succesfully changed".mysqli_error($conn);
        $msg = "<div class='alert alert-danger'>$error</div>";
    }
    

}



// DELETE
if (isset($_GET['delete_id'])) {
   $id = intval($_GET['delete_id']);

   $delete_student = "DELETE FROM user_reg1 WHERE id ='$id' ";
   $delete_student_exc =mysqli_query($conn, $delete_student);

   if ($delete_student_exc) {
    $error = "Your Data is Succesfully Deleted".mysqli_error($conn);
    $msg = "<div class='alert alert-danger'>$error</div>";
   } else {
    $error = "Your Data is not Succesfully Deleted".mysqli_error($conn);
    $msg = "<div class='alert alert-danger'>$error</div>";
   }
   


} 







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="">
    <div class="navbar bg-primary"></div>

    <div class="row justify-content-around bg-primary ">
        <!-- SIDE BAR -->
        <div class="sidebar col-2 d-block navbar bg-primary fw-bold">
            <div class="col-12">
                <h3 class="text-warning fw-bold mb-4">CozaStore <br> <span class=" text-dark">Dashboard</span></h3>
                <a href="dashboard.php" class="active nav-link strong text-white">Users/Overview</a><br>
                <a href="category.php" class="my-2 nav-link strong text-white">Category</a><br>
                <a href="product.php" class="my-2 nav-link strong text-white">Prodoct</a><br>
                  <a href="register.php" class="my-2 nav-link strong text-white">Register</a><br>
                    <a href="login.php" class="my-2 nav-link strong text-white">LogIn</a><br>
                <a href="#" class="nav-link strong text-white">Logout</a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="content col-9 bg-white my-3">

            <h4>Welcome, KENNETH </h4>

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

                            <form action="add.php" method="POST" enctype="multipart/form-data">
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

            <!-- RECENT ACTIVITY -->
             <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive w-100">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Password</th>
                                <th scope="col">Created</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                         <?php while ($row = mysqli_fetch_assoc($select_student_exc)) {
                            $row['id'];
                        ?>
                            <tr>
                                <th scope="row"> <?= $row['id'] ?></th>
                                <td class="col-md-1"> <?= $row['firstName'] ?> </td>
                                <td class="col-md-1"> <?= $row['lastName'] ?> </td>
                                <td class="col-md-1"> <?= $row['email'] ?> </td>
                                <td class="col-md-1"> <?= $row['phone'] ?> </td>
                                <td class="col-md-1"> <?= $row['password'] ?> </td>
                                <td class="col-md-1"> <?= $row['date_created'] ?> </td>
                                <td class="text-center d-flex justify-content-center align-items-center">
                                    <a href="#" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">Edit</a>
                                    <a href="dashboard.php?delete_id= <?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                             <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="dashboard.php" method="POST">
                                            <div class="modal-body">

                                                <input type="hidden" name="id" id="edit_id">



                                                <div class="mb-3">
                                                    <!-- hidden id -->
                                                     <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                </div>

                                                  <div class="mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="firstName" class="form-control" value="<?= $row['firstName'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="lastName" class="form-control" value="<?= $row['lastName'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" name="email" class="form-control" value="<?= $row['phone'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control" value="<?= $row['email'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Change Password</label>
                                                    <input type="text" name="password" class="form-control" value="<?= $row['password'] ?>" required>
                                                </div>

                                                <div class="modal-footer">
                                                     <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
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

    <!-- <h1 class="alert alert-danger text-center" style="color: brown;">Dear <?= $_SESSION['firstName'] ?> welcome to CodeHub</h1> -->
    

    <!-- YOU CAN ALSO ADD "lastName" by adding "$_SESSION[lastName]" for "lastName" -->

    <!-- <h1 class="alert alert-danger text-center" style="color: brown;">Dear <?= $_SESSION['firstName']. $_SESSION['lastName'] ?> welcome to CodeHub</h1> -->

    <!-- <div class="py-5">

        <h1 class="mb-4">Students</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive w-100">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Password</th>
                                <th scope="col">Created</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                         <?php while ($row = mysqli_fetch_assoc($select_student_exc)) {  ?>
                            <tr>
                                <th scope="row"> <?= $row['id'] ?></th>
                                <td> <?= $row['firstName'] ?> </td>
                                <td> <?= $row['lastName'] ?> </td>
                                <td> <?= $row['phone'] ?> </td>
                                <td> <?= $row['email'] ?> </td>
                                <td> <?= $row['password'] ?> </td>
                                <td> <?= $row['date_created'] ?> </td>
                                <td class="text-center d-flex justify-content-center align-items-center">
                                    <a href="#" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editmodal<?= $row['id'] ?>">Edit</a>
                                    <a href="dashboard.php?delete_id= <?= $row['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr> -->

                            <!-- Edit Modal -->
                             <!-- <div class="modal fade" id="editmodal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="dashboard.php" method="POST">
                                            <div class="modal-body">

                                                <input type="hidden" name="id" id="edit_id">



                                                <div class="mb-3"> -->
                                                    <!-- hidden id -->
                                                     <!-- <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                </div>

                                                  <div class="mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="firstName" class="form-control" value="<?= $row['firstName'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="lastName" class="form-control" value="<?= $row['lastName'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" name="phone" class="form-control" value="<?= $row['phone'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" name="email" class="form-control" value="<?= $row['email'] ?>" required>
                                                </div>
                                                  <div class="mb-3">
                                                    <label class="form-label">Change Password</label>
                                                    <input type="text" name="password" class="form-control" value="<?= $row['password'] ?>" required>
                                                </div>

                                                <div class="modal-footer">
                                                     <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
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

    </div> -->


    <!-- <div class="d-flex justify-content-around align-itens-center">
        <a href="login.php" class="text-dark w-25 btn btn-outline-danger">Log Out</a>
    </div> -->

<?php


    require "footer.php";
    
    
?>