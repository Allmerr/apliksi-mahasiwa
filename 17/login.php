<?php

session_start();
require "functions.php";

if(isset($_COOKIE["id"])){
    $id = $_COOKIE["id"];
    $pass = $_COOKIE["pass"];
    $res = query("SELECT * FROM `users` WHERE `users`.`id` = $id");
    if($res){
        if(hash('sha1', $res[0]["username"]) === $pass){
            $_SESSION["login"] = true;
        }
    }
}


if(isset($_SESSION["login"])){
    echo"<script>document.location.href='index.php'</script>";
}


if(isset($_POST["submit"])){
    $username = strtolower($_POST["username"]);
    $pwd = $_POST["password"];

    $res = query("SELECT * FROM `users` WHERE `users`.`username` = '$username'");
    
    if($res){
        if(password_verify($pwd, $res[0]["password"])){
            $id = $res[0]["id"];
            $user = hash('sha1', $res[0]["username"]);
            

            $_SESSION["login"] = true;

            if(isset($_POST["remember"])){
                setcookie('id',"$id", time() + 120);
                setcookie('pass', "$user", time() + 120);
            }
            echo"<script>alert('berhasil login!');document.location.href='index.php';</script>";
        }
    }

    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Silahkan Login</h1>
    <?php if(isset($res)) : ?>
        <p style="color:red;font-style:italic;">username atau password salah!</p>
    <?php endif;?>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" id="username" name="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me </label>
            </li>
            <li>
                <button type="submit" name="submit">login</button>
            </li>
        </ul>
    </form>
</body>
</html>