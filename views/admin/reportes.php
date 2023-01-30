
<?php
//require __DIR__ . 'dompdf/autoload.inc.php';

//$mysql=new mysqli('localhost', 'root', 'admin', 'appsebitas');
use Model\AdminCita;
use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DompdfException;
use Dompdf\Optins;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
// $dompdf->loadHtml('hello world');
$dompdf->load_html(
    
    '<!DOCTYPE html>
    <html>
    <head>
        <style>
            @page {
                margin: 0cm 0cm;
                font-family: Arial;
            }
    
            body {
                margin: 3cm 2cm 2cm;
            }
    
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #2a0927;
                color: white;
                text-align: center;
                line-height: 30px;
            }
    
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;
                background-color: #2a0927;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
    </head>
    <body>
    <header>
        <h1>PELUQUERIA SEBITAS</h1>
    </header>
    
    <main>
        <h1>Reporte de citas </h1>
        <table>
        <thead>
        <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        <td>Nataly<td/>
        <td>Guallichico<td/>
        <td>2023-01-26<td/>
        <td>10:30<td/>
        <td>Atendido<td/>
        </tbody>
        </table>
    </main>
    <?php echo "Desde reportes" ?>
    
    <footer>
        <h1>Natilu01</h1>
    </footer>
    </body>
    </html>
');


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();
$fecha = date('H:i:s');

// Output the generated PDF to Browser
$dompdf->stream(time()."archivo.pdf", array("Attachment" => 0))();


// use Dompdf\Dompdf;

// $dompdf = new Dompdf();
// $html = loadHtml('hello world from pdf');
// $dompdf->loadHtml($html);
// $dompdf->setPaper('A4', 'portrait');
// $dompdf->render();

// header('Content-Type: application/pdf');
// header('Content-Disposition: attachment; filename="portrait.pdf"');
// echo $dompdf->output();
//$dompdf->stream("my_pdf.pdf", array("Attachment" => 0));
exit;
?>
