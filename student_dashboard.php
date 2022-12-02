<?php
    session_start();
    $_SESSION['currentuser'] = "student";
    if(!isset($_SESSION['suser'])){
        header('Location: student_login.php');
    }
    else{
        $con = mysqli_connect('localhost','root','');
        if(!$con){
            die ("Connection Failed". mysqli_connect_error());
        }
    }

    $db = mysqli_select_db($con, 'university_database')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>.css">
</head>
<body>
    <header>
        <h1>Management System</h1>
        <h2>Student Dashboard</h2>
    </header>

    <main class="dash">
        <div class="tab">
            <button type="button" onclick="showTab(event,'stud_home')" class="tablink" >Details</button>
            <button type="button" onclick="showTab(event,'edit_user')" class="tablink" >Edit Email</button>
            <button type="button" onclick="showTab(event,'edit_pass')" class="tablink">Edit Password</button>
        </div>

        <div class="content">
            <div class="tab-content" id='stud_home'>
                <?php
                    $query = "Select * from student where rollno = '$_SESSION[roll]'";
                    $queryrun = mysqli_query($con, $query);

                    $run = mysqli_fetch_assoc($queryrun);

                    if(isset($run)){

                        ?>
                    <h2>Student Details</h2>
                    <table>
                        <tr>
                            <td>Roll No.</td>
                            <td><?php echo $run['rollno'];?></td>
                        </tr>
                        <tr>
                            <td>Student Name</td>
                            <td><?php echo $run['name'];?></td>
                        </tr>
                        <tr>
                            <td>Father's Name</td>
                            <td><?php echo $run['faname'];?></td>
                        </tr>
                        <tr>
                            <td>Attendance</td>
                            <td><?php echo $run['attendance'];?></td>
                        </tr>
                        <tr>
                            <td>CGPA</td>
                            <td><?php echo $run['cgpa'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $run['email'];?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><?php echo $run['password'];?></td>
                        </tr>
                    </table>
                        <?php
                    }
                ?>
            </div>
            <div class="tab-content" id="edit_user">
                    <h2>Edit Email</h2>

                    <form action="edit_student.php" method="post">
                        <legend>Enter the original email id and the new email id</legend>
                        <table>
                            <tr>
                                <td><label for="og_user">Original Email ID:</label></td>
                                <td><input type="email" name="og_user" id="og_user" required></td>
                            </tr>
                            <tr>
                                <td><label for="new_user">New Email ID:</label></td>
                                <td><input type="email" name="new_user" id="new_user" required></td>
                            </tr>

                            <tr>
                                <td><label for="conf_user">Confirm new Email ID:</label></td>
                                <td><input type="email" name="conf_user" id="conf_user" required></td>
                            </tr>
                        </table>

                        <button type="submit" name="edit_user">Edit</button>
                    </form>
            </div>
            <div class="tab-content" id="edit_pass">
                    <h2>Edit Password</h2>

                    <form action="edit_student.php" method="post">
                        <legend>Enter the original password and the new password</legend>
                        <table>
                            <tr>
                                <td><label for="og_pass">Original Password:</label></td>
                                <td><input type="password" name="og_pass" id="og_pass" required></td>
                            </tr>
                            <tr>
                                <td><label for="new_pass">New Password:</label></td>
                                <td><input type="password" name="new_pass" id="new_pass" required></td>
                            </tr>

                            <tr>
                                <td><label for="conf_pass">Confirm Password:</label></td>
                                <td><input type="password" name="conf_pass" id="conf_pass" required></td>
                            </tr>
                        </table>

                        <button type="submit" name="edit_pass">Edit Password</button>
                    </form>
            </div>
        </div>
        <a href="logout.php">Logout</a>
    </main>
    <script>
      function showTab(event, opname) {
        let i, tabcontent, tablink;
        tabcontent = document.getElementsByClassName("tab-content");

        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }

        tablink = document.getElementsByClassName("tablink");

        for (i = 0; i < tablink.length; i++) {
          tablink[i].className = tablink[i].className.replace(" active", "");
        }

        document.getElementById(opname).style.display = "block";
        event.currentTarget.className += " active";
      }

    </script>
</body>
</html>