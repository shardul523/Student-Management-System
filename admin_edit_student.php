<?php
    session_start();
    $con = mysqli_connect('localhost','root','');
  
    if(!$con){
      die ("Connection Failed". mysqli_connect_error());
    }
  
    $db = mysqli_select_db($con,'university_database');


    if(isset($_GET["update2"])){
              $query = "UPDATE `student` SET `name` = '$_GET[stud_name]', `faname` = '$_GET[fath_name]', `attendance` = '$_GET[attendance_count]', `cgpa` = '$_GET[cgpa_a]', `email` = '$_GET[mail]', `password` = '$_GET[pw]' WHERE `student`.`rollno` = '$_GET[roll_no]';";

              $queryrun = mysqli_query($con, $query);
    }

?>

<script>
    alert("Edit successful");
    window.location.href = "admin_dashboard.php";
</script>