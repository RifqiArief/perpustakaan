<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/perpustakaan/function/style.css">
    <title>Member | Perpustakaan</title>
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
    <p>Daftar member perpustakaan</p>

    <?php
    include('../function/db.php');
    $query = "SELECT * FROM anggota";
    $result= mysqli_query($conn, $query) OR die(mysql_error());
    ?> 
  <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Registrasi Member</button>

    <table border="1" cellspacing="0" cellpadding="4">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No. Tlp</th>
        <th width = "1px">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['alamat']; ?></td>          
          <td><?= $row['no_telp']; ?></td>
          <td>
            <a href="/perpustakaan/function/hapus_member.php?id=<?php echo $row['id_anggota'];?>"><button>Delete</button></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/perpustakaan/function/simpan_member.php" method="post">

    <header class = "header-popup">
      <h1>Registrasi Member</h1>
    </header>
    
    <div class="container">
      <label for="tambah_nama"><b>Nama</b></label>
      <input type="text" placeholder="Masukan nama anda" name="tambah_nama" required>

      <label for="tambah_alamat"><b>Alamat</b></label>
      <input type="text" placeholder="Masukan alamat anda" name="tambah_alamat" required>

      <label for="tambah_alamat"><b>No. Telephone / HP</b></label>
      <input type="number" placeholder="Masukan No. Tlp / Hp " name="tambah_nomer" required>

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