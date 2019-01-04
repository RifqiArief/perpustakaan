<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/perpustakaan/function/style.css">
    <title>Pinjam | Perpustakaan</title>
    <header class = "header">
    <h1>Sistem Informasi Perpustakaan</h1>
    </header>
</head>

<body>
<div class="topnav">
  <a href="../index.php" >Dashboard</a>
  <a href="./pinjam.php" >Pinjam Buku</a>
  <a href="./buku.php" >Daftar Buku</a>
  <a href="./member.php" >Member</a>
</div>
    <p>Daftar peminjam buku perpustakaan</p>

    <?php
     include('../function/db.php');
     $query = "SELECT a.nama, a.alamat, a.no_telp, b.pengarang, b.judul, p.id, p.tanggal_pinjam, p.tanggal_kembali, p.status FROM anggota a, buku b, pinjam p where p.id_anggota=a.id_anggota and b.id_buku=p.id_buku";
     $result= mysqli_query($conn, $query) OR die(mysql_error());
    ?> 
  <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Tambah peminjam</button>

    <table border="1" cellspacing="0" cellpadding="4">
    <thead>
      <tr>
        <th>Nama peminjam</th>
        <th>Alamat peminjam</th>
        <th>No. Tlp peminjam</th>
        <th>Judul buku</th>
        <th>Pengarang buku</th>
        <th>Tanggal pinjam</th>
        <th>Tanggal kembali</th>
        <th>Status</th>
        <th width = "1px">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['alamat']; ?></td>          
          <td><?= $row['no_telp']; ?></td>
          <td><?= $row['pengarang']; ?></td>
          <td><?= $row['judul']; ?></td>
          <td><?= date('d F Y', strtotime($row['tanggal_pinjam'])); ?></td>
          <td>
            <?php 
              if ($row['tanggal_kembali'] != "0000-00-00 00:00:00") {
                echo date('d F Y', strtotime($row['tanggal_kembali']));
              } else {
                echo "-";
              }
            ?>
          </td>
          <td>
            <?php
              if ($row['status'] == 1) {
                echo "Belum kembali";
              } else {
                echo "Sudah kembali";
              }
            ?>
          </td>
          <td>
            <?php
              if ($row['status'] == 1) {
            ?>
              <a href="/perpustakaan/function/kembali.php?id=<?php echo $row['id'];?>"><button>Kembali</button></a>
            <?php
              }
            ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/perpustakaan/function/simpan_pinjaman.php" method="post">

    <header class = "header-popup">
      <h1>Tambah pinjaman</h1>
    </header>
    <?php
      $query = "SELECT * FROM buku";
      $buku= mysqli_query($conn, $query) OR die(mysql_error());

      $query = "SELECT * FROM anggota";
      $anggota= mysqli_query($conn, $query) OR die(mysql_error());
    ?> 
    <div class="container">
      <label for="id_anggota"><b>Nama member</b></label>
      <select name="id_anggota" id="">
        <?php while($row = mysqli_fetch_assoc($anggota)){ ?>
          <option value="<?php echo $row['id_anggota']; ?>"><?php echo $row['nama']; ?></option>
        <?php } ?>
      </select>

      <label for="id_buku"><b>Judul buku</b></label>
      <select name="id_buku" id="">
        <?php while($row = mysqli_fetch_assoc($buku)){ ?>
          <option value="<?php echo $row['id_buku']; ?>"><?php echo $row['judul']; ?></option>
        <?php } ?>
      </select>

      <label for="tanngal_pinjam"><b>Tanggal peminjam</b></label>
      <input type="date" placeholder="Tanggal pinjam" name="tanngal_pinjam" required>

      <input type="Submit" value="Register" name = "submit-tambah" class ="input-submit">
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
  
</body>
<footer class="footer">
Buku adalah jendela dunia
</footer>
</html>

<?php

if(isset($_POST['submit-hapus'])){

  require_once __DIR__."/../core/autoload.php";

  //Define the query
  $sql = "DELETE FROM anggota WHERE id_anggota={$_POST['id_anggota']}";

  if (mysqli_query($conn, $sql)) {
      echo "Record deleted successfully";
      ?>
      <script>
        setInterval(function(){ window.location.href='http://localhost/perpustakaan/view/member.php'; }, 2000);
      </script>
      <?php
  } else {
      echo "Error deleting record: " . mysqli_error($connect);
  }
 }

 if(isset($_POST['submit-tambah'])){
  require_once __DIR__."/../core/autoload.php";

  $nama = $_POST['tambah_nama'];
  $alamat = $_POST['tambah_alamat'];
  $no_tlp = $_POST['tambah_nomer'];


  $sql = "INSERT INTO anggota (nama,alamat,no_telp)
  VALUES ('$nama','$alamat','$no_tlp')";

  if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      ?>
      <script>
        setInterval(function(){ window.location.href='http://localhost/perpustakaan/view/member.php'; }, 2000);
      </script>
      <?php
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
?>