<?php
     session_start();
    include '../includes/config.php';
     if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1){
        header('Location:../hmanager/hmanager_index.php');
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
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
     <div class="head">
                     <a href="admin_home.php" class="index-a">Hostel Managment System Portal</a>
     </div>
    </div>
<main class="app-main">
      <div class=""> 
            <h3>Students</h3>
      </div>
      <div class="app-main">
            <form action="" name="" method="POST">
               <div class="app-bar">
                     <input type="search" placeholder="Search By StudentId" class="app-input" name="studentId">
                     <input type="submit" placeholder="Search" class="app-btn" name="student_search">
               </div>
           </form>
     </div>
</main>
<section>
<?php       
    if(isset($_POST['student_search'])){
        $studentId = $_POST['studentId'];
        $hostel_id = $_SESSION['hostel_id'];
        $sql = "SELECT * FROM student WHERE student_id like '$studentId%'";
        $query = $conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
    ?>
         <div class="main-table">
                   <table class="app-table">
                         <thead>
                         <tr>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Contact Number</th>
                            <th>Hostel</th>
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
                             foreach($results as $result){
                                 $room_id = $result->room_id;
                                 $sthostel_id = $result->hostel_id;
                                 $sql2 = "SELECT * FROM room WHERE room_id='$room_id'";
                                 $query2 = $conn->prepare($sql2);
                                 $query2->execute();
                                 $result2 = $query2->fetch(PDO::FETCH_ASSOC);
                                 $sql3 = "SELECT * FROM hostel WHERE hostel_id='$sthostel_id'";
                                 $query3 = $conn->prepare($sql3);
                                 $query3->execute();
                                 $result3 = $query3->fetch(PDO::FETCH_ASSOC);
                                 $room_num = $result2['room_num'];
                                 $hostel_name = $result3['hostel_name'];
                                 $student_name =$result->firstname." ".$result->lastname;
                                 echo "<tr>
                                 <td>{$student_name}</td>
                                 <td>{$result->student_id}</td>
                                 <td>{$result->mobile_num}</td>
                                 <td>{$hostel_name}</td>
                                 <td>{$room_num}</td>
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
        <h3 class="">Rooms Alloted</h3>
    </div>
    <?php
        $sql4 = "SELECT * FROM student";
        $query4 = $conn->prepare($sql4);
        $query4->execute();
        $students = $query4->fetchAll(PDO::FETCH_OBJ);
    ?>
    <div class="main-table">
    <table class="app-table">
                         <thead>
                         <tr>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Contact Number</th>
                            <th>Hostel</th>
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
                             foreach($students as $student){
                                 $stroom_id = $student->room_id;
                                 $stuhostel_id = $student->hostel_id;
                                 $sql5 = "SELECT * FROM room WHERE room_id='$stroom_id'";
                                 $query5 = $conn->prepare($sql5);
                                 $query5->execute();
                                 $result5 = $query5->fetch(PDO::FETCH_ASSOC);
                                 $stroom_num = $result5['room_num'];
                                 $sql6 = "SELECT * FROM hostel WHERE hostel_id='$stuhostel_id'";
                                 $query6 = $conn->prepare($sql6);
                                 $query6->execute();
                                 $result6 = $query6->fetch(PDO::FETCH_ASSOC);
                                 $sthostel_name = $result6['hostel_name'];
                                 if(!$sthostel_name){
                                     $sthostel_name="None";
                                 }
                                 if(!$stroom_num){
                                    $stroom_num="None";
                                }
                                 $student_fullname =$student->firstname." ".$student->lastname;
                                 echo "<tr>
                                 <td>{$student_fullname}</td>
                                 <td>{$student->student_id}</td>
                                 <td>{$student->mobile_num}</td>
                                 <td>{$sthostel_name}</td>
                                 <td>{$stroom_num}</td>
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