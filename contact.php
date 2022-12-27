<?php
     session_start();
    include 'includes/config.php';
    ini_set('display_errors', 1);
    if(isset($_POST['contact'])){
        $studentId = $_SESSION['studentId'];
        $hostel_name = $_POST["hostel_name"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        $date =  date("Y-m-d");
        $time = date("H:i:s");
        $sql = "SELECT * FROM hostel WHERE hostel_name='$hostel_name'";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $hostel_id = $result['hostel_id'];
        $sql1 = "SELECT * FROM hmanager WHERE hostel_id='$hostel_id'";
        $query1 = $conn->prepare($sql1);
        $query1->execute();
        $result1 = $query1->fetch(PDO::FETCH_ASSOC);
        $hmanager_id = $result1['hmanager_id'];
        if($hostel_name==$result['hostel_name']){
                      $sql2 ="INSERT INTO message(student_id, hostel_id, hmanager_id, subject, message, message_date, message_time) VALUES (:studentId, :hostel_id, :hmanager_id, :subject, :message, :date, :time)";
                      $query2 = $conn->prepare($sql2);
                      $query2->bindParam(':studentId', $studentId, PDO :: PARAM_STR);
                      $query2->bindParam(':hostel_id', $hostel_id, PDO :: PARAM_STR);
                      $query2->bindParam(':hmanager_id', $hmanager_id, PDO :: PARAM_STR);
                      $query2->bindParam(':subject', $subject, PDO :: PARAM_STR);
                      $query2->bindParam(':message', $message, PDO :: PARAM_STR);
                      $query2->bindParam(':date', $date, PDO :: PARAM_STR);
                      $query2->bindParam(':time', $time, PDO :: PARAM_STR);
                      $query2->execute();
                      $lastInsertId = $conn->lastInsertId();
                        header('Location:contact.php?success=Contact form sent successfully');
                        exit();
        }
        else {
            header('Location:contact.php?error=Invalid Hostel');
            exit();
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
        <div class="head-bar"><a href="home.php" class="index-a">HOSTEL MANAGEMENT SYSTEM</a></div>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper contact-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">CONTACT FORM</h4>
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
                         <label for='hostelname' class="signup-label">Hostel Name</label>
                         <input type='text' class="label-input" placeholder='Enter Hostel' name='hostel_name' required>
                    </div>
                    <div class="student-input">
                         <label for='password' class="signup-label">Enter Subject</label>
                         <input type='text' class="label-input" placeholder='Enter Subject' name='subject' required>
                    </div>
                    <div class="student-input">
                         <label for='message' class="signup-label">Enter Message</label>
                         <textarea name="message" placeholder="Message..." class="label-input"></textarea>
                    </div>
                    <div class="student-input">
                         <input type='submit' class="student-submit" placeholder="Contact Hostel Manager" name='contact'>
                    </div>
                  </form>  
              </div>  
           </div>
        </div>    
    </main>      
</body>
</html>