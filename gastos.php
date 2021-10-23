<?php
include('conexao.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Gastos</title>


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
  <a class="navbar-brand" href="painel_tesouraria.php"><big><big><i class="fa fa-arrow-left"></i></big></big></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input name="txtpesquisar" class="form-control mr-sm-2" type="date" placeholder="Pesquisar" aria-label="Pesquisar">
      <button name="buttonPesquisar" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</nav>





<div class="container">


    

      <br>


         <div class="row">
           <div class="col-sm-12">
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalExemplo">Inserir Novo </button>

           </div>

          
        </div>


          <div class="content">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"> Tabela de Gastos</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <!--LISTAR TODOS OS CLIENTES -->

                      <?php


                        if(isset($_GET['buttonPesquisar']) and $_GET['txtpesquisar'] != ''){
                          $data = $_GET['txtpesquisar'];
                           $query = "select * from gastos where data = '$data'  order by id asc"; 
                        }else{
                         $query = "select * from gastos where data = curDate()  order by id asc"; 
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
                            Valor
                          </th>
                          <th>
                            Motivo
                          </th>
                          <th>
                            Funcionário
                          </th>
                           <th>
                            Data
                          </th>
                           
                            <th>
                            Ações
                          </th>
                        </thead>
                        <tbody>
                         
                         <?php 

                          while($res_1 = mysqli_fetch_array($result)){
                            $valor = $res_1["valor"];
                            $motivo = $res_1["motivo"];
                            $funcionario = $res_1["funcionario"];
                            $data = $res_1["data"];
                           
                            $id = $res_1["id"];

                            $data2 = implode('/', array_reverse(explode('-', $data)));

                            ?>

                            <tr>

                             <td><?php echo $valor; ?></td>
                             <td><?php echo $motivo; ?></td> 
                             <td><?php echo $funcionario; ?></td>
                             <td><?php echo $data2; ?></td>
                           
                             <td>
                             <a class="btn btn-info" href="gastos.php?func=edita&id=<?php echo $id; ?>"><i class="fa fa-pencil-square-o"></i></a>

                             <a class="btn btn-danger" href="gastos.php?func=deleta&id=<?php echo $id; ?>"><i class="fa fa-minus-square"></i></a>

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




 <!-- Modal -->
      <div id="modalExemplo" class="modal fade" role="dialog">
        <div class="modal-dialog">
         <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title">Gastos</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="">
              <div class="form-group">
                <label for="id_produto">Valor</label>
                <input type="text" class="form-control mr-2" name="txtvalor" placeholder="Valor" required>
              </div>
               <div class="form-group">
                <label for="fornecedor">Motivo</label>
                 <input type="text" class="form-control mr-2" name="txtmotivo"  placeholder="Motivo" required>
              </div>
             
              
             
            </div>
                   
            <div class="modal-footer">
               <button type="submit" class="btn btn-success mb-3" name="button">Salvar </button>


                <button type="button" class="btn btn-danger mb-3" data-dismiss="modal">Cancelar </button>
            </form>
            </div>
          </div>
        </div>
      </div>  



       <?php


                        if(isset($_GET['buttonPesquisar']) and $_GET['txtpesquisar'] != ''){
                          $data = $_GET['txtpesquisar'];
                           $query = "select SUM(valor) as total from gastos where data = '$data'  order by id asc"; 
                        }else{
                         $query = "select SUM(valor) as total from gastos where data = curDate()  order by id asc"; 
                        }

                        

                        $result = mysqli_query($conexao, $query);
                        //$dado = mysqli_fetch_array($result);
                        $row = mysqli_num_rows($result);

                         while($res_1 = mysqli_fetch_array($result)){
                          $total = $res_1['total'];

?>


      <div class="row mt-3">
        <div class="col-md-12">
         <p align="right">Total: R$ 
          <?php
          if($total == '') {
            echo 0;
          }else{
            echo $total;
          }
          
           ?>
            
          </p>
        </div>
      </div>  

<?php } ?>


</body>
</html>




<!--CADASTRAR -->

<?php
if(isset($_POST['button'])){
  $valor = $_POST['txtvalor'];
  $motivo = $_POST['txtmotivo'];
  $funcionario = $_SESSION['nome_usuario'];


$query = "INSERT into gastos (valor, motivo, funcionario, data) VALUES ('$valor', '$motivo', '$funcionario',  curDate() )";

$result = mysqli_query($conexao, $query);


//RECUPERAR O ULTIMO ID LANÇADO
$query_id = "select * from gastos order by id desc limit 1";
$result_id = mysqli_query($conexao, $query_id);
while($res_id = mysqli_fetch_array($result_id)){
  $id_gasto = $res_id['id'];
  }

//INSERIR OS DADOS NA TABELA DE MOVIMENTAÇÕES
$query_mov = "INSERT into movimentacoes (tipo, movimento, valor, funcionario, data, id_movimento) VALUES ('Saída', 'Gasto', '$valor', '$funcionario',  curDate(), '$id_gasto' )";
mysqli_query($conexao, $query_mov);


if($result == ''){
  echo "<script language='javascript'> window.alert('Ocorreu um erro ao Cadastrar!'); </script>";
}else{
    echo "<script language='javascript'> window.alert('Salvo com Sucesso!'); </script>";
    echo "<script language='javascript'> window.location='gastos.php'; </script>";
}

}
?>


<!--EXCLUIR -->
<?php
if(@$_GET['func'] == 'deleta'){
  $id = $_GET['id'];
  $query = "DELETE FROM gastos where id = '$id'";
  mysqli_query($conexao, $query);

  $query = "DELETE FROM movimentacoes where movimento = 'Gasto' and id_movimento = '$id'";
  mysqli_query($conexao, $query);

  echo "<script language='javascript'> window.location='gastos.php'; </script>";
}
?>



<!--EDITAR -->
<?php
if(@$_GET['func'] == 'edita'){  
$id = $_GET['id'];
$query = "select * from gastos where id = '$id'";
$result = mysqli_query($conexao, $query);

 while($res_1 = mysqli_fetch_array($result)){


?>

  <!-- Modal -->
      <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
         <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title">Gastos</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="">
              <div class="form-group">
                <label for="id_produto">Motivo</label>
                <input type="text" class="form-control mr-2" name="txtmotivo" placeholder="Nome" value="<?php echo $res_1['motivo']; ?>" required>
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
if(isset($_POST['buttonEditar'])){
  $motivo = $_POST['txtmotivo'];
 


  
 


$query_editar = "UPDATE gastos set motivo = '$motivo' where id = '$id' ";

$result_editar = mysqli_query($conexao, $query_editar);

if($result_editar == ''){
  echo "<script language='javascript'> window.alert('Ocorreu um erro ao Editar!'); </script>";
}else{
    echo "<script language='javascript'> window.alert('Editado com Sucesso!'); </script>";
    echo "<script language='javascript'> window.location='gastos.php'; </script>";
}

}
?>


<?php } }  ?>



   