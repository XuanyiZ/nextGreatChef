<?php
/**
 * Created by PhpStorm.
 * User: linjy0419
 * Date: 3/11/17
 * Time: 10:50 AM
 */
    require 'config.php';
    if(isset($_POST['submit_button']))
    {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $worldcuisinetype = $_POST['cuisinetype'];
        if ($username != '' && $name != '' && $email != ''&& $password != '' &&
            $cpassword != '')
               //&& $cookingstyle != '' && $cuisinetype != '' && $flavor != ''
            //
        {
            if($password == $cpassword)
            {
                $query = "select * from User where username = '$username'";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0)
                {
                    echo '<script type="text/javascript"> alert("Username already exists! Try another username!") </script>';
                }else{
                    $sql = "insert into User values('$username', '$name', '$password', 
                                  '$email', '$worldcuisinetype')";

                    if (mysqli_query($conn, $sql)) {
                        echo '<script type="text/javascript"> alert("New user created successfully") </script>';
                    } else {
                        echo '<script type="text/javascript"> alert("Failed to insert new user!") </script>';
                    }
                }

            }else{
                echo '<script type="text/javascript"> alert("Password does not match! ") </script>';
            }
        }else{
            echo '<script type="text/javascript"> alert("Please fill out required columns!") </script>';
        }
    //echo '<script type="text/javascript"> alert("Sign up button clicked!") </script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Page</title>
    <!-- CORE CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

    <style type="text/css">
        html,
        body {
            background: url(images/bg-body.jpg) repeat;
            height: 100%;
        }
        html {
            display: table;
            margin: auto;
        }
        body {
            display: table-cell;
            vertical-align: middle;
        }
        .margin {
            margin: 0 !important;
        }
    </style>

</head>

<body class="blue">


<div id="login-page" class="row">
    <div class="col s12 z-depth-6 card-panel">
        <form method="post" action="register.php" class="login-form">
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="username" name="username" type="text" class="validate">
                    <label for="username" class="center-align">*Username</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="name" name="name" type="text" class="validate">
                    <label for="name" class="center-align">*Name</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-communication-email prefix"></i>
                    <input id="email" name="email" type="email" class="validate">
                    <label for="email" class="center-align">*Email</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">*Password</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-action-lock-outline prefix"></i>
                    <input id="password-again" name="cpassword" type="password">
                    <label for="password-again">*Re-type password</label>
                </div>
            </div>

            <div class="row margin">
                <div class="input-field col s12">
                    <i class="mdi-social-person-outline prefix"></i>
                    <input id="cuisinetype" name="cuisinetype" type="text" class="validate">
                    <label for="cuisinetype" class="center-align">Preferred World Cuisine Type</label>
                    <p style="font-size:90%;color:coral;margin-left: 9%">Ex:Asian,Indian,Italian,etc.</p>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input name="submit_button" type="submit" value="Submit" class="btn" style="margin-left:auto;margin-right:auto;display:block;margin-top:0%;margin-bottom:0%;">
                </div>
                <div class="input-field col s12">
                    <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
                </div>
                <div class="input-field col s12">
                    <p class="margin center medium-small sign-up"><a href="index.php">Back to Homepage</a></p>
                </div>

            </div>
        </form>
    </div>
</div>



<!-- ================================================
  Scripts
  ================================================ -->

<!-- jQuery Library -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--materialize js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>



<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-27820211-3', 'auto');
    ga('send', 'pageview');

</script><script src="//load.sumome.com/" data-sumo-site-id="1cf2c3d548b156a57050bff06ee37284c67d0884b086bebd8e957ca1c34e99a1" async="async"></script>


<footer >
    <p align="center"> </p>
</footer>
</body>

</html>