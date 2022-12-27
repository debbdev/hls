<?php
session_start();
include '../includes/config.php';
     if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1){
        header('Location:../hmanager/hmanager_index.php');
        exit();
    }
    else{
if(isset($_POST['hm-remove']))
{
$username=$_POST['username'];
$hostel_name=$_POST['hostel_name'];
$password=$_POST['password'];
$sql ="SELECT * FROM hmanager WHERE username=:username";
$query=$conn->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_ASSOC);
if($query->rowCount()==0){
  header('Location:remove_hm.php?error=Invalid Username');
  exit();
}
else{
    $sql2 ="SELECT * FROM hostel WHERE hostel_name=:hostel_name";
    $query2=$conn->prepare($sql2);
    $query2->bindParam(':hostel_name', $hostel_name, PDO::PARAM_STR);
    $query2->execute();
    $result2=$query2->fetch(PDO::FETCH_ASSOC);
    $hostel_id = $result2['hostel_id'];
    if($hostel_id==$result['hostel_id']){
        $pwdcheck = password_verify($password,$_SESSION['pwd']);
        if($pwdcheck==false){
            header('Location:remove_hm.php?error=Invalid Password');
            exit();
        }
        else{
            $sql3 ="DELETE FROM hmanager WHERE username=:username";
            $query3=$conn->prepare($sql3);
            $query3->bindParam(':username', $username, PDO::PARAM_STR);
            $result3=$query3->execute();
            if($result3){
                header('Location:remove_hm.php?success=Deleted Successfully');
                exit();
            }
            else{
                header('Location:remove_hm.php?error=Deletion Failure');
                exit();
            }
        }
        }
        else{
            header('Location:remove_hm.php?error=Invalid Hostel');
            exit();
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
    <header>
    <div class="container">
     <div class="head">
                     <a href="admin_home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">REMOVE HOSTEL MANAGER</h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
                 <?php if(isset($_GET['success'])){?><div class="errorWrap"><strong>Success</strong> : <?php echo $_GET['success']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='hm-remove' method="POST">
                       <div class="student-input">
                           <label for='username' class="signup-label">Enter UserName</label>
                           <input type='text' class="label-input" placeholder='Enter Username' name='username' autocomplete='off' required>
                       </div>
                       <div class="student-input">
                           <label for='hostel_name' class="signup-label">Enter Hostel Name</label>
                           <input type='text' class="label-input" placeholder='Enter Hostel Name' name='hostel_name' autocomplete='off' required>
                        </div>
                        <div class="student-input">
                           <label for='password' class="signup-label">Enter Admin Password</label>
                           <input type='password' class="label-input" placeholder='Enter Password' name='password' autocomplete='off' required>
                        </div>
                        <div class="student-input">
                           <input type='submit' name='hm-remove' class="student-submit" placeholder="Remove Hostel Manager">
                          </div>
                  </form> 
              </div>  
           </div>
        </div>   
    </main>      
</body>
</html>