<?php
     session_start();
     include 'includes/config.php';
     if(!isset($_SESSION['studentId'])){
        header('Location:student_index.php');
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
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="wrap">
<div class="home-wrap">
     <div class="head home-text">
     <div class="head-left student-left">
        <a href=""><i class="fa-solid fa-graduation-cap fa-2x"></i>DMGS</a>
    </div>
    <div class="head-right student-right">
        <div class="head-bar"><a href="home.php" class="">Home</a></div>
        <div class="head-bar"><a href="hostels.php" class="">Hostels</a></div>
        <div class="head-bar"><a href="contact.php" class="">Contact</a></div>
        <div class="head-bar"><a href="profile.php" class=""><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?></a></div>
        <div class="head-bar"><a href="logout.php" class="">Logout</a></div>
     </div>
    </div>
     </div> 
    <div>
    <div class="hero">
       <div class="hero-left">
       <h1 class="hero-head">Hostel Management System</h1>
       <p class="hero-paragraph">Choose from a wide range of well serviced apartments online</p>
       <button class="hero-btn">EXPLORE</button>
    </div>
       <div class="hero-right">
       <img src="assets/images/a5.png" class="hero-img">
    </div>
    </div>
    <div  class="bottom">
        <div class="bottom-text">
            <h3>Featured</h3>
        </div>
        <div class="bottom-content">
            <img src="assets/images/a3.png" class="bottom-img">
            <p class="bottom-p">Alamanda</p>
        </div>
        <div class="bottom-content">
            <img src="assets/images/a2.png" class="bottom-img f2">
            <p class="bottom-p">Jasmine</p>
        </div>
        <div class="bottom-content">
            <img src="assets/images/a4.png" class="bottom-img f3">
            <p class="bottom-p">Marigold</p>
        </div>
        <div class="bottom-arrow" id="btn"><i class="fa fa-arrow-right f4" aria-hidden="true"></i></div>
    </div>
    </div>
    </div>

</body>
</html><?php } ?>