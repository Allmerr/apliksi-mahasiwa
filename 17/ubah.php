<?php

session_start();
if(!isset($_SESSION["login"])){
    echo"<script>document.location.href='login.php'</script>";
}


require "functions.php";

// tampil data
$id =  $_GET["id"];

$manusia = query("SELECT * FROM `penghuni` WHERE id = $id")[0];

// ubah fungsi

if(isset($_POST["submit"])){
    if(ubah($_POST) > 0){
        echo "<script>alert('data berhasil diubah');document.location.href='index.php'</script>";
    }else{
        echo "<script>alert('data gagal dihapus');document.location.href='index.php'</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah panghuni</title>
</head>
<body>
    <h1>ubah Penghuni</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <input type="hidden" name="id" value="<?= $manusia['id']?>">
            <input type="hidden" name="gambarlama" value="<?= $manusia['gambar']?>">
            <li>
                <label for="nama">Nama : </label>
                <input type="text" id="nama" name="nama" required value="<?= $manusia['nama'] ?>">
            </li>
            <li>
                <label for="hobi">Hobi : </label>
                <input type="text" id="hobi" name="hobi" required value="<?= $manusia['hobi'] ?>">
            </li>
            <li>
                <label for="nkp">NKP : </label>
                <input type="text" id="nkp" name="nkp" required value="<?= $manusia['nkp'] ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $manusia['gambar']?>" alt=""><br>
                <input type="file" id="gambar" name="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Ganti</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Dashboard</a>
</body>
</html>