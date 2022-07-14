<?php
require "functions.php";


if(isset($_POST["submit"])){
    if(register($_POST) > 0 ){
        echo"<script>alert('berhasil register!');documet.locatio.href='login.php'</script>";
    }else{
        echo"<script>alert('gagal register!')</script>";
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username : </label> <br>
                <input type="text" id="username" name="username">
            </li>
            <li>
                <label for="password">password : </label> <br>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <label for="password2">konfirmasi password : </label> <br>
                <input type="password" id="password2" name="password2">
            </li>
            <li>
                <button type="submit" name="submit">Daftar</button>
            </li>
        </ul>
    </form>
</body>
</html>