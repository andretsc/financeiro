<?php 



//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$id = $_GET['id'];
$id_orc = $_GET['id_orc'];
$email = $_GET['email'];

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = utf8_encode(file_get_contents("http://localhost/os/rel/rel_os.php?id=".$id."&id_orc=".$id_orc));



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
'relatorioOS.pdf',
array("Attachment" => false)
);



//ENVIAR O ORÇAMENTO POR EMAIL
$to = 'hugovasconcelosf@hotmail.com';
$subject = 'Systec Ordem de Serviço';
$message = file_get_contents("http://localhost/financeiro/rel/rel_os.php");
$dest = $email;
$headers = 'Content-type: text/html; charset=utf-8;';
mail($to, $subject, $message, $headers);
 