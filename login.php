<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div>
        <nav class='navbar'>
        <ul>
<li class="mini"><a href="index.html">Home</a></li>
<li class="mini"><a href="aboutus.html">Aboutus</a></li>
<li class="mini"><a href="contact.html">Contact</a></li>
<li class="mini"><a href="registration.php">Login</a></li>
<div class="search">
<img src='icon.png' class='icon'> 
<input class="search" type="text" placeholder="search anything">

</div>
        </ul>
    </nav>
        </div>
    <div class="all">
    <?php
       session_start();
       if(isset($_SESSION['status']))
       {
        echo $_SESSION['status'];
        unset($_SESSION['status']);
       }
        
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM new_data WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $message="wrong password";
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    // session_start();
                    // $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                    $_SESSION['status'] = "wrong password";
                    header("Location: login.php");
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <!-- <?php
           if (isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql="SELECT * FROM datas WHERE email = '$email'";
                $result=mysqli_query($conn, $sql);
                $user=mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user)
                 {
                     if (password_verify($password, $user['password']))
                      {
                        header("Location: index.php");
                       die();
                      }
                     else{
                       echo "password doesnt match";
                       header("Location: index.php");
                       }
                    }
                else{

                   echo "<div>email doesnt exists</div>";}
                  }
            
        ?> -->
        <div class="green">
        <div class="blue">
        <form action="login.php" method="post">

<input class="red"  type="email" name="email" placeholder="email">
        <input class="red" type="password" name="password" placeholder="password">

        <input class="log" type="submit" name="login" value="LOGIN">
        </form>
        </div>

        <div><p>not registered yet? <a href="registration.php">register</a></p></div>
        </div>
       
       

    </div>
</body>
</html>