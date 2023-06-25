<?php
include('./pages/auth/koneksi.php');
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$freelancerid = $_GET['freelancerid'];

$qwr = "SELECT o.ID_ORDER, o.CREATED_AT,
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
WHERE f.ID_FREELANCER = $freelancerid
GROUP BY o.ID_ORDER;";

$query = mysqli_query($koneksi, $qwr);
$html = '<center><h3>Order</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th>No</th>
 <th>Invoice / Date Purchase</th>
 <th>Payment Date / Method</th>
 <th>Freelancer</th>
 <th>Customer</th>
 <th>Item</th>
 <th>Quantity</th>
 <th>Amount</th>
 <th>Tax</th>
 <th>Discount</th>
 <th>Total Amount</th>
 </tr>';
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $html .= "<tr>
 <td>" . $no . "</td>
 <td>#" . $row['ID_ORDER'] . "/" . $row['CREATED_AT'] . "</td>
 <td>" . $row['PAYMENT_DATE'] . "/" . $row['METHOD'] . "</td>
 <td>" . $row['FREELANCER_NAME'] . "</td>
 <td>" . $row['CUSTOMER_NAME'] . "</td>
 <td>" . $row['TITLE'] . " " . $row['DESCRIPTION'] . "</td>
 <td>" . $row['QTY'] . "</td>
 <td>" . $row['AMOUNT'] . "</td>
 <td>" . $row['TAX'] . "</td>
 <td>" . $row['DISCOUNT'] . "</td>
 <td>" . $row['TOTAL_AMOUNT'] . "</td>
 </tr>";
    $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Report Freelancer.pdf');
