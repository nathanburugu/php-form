<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
if (isset($_POST["update_student"])){
    $student_id = htmlspecialchars($_POST['student_id']);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    try{
        $query = "UPDATE sample SET firstname=:firstname, lastname=:lastname, email=:email, course=:course WHERE Id=:stud_id";
        $statement = $databaseConnection->prepare($query);
        $data =[
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
            ':course' => $course,
            ':stud_id' => $student_id
        ];
        $query_execute = $statement->execute($data);
        if ($query_execute){
            header('location: students.php');
        }else{
            //echo '<script> alert("Data NOT added")</script>';
        }
    }
}
?>
<body>
    
</body>
</html>