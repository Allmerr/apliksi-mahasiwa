<?php

$conn = mysqli_connect("localhost", "root", "kusumapos", "phpdasar");

function query($perintah){
    global $conn;

    $res = mysqli_query($conn,$perintah);
    $penghuni = [];
    
    while ($row = mysqli_fetch_assoc($res)) {
        $penghuni[] = $row;
    }
    
    return $penghuni;
}

function tambah($data){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $hobi = htmlspecialchars($data["hobi"]); 
    $nkp = htmlspecialchars($data["nkp"]); 
    $gambar = upload();
    if(!$gambar){
        return false;
    }

    mysqli_query($conn, "INSERT INTO `penghuni` VALUES('','$nama', '$hobi', '$nkp', '$gambar')");

    return mysqli_affected_rows($conn);
}

function upload(){

    $name = $_FILES["gambar"]["name"];
    $tmp_name = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];
    $size = $_FILES["gambar"]["size"];

    if($error !== 0){
        echo "<script>alert('gambar tidak dimasukan')</script>";
        return false;
    }

    $ekstensiValid = ["jpg","jpeg","png"];
    $ekstensiUser = strtolower(end(explode(".", $name)));
    if(!in_array($ekstensiUser,$ekstensiValid)){
        echo "<script>alert('bukan gambar')</script>";
        return false;
    }

    if($size > 10000000){
        echo "<script>alert('size gambar terlalu besar')</script>";
        return false;
    }
    
    $unik = uniqid();
    move_uploaded_file($tmp_name, "img/$unik.$ekstensiUser");
    

    return "$unik.$ekstensiUser";
}

function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM penghuni WHERE `penghuni`.`id` = $id");

    return mysqli_affected_rows($conn);

}

function ubah($data){
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $hobi = htmlspecialchars($data["hobi"]); 
    $nkp = htmlspecialchars($data["nkp"]); 
    $gambar = $data["gambarlama"];


    if($_FILES["gambar"]["error"] === 0){
        $gambar = upload();
    }

    mysqli_query($conn, "UPDATE `penghuni` SET `nama` = '$nama', `hobi` = '$hobi',`nkp` = '$nkp', `gambar` = '$gambar' WHERE `penghuni`.`id` = $id");

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    return query("SELECT * FROM `penghuni` WHERE `nama` LIKE '%$keyword%' OR `nkp` LIKE '%$keyword%' OR `hobi` LIKE '%$keyword%'");
}

function register($data){
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $pwd = $data["password"];
    $pwd2 = $data["password2"];

    if(query("SELECT * FROM `users` WHERE `users`.`username` = '$username'")){
        echo"<script>alert('username sudah digunakan!')</script>";
        return false;
    };

    if($pwd !== $pwd2){
        echo"<script>alert('konfirmasi password gagal')</script>";
        return false;
    }

    $pwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO `users` VALUES('','$username','$pwd')");

    return mysqli_affected_rows($conn);
}

?>