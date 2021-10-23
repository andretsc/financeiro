<?php
include('conexao.php');


session_start();
include('verificar_login.php');



?>

<!DOCTYPE html>
<html>
<head>
  <title>Fechar Orçamentos</title>


<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>



</head>


<body>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="painel_funcionario.php"><big><big><i class="fa fa-arrow-left"></i></big></big></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      
    </ul>
   
  </div>
</nav>





<div class="container">


    

      <br>


         <div class="row">
           

          
        </div>


          <div class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"> Orçamentos Abertos</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <!--LISTAR TODOS OS ORÇAMENTOS -->

                      <?php
                        
                        $usuario = $_SESSION['nome_usuario'];
                        if(isset($_GET['buttonPesquisar']) and $_GET['txtpesquisar'] != ''){
                          $data = $_GET['txtpesquisar'] . '%';
                           $query = "select o.id, o.cliente, o.tecnico, o.produto, o.problema, o.status, o.data_abertura, c.nome as cli_nome, f.nome as func_nome from orcamentos as o INNER JOIN clientes as c on o.cliente = c.cpf INNER JOIN funcionarios as f on o.tecnico = f.id where  f.nome = '$usuario' and o.status = 'Aberto' order by o.id asc"; 
                        }else{
                         $query = "select o.id, o.cliente, o.tecnico, o.produto, o.valor_total, o.problema, o.status, o.data_abertura, c.nome as cli_nome, f.nome as func_nome from orcamentos as o INNER JOIN clientes as c on o.cliente = c.cpf INNER JOIN funcionarios as f on o.tecnico = f.id where  f.nome = '$usuario' and o.status = 'Aberto'  order by o.id asc"; 
                        }

                        

                        $result = mysqli_query($conexao, $query);
                        //$dado = mysqli_fetch_array($result);
                        $row = mysqli_num_rows($result);

                        if($row == ''){

                            echo "<h3> Não existem dados cadastrados no banco </h3>";

                        }else{

                           ?>

                          

                      <table class="table">
                        <thead class=" text-primary">
                          
                          <th>
                            Cliente
                          </th>
                          <th>
                            Técnico
                          </th>
                          <th>
                            Produto
                          </th>
                           <th>
                            Defeito
                          </th>
                            <th>
                            Data Abertura
                          </th>
                           </th>
                           
                           </th>
                            <th>
                            Ações
                          </th>
                        </thead>
                        <tbody>
                         
                         <?php 

                          while($res_1 = mysqli_fetch_array($result)){
                            $cliente = $res_1["cli_nome"];
                            $tecnico = $res_1["func_nome"];
                            $produto = $res_1["produto"];
                            $defeito = $res_1["problema"];
                            $data_abertura = $res_1["data_abertura"];
                           
                            $id = $res_1["id"];
                            $data2 = implode('/', array_reverse(explode('-', $data_abertura)));
                         
                            ?>

                            <tr>

                             <td><?php echo $cliente; ?></td>
                             <td><?php echo $tecnico; ?></td> 
                             <td><?php echo $produto; ?></td>
                             <td><?php echo $defeito; ?></td>
                             <td><?php echo $data2; ?></td>
                             
                           
                             <td>
                             <a class="btn btn-primary" href="fechar_orcamentos.php?func=edita&id=<?php echo $id; ?>"><i class="fa fa-pencil-square-o"></i></a>

                            

                             </td>
                            </tr>

                            <?php 
                              }                        
                            ?>
                            

                        </tbody>
                      </table>
                          <?php 
                              }                        
                            ?>
                    </div>
                  </div>
                </div>
              </div>

</div>




 



</body>
</html>






<!--FECHAR ORÇAMENTO -->
<?php

if(@$_GET['func'] == 'edita'){  

  ?>

 <!-- Modal -->
      <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
         <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title">Fechar Orçamento</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="">
             
              
              
              
               <div class="form-group">
                <label for="quantidade">Valor Serviço</label>
                <input type="text" class="form-control mr-2" name="txtvalor" placeholder="Valor Mão de Obra" required>
              </div>

               <div class="form-group">
                <label for="quantidade">Peças</label>
                <input type="text" class="form-control mr-2" name="txtpecas" placeholder="Peças" required>
              </div>


                <div class="form-group">
                <label for="quantidade">Valor Peças</label>
                <input type="text" class="form-control mr-2" name="txtvalorPecas" placeholder="Valor das Peças" required>
              </div>

              <div class="form-group">
                <label for="quantidade">Laudo</label>
                <textarea class="form-control mr-2" name="txtlaudo" placeholder="Laudo Técnico" required> </textarea>
              </div>
              
             
            </div>
                   
            <div class="modal-footer">
               <button type="submit" class="btn btn-success mb-3" name="buttonEditar">Salvar </button>


                <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>
            </form>
            </div>
          </div>
        </div>
      </div>    

 

 <script> $("#modalEditar").modal("show"); </script> 

<!--Comando para editar os dados UPDATE -->
<?php


$id = $_GET['id'];

if(isset($_POST['buttonEditar'])){
  
  $laudo = $_POST['txtlaudo'];
  $valor_servico = $_POST['txtvalor'];
  $pecas = $_POST['txtpecas'];
  
  $valor_pecas = $_POST['txtvalorPecas'];
  $desconto = 0;
  $valor_total = $_POST['txtvalor'] + $_POST['txtvalorPecas'];
  $status = 'Aguardando';




$query_editar = "UPDATE orcamentos set laudo = '$laudo', valor_servico = '$valor_servico', pecas = '$pecas', valor_pecas = '$valor_pecas', desconto = '$desconto', total = '$valor_total', valor_total = '$valor_total', data_geracao = curDate(), status = '$status' where id = '$id' ";

$result_editar = mysqli_query($conexao, $query_editar);

if($result_editar == ''){
  echo "<script language='javascript'> window.alert('Ocorreu um erro ao Editar!'); </script>";
}else{
    echo "<script language='javascript'> window.alert('Editado com Sucesso!'); </script>";
    echo "<script language='javascript'> window.location='fechar_orcamentos.php'; </script>";
}

}
?>


<?php }  ?>


<!--MASCARAS -->

<script type="text/javascript">
    $(document).ready(function(){
      $('#txttelefone').mask('(00) 00000-0000');
      $('#txtcpf').mask('000.000.000-00');
      });
</script>



   