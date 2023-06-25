<?php
// Lokasi file Excel
$excelFile = './Report Freelancer.xlsx';

// Cek apakah file ada
if (file_exists($excelFile)) {
    // Set header untuk pengunduhan file Excel
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . basename($excelFile) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($excelFile));
    readfile($excelFile);
    exit;
} else {
    echo "File tidak ditemukan.";
}
?>