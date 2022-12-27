<?php
     session_start();
    include '../includes/config.php';
     if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 0){
        header('Location:hmanager_index.php');
        exit();
    }
    else{
    if(isset($_POST['vacate'])){
        $hostel_id = $_SESSION["hostel_id"];
        $studentId = $_POST['studentId'];
        $hostel = $_POST["hostel"];
        $room_num = (int)$_POST["room_num"];
        $sql1 = "SELECT * FROM room WHERE hostel_id='$hostel_id' AND room_num='$room_num'";
        $query1 = $conn->prepare($sql1);
        $query1->execute();
        $result1 = $query1->fetch(PDO::FETCH_ASSOC);
        $allocated = $result1['allocated'];
        if($result1){
            if($allocated==1){
                $room_id = (int)$result1['room_id'];
                $sql2 = "SELECT * FROM student WHERE student_id='$studentId' AND hostel_id='$hostel_id' AND room_id='$room_id'";
                $query2 = $conn->prepare($sql2);
                $query2->execute();
                $result2 = $query2->fetch(PDO::FETCH_ASSOC);
           if($result2){
                $sql3 = "UPDATE student SET hostel_id=NULL, room_id=NULL WHERE student_id='$studentId'";
                $query3 = $conn->prepare($sql3);
                $query3->execute();
                $result3 = $query3->fetch(PDO::FETCH_ASSOC);
                $sql4 = "UPDATE room SET allocated='0' WHERE room_id='$room_id'";
                $query4 = $conn->prepare($sql4);
                $query4->execute();
                $result4 = $query4->fetch(PDO::FETCH_ASSOC);
                    $sql5 = "DELETE FROM application WHERE student_id='$studentId'";
                    $query5 = $conn->prepare($sql5);
                    $query5->execute();
                    $result5 = $query4->fetch(PDO::FETCH_ASSOC);
                    
                        header('Location:vacate.php?success=Vacated Successfully');
                        exit();
                     
                 }
                
        }
       else {
            header('Location:vacate.php?error=Room not allocated');
            exit();
        }
        }
        else {
            header('Location:vacate.php?error=Invalid Details');
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
        <div class="head-bar"><a href="hmanager_home.php" class="index-a">HOSTEL MANAGEMENT SYSTEM</a></div>
     </div>
    </div>
    </header> 
    <main class='student-main'>
        <div class='student-wrapper'>
           <h1 class="main-heading">Welcome to HMS</h1>
           <div class='student-container'>
                 <h4 class="main-heading student-heading">VACATE ROOM FORM</h4>
                 <?php if(isset($_GET['error'])){?><div class="errorWrap"><strong>Error</strong> : <?php echo $_GET['error']; ?> </div><?php }?>
                 <?php if(isset($_GET['success'])){?><div class="errorWrap"><strong>Success</strong> : <?php echo $_GET['success']; ?> </div><?php }?>
              <div class='form-wrapper'>
                  <form  name='vacate' action="" method="POST">
                    <div class="student-input">
                         <label for='studentId' class="signup-label">Student-Id</label>
                         <input type='text' class="label-input" placeholder='Enter Student Id' name='studentId' required>
                    </div> 
                    <?php 
                     $hostel_id = $_SESSION["hostel_id"];
                     $sql = "SELECT * FROM hostel WHERE hostel_id='$hostel_id'";
                     $query = $conn->prepare($sql);
                     $query->execute();
                     $result = $query->fetch(PDO::FETCH_ASSOC);
                     $hostel_name = $result['hostel_name'];
                    ?>                  
                    <div class="student-input">
                         <label for='hostelId' class="signup-label">Hostel</label>
                         <input type='text' class="label-input" placeholder='Enter Hostel' name='hostel' value="<?php echo $hostel_name; ?>" required disabled="disabled">
                    </div>
                    <div class="student-input">
                         <label for='roomnum' class="signup-label">Enter Room Number</label>
                         <input type='text' class="label-input" placeholder='Enter Room Number' name='room_num' required>
                    </div>
                    <div class="student-input">
                         <input type='submit' class="student-submit" placeholder="Click To Vacate" name='vacate'>
                    </div>
                  </form>  
              </div>  
           </div>
        </div>    
    </main>      
</body>
</html>