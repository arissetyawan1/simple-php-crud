<?php
    // Session start & Connect the MySql
    session_start();
    $db = mysqli_connect("localhost", "root", "", "simple_crud");

    // Initialize Variables
    $nama = "";
    $no_meja = "";
    $detail_pesanan = "";
    $id = 0;
    $update = false;

    // POST Add new data
    if (isset($_POST['save'])) {
        $nama = $_POST['nama'];
        $no_meja = $_POST['no_meja'];
        $detail_pesanan = $_POST['detail_pesanan'];

        mysqli_query($db, "INSERT INTO user (nama, no_meja, detail_pesanan) VALUES ('$nama', '$no_meja', '$detail_pesanan')");
        $_SESSION['alert'] = "Data saved!";
        header("location: index.php");
    }

    // POST Update data
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $no_meja = $_POST['no_meja'];
        $detail_pesanan = $_POST['detail_pesanan'];

        mysqli_query($db, "UPDATE user SET nama='$nama', no_meja='$no_meja', detail_pesanan='$detail_pesanan' WHERE id=$id");
        $_SESSION['alert'] = "Data updated!";
        header("location: index.php");
    }

    // GET Delete data
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        
        mysqli_query($db, "DELETE FROM user WHERE id=$id");
        $_SESSION['alert'] = "Data deleted!";
        header("location: index.php");
    }
?>