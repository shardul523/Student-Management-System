<?php
  session_start();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <h1>Admin Login</h1>
    </header>
    <main class="login">
      <form action="admin_login.php" method="POST" class="cred">
        <label
          >USER:
          <input type="email" name="auser" placeholder="Enter your username"
        required></label>
        <label
          >PASS:
          <input type="password" name="apass" placeholder="Enter your password"
        required></label>
        <button type="submit" name="login">Submit</button>
      </form>
      <a href="index.php">Home</a>
        <?php
            if(isset($_POST['login'])){
                $con = mysqli_connect('localhost','root','');

                if(!$con){
                    die ("Connection Failed". mysqli_connect_error());
                }

                $db = mysqli_select_db($con,'university_database');
                $query = "SELECT * from admin where Username = '$_POST[auser]'";
                $queryRun = mysqli_query($con, $query);

                while($run = mysqli_fetch_assoc($queryRun)){
                    if($run['Username']==$_POST['auser']){
                        if($run['Password']==$_POST['apass']){
                          $_SESSION['adminuser'] = $run['Username'];
                          $_SESSION['adminname'] = $run['Name'];
                          header('Location: admin_dashboard.php');
                        }
                        else
                        ?><p1 class="warn"><?php echo "Wrong Password";?></p1><?php
                    }
                    else
                    ?><p1 class="warn"><?php echo "Wrong Username";?></p1><?php
                }

            }
        ?>


    </main>

  </body>
</html>


