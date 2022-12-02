<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" />
  </head>
  <body>
    <header>
      <h1>Student Login</h1>
    </header>
    <main class="login">
      <form action="" method="POST" class="cred">
        <label
          >USER:
          <input type="email" name="user" placeholder="Enter your username"
         required/></label>
        <label
          >PASS:
          <input type="password" name="pass" placeholder="Enter your password"
        required/></label>
        <button type="submit" name="login">Submit</button>
      </form>

      <a href="index.html">Home</a>

      <?php
            if(isset($_POST['login'])){
                $con = mysqli_connect('localhost','root','');

                if(!$con){
                    die ("Connection Failed". mysqli_connect_error());
                }

                $db = mysqli_select_db($con,'university_database');
                $query = "SELECT * from student where email = '$_POST[user]'";
                $queryRun = mysqli_query($con, $query);
                $run = mysqli_fetch_assoc($queryRun);
                if(isset($run)){
                    if($run['email']==$_POST['user']){
                        if($run['password']==$_POST['pass'])
                        {
                          $_SESSION['suser'] = $run['email'];
                          $_SESSION['sname'] = $run['name'];
                          $_SESSION['roll'] = $run['rollno'];
                          $_SESSION['spass'] = $run['password'];
                          header('Location: student_dashboard.php');
                        }
                        else
                        ?><p1 class="warn"><?php echo "Wrong Password";?></p1><?php
                    }
                }
                else
                ?><p1 class="warn"><?php echo "Wrong Username";?></p1><?php

              

            }
      ?>
    </main>
  </body>
</html>
