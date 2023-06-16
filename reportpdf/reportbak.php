<?php
include('koneksi.php');
require('dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($koneksi, "select * from tb_siswa");
$html = '<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th>No</th>
 <th>Nama</th>
 <th>Kelas</th>
 <th>Alamat</th>
 </tr>';
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
 <td>" . $no . "</td>
 <td>" . $row['nama'] . "</td>
 <td>" . $row['KELAS'] . "</td>
 <td>" . $row['alamat'] . "</td>
 </tr>";
    echo "<pre>";
    print_r($row);
    echo "</pre>";
    $no++;
}
// $query = mysqli_query($koneksi, "select * from tb_siswa");
// $row = mysqli_fetch_array($query);
// // print with tag pre and print_r
// echo "<pre>";
// print_r($row);
// echo "</pre>";

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_siswa.pdf');