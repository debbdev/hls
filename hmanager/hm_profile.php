<?php
     session_start();
     include '../includes/config.php';
     ini_set('display_errors',1);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
     <div class="head">
        <a href="hmanager_home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
    <main class='profile-main'>
    <?php
            $hostel_id = $_SESSION['hostel_id'];
            $isAdmin = $_SESSION['isAdmin'];
            $sql ="SELECT * FROM hostel WHERE hostel_id='$hostel_id'";
            $query= $conn->prepare($sql);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $hostel_name = $result['hostel_name'];
            if($isAdmin==0){
                $hmanager ="Hostel Manager";
            }
            else{
                $hmanager ="Admin";
            }
            ?>
        <h1 class="main-heading">Welcome to HMS</h1>
        <div class='admin-wrapper hm-wrapper'>
                 <h2 class="main-heading">Personal Info</h2>
                <div class="admin-box p-box">
                    <div class="">
                        <i class="fa-solid fa-graduation-cap fa-5x"></i>
                    </div>
                    <div class="p-item">
                    <h3><?php echo $_SESSION['firstname']." ". $_SESSION['lastname'];?></h3>
                    <h3><?php echo $hmanager;?></h3>
                    <hr>
                    <h3>Username : <?php echo $_SESSION['username'];?></h3>
                    <h3>Mobile Number : <?php echo $_SESSION['mobileNum'];?></h3>
                    <h3>Email : <?php echo $_SESSION['email'];?></h3>
                    <h3>Hostel : <?php echo $hostel_name;?></h3>
        </div>
           </div>
        </div>    
    </main>      
</body>
</html><?php } ?>