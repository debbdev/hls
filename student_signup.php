<?php
     session_start();
     include "includes/config.php";
     if(isset($_POST['student-signup'])){
         function validate($data){
             $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
         }
         $studentId = validate($_POST['studentId']);
         $firstname = validate($_POST['firstname']);
         $lastname = validate($_POST['lastname']);
         $mobilenum = validate($_POST['mobile_num']);
         $dept = validate($_POST['dept']);
         $yearstudy = validate($_POST['year_study']);
         $password = validate($_POST['password']);
         $confirmpassword = validate($_POST['confirm_password']);
         if($password!=$confirmpassword){
            header('Location:student_signup.php?error=Invalid Password');
            exit();
         }
         else {
             $sql = "SELECT * FROM student WHERE student_id=:studentId";
             $query = $conn->prepare($sql);
             $query->bindParam(':studentId', $studentId, PDO::PARAM_STR);
             $query->execute();
             if($query->rowCount()>0){
                header('Location:student_signup.php?error=User Exist');
                exit();
             }
             else {
                 $password_hash = password_hash($password, PASSWORD_BCRYPT);
                 $sql1 = "INSERT INTO student(student_id, firstname, lastname, mobile_num, dept, year_study, pwd) VALUES (:studentId, :firstname, :lastname, :mobilenum, :dept, :yearstudy, :password_hash)";
                 $query1 = $conn->prepare($sql1);
                 $query1->bindParam(':studentId', $studentId, PDO :: PARAM_STR);
                 $query1->bindParam(':firstname', $firstname, PDO :: PARAM_STR);
                 $query1->bindParam(':lastname', $lastname, PDO :: PARAM_STR);
                 $query1->bindParam(':mobilenum', $mobilenum, PDO :: PARAM_STR);
                 $query1->bindParam(':dept', $dept, PDO :: PARAM_STR);
                 $query1->bindParam(':yearstudy', $yearstudy, PDO :: PARAM_STR);
                 $query1->bindParam(':password_hash', $password_hash, PDO :: PARAM_STR);
                 $query1->execute();
                 $lastInsertId = $conn->lastInsertId();
                 header('Location:application_form.php');
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
    <div class="container">
     <div class="head">
     <a href="#" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
    <main class='student-main'>
        <div class='student-wrapper signup-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">STUDENT SIGNUP</h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='student-signup' method="POST">
                  <div class="student-input">
                       <label for='studentId' class="signup-label">Student Id</label>
                       <input type='text' class="label-input" placeholder='Enter Student Id' name='studentId' required>
                    
                  </div>
                  <div class="student-input ">
                        <label for='firstname' class="signup-label">Firstname</label>
                        <input type='text' class="label-input" placeholder='Enter Firstname' name='firstname' required>
                    </div>
                    <div class="student-input ">
                        <label for='lastname' class="signup-label">Lastname</label>
                        <input type='text' class="label-input" placeholder='Enter Lastname' name='lastname' required>
                    </div>
                    <div class="student-input">
                        <label for='mobilenum' class="signup-label">Mobile Number</label>
                        <input type='text' class="label-input" placeholder='Enter Mobile Number' name='mobile_num' required>
                    </div>   
                    <div class="student-input">
                         <label for='dept' class="signup-label">Department</label>
                         <input type='text' class="label-input" placeholder='Enter Department' name='dept' required>
                    </div>
                    <div class="student-input">
                        <label for='year_study' class="signup-label">Year of Study</label>
                        <input type='text' class="label-input" placeholder='Enter Year of Study' name='year_study' required>
                    </div>
                    <div class="student-input">
                        <label for='password' class="signup-label">Enter Password</label>
                        <input type='password' class="label-input" placeholder='Enter Password' name='password' required>
                    </div>
                    <div class="student-input">
                         <label for='confirm_password' class="signup-label">Confirm Password</label>
                        <input type='password' class="label-input" placeholder='Confirm Password' name='confirm_password' required>
                    </div>
                    <div class="student-input">
                        <input type='submit' name='student-signup' class="student-submit" placeholder="SignUp">
                        </div>
                  </form>  
              </div>  
           </div>
        </div>    
    </main>      
</body>
</html>