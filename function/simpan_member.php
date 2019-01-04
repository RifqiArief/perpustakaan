<?php
    if(isset($_POST['tambah_nama'])){
        include("db.php");

        $nama = $_POST['tambah_nama'];
        $alamat = $_POST['tambah_alamat'];
        $no_tlp = $_POST['tambah_nomer'];
      
      
        $sql = "INSERT INTO anggota (nama,alamat,no_telp) VALUES ('$nama','$alamat','$no_tlp')";
        if (mysqli_query($conn, $sql)) {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully add');
                window.location.href='http://localhost/perpustakaan/view/member.php';
                </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('Failed add');
                window.location.href='http://localhost/perpustakaan/view/member.php';
                </script>");
        }
    } else {
        header('Location: http://localhost/perpustakaan/view/member.php');
    }
?>