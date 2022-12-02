<?php
  session_start();
  $con = mysqli_connect('localhost','root','');
  $_SESSION['currentuser'] = "admin";

  if(!((isset($_SESSION['adminuser'])))){
    header('Location: admin_login.php');
  }
  if(!$con){
    die ("Connection Failed". mysqli_connect_error());
  }

  $db = mysqli_select_db($con,'university_database');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=., initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" >
  </head>
  <body>
    <header>
      <h1>Management System</h1>
      <h2>Admin Dashboard</h2>
    </header>

    <main class="dash">
      <div class="tab">
        <button type="button" onclick="showTab(event,'Search')" class="tablink">
          Search for a student
        </button>
        <button type="button" onclick="showTab(event,'Add')" class="tablink">
          Add a student
        </button>
        <button type="button" onclick="showTab(event,'Remove')" class="tablink">
          Remove a student
        </button>
        <button type="button" onclick="showTab(event,'Update')" class="tablink">
          Update details
        </button>
        
      </div>

      <div class="content">
      <div id="Search" class="tab-content" >
        <h2>Search for a student</h2>
        <p>Enter the roll no. of the student you want to search for</p>
        <form action="admin_search.php" method="post" class="form">
          <label
            >Roll No: <input type="number" maxlength="10" name="rollno"
          /></label>
          <button type="submit" name="search">Search</button>
        </form>

        
      </div>

      

      <div id="Add" class="tab-content">
        <h2>Add a student</h2>
        <p>Enter the details of the student you want to add</p>
        <form action="" method="post" class="form">
          <table>
            <tr>
              <td><label for="rollno">Roll No:</label></td>
              <td><input type="number" maxlength="10" name="rollno" id="rollno" required></td>
            </tr>
            <tr>
              <td><label for="name">Student's Name:</label></td>
              <td><input type="text" name="name" id="name" required></td>
            </tr>
            <tr>
              <td><label for="fname">Father's Name:</label></td>
              <td><input type="text" name="fname" id="fname" required></td>
            </tr>
            <tr>
              <td><label for="attendance">Attendance:</label></td>
              <td><input type="number" maxlength="3" name="attendance" id="attendance" required></td>
            </tr>
            <tr>
              <td><label for="cgpa">CGPA:</label></td>
              <td><input type="number" name="cgpa" id="cgpa" required></td>
            </tr>
            <tr>
              <td><label for="email">Email:</label></td>
              <td><input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
              <td><label for="password">Password:</label></td>
              <td><input type="password" name="pass" id="password" required></td>
            </tr>
          </table>
          <button type="submit" name="add">Add Student</button>
        </form>

        <?php
          if(isset($_POST['add'])){
            $query = "Insert into student values('$_POST[rollno]', '$_POST[name]', '$_POST[fname]', '$_POST[attendance]', '$_POST[cgpa]', '$_POST[email]', '$_POST[pass]')";
            $queryrun = mysqli_query($con, $query);

            if($queryrun){
              ?>
              <script>
                alert("Student Added Successfully!");
              </script>
              <?php
            }

            else{
              ?>
              <script>
                alert("Student could not be added :<");
              </script>
              <?php
            }
          }
        ?>
      </div>

      <div id="Remove" class="tab-content">
        <h2>Remove a student</h2>
        <p>Enter the roll no. of the student you want to remove</p>
        <form action="" method="post" class="form">
          <label
            >Roll No: <input type="number" maxlength="10" name="rollno"
          /></label>
          <button type="submit" name="remove">Remove Student</button>
        </form>

        <?php
          if(isset($_POST['remove'])){
            $query = "DELETE FROM `student` WHERE `student`.`rollno` = '$_POST[rollno]';";
            $queryrun = mysqli_query($con, $query);

            if($queryrun){
              ?>
              <script>
                alert("Student Removed Successfully (if he existed that is)!");
              </script>
              <?php
            }

            else{
              ?>
              <script>
                alert("Error! :<");
              </script>
              <?php
            }
          }
        ?>
      </div>

      <div id="Update" class="tab-content" >
        <h2>Update the details of a student</h2>
        <p>
          Enter the roll no. of the student you want to update the details of
        </p>
        <form action="" method="post" class="form">
          <label
            >Roll No: <input type="number" maxlength="10" name="rollno"
          /></label>
          <button type="submit" name="update">Update Details</button>
        </form>

        
      </div>

      <?php
          if(isset($_POST['update'])){
            $query = "Select * from student where rollno = $_POST[rollno]";
            $queryrun = mysqli_query($con, $query);
            $run = mysqli_fetch_assoc($queryrun);
            
            
            if(isset($run)){
              ?>
              
              <form action="admin_edit_student.php" method="get" >
                <table>
                  <tr>
                    <td><label for="roll_no">Roll No:</label></td>
                    <td><input type="number" maxlength="10" name='roll_no' value="<?php echo $run['rollno']?>" id="roll_no" required></td>
                  </tr>
                  <tr>
                    <td><label for="stud_name">Student's Name:</label></td>
                    <td><input type="text" maxlength="30" name="stud_name" value="<?php echo $run['name']?>" id="stud_name" required></td>
                  </tr>
                  <tr>
                    <td><label for="faname">Father's Name:</label></td>
                    <td><input type="text" maxlength="30" name="fath_name" value="<?php echo $run['faname']?>" id="faname" required></td>
                  </tr>
                  <tr>
                    <td><label for="attendance_count">Attendance:</label></td>
                    <td><input type="number" maxlength="3" name="attendance_count" value="<?php echo $run['attendance']?>" id="attendance_count" required></td>
                  </tr>
                  <tr>
                    <td><label for="cgpa_a">CGPA:</label></td>
                    <td><input type="number" max="10" name="cgpa_a" value="<?php echo $run['cgpa']?>" id="cgpa_a" required></td>
                  </tr>
                  <tr>
                    <td><label for="mail">Email:</label></td>
                    <td><input type="text" maxlength="30" name="mail" value="<?php echo $run['email']?>" id="mail" required></td>
                  </tr>
                  <tr>
                    <td><label for="pw">Password:</label></td>
                    <td><input type="text" maxlength="30" name="pw" value="<?php echo $run['password']?>" id="pw" required></td>
                  </tr>
                </table>

                <button type="submit" name="update2">Update</button>
                <button type="reset">Reset</button>
            </form>
            <?php

            }
          }
        ?>
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


<!-- DELETE FROM `student` WHERE `student`.`rollno` = 1; -->
