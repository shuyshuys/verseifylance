<?php
include('./pages/auth/koneksi.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'ID Order');
$sheet->setCellValue('C1', 'Created At');
$sheet->setCellValue('D1', 'Customer Name');
$sheet->setCellValue('E1', 'Freelancer Name');
$sheet->setCellValue('F1', 'Payment Date');
$sheet->setCellValue('G1', 'Method');
$sheet->setCellValue('H1', 'Title');
$sheet->setCellValue('I1', 'Description');
$sheet->setCellValue('J1', 'Qty');
$sheet->setCellValue('K1', 'Amount');
$sheet->setCellValue('L1', 'Tax');
$sheet->setCellValue('M1', 'Discount');
$sheet->setCellValue('N1', 'Total Amount');


$sql = "SELECT o.ID_ORDER, o.CREATED_AT,
c.FULL_NAME as CUSTOMER_NAME, 
f.FULL_NAME as FREELANCER_NAME,  
p.PAYMENT_DATE, p.`METHOD`,
s.TITLE,
s.DESCRIPTION,
COUNT(o.ID_ORDER) as QTY,
p.AMOUNT,
p.TAX,
p.DISCOUNT,
p.TOTAL_AMOUNT 
FROM orders o 
join services s on s.ID_SERVICE = o.ID_SERVICE 
join freelancers f on f.ID_FREELANCER = s.ID_FREELANCER 
join customers c on c.ID_CUSTOMER = o.ID_CUSTOMER 
join payments p on p.ID_PAYMENT = o.ID_PAYMENT
GROUP BY o.ID_ORDER;";

$query = mysqli_query($koneksi, $sql);
$i = 2;
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $sheet->setCellValue('A' . $i, $no++);
    $sheet->setCellValue('B' . $i, $row['ID_ORDER']);
    $sheet->setCellValue('C' . $i, $row['CREATED_AT']);
    $sheet->setCellValue('D' . $i, $row['CUSTOMER_NAME']);
    $sheet->setCellValue('E' . $i, $row['FREELANCER_NAME']);
    $sheet->setCellValue('F' . $i, $row['PAYMENT_DATE']);
    $sheet->setCellValue('G' . $i, $row['METHOD']);
    $sheet->setCellValue('H' . $i, $row['TITLE']);
    $sheet->setCellValue('I' . $i, $row['DESCRIPTION']);
    $sheet->setCellValue('J' . $i, $row['QTY']);
    $sheet->setCellValue('K' . $i, $row['AMOUNT']);
    $sheet->setCellValue('L' . $i, $row['TAX']);
    $sheet->setCellValue('M' . $i, $row['DISCOUNT']);
    $sheet->setCellValue('N' . $i, $row['TOTAL_AMOUNT']);
    $i++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

// set style border ke semua cell yang memiliki data
$startRow = $sheet->getHighestRow();
$sheet->getStyle('A1:N' . $startRow)->applyFromArray($styleArray);

// set autofit column width
for ($column = 'A'; $column <= 'N'; $column++) {
    $spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
}

// $i = $i - 1;
// $sheet->getStyle('A1:N' . $i)->applyFromArray($styleArray);

$writer = new Xlsx($spreadsheet);
$writer->save('Report Freelancer.xlsx');

// Lokasi file Excel
$excelFile = 'Report Freelancer.xlsx';

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

