<?php
     session_start();
     include 'includes/config.php';
     if(!isset($_SESSION['studentId'])){
        header('Location:student_index.php');
        exit();
    }
    else{
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System | Student </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
     <div class="head">
        <a href="home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
    <main class='profile-main'>
        <h1 class="main-heading">Welcome to HMS</h1>
        <div class='box-wrapper'>
        <div class='admin-wrapper profile-gap'>
            <h2 class="main-heading">Personal Info</h2>
           <div class="admin-box p-box">
                <div class="">
                    <i class="fa-solid fa-graduation-cap fa-5x"></i>
                </div>
                <div class="p-item">
                    <h3><?php echo $_SESSION['firstname']." ". $_SESSION['lastname'];?></h3>
                    <?php
                    $student = $_SESSION['studentId'];
                    if(isset($student)){
                        $student ="Student";
                    }
                ?>
                <p><?php echo $student;?></p>
                <hr>
                    <h3><?php echo $_SESSION['studentId'];?></h3>
                    <h3><?php echo $_SESSION['mobileNum'];?></h3>
                    <h3><?php echo $_SESSION['dept'];?></h3>
                    <h3><?php echo $_SESSION['yearstudy'];?></h3>
                </div>
           </div>
        </div>
           <div class='admin-wrapper profile-gap'>
              <h2 class="main-heading">Hostel Info</h2>
              <div class="admin-box p-box">
                <div class="">
                    <i class="fa-solid fa-graduation-cap fa-5x"></i>
                </div>
                <div class="p-item">
                <h3><?php echo $_SESSION['firstname']." ". $_SESSION['lastname'];?></h3>
                <?php
                    $student = $_SESSION['studentId'];
                    if(isset($student)){
                        $student ="Student";
                    }
                ?>
                <p><?php echo $student;?></p>
                <hr>
                    <?php
                    $hostel_id = $_SESSION['hostel_id'];
                    if(isset($_SESSION['hostel_id'])){
                        $sql = "SELECT * FROM hostel WHERE hostel_id='$hostel_id'";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetch(PDO::FETCH_ASSOC);
                        $hostel_name = $results['hostel_name'];
                    }
                    ?>
                    <h3><?php echo $hostel_name;?></h3>
                    <?php
                    $room_id = $_SESSION['room_id'];
                    if(isset($_SESSION['room_id'])){
                        $sql1 = "SELECT * FROM room WHERE room_id='$room_id'";
                        $query1 = $conn->prepare($sql1);
                        $query1->execute();
                        $result = $query1->fetch(PDO::FETCH_ASSOC);
                        $room_num = $result['room_num'];
                    }
                    ?>
                    <h3><?php echo $room_num;?></h3>
                </div>
            </div>
           </div>
          
           <div class='admin-wrapper profile-gap'>
              <h2 class="main-heading">Hostel Manager Info</h2>
           <div class="admin-box p-box">
                <div class="">
                    <i class="fa-solid fa-graduation-cap fa-5x"></i>
                </div>
                <div class="p-item">
                <?php
                    $hostel_id = $_SESSION['hostel_id'];
                    if(isset($_SESSION['hostel_id'])){
                        $sql = "SELECT * FROM hmanager WHERE hostel_id='$hostel_id'";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $results = $query->fetch(PDO::FETCH_ASSOC);
                        $hm_firstname = $results['firstname'];
                        $hm_lastname = $results['lastname'];
                        $hm_mobile = $results['mobile_num'];
                        $hm_email = $results['email'];
                        $hm_isAdmin = $results['isAdmin'];
                        if($hm_isAdmin==0){
                            $hmanager ="Hostel Manager";
                        }
                        else{
                            $hmanager ="Admin";
                        }
                    }
                    ?>
                    <h3><?php echo $hm_firstname." ". $hm_lastname;?></h3>
                    <p><?php echo $hmanager;?></p>
                    <hr>
                    <h3><?php echo $hm_mobile;?></h3>
                    <h3><?php echo $hm_email;?></h3>
               </div>
           </div>
           </div>
        </div>
    </main>      
</body>
</html><?php } ?>