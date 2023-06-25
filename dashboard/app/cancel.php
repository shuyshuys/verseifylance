<?php
include_once('../../pages/auth/auth.php');
include_once('../../pages/auth/koneksi.php');
include_once('../../assets/alert.php');

if (!is_authenticated()) {
    header("Location: ../../pages/auth/sign-in");
    exit();
}

$orderID = $_GET['orderid'];

$query = "DELETE FROM orders WHERE ID_ORDER= '$orderID'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
} else {
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Pesanan berhasil dibatalkan.";
    $_SESSION['icon'] = "check-circle-fill";

    header("location: ../../dashboard/app/billing");
}
?>