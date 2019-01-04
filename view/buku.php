<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Buku | Perpustakaan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://localhost/perpustakaan/function/style.css">
</head>
<header class="header">
  <h1>Sistem Informasi Perpustakaan</h1>
</header>
<body>
<div class="topnav">
  <a href="../index.php" >Dashboard</a>
  <a href="./pinjam.php" >Pinjam Buku</a>
  <a href="./buku.php" >Daftar Buku</a>
  <a href="./member.php" >Member</a>
</div>

  <p>Daftar Buku Perpustakaan</p>

  <?php
  include('../function/db.php');
  $query = "SELECT * FROM buku";
  $result= mysqli_query($conn, $query) OR die(mysql_error());
  ?>
  <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Tambah Buku</button>

  <table border="1" cellspacing="0" cellpadding="4">
    <thead>
      <tr>
        <th>Judul</th>
        <th>Pengarang</th>
        <th>Tahun</th>
        <th>Penerbit</th>
        <th width = "1px">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?= $row['judul']; ?></td>
          <td><?= $row['pengarang']; ?></td>
          <td><?= $row['tahun']; ?></td>
          <td><?= $row['penerbit']; ?></td>
          <td>
          <a href="/perpustakaan/function/hapus_buku.php?id=<?php echo $row['id_buku'];?>"><button>Delete</button></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<!-- Pop-up -->
  <div id="id01" class="modal">
  
  <form class="modal-content animate" action="/perpustakaan/function/simpan_buku.php" method="post">

    <header class = "header-popup">
      <h1>Tambah Buku</h1>
    </header>
    
    <div class="container">
      <label for="tambah_judul"><b>Judul</b></label>
      <input type="text" placeholder="Masukan judul buku" name="tambah_judul" required>

      <label for="tambah_pengarang"><b>Pengarang</b></label>
      <input type="text" placeholder="Masukan pengarang buku" name="tambah_pengarang" required>

      <label for="tambah_tahun"><b>Tahun Terbit</b></label>
      <input type="number" placeholder="Masukan tahun terbit buku" name="tambah_tahun" required>

      <label for="tambah_penerbit"><b>Penerbit</b></label>
      <input type="text" placeholder="Masukan penerbit buku" name="tambah_penerbit" required>

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

function refresh() {
  location.reload();
}
</script>

</body>
<footer class = "footer">
Buku adalah jendela dunia
</footer>
</html>

<?php
if(isset($_POST['submit-hapus'])){
  require_once __DIR__."/../core/autoload.php";

  //Define the query
  $query = "DELETE FROM buku WHERE id_buku={$_POST['id_buku']}";

  if (mysqli_query($connect, $query)) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . mysqli_error($connect);
  }
}
?>