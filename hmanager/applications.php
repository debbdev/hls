<?php
     session_start();
    include '../includes/config.php';
    ini_set('display_errors', 1);
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
            <h3>Received Applications</h3>
      </div>
      <div class="app-main">
            <form action="" name="" method="POST">
               <div class="app-bar">
                     <input type="search" placeholder="Search By StudentId" class="app-input" name="studentId">
                     <input type="submit" placeholder="Search" class="app-btn" name="msg_search">
               </div>
           </form>
     </div>
</main>
<section>
<?php       
    if(isset($_POST['msg_search'])){
        $studentId = $_POST['studentId'];
        $hostel_id = $_SESSION['hostel_id'];
        $sql = "SELECT * FROM application WHERE student_id like '$studentId%' AND hostel_id='$hostel_id' AND application_status='1'";
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
                         <tr class="table-row">
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Contact Number</th>
                            <th>Hostel</th>
                            <th>Message</th>
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
                             foreach($result as $student){
                                 $student_id = $student->student_id;
                                 $sql3 = "SELECT * FROM student WHERE student_id='$student_id'";
                                 $query3 = $conn->prepare($sql3);
                                 $query3->execute();
                                 $result3 = $query3->fetch(PDO::FETCH_ASSOC);
                                 $student_name =$result3['firstname']." ".$result3['lastname'];
                                 echo "<tr>
                                 <td>{$student_name}</td>
                                 <td>{$student_id}</td>
                                 <td>{$result3['mobile_num']}</td>
                                 <td>{$hostel_name}</td>
                                 <td>{$student->message}</td>
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
        <h3 class="">Applications Received</h3>
    </div>
    <?php
        $hostel_id = $_SESSION['hostel_id'];
        $sql4 = "SELECT * FROM application WHERE hostel_id='$hostel_id' AND application_status='1'";
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
    <table class="app-table">
                         <thead>
                         <tr class="table-row">
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Contact Number</th>
                            <th>Hostel Name</th>
                            <th>Message</th>
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
                             foreach($result4 as $stu){
                                 $sth_id = $stu->student_id;
                                 $sql6 = "SELECT * FROM student WHERE student_id='$sth_id'";
                                 $query6 = $conn->prepare($sql6);
                                 $query6->execute();
                                 $result6 = $query6->fetch(PDO::FETCH_ASSOC);
                                 if(!$sthostel_name){
                                     $sthostel_name="None";
                                 }
                                 if(!$stu->message){
                                    $stu->message="None";
                                }
                                 $student_fullname =$result6['firstname']." ".$result6['lastname'];
                                 echo "<tr>
                                 <td>{$student_fullname}</td>
                                 <td>{$result6['student_id']}</td>
                                 <td>{$result6['mobile_num']}</td>
                                 <td>{$sthostel_name}</td>
                                 <td>{$stu->message}</td>
                                 <td></td>
                              </tr>\n";
                              }
                         }
                         ?>
                         </tbody>
                   </table>
    </div>
    <div class=""> 
             <?php if(isset($_GET['success'])){?><div class="errorWrap"><strong>Success</strong> : <?php echo $_GET['success']; ?> </div><?php }?>
         <div class="">
            <form action="applications.php" name="allocate" method="POST">
               <div class="head-bar">
                     <input type="submit" placeholder="Allocate Room" class="app-btn" name="allocate">
               </div>
           </form>
     </div>
    </div>
</div>

    <?php
    if(isset($_POST['allocate'])){
        $sql7 = "SELECT * FROM application WHERE hostel_id='$hostel_id' AND application_status='1'";
        $query7 = $conn->prepare($sql7);
        $query7->execute();
        $result7 = $query7->fetchAll(PDO::FETCH_OBJ);
        foreach($result7 as $app){
            $sql8 = "SELECT * FROM room WHERE room_num = (SELECT MIN(room_num) FROM room where allocated = '0' and hostel_id = '$hostel_id')";
            $query8 = $conn->prepare($sql8);
            $query8->execute();
            $result8 = $query8->fetchAll(PDO::FETCH_OBJ);
            foreach($result8 as $room){
            $room_num =$room->room_num;
            $stuh_id = $app->student_id;
            $sql9 = "UPDATE application SET application_status = '0', room_num = '$room_num' WHERE student_id = '$stuh_id'";
            $query9 = $conn->prepare($sql9);
            $query9->execute();
            $result9 = $query9->fetch(PDO::FETCH_ASSOC);
            
                $room_id = $room->room_id;
                $sql11 = "UPDATE student SET hostel_id = '$hostel_id', room_id = '$room_id' WHERE student_id = '$stuh_id'";
                $query11 = $conn->prepare($sql11);
                $query11->execute();
                $result11 = $query11->fetch(PDO::FETCH_ASSOC);

                $sql10 = "UPDATE room SET allocated = '1' WHERE room_id = '$room_id'";
                $query10 = $conn->prepare($sql10);
                $query10->execute();
                $result10 = $query10->fetch(PDO::FETCH_ASSOC);
                
                    header('Location:allocate.php?success=Room Allocated Successfully');
                    exit();
                

            
        }
        }
    }
    ?>
</body>
</html><?php } ?>