<?php
  session_start();

  if(!((isset($_SESSION['facuser'])))){
    header('Location: faculty_login.php');
  }
  $_SESSION['currentuser'] = "faculty";
  $con = mysqli_connect('localhost', 'root', '');
  $db = mysqli_select_db($con, 'university_database');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1>Management System</h1>
      <h2>Faculty Dashboard</h2>
    </header>

    <main class="dash">
        <div class="tab">
          <button
            type="button"
            onclick="showTab(event,'Search')"
            class="tablink"
          >
            Search for a student
          </button>

          <button
            type="button"
            onclick="showTab(event,'e_marks')"
            class="tablink"
          >
            Edit Marks
          </button>

          <button
            type="button"
            onclick="showTab(event,'e_attendance')"
            class="tablink"
          >
            Edit Attendance
          </button>
        </div>

        <div class="content">
        <div id="Search" class="tab-content">
          <h3>Search for the details of a student</h3>
          <p>Enter the roll no of the student you want to search</p>
          <form action="admin_search.php" method="post">
            <label>Roll No: <input type="number" name="rollno" /></label>
            <button type="submit" name="search">Search</button>
          </form>
        </div>

        <div id="e_marks" class="tab-content">
          <h3>Editing Marks</h3>
          <p>Enter the roll no of the student whose marks you want to edit</p>
          <form action="" method="post">
            <label>Roll No: <input type="number" name="rollno" /></label>
            <button type="submit" name="search">Search</button>
          </form>
          
          <?php
            if(isset($_POST['rollno'])){
              $query = "Select * from student where rollno = '$_POST[rollno]'";
              $querRun = mysqli_query($con, $query);
              $run = mysqli_fetch_assoc($querRun);
              $_SESSION['stud_rollno'] = $run['rollno'];
              ?>
                <p>Roll No: <?php echo $run['rollno']?></p>
                <p>Student Name: <?php echo $run['name']?></p>
                <p>CGPA: <?php echo $run['cgpa']?></p>
                <form action="edit_student.php" method="post">
                  <legend>Please enter the new cgpa of the student</legend>
                  <label for="new_cgpa">Updated CGPA:</label>
                    
                  <input type="number" max="10" name="new_cgpa" id="new_cgpa">
                  <button type="submit" name="update_cgpa">Update</button>
                </form>
              <?php
              
            }
          ?>
        </div>

        <div id="e_attendance" class="tab-content">
          <h3>Editing Attendance</h3>
          <p>Enter the roll no of the student whose marks you want to edit</p>
          <form action="" method="post">
            <label>Roll No: <input type="number" name="rollno" /></label>
            <button type="submit" name="search">Search</button>
          </form>

          <?php
            if(isset($_POST['rollno'])){
              $query = "Select * from student where rollno = '$_POST[rollno]'";
              $querRun = mysqli_query($con, $query);
              $run = mysqli_fetch_assoc($querRun);

              ?>
                <p>Roll No: <?php echo $run['rollno']?></p>
                <p>Student Name: <?php echo $run['name']?></p>
                <p>Attendance: <?php echo $run['attendance']?></p>
                <form action="edit_student.php" method="post">
                  <legend>Please enter the new attendance of the student</legend>
                  <label for="new_attendance">Updated Attendance:</label>
                  <input type="number" max="999" name="new_attendance" id = "new_attendance">
                  <button type="submit" name="update_attendance" >Update</button>
                 
                </form>
              <?php
              
            }
          ?>
        </div>

        
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
