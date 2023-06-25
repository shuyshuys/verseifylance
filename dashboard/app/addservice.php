<?php
include('../../pages/auth/auth.php');
// terima data name, description, price
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$freelancerID = $_SESSION['user']['ID_FREELANCER'];

// panggil koneksi
include "../../pages/auth/koneksi.php";

// query update
$query = "INSERT INTO services (ID_FREELANCER, TITLE, DESCRIPTION, PRICE) VALUES ('$freelancerID', '$name', '$description', '$price')";
$hasil = mysqli_query($koneksi, $query);

// cek hasil
if ($hasil) {
    header("location:./services");
} else {
    echo "Update Data Gagal";
    // print error
    echo mysqli_error($koneksi);
}

?>