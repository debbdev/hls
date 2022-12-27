<?php
session_start();
error_reporting(E_ALL);
include 'includes/config.php';
if(isset($_POST['student-login']))
{
$studentId=$_POST['studentId'];
$password=$_POST['password'];
$sql ="SELECT * FROM student WHERE student_id=:studentId";
$query=$conn->prepare($sql);
$query->bindParam(':studentId', $studentId, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_ASSOC);
if($query->rowCount()==0){
  header('Location:student_index.php?error=Invalid Details');
  exit();
}
else{
    if(password_verify($password,$result['pwd'])){
     $_SESSION['firstname'] = $result['firstname'];
     $_SESSION['lastname'] = $result['lastname'];
     $_SESSION['studentId'] = $result['student_id'];
     $_SESSION['mobileNum'] = $result['mobile_num'];
     $_SESSION['dept'] = $result['dept'];
     $_SESSION['yearstudy'] = $result['year_study'];
     $_SESSION['hostel_id'] = $result['hostel_id'];
     $_SESSION['room_id'] = $result['room_id'];
     header('Location:home.php');
     exit();
    }
    else {
     header('Location:student_index.php?error=Invalid Password');
     exit();
    }
 } 
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System | Student </title>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
    <div class="container">
     <div class="head">
                     <a href="home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">STUDENT LOGIN</h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='student-login' method="POST">
                       <div class="student-input">
                           <label for='studentId'>Enter Student-Id</label>
                           <input type='text' class="label-input" placeholder='Enter Student Id' name='studentId' autocomplete='off' required>
                       </div>
                       <div class="student-input">
                           <label for='studentId'>Enter Password</label>
                           <input type='password' class="label-input" placeholder='Enter Password' name='password' autocomplete='off' required>
                        </div>
                        <div class="student-input">
                           <input type='submit' name='student-login' class="student-submit">
                          </div>
                  </form> 
                           <h6 class="main-heading student-heading">Login as <a href="#" class='index-a'>Hostel Manager || Admin</a></h6>
                           <h6 class="main-heading student-heading">Don't have an Account? <a class='index-a' href="student_signup.php"> SignUp</a></h6>
                        
              </div>  
           </div>
        </div>   
    </main>      
</body>
</html>