<?php
include('./pages/auth/koneksi.php');
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

// select full name from user for customer
$qwr2 = "SELECT FULL_NAME FROM customers WHERE ID_CUSTOMER = " . $_GET['report'] . ";";
$query2 = mysqli_query($koneksi, $qwr2);
$row2 = mysqli_fetch_array($query2);

$html = '<center><h3>Orders by '.$row2['FULL_NAME'].'</h3></center><hr/><br/>';

$qwr = "SELECT o.ID_ORDER, o.ID_PAYMENT,
p.STATUS,
c.FULL_NAME as CUSTOMER_NAME, 
f.FULL_NAME as FREELANCER_NAME, 
COUNT(o.ID_ORDER) as QTY,
o.ID_SERVICE, o.CREATED_AT,
s.TITLE,
s.DESCRIPTION,
s.PRICE
FROM orders o 
join services s on s.ID_SERVICE = o.ID_SERVICE 
join freelancers f on f.ID_FREELANCER = s.ID_FREELANCER 
join customers c on c.ID_CUSTOMER = o.ID_CUSTOMER 
join payments p on p.ID_PAYMENT = o.ID_PAYMENT
WHERE o.ID_CUSTOMER = " . $_GET['report'] . " AND o.STATUS = '1'
GROUP BY o.ID_ORDER;";

$query = mysqli_query($koneksi, $qwr);

$html .= '<table border="1" width="100%">
 <tr>
 <th>No</th>
 <th>Invoice / Date Purchase</th>
 <th>Item</th>
 <th>Freelancer</th>
 <th>Quantity</th>
 <th>Price</th>
 </tr>';
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
 <td>" . $no . "</td>
 <td>" . $row['ID_ORDER'] . " " . $row['CREATED_AT'] . "</td>
 <td>" . $row['TITLE'] . " " . $row['DESCRIPTION'] . "</td>
 <td>" . $row['FREELANCER_NAME'] . "</td>
 <td>" . $row['QTY'] . "</td>
 <td>" . $row['PRICE'] . "</td>
 </tr>";

    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('History Pelanggan.pdf');
