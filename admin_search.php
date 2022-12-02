        <?php
            session_start();
            $con = mysqli_connect('localhost','root','');
          
            if(!$con){
              die ("Connection Failed". mysqli_connect_error());
            }
          
            $db = mysqli_select_db($con,'university_database');
          if(isset($_POST["search"])){
            $query = "Select * from student where rollno = '$_POST[rollno]';";
            $queryrun = mysqli_query($con, $query);

            $run = mysqli_fetch_assoc($queryrun);
            $user = $_SESSION['currentuser'];
            if($run){

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Student Details</title>
                <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" >

            </head>
            <body>

            <header>
                <h1>Management System</h1>
                <h2>Student Details</h2>
            </header>
            <main class="result">
            <table class="detail">
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

            <a href="<?php echo $user; ?>_dashboard.php">Return</a>
            </main>
            </body>
            </html>
            
            <?php
            }
            else{
              ?>
            <script>alert("No such records found");
            let user = '<?php echo $user;?>';
            console.log(user);
            window.location.href = user+"_dashboard.php"
          </script>
            
            <?php
            
            }
          }
        ?>