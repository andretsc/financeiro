<?php 

date_default_timezone_set('America/Sao_Paulo');

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dataInicial = $_POST['txtdataInicial'];
$dataFinal = $_POST['txtdataFinal'];




if ($dataInicial == ''){
	$dataInicial = Date('Y-m-d');
}

if ($dataFinal == ''){
	$dataFinal = Date('Y-m-d');
}

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = utf8_encode(file_get_contents("http://localhost/financeiro/rel/rel_gastos_data.php?dataInicial=".$dataInicial."&dataFinal=".$dataFinal));



//INICIALIZAR A CLASSE DO DOMPDF
$pdf = new DOMPDF();

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html(utf8_decode($html));

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'relatorioGastosData.pdf',
array("Attachment" => false)
);


