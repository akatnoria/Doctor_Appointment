<?php

session_start();
$CONNECTION=mysqli_connect("localhost","root","","my_db");

if(!$CONNECTION)
{
 die(" Couldn't connect to server"); 
}
 
 if (!mysqli_select_db($CONNECTION,'my_db'))
 {
	 die("Database not selected");
 }


 if(isset($_POST['sub'])){

    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);

    $query = "select * from admin where email = '$email' and pass = '$pass'";
    $result = mysqli_query($CONNECTION,$query);
    $rows = mysqli_num_rows($result);

    if($rows=="1"){
        echo "in iff";
        $data = mysqli_fetch_assoc($result);
        $_SESSION['sid'] = $data['id'];
        $_SESSION['name'] = $data['name'];
        header("location:list.php");
    }
    else{
        echo "<script>alert('Email or Password is Incorrect')</script>";
    }

 }



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login form</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        body:before{
            content: '';
            position: fixed;
            width: 100vw;
            height: 100vh;
            background-image: url("images/4.jpeg");
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .contact-form
        {
            position: absolute;
            top: 50%;
            left: 85%;
            transform: translate(-50%,-50%);
            width: 400px;
            height: 500px;
            padding: 80px 40px;
            box-sizing: border-box;
            background: rgba(0, 0, 0, 0.719);
        }
        .avatar {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            top: calc(-80px/2);
            left: calc(50% - 40px);
        }
        .contact-form h2 {
            margin: 0;
            padding: 0 0 20px;
            color: #fff;
            text-align: center;
            text-transform: uppercase;
        }
        .contact-form p
        {
            margin: 0;
            padding: 0;
            font-weight: bold;
            color: rgb(255, 255, 255);
        }
        .contact-form input
        {
            width: 100%;
            margin-bottom: 20px;
        }
        .contact-form input[type="text"],
        .contact-form input[type="password"]
        {
            border: none;
            border-bottom: 1px solid rgb(255, 255, 255);
            background: transparent;
            outline: none;
            height: 40px;
            color: rgb(255, 255, 255);
            font-size: 16px;
        }
        .contact-form input[type="submit"] {
            height: 30px;
            color: rgb(7, 0, 0);
            font-size: 15px;
            background: rgb(238, 230, 230);
            cursor: pointer;
            border-radius: 25px;
            border: none;
            outline: none;
            margin-top: 15%;
        }
        .contact-form a
        {
            color: rgb(36, 32, 32);
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }
        input[type="checkbox"] {
            width: 20%;
        }
    </style>
</head>
<body>
    <div class="contact-form">
        <img src="images/2.jpeg" class="avatar">
        <h2>login</h2>
        <form action = "" method = "post">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email" required>
            <p>Password</p>
            <input type="password" name="pass" placeholder="Enter Password" required>
            <input type="submit" name="sub" value="Sign In">
            <p><input type="checkbox"> Remember Me</p>
        </form>
    </div>
</body>
</html>