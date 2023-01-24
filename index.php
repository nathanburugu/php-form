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

<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="one">
                    <h1 class="message">SOFTWARE DEVELOPMENT UNIVERSITY <br> TRANSFORMING LIVES SINCE 1999</h1>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="three"> 
                    <h1 class="mission">OUR MISSION</h1>
                   <p class="mission"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, magni labore eius quibusdam provident cupiditate, nobis eos ad aut, perspiciatis alias inventore harum odit exercitationem. Architecto laudantium quae dolores rerum?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, magni labore eius quibusdam provident cupiditate, nobis eos ad aut, perspiciatis alias inventore harum odit exercitationem. Architecto laudantium quae dolores rerum?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, magni labore eius quibusdam provident cupiditate, nobis eos ad aut, perspiciatis alias inventore harum odit exercitationem. Architecto laudantium quae dolores rerum?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, magni labore eius quibusdam provident cupiditate, nobis eos ad aut, perspiciatis alias inventore harum odit exercitationem. Architecto laudantium quae dolores rerum?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, magni labore eius quibusdam provident cupiditate, nobis eos ad aut, perspiciatis alias inventore harum odit exercitationem. Architecto laudantium quae dolores rerum?
</p>
                <div class="mission">
                <button class="btn btn-primary">Apply</button>
                </div>
                </div>
            </div>
            
        </div>
</body>
</html>
