<?php
     session_start();
    include '../includes/config.php';
     if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 0){
        header('Location:hmanager_index.php');
        exit();
    }
    else{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/styles.css?<?php echo time();?>" />
</head>
<body>
<div class="wrap">
<div class="home-wrap">
     <div class="head home-text">
     <div class="head-left">
        <a href="hmanager_home.php"><i class="fa-solid fa-graduation-cap fa-1x"></i>DMGS</a>
    </div>
    <div class="head-right">
        <div class="head-bar"><a href="hmanager_home.php" class="">Home</a></div>
        <div class="head-bar"><a href="applications.php" class="">Applications Received</a></div>
        <div class="head-bar"><a href="allocate.php" class="">Allocate Rooms</a></div>
        <div class="head-bar"><a href="empty.php" class="">Empty Rooms</a></div>
        <div class="head-bar"><a href="vacate.php" class="">Vacate Rooms</a></div>
        <div class="head-bar"><a href="messages.php" class="">Messages</a></div>
        <div class="head-bar"><a href="hm_profile.php" class=""><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></a></div>
        <div class="head-bar"><a href="/hls/logout.php" class="">Logout</a></div>
     </div>
    </div>
     </div> 
    <div>
    <div class="hero">
       <div class="hero-left">
       <h1 class="hero-head">Hostel Management System</h1>
       <p class="hero-paragraph">Choose from a wide range of well crafted premuim quality wooden furniture online</p>
       <button class="hero-btn">EXPLORE</button>
    </div>
       <div class="hero-right">
       <img src="../assets/images/hero.png" class="hero-img">
    </div>
    </div>
    <div  class="bottom">
        <div class="bottom-text">
            <h3>Featured</h3>
        </div>
        <div class="bottom-content">
            <img src="../assets/images/f3.png" class="bottom-img">
            <p class="bottom-p">Alamanda</p>
        </div>
        <div class="bottom-content">
            <img src="../assets/images/f2.png" class="bottom-img f2">
            <p class="bottom-p">Jasmine</p>
        </div>
        <div class="bottom-content">
            <img src="../assets/images/f1.png" class="bottom-img f3">
            <p class="bottom-p">Marigold</p>
        </div>
        <div class="bottom-arrow" id="btn"><i class="fa fa-arrow-right f4" aria-hidden="true"></i></div>
    </div>
    </div>
    </div>

</body>
</html><?php } ?>