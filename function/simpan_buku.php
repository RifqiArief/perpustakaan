<?php
    if(isset($_POST['tambah_judul'])){
        include("db.php");

        $judul = $_POST['tambah_judul'];
        $pengarang = $_POST['tambah_pengarang'];
        $tahun = $_POST['tambah_tahun'];
        $penerbit = $_POST['tambah_penerbit'];
  
        $sql = "INSERT INTO buku (judul,pengarang,tahun,penerbit) VALUES ('$judul','$pengarang','$tahun','$penerbit')";
        if (mysqli_query($conn, $sql)) {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully add');
                window.location.href='http://localhost/perpustakaan/view/buku.php';
                </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Failed add');
                window.location.href='http://localhost/perpustakaan/view/buku.php';
                </script>");
        }

    } else {
        header('Location: http://localhost/perpustakaan/view/buku.php');
    }
?>