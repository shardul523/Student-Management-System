<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Faculty Login</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" />
  </head>
  <body>
    <header>
      <h1>Faculty Login</h1>
    </header>
    <main class="login">
      <form action="" method="POST" class="cred">
        <label
          >USER:
          <input type="email" name="fuser" placeholder="Enter your username"
        required></label>
        <label
          >PASS:
          <input type="password" name="fpass" placeholder="Enter your password"
        required></label>
        <button type="submit" name="login">Login</button>
        <button type="reset">Reset</button>
      </form>
      <a href="index.php">Home</a>

      <?php
            if(isset($_POST['login'])){
                $con = mysqli_connect('localhost','root','');

                if(!$con){
                    die ("Connection Failed". mysqli_connect_error());
                }

                $db = mysqli_select_db($con,'university_database');
                $query = "SELECT * from faculty where fac_email = '$_POST[fuser]'";
                $queryRun = mysqli_query($con, $query);

                while($run = mysqli_fetch_assoc($queryRun)){
                    if($run['fac_email']==$_POST['fuser']){
                        if($run['fac_password']==$_POST['fpass']){
                          $_SESSION['facuser'] = $run['fac_email'];
                          $_SESSION['facname'] = $run['fac_name'];
                          header('Location: faculty_dashboard.php');
                        }
                        else
                        ?><p1 class="warn"><?php echo "Wrong Password";?></p1><?php
                    }
                }
               
                ?><p1 class="warn"><?php echo "Wrong Username";?></p1><?php
              }
        ?>
    </main>
  </body>
</html>
