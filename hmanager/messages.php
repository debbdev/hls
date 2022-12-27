<?php
     session_start();
    include '../includes/config.php';
     if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 0){
        header('Location:hmanager_index.php');
        exit();
    }
    else{
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
        <div class="head-bar"><a href="index.php" class="index-a">HOSTEL MANAGEMENT SYSTEM</a></div>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper msg-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h2 class="main-heading student-heading">Messages</h2>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
                 <?php if(isset($_GET['success'])){?><div class="errorWrap"><strong>Success</strong> : <?php echo $_GET['success']; ?> </div><?php }?>
                 <?php
                       $hmanager_id =$_SESSION['hmanager_id'];
                       $sql = "SELECT * FROM message WHERE hmanager_id='$hmanager_id' ORDER BY message_time DESC LIMIT 1, 5";
                       $query = $conn->prepare($sql);
                       $query->execute();
                       $result = $query->fetchAll(PDO::FETCH_OBJ);
                      
                    ?>
              <div class='msg-box'>
                    <?php
                          foreach($result as $msg){
                            $subject=$msg->subject;
                            $message=$msg->message;
                            $student_id=$msg->student_id;
                            $date=$msg->message_date;
                            $time=$msg->message_time;
                        
                    ?>
                    <div class="message">
                       <h4><?php echo $subject; ?></h4>
                    </div>
                    <div class="message msgs">
                       <p><?php echo $message; ?></p>
                    </div>                   
                    <div class="message">
                       <p><?php echo $student_id; ?></p>
                    </div>
                    <div class="message msg">
                        <p><?php echo $date; ?></p>
                        <p><?php echo $time; ?></p>
                    </div>
                        <hr>
                    <?php } ?>
              </div>  
           </div>
        </div>    
    </main>      
</body>
</html><?php } ?>