<?php
session_start();
if(!isset($_SESSION["login"])){
    echo"<script>document.location.href='login.php'</script>";
}


require "functions.php";

$penghuni = query("SELECT * FROM `penghuni`");

if(isset($_POST["cari"])){
    $penghuni = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        table,tr,td,th{
            border: solid 1px #000;
        }
        td,th{
            padding: 10px;
        }
        table img{
            width: 75px;
        }
    </style>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>Daftar Penghuni Kusuma Pos</h1>
    <p>Kucing sudah mandiri dan persatuan orang senang</p>

    <form action="" method="post">
        <input type="text" name="keyword" placholder="Cari..." autofocus autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>

    <a href="tambah.php">tambah penghuni</a>

    <br><br>

    <table>
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>NKP</th>
            <th>Hobi</th>
        </tr>
        <?php $count = 0; ?>
        <?php foreach($penghuni as $manusia) : ?>
            <tr>
                <td><?php $count++; echo $count;?></td>
                <td><a href="ubah.php?id=<?= $manusia["id"]?>">Ubah</a> | <a href="hapus.php?id=<?= $manusia["id"]?>" onclick="return confirm('anda yakin ?')">Hapus</a></td>
                <td><?= $manusia["nama"]?></td>
                <td><img src="img/<?= $manusia["gambar"]?>" alt=""></td>
                <td><?= $manusia["nkp"]?></td>
                <td><?= $manusia["hobi"]?></td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>