<?php
include("dbh.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="index.php">
    <img src="school_logo.jpg" width="40" height="40" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="students.php">Students</a>
      <a class="nav-item nav-link active" href="form.php">LogIn</a>
      
    </div>
  </div>
</nav>

    <div class="container">
        <h1 class="headings">All Students Details</h1>
        <table class="table table-hover table-bordered table sm" style="background-color: rgb(227, 242, 253, 0.7);">
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Course</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <?php
            $query = "SELECT * FROM sample";
            $statement = $databaseConnection ->prepare($query);
            $statement ->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result){
                foreach($result as $row){
                    ?>
            <tr>
                <td><?=$row['firstname'];?></td>
                <td><?=$row['lastname'];?></td>
                <td><?=$row['email'];?></td>
                <td><?=$row['course'];?></td>
                <td>
                    <a href="student-edit.php?Id=<?=$row['Id']; ?>" class="btn btn-primary" name="Edit_students">Edit</a>
                </td>
                 <td> 
                    <form action="crud.php" method="POST">
                        <button value="<?=$row['Id']; ?>" class="btn btn-danger btn-sm" name="delete_student">Delete</button>
                    </form>
                </td> 
            </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</body>
</html>