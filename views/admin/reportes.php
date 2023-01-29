
<?php
//require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
// $dompdf->loadHtml('hello world');
$dompdf->load_html('<!DOCTYPE html>
<html>
<head>
<title>Ejemplo de PHP en HTML</title>
</head>
<body>

<h2>Buscar Citas</h2>


<input type="submit" name="estado" id="estado" class="botonReporte" value="Reporte" /> 
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha Inicio: </label>
            <input type="date" id="fechaInicio" name="fecha" value="<?php echo $fecha ?>"/>
        </div>
        <div class="campo">
            <label for="fecha">Fecha Fin: </label>
            <input type="date" id="fechaFin" name="fecha" value="<?php echo $fecha ?>"/>
        </div>
    </form>
</div>
</body>
</html>
');


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();
$fecha = date('H:i:s');

// Output the generated PDF to Browser
$dompdf->stream("archivo.pdf", array("Attachment" => 0));


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
