<?php
    if(isset($_POST['id_anggota'])){
        include("db.php");

        $idAnggota = $_POST['id_anggota'];
        $idBuku = $_POST['id_buku'];
        $tanggalPinjam = $_POST['tanngal_pinjam'];
      
      
        $sql = "INSERT INTO pinjam (id_anggota,id_buku,tanggal_pinjam)
         VALUES ('$idAnggota','$idBuku','$tanggalPinjam')";
        if (mysqli_query($conn, $sql)) {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully add');
                window.location.href='http://localhost/perpustakaan/view/pinjam.php';
                </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Failed add');
                window.location.href='http://localhost/perpustakaan/view/pinjam.php';
                </script>");
        }
    } else {
        header('Location: http://localhost/perpustakaan/view/pinjam.php');
    }
?>