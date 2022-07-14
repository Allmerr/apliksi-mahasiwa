<?php

session_start();
if(!isset($_SESSION["login"])){
    echo"<script>document.location.href='login.php'</script>";
}

require "functions.php";

if(isset($_POST["submit"])){


    if(tambah($_POST) > 0){
        echo "<script>alert('data berhasil ditambahkan');document.location.href='index.php'</script>";
    }else{
        echo "<script>alert('data gagal ditambahkan');</script>";
    };
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah panghuni</title>
</head>
<body>
    <h1>Tambah Penghuni</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" id="nama" name="nama" required>
            </li>
            <li>
                <label for="hobi">Hobi : </label>
                <input type="text" id="hobi" name="hobi" required>
            </li>
            <li>
                <label for="nkp">NKP : </label>
                <input type="text" id="nkp" name="nkp" required>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" id="gambar" name="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Dashboard</a>
</body>
</html>