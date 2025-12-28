<?php

// CONNECT TO LOCAL HOST
$connt = mysqli_connect("localhost", "root", "");
if ($connt) {
    echo "DATABASE CONNECTED";
    echo "<br>";
} else {
    echo "DATABASE not CONNECTED";
    echo "<br>";
}

// CREATING DATABASE
$db = "CREATE DATABASE IF NOT EXISTS databs";
$db_exc = mysqli_query($connt,$db);

if ($db_exc) {
    echo "DATABASE CREATED";
    echo "<br>";
} else {
    echo "DATABASE not CREATED";
    echo "<br>";
}

// CONNECT TO DATABASE "databs"
$conn = mysqli_connect("localhost", "root", "", "databs");

if ($conn) {
    echo "DATABS CONNECTED";
    echo "<br>";
} else {
    echo "DATABS not CONNECTED";
    echo "<br>";
}

// CREATING DATABASE TABLE
$create_table = "CREATE TABLE IF NOT EXISTS students(
id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
name VARCHAR(255),
lastname VARCHAR(255),
email VARCHAR(255),
phone VARCHAR(255),
password VARCHAR(255),
date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// EXCECUTING THE CREATED TABLE
$create_table_exc = mysqli_query($conn, $create_table);
if ($create_table_exc) {
    echo "Table Created";
    echo "<br>";
} else {
    echo "Table not Created";
    echo "<br>";
}


// Points: (CR=create, U=update, D=delete)
// CREATE(creating new row inside the created table "students" )
$create_student = "INSERT INTO students (name,lastname,email,phone,password) VALUES ('chizzy', 'kenneth','chizyken@gmail.com','09075501903','1234567890')";
// $create_student_exc = mysqli_query($conn, $create_student);
// if ($create_student_exc) {
//     echo "Row Created";
//     echo "<br>";
// } else {
//     echo "Row not Created";
//     echo "<br>";
// }

// UPDATE
$update_student = "UPDATE students SET name = 'uche', lastname = 'smug', email = 'jaysmugdollar@gmail.com', phone = '09075501903', password = '1234567890' WHERE id = '1'";
$update_student_exc = mysqli_query($conn, $update_student);
if ($update_student_exc) {
    echo "Table Updated";
    echo "<br>";
} else {
    echo "Table not Updated";
    echo "<br>";
}

// DELETE
// $delete_student  = "DELETE FROM students WHERE id = '3'";
// $delete_student_exc = mysqli_query($conn, $delete_student);
// if ($delete_student_exc) {
//     echo "Table row Deleted";
//     echo "<br>";
// } else {
//     echo "Table row not Deleted";
//     echo "<br>";
// }

// SELECT ROWS
$select_student = "SELECT * FROM students";
$select_student_exc = mysqli_query($conn, $select_student);

// while ($row = mysqli_fetch_assoc($select_student_exc)) {
//     echo $user = $row['id']."<br>" ;
//     echo $user = $row['name']."<br>" ;
//     echo $user = $row['lastname']."<br>" ;
//     echo $user = $row['email']."<br>" ;
//     echo $user = $row['phone']."<br>" ;
//     echo $user = $row['password']."<br>" ;
//     echo $user = $row['date_created']."<br>" ;
// }




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-cy="_DefaultHelmet_title" data-react-helmet="data-cy">Music Licensing for Video, Film &amp; Advertising | Musicbed</title>
    <!-- <title>Document</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4"  style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Students</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-rsponsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Lastname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Password</th>
                                <th scope="col">Created</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($select_student_exc)) { ?> 

                                <tr>
                                    <th scope="row"> <?= $row['id'] ?> </th>
                                    <td> <?= $row['name'] ?> </td>
                                    <td> <?= $row['lastname'] ?> </td>
                                    <td> <?= $row['email'] ?> </td>
                                    <td> <?= $row['phone'] ?> </td>
                                    <td> <?= $row['password'] ?> </td>
                                    <td> <?= $row['date_created'] ?> </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" databs-target="#editModal">Edit</a>
                                        <a href="#" class="btn btn-sm btn-outline-danger" >Delete</a>
                                    </td>
                                </tr>


                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    
</body>
</html>