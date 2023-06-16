<?php
$query = $_POST['query'];

$result = mysqli_query($koneksi, $query);

$chartData = array();
while ($row = mysqli_fetch_array($result)) {
    $chartData[] = array(
        'month' => $row['MONTH'],
        'total' => $row['TOTAL_AMOUNT'],
        'name' => $row['FULL_NAME']
    );
}

// Mengubah data menjadi format JSON
$jsonData = json_encode($chartData);

// Mengirimkan response JSON ke JavaScript
header('Content-Type: application/json');
echo $jsonData;