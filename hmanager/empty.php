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
    <title>Hostel Manager Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
     <div class="head">
                     <a href="hmanager_home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
<main class="app-main">
      <div class=""> 
            <h3>Empty Rooms</h3>
      </div>
      <div class="app-main">
            <form action="" name="" method="POST">
               <div class="app-bar">
                     <input type="search" placeholder="Search By Room Number" class="app-input" name="room_num">
                     <input type="submit" placeholder="Search" class="app-btn" name="empty_search">
               </div>
           </form>
     </div>
</main>
<section>
<?php       
    if(isset($_POST['empty_search'])){
        $room_num = $_POST['room_num'];
        $hostel_id = $_SESSION['hostel_id'];
        $sql = "SELECT * FROM room WHERE room_num like '$room_num%' AND hostel_id='$hostel_id' AND allocated='0'";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $sql2 = "SELECT * FROM hostel WHERE hostel_id='$hostel_id'";
                                 $query2 = $conn->prepare($sql2);
                                 $query2->execute();
                                 $result2 = $query2->fetch(PDO::FETCH_ASSOC);
                                 $hostel_name = $result2['hostel_name'];

    ?>
         <div class="main-table">
                   <table class="app-table">
                         <thead>
                         <tr>
                            <th>Hostel Name</th>
                            <th>Room Number</th>
                         </tr>
                         </thead>
                         <tbody>
                         <?php
                         if($query->rowCount()==0){
                             echo '<tr>
                                     <td>No Data</td>
                                  </tr>';
                         }
                         else{
                             foreach($result as $room){
                                 $roomnum = $room->room_num;
                                 echo "<tr>
                                 <td>{$hostel_name}</td>
                                 <td>{$roomnum}</td>
                              </tr>\n";
                         }
                         }
                         ?>
                         </tbody>
                   </table>
         </div>
<?php } ?>
</section>
<div class="app-main table">
    <div class="">
        <h3 class="">Empty Rooms</h3>
    </div>
    <?php
        $hostel_id = $_SESSION['hostel_id'];
        $sql4 = "SELECT * FROM room WHERE hostel_id='$hostel_id' AND allocated='0'";
        $query4 = $conn->prepare($sql4);
        $query4->execute();
        $result4 = $query4->fetchAll(PDO::FETCH_OBJ);
        $sql5 = "SELECT * FROM hostel WHERE hostel_id='$hostel_id'";
                                 $query5 = $conn->prepare($sql5);
                                 $query5->execute();
                                 $result5 = $query5->fetch(PDO::FETCH_ASSOC);
                                 $sthostel_name = $result5['hostel_name'];
    ?>
    <div class="main-table">
    <table class="app-table empty-table">
                         <thead>
                         <tr>
                            <th>Hostel Name</th>
                            <th>Room Number</th>
                         </tr>
                         </thead>
                         <tbody>
                         <?php
                         if($query4->rowCount()==0){
                             echo '<tr>
                                     <td>No Data</td>
                                  </tr>';
                         }
                         else{
                             foreach($result4 as $rom){
                                 $stroom_num = $rom->room_num;
                                 if(!$sthostel_name){
                                     $sthostel_name="None";
                                 }
                                 if(!$stroom_num){
                                    $stroom_num="None";
                                }
                                 echo "<tr>
                                 <td>{$sthostel_name}</td>
                                 <td>{$stroom_num}</td>
                                 <td></td>
                              </tr>\n";
                              }
                         }
                         ?>
                         </tbody>
                   </table>
    </div>
</div>
</body>
</html><?php } ?>