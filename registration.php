<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
                <?php
              if(isset($_POST["submit"])){
        $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];
          $email=$_POST["email"];
        $password=$_POST["password"];
        $passwordHash=password_hash($password, PASSWORD_DEFAULT);
        $errors=array();
        if (empty($firstname) OR empty($lastname) OR empty($email) OR empty($password)){
            array_push($errors,"all fields are required");
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            array_push($errors,"invalid email");
        }
        if (strlen($password) <8 )
        {
            array_push($errors,"invalid password");
        }
        if (count($errors)>0)
        {
            foreach ($errors as $error)
            {
                echo "satyanas";
           }
        }else{
        require_once "database.php";
        $sql="INSERT INTO new_data(firstname,lastname,email,password) VALUES ( ?, ?, ?, ?)";
        $stmt=mysqli_stmt_init($conn);
        $stmt_prepare=mysqli_stmt_prepare($stmt,$sql);
        if ($stmt_prepare)
        {
         mysqli_stmt_bind_param($stmt,"ssss",$firstname,$lastname,$email,$passwordHash);
         mysqli_stmt_execute($stmt);
         echo "<div>well done</div>";
        }
        else
        {
            die("something went wrong");
        }
        }
    }
        ?>
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
    <div class="green">
        <div class="blue">

                <form action="registration.php" method="post">
                <input class="red" type="text" name="firstname" placeholder="firstname">
                <input class="red" type="text" name="lastname" placeholder="lastname">
                <input class="red" type="email" name="email" placeholder="email">
                <input class="red" type="password" name="password" placeholder="password">
                <input  class="log" type="submit" value="submit" name="submit">
    </form>
    </div>

   
    <div><p>registered? <a href="login.php">login</a></p></div>
    </div>
</div>
    
</body>
</html>