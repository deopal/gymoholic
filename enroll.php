<?php
session_start();
$db=mysqli_connect("localhost","root","","gymoholic");
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $sql="INSERT INTO members(name,age,gender,email,number) VALUES('$name','$age','$gender','$email','$number')";
    mysqli_query($db,$sql);
    header("location:enroll.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" ></script>
</head>
<link rel="index.php" href="index.php">
<body>
<script type="text/javascript">
    $(function(){
        swal.fire({
            'title':'Cogratulations',
            'text':'you are now a member of our family',
            confirmButtonText: `OK`,
            'type':'success',
     
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href="index.php";
            }
        })
     });
     </script>
</body>
</html>
