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
    <div class="hostels">
         <h2 class="main-heading">Hostels</h2>
         <div class="hostel-container">
             <?php
             $sql = "SELECT * FROM hostel";
             $query = $conn->prepare($sql);
             $query->execute();
             $results = $query->fetchAll(PDO::FETCH_OBJ);
             if($query->rowCount()>0){
                 foreach ($results as $result){
             ?>
               <div class="hostel a">
                   <i class="fa-solid fa-bed"></i>
                   <a href="application_form.php?id=<?php echo $result->hostel_name;?>"><span>APPLY FOR <?php echo $result->hostel_name;?> HOSTEL
                   <h4><?php echo $result->hostel_name;?> HOSTEL</h4><span>
                   <p><?php echo $result->year;?>yr</p></a>
               </div>
               <?php }} ?>
        </div>
    </div>
</body>
</html> <?php } ?>