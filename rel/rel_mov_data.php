
<?php 
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$tipo = $_GET['tipo'];

if($tipo != 'Todas' and $tipo != 'Entrada'){
	$tipo = 'Saída';
}


$dataIni = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFin = implode('/', array_reverse(explode('-', $dataFinal)));

include('../conexao.php');



 ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>

 @page {
            margin: 0px;

        }

.footer {
    position:absolute;
    bottom:0;
    width:100%;
    background-color: #ebebeb;
    padding:10px;
}

.cabecalho {    
    background-color: #ebebeb;
    padding-top:15px;
    margin-bottom:30px;
}

.titulo{
	margin:0;
}

.areaTotais{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
}

.areaTotal{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
	background-color: #f9f9f9;
	margin-top:2px;
}

.pgto{
	margin:1px;
}



</style>


<div class="cabecalho">
	
		<div class="row">
			<div class="col-sm-5">	
			  <img src="../img/logo2.png" width="250px">
			</div>
			<div class="col-sm-7">	
			 <h3 class="titulo"><b>SysTec Freitas - Assistência Técnica</b></h3>
			 <h6 class="titulo">Rua da Q-Cursos Networks Nº 1000, Centro - BH - MG - CEP 30555-555</h6>
			</div>
		</div>
	

</div>

<div class="container">

		
			<div class="row">
				<div class="col-sm-6">	
				   <big><big> RELATÓRIO DE MOVIMENTAÇÕES  </big> </big> 
				</div>
				<div class="col-sm-6">	
				<small><?php 
					if($tipo == 'Todas'){
						echo 'Todas as Movimentações';
					}else{
						echo 'Movimentações de '.$tipo;
					}
				 ?></small>
				</div>
				
			</div>

			<div class="row">
				<div class="col-sm-6">	
				 
				</div>
				<div class="col-sm-6">	
				<small><b> Data Inicial:</b> <?php echo $dataIni; ?> <b> Data Final:</b> <?php echo $dataFin; ?> </small>
				</div>
				
			</div>
		
		<hr>

			

						
		<br><br>

		<?php

		$total_mov = 0;
		$quant = 0;
		$quant_entradas = 0;
		$quant_saidas = 0;
		$total_entradas = 0;
		$total_saidas = 0;

		 if($tipo != 'Todas'){
                          
                           $query = "select * from movimentacoes where (data >= '$dataInicial' and data <= '$dataFinal') and tipo = '$tipo' order by data asc";
                       }
                       else{
                       	$query = "select * from movimentacoes where data >= '$dataInicial' and data <= '$dataFinal' order by data asc";
                       }

                           

                        $result = mysqli_query($conexao, $query);
                        //$dado = mysqli_fetch_array($result);
                        $row = mysqli_num_rows($result);

                        if($row == ''){

                            echo "<h3> Não existem dados cadastrados no banco </h3>";

                        }else{

                           ?>


		<table class="table">
			<tr bgcolor="#f9f9f9">
				<td style="font-size:12px"> <b>Tipo</b> </td>
				<td style="font-size:12px"> <b>Movimento</b> </td>
				<td style="font-size:12px"> <b> Valor</b> </td>
				<td style="font-size:12px"> <b> Funcionário</b> </td>
				
				<td style="font-size:12px"> <b> Data</b> </td>
				
			</tr>
			

				 <?php 
				  			
				  			

                          while($res_1 = mysqli_fetch_array($result)){
                            $tipo_mov = $res_1["tipo"];
                            $movimento = $res_1["movimento"];
                            $valor = $res_1["valor"];
                            $funcionario = $res_1["funcionario"];
                           
                            $data = $res_1["data"];


                            


                            $data2 = implode('/', array_reverse(explode('-', $data)));
							
							

                           
                            $total_mov = $total_mov + $valor;
                            $quant = $quant + 1;

                            if($tipo_mov == 'Entrada'){
                            	$quant_entradas = $quant_entradas + 1;
                            	$total_entradas = $total_entradas + $valor;
                            }

                            if($tipo_mov == 'Saída'){
                            	$quant_saidas = $quant_saidas + 1;
                            	$total_saidas = $total_saidas + $valor;
                            }
                         
                         	
                         
                         	
                         
                         
                            ?>

                <tr>
				<td style="font-size:12px"> <?php echo $tipo_mov; ?> </td>
				<td style="font-size:12px"> <?php echo $movimento; ?> </td>
				<td style="font-size:12px"> R$ <?php echo $valor; ?> </td>
				<td style="font-size:12px"> <?php echo $funcionario; ?> </td>
				
				<td style="font-size:12px"> <?php echo $data2; ?> </td>
				
				</tr>

			<?php }  ?>
		</table>

	<?php }  ?>


		<hr>
		

		<hr>

		<?php
		if($tipo == 'Todas'){

			?>

			<div class="row">
				<div class="col-sm-12">	
				 <p style="font-size:12px">
				 	 <b>Quantidade de Entradas:</b>  <?php echo $quant_entradas; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 	  <b>Quantidade de Saídas:</b>  <?php echo $quant_saidas; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 	  
				 	   
				 	

				  </p>
				</div>
			</div>

			<div class="row">

				<div class="col-sm-7">	
				 <p style="font-size:12px">
				 	 <b>Valor das Entradas:</b> <font color="green"> R$ <?php echo $total_entradas; ?>,00 </font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 	  <b>Valor das Saídas:</b><font color="red"> R$ <?php echo $total_saidas; ?>,00 </font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 	  
				 	   
				 	

				  </p>
				</div>
				<div class="col-sm-3">	
				 <p style="font-size:12px" align="right">
				 	 <b>Saldo Total:</b>
				 	 <?php 
				 	 $saldo = $total_entradas - $total_saidas;
				 	 if($saldo >= 0){
				 	 	?>
				 	 	<font color="green">R$ <?php echo $saldo ?>,00 </font>
				 	 	<?php 
				 	 }else{
				 	 	?>
				 	 	<font color="red">R$ <?php echo $saldo ?>,00 </font> 
				 	 	<?php 
				 	 }

				 	 ?>
				 	 
				 	 
				 	   
				 	

				  </p>
				</div>
				
			</div>

		<?php }else{

			?>

			<div class="row">
				<div class="col-sm-8">	
				 <small><b> Quantidade de Movimentações:</b> <?php echo $quant; ?> </small>
				</div>
				<div class="col-sm-4">	
				 <small><b> Valor Total:</b> R$<?php echo $total_mov; ?>,00 </small>
				</div>
				
			</div>

			<?php
		}

			?>
		

			
			

	
</div>


<div class="footer">
 <p style="font-size:12px" align="center">Desenvolvido por Hugo Vasconcelos - Q-Cursos Networks</p> 
</div>


