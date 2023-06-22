<?php
session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        //read from database
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
    
        if(!empty($user_name) && !empty($password))
        {
        //save to database
            $query = "select * from users where user_name = '$user_name' limit 1";
        
            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result)>0)
                {

                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password']===$password)
                    {
                        $_SESSION['user_name'] = $user_data['user_name'];
                        header("Location: index.php");
                        die;
                    }

                }
            }
            echo "Wrong username or password";
            
        }
        else{
        echo "Please enter Valid DATA";
        }



    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="css/loginstyle.css">
    <script src="https://kit.fontawesome.com/f1222b86fb.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav id="navbar">
            <div class="navbarcontainer">
                <h1 class="logo"><a href="login.php">WORKHUB</a></h1>
                <ul>
                    <li><a class="current" href="login.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <div class="container">   

        <div class="form-box">
            <h1>LogIn</h1>
            <form method="post">
                <div class="input-group">
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input id="text" type="text" name="user_name" placeholder="User Name"><br><br>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input id="text" type="password" name="password" placeholder="Password"><br><br>
                    </div>
                    <p>Lost Password &nbsp;<a href="#">Click Here!</a></p>    
                </div>
                <div class="button-field">
                    <button id="button" type="submit" value="LogIn">LogIn</button><br><br>
                </div>
                <div class="clicktosignup">
                    <p><a href="signup.php">Click to SignUp</a></p><br><br>
                </div>
                
            </form>

        </div>
    </div>

</body>
</html>