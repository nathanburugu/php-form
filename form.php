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

<?php
$firstname=$lastname=$email=$course='';
$errors=array('firstname'=>'','lastname'=>'','email'=>'','course'=>'');
if(isset($_POST['save'])){
    //checking for firstname validation
    if(empty($_POST['firstname'])){
        $errors['firstname']='firstname cannot be empty<br/>';
    }else{
        $firstname=$_POST['firstname'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$firstname)){
            $errors['firstname']='firstname must be letters and spaces only';
        }
    }
    //checking for lastname validation
    if(empty($_POST['lastname'])){
        $errors['lastname']='lastname cannot be empty<br/>';
    }else{
        $lastname=$_POST['lastname'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$lastname)){
            $errors['lastname']='lastname must be letters and spaces only';
        }
    }
    //checking for course validation
    if(empty($_POST['course'])){
        $errors['course']='course cannot be empty<br/>';
    }else{
        $course=$_POST['course'];
        if(!preg_match('/^[a-zA-Z\s]+$/',$course)){
            $errors['course']='course must be letters and spaces only';
        }
    }
    //checking for email validation
    if(empty($_POST['email'])){
        $errors['email']='email cannot be empty<br/>';
    }else{
        $email=$_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email']='email must be a valid address';
        }
    }
    if(array_filter($errors)){
        //echo 'there are errors in the form';
    }else{
        //echo 'no errors in the form';
        /*$statement = $databaseConnection ->prepare(
            "INSERT INTO sample(firstname, lastname, email, course)
            VALUES ($firstname, $lastname, $email, $course)");
            $statement ->execute();*/
            try
            {
                $query = "INSERT INTO sample(firstname, lastname, email, course) VALUES (:firstname,:lastname,:email,:course)";
                $query_run = $databaseConnection ->prepare($query);
                $data = [
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':email' => $email,
                    ':course' => $course,
                ];
                $query_execute = $query_run-> execute($data);
                if($query_execute){
                    echo '<script> alert("Data added Successfully")</script>';
                }else{
                    echo '<script> alert("Data NOT added Successfully")</script>';
                }
            }catch(PDOException $err){
                echo $err->getmessage();
            }
    }

}

?>
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
<div class="col-md-4 offset-md-4">
<h5>Enter student details</h5>
<form action="index.php" method="POST">
    <div class="form-group">
        <input type="text" name="firstname" placeholder="Enter firstname" class="form-control" value="<?php echo htmlspecialchars($firstname); ?>">
        <div class="text-danger"><?php echo $errors['firstname']; ?></div>
        </div>

        <div class="form-group">
        <input type="text" name="lastname" placeholder="Enter lastname" class="form-control" value="<?php echo ($lastname); ?>">
        <div class="text-danger"><?php echo $errors['lastname']; ?></div>
        </div>

        <div class="form-group">
        <input type="text" name="email" placeholder="Enter email" class="form-control" value="<?php echo $email ?>">
        <div class="text-danger"><?php echo $errors['email']; ?></div>
        </div>

        <div class="form-group">
        <input type="text" name="course" placeholder="Enter course" class="form-control" value="<?php echo $course ?>">
        <div class="text-danger"><?php echo $errors['course']; ?></div>
        </div>
        <button name="save" class="btn btn-primary">save details</button>
    </form>
    </div>
</body>
</html>
