<?php
     session_start();
     include "../includes/config.php";
     if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1){
        header('Location:../hmanager/hmanager_index.php');
        exit();
    }
    else{
     if(isset($_POST['hm-signup'])){
         function validate($data){
             $data = trim($data);
             $data = stripslashes($data);
             return $data;
         }
         $username = validate($_POST['hm_username']);
         $firstname = validate($_POST['firstname']);
         $lastname = validate($_POST['lastname']);
         $mobilenum = validate($_POST['mobile_num']);
         $hostel_name = validate($_POST['hostel_name']);
         $email = validate($_POST['email']);
         $password = validate($_POST['password']);
         $confirmpassword = validate($_POST['confirm_password']);
         $isAdmin = 0;
         if($password!=$confirmpassword){
            header('Location:signup_hm.php?error=Invalid Password');
            exit();
         }
         else {
             $sql = "SELECT * FROM hmanager WHERE username=:username";
             $query = $conn->prepare($sql);
             $query->bindParam(':username', $username, PDO::PARAM_STR);
             $query->execute();
             if($query->rowCount()>0){
                header('Location:signup_hm.php?error=User Exist');
                exit();
             }
             else {
                 $password_hash = password_hash($password, PASSWORD_BCRYPT);
                 $sql2 = "SELECT * FROM hostel WHERE hostel_name=:hostel_name";
                 $query2 = $conn->prepare($sql2);
                 $query2->bindParam(':hostel_name', $hostel_name, PDO::PARAM_STR);
                 $query2->execute();
                 $result2 = $query2->fetch(PDO::FETCH_ASSOC);
                 $hostel_id = $result2['hostel_id'];
                 if($query2->rowCount()>0){
                    $sql1 = "INSERT INTO hmanager(username, firstname, lastname, mobile_num, hostel_id, email, pwd, isAdmin) VALUES (:username, :firstname, :lastname, :mobilenum, :hostel_id, :email, :password_hash, :isAdmin)";
                    $query1 = $conn->prepare($sql1);
                    $query1->bindParam(':username', $username, PDO :: PARAM_STR);
                    $query1->bindParam(':firstname', $firstname, PDO :: PARAM_STR);
                    $query1->bindParam(':lastname', $lastname, PDO :: PARAM_STR);
                    $query1->bindParam(':mobilenum', $mobilenum, PDO :: PARAM_STR);
                    $query1->bindParam(':hostel_id', $hostel_id, PDO :: PARAM_STR);
                    $query1->bindParam(':email', $email, PDO :: PARAM_STR);
                    $query1->bindParam(':password_hash', $password_hash, PDO :: PARAM_STR);
                    $query1->bindParam(':isAdmin', $isAdmin, PDO :: PARAM_STR);
                    $query1->execute();
                    $lastInsertId = $conn->lastInsertId();
                    if($lastInsertId){
                        $_SESSION['firstname'] = $result['firstname'];
                        $_SESSION['lastname'] = $result['lastname'];
                        $_SESSION['username'] = $result['username'];
                        $_SESSION['mobileNum'] = $result['mobile_num'];
                        $_SESSION['hmanager_id'] = $result['hmanager_id'];
                        $_SESSION['email'] = $result['email'];
                        $_SESSION['pwd'] = $result['pwd'];
                        $_SESSION['hostel_id'] = $result['hostel_id'];
                        $_SESSION['isAdmin'] = $result['isAdmin'];
                       header('Location:signup_hm.php?success=User Created Successfully');
                       exit();
                    }
                    else {
                       header('Location:signup_hm.php?error=Error Creating User');
                       exit();
                    }
                 }else{
                    header('Location:signup_hm.php?error=Error Creating User');
                    exit();
                 }
             }
         }
     }
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System | Admin </title>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
     <div class="head">
     <a href="admin_home.php" class="index-a">Hostel Management Admin Portal</a>
     </div>
    </div>
    <main class='student-main'>
        <div class='student-wrapper signup-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">APPOINT HOSTEL MANAGER </h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
                 <?php if(isset($_GET['success'])){?><div class="errorWrap"><strong>Success</strong> : <?php echo $_GET['success']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='hm-signup' method="POST">
                  <div class="student-input">
                       <label for='hm_username' class="signup-label">UserName</label>
                       <input type='text' class="label-input" placeholder='Enter Username' name='hm_username' required>
                    
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
                         <label for='dept' class="signup-label">Hostel Name</label>
                         <input type='text' class="label-input" placeholder='Enter Hostel Name' name='hostel_name' required>
                    </div>
                    <div class="student-input">
                        <label for='year_study' class="signup-label">Email</label>
                        <input type='email' class="label-input" placeholder='Enter Email' name='email' required>
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
                        <input type='submit' name='hm-signup' class="student-submit" placeholder="SignUp">
                        </div>
                  </form> 
                  <h6 class="main-heading student-heading">Remove <a href="remove_hm.php" class='index-a'>Hostel Manager</a></h6> 
              </div>  
           </div>
        </div>    
    </main>      
</body>
</html>