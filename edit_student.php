<?php
    session_start();

    if(!isset($_SESSION['suser'])){
        header('Location: student_login.php');
    }
    $con = mysqli_connect('localhost','root','');
    $db = mysqli_select_db($con, 'university_database');
    $sucess = false;
    $user = $_SESSION['currentuser'];
    if(isset($_POST['edit_user'])){
        if($_POST['og_user']==$_SESSION['suser']){
            if($_POST['new_user']==$_POST['conf_user']){
                $query = "Update student set student.email = '$_POST[new_user]' where student.rollno = '$_SESSION[roll]'";
                $queryrun = mysqli_query($con, $query);

                
                    $sucess = true;
                    $_SESSION['suser'] = $_POST['new_user'];
                
            }

        }



       
    }

    if(isset($_POST['edit_pass'])){
        if($_POST['og_pass']==$_SESSION['spass']){
            if($_POST['new_pass']==$_POST['conf_pass']){
                $query = "Update student set student.password = '$_POST[new_pass]' where student.rollno = '$_SESSION[roll]'";
                $queryrun = mysqli_query($con, $query);

                
                    $sucess = true;
                    $_SESSION['spass'] = $_POST['new_pass'];
                

            }
        }


    }

    if(isset($_POST['update_cgpa'])){
        $query = "Update student set student.cgpa = '$_POST[new_cgpa]' where student.rollno = '$_SESSION[stud_rollno]'";
        $queryrun = mysqli_query($con,$query);
        $sucess = true;
    }

    if(isset($_POST['update_attendance'])){
        $query = "Update student set student.attendance = '$_POST[new_attendance]' where student.rollno = '$_SESSION[stud_rollno]'";
        $queryrun = mysqli_query($con,$query);
        $sucess = true;
    }

    if($sucess){
        ?>
        <script>
            let user = "<?php echo $user ?>";
        alert("Edit successful");
        window.location.href = user+"_dashboard.php";</script>
    <?php
    }
?>