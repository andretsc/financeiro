<?php 



//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$id = $_GET['id'];
$email = $_GET['email'];

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = utf8_encode(file_get_contents("http://localhost/financeiro/rel/rel_orcamentos.php?id=".$id));



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
'relatorioOrcamento.pdf',
array("Attachment" => false)
);



//ENVIAR O ORÇAMENTO POR EMAIL
$to = 'hugovasconcelosf@hotmail.com';
$subject = 'Systec Orçamento';
$message = file_get_contents("http://localhost/financeiro/rel/rel_orcamentos.php");
$dest = $email;
$headers = 'Content-type: text/html; charset=utf-8;';
mail($to, $subject, $message, $headers);
 