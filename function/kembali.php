<?php
    include("db.php");

    $id = $_GET['id'];
  

    $sql = "UPDATE pinjam set status = 0, tanggal_kembali = date(now()) where id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Succesfully update');
            window.location.href='http://localhost/perpustakaan/view/pinjam.php';
            </script>");
    } else {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Failed update');
            window.location.href='http://localhost/perpustakaan/view/pinjam.php';
            </script>");
    }
?>