<?php
     session_start();
    include 'includes/config.php';
    if(!isset($_SESSION['studentId'])){
        header('Location:student_index.php');
        exit();
    }
    else{
    if(isset($_POST['apply']) && isset($_GET['id'])){
        $studentId = $_SESSION['studentId'];
        $hostel = $_GET["id"];
        $password = $_POST["password"];
        $message = $_POST["message"];
        $application_status = 1;
        $sql = "SELECT * FROM student WHERE student_id='$studentId'";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if(is_null($result['room_id'])){
        $sql1 = "SELECT * FROM application WHERE student_id='$studentId'";
        $query1 = $conn->prepare($sql1);
        $query1->execute();
        $result1 = $query1->fetch(PDO::FETCH_ASSOC);
        if($query1->rowCount()==0){
            $sql2 = "SELECT * FROM student WHERE student_id='$studentId'";
            $query2 = $conn->prepare($sql2);
            $query2->execute();
            $result2 = $query2->fetch(PDO::FETCH_ASSOC);
            if($result2){
                $pwdcheck = password_verify($password, $result2['pwd']);
                 if($pwdcheck==false){
                    header('Location:application_form.php?error=Invalid Password');
                    exit();
                 }
                 else if($pwdcheck==true){
                     $sql3 = "SELECT * FROM hostel WHERE hostel_name='$hostel'";
                      $query3 = $conn->prepare($sql3);
                      $query3->execute();
                      $result3 = $query3->fetch(PDO::FETCH_ASSOC);
                      $hostel_id = $result3['hostel_id'];
                      $sql4 ="INSERT INTO application(student_id, hostel_id, application_status, message) VALUES (:studentId, :hostel_id, :application_status, :message)";
                      $query4 = $conn->prepare($sql4);
                      $query4->bindParam(':studentId', $studentId, PDO :: PARAM_STR);
                      $query4->bindParam(':hostel_id', $hostel_id, PDO :: PARAM_STR);
                      $query4->bindParam(':application_status', $application_status, PDO :: PARAM_STR);
                      $query4->bindParam(':message', $message, PDO :: PARAM_STR);
                      $query4->execute();
                      $lastInsertId = $conn->lastInsertId();
                      header('Location:application_form.php?success=Application form sent successfully');
                      exit();
                 }
                }
        }
        else {
            header('Location:application_form.php?error=You have Already applied for a Room');
            exit();
        }
        }
        else {
            header('Location:application_form.php?error=You have Already been alloted a Room');
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
        <div class="head-bar"><a href="index.php" class="index-a">HOSTEL MANAGEMENT SYSTEM</a></div>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper app-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">APPLICATION FORM</h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
                 <?php if(isset($_GET['success'])){?><div class="errorWrap"><strong>Success</strong> : <?php echo $_GET['success']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='application' action="" method="POST">
                    <div class="student-input">
                         <label for='fullname' class="signup-label">FullName</label>
                         <input type='text' class="label-input" placeholder='Enter Fullname' name='fullname' value="<?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>" required disabled="disabled">
                    </div>
                    <div class="student-input">
                         <label for='studentId' class="signup-label">Student-Id</label>
                         <input type='text' class="label-input" placeholder='Enter Student Id' name='studentId' value="<?php echo $_SESSION['studentId']; ?>" required disabled="disabled">
                    </div>                   
                    <div class="student-input">
                         <label for='hostelId' class="signup-label">Hostel</label>
                         <input type='text' class="label-input" placeholder='Enter Hostel' name='hostel' value="<?php echo $_GET["id"]; ?>" required disabled="disabled">
                    </div>
                    <div class="student-input">
                         <label for='password' class="signup-label">Enter Password</label>
                         <input type='password' class="label-input" placeholder='Enter Password' name='password' required>
                    </div>
                    <div class="student-input">
                         <label for='studentId' class="signup-label">Enter Message</label>
                         <textarea name="message" placeholder="Message..." class="label-input"></textarea>
                    </div>
                    <div class="student-input">
                         <input type='submit' class="student-submit" placeholder="Click To Apply" name='apply'>
                    </div>
                  </form>  
              </div>  
           </div>
        </div>    
    </main>      
</body>
</html>