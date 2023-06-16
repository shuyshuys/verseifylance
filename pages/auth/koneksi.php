<?php
// menghubungkan file auth.php untuk memproses login
require_once 'auth.php';

$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "verseifylance";

// $servername = "sql308.infinityfree.com";
// $user = "epiz_33929470";
// $pass = "Xii0ChiqoTMvRa2";
// $dbname = "epiz_33929470_verseifylance";

// $servername = "sql308.epizy.com";
// $user = "epiz_33929470";
// $pass = "Xii0ChiqoTMvRa2";
// $dbname = "epiz_33929470_time_management";

// Create connection
$koneksi = mysqli_connect($servername, $user, $pass, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
