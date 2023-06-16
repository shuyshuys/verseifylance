<?php
// terima data name, description, price
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// panggil koneksi
include "../../pages/auth/koneksi.php";

// query update
$query = "UPDATE services SET title = '$name', description = '$description', price = '$price' WHERE ID_SERVICE = '$id'";
$hasil = mysqli_query($koneksi, $query);

// cek hasil
if ($hasil) {
    header("location:./services");
} else {
    echo "Update Data Gagal";
}
?>