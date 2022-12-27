<?php
session_start();
include '../includes/config.php';
if(isset($_POST['hm-login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$sql ="SELECT * FROM hmanager WHERE username=:username";
$query=$conn->prepare($sql);
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->execute();
$result=$query->fetch(PDO::FETCH_ASSOC);
if($query->rowCount()==0){
  header('Location:hmanager_index.php?error=Invalid Username');
  exit();
}
else{
    if(password_verify($password,$result['pwd'])){
     $_SESSION['firstname'] = $result['firstname'];
     $_SESSION['lastname'] = $result['lastname'];
     $_SESSION['username'] = $result['username'];
     $_SESSION['mobileNum'] = $result['mobile_num'];
     $_SESSION['hmanager_id'] = $result['hmanager_id'];
     $_SESSION['email'] = $result['email'];
     $_SESSION['hostel_id'] = $result['hostel_id'];
     $_SESSION['pwd'] = $result['pwd'];
     $_SESSION['isAdmin'] = $result['isAdmin'];
     if($_SESSION['isAdmin']==0){
        header('Location:hmanager_home.php?success=Hostel manager successfully logged in');
        exit();
     }else{
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['mobileNum'] = $result['mobile_num'];
        $_SESSION['hmanager_id'] = $result['hmanager_id'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['hostel_id'] = $result['hostel_id'];
        $_SESSION['pwd'] = $result['pwd'];
        $_SESSION['isAdmin'] = $result['isAdmin'];
        header('Location:../admin/admin_home.php?success=Admin successfully logged in');
        exit();
     }
    }
    else {
     header('Location:hmanager_index.php?error=Invalid Password');
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
    <title>Hostel Management System | Hostel Manager </title>
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
    <div class="container">
     <div class="head">
                     <a href="hmanager_home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">HOSTEL MANAGER LOGIN</h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='hm-login' method="POST">
                       <div class="student-input">
                           <label for='username'>Enter UserName</label>
                           <input type='text' class="label-input" placeholder='Enter Username' name='username' autocomplete='off' required>
                       </div>
                       <div class="student-input">
                           <label for='password'>Enter Password</label>
                           <input type='password' class="label-input" placeholder='Enter Password' name='password' autocomplete='off' required>
                        </div>
                        <div class="student-input">
                           <input type='submit' name='hm-login' class="student-submit">
                          </div>
                  </form> 
                           <h6 class="main-heading student-heading">Login as <a href="#" class='index-a'> Admin</a></h6>
                        
              </div>  
           </div>
        </div>   
    </main>      
</body>
</html>