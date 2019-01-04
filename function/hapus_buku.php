<?php
    include("db.php");

    $id = $_GET['id'];
  

    $sql = "DELETE FROM buku WHERE id_buku='$id'";

    if (mysqli_query($conn, $sql)) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Succesfully deleted');
            window.location.href='http://localhost/perpustakaan/view/buku.php';
            </script>");
    } else {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Failed deleted');
            window.location.href='http://localhost/perpustakaan/view/buku.php';
            </script>");
    }
?>