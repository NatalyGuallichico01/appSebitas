
<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = file_get_contents('prueba.html');
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// header('Content-Type: application/pdf');
// header('Content-Disposition: attachment; filename="portrait.pdf"');
// echo $dompdf->output();
$dompdf->stream("my_pdf.pdf", array("Attachment" => 0));
exit;
?>
