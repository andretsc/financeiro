<?php
include('conexao.php');


session_start();
include('verificar_login.php');



?>

<!DOCTYPE html>
<html>
<head>
  <title>Serviços do Cliente</title>


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
            <div class="row mb-4">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"> Orçamentos do Cliente</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <!--LISTAR TODOS OS ORÇAMENTOS -->

                      <?php
                        
                         $cpf = $_GET['cpf'];
                         $query = "select * from orcamentos where cliente = '$cpf' "; 
                        
                        

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
                            Produto
                          </th>
                          <th>
                            Problema
                          </th>
                          <th>
                            Valor
                          </th>
                           <th>
                            Data Abertura
                          </th>
                            <th>
                            Data Aprovação
                          </th>
                           <th>
                            Status
                          </th>
                          
                        </thead>
                        <tbody>
                         
                         <?php 

                          while($res_1 = mysqli_fetch_array($result)){
                            $produto = $res_1["produto"];
                            $problema = $res_1["problema"];
                            $valor_total = $res_1["valor_total"];
                            $data_abertura = $res_1["data_abertura"];
                            $data_aprovacao = $res_1["data_aprovacao"];
                            $status = $res_1["status"];
                           
                            $id = $res_1["id"];
                            $data2 = implode('/', array_reverse(explode('-', $data_abertura)));
                             $data3 = implode('/', array_reverse(explode('-', $data_aprovacao)));
                         
                            ?>

                            <tr>

                             <td><?php echo $produto; ?></td>
                             <td><?php echo $problema; ?></td> 
                             <td><?php echo $valor_total; ?></td>
                             <td><?php echo $data2; ?></td>
                             <td><?php echo $data3; ?></td>
                             <td><?php echo $status; ?></td>
                             
                           
                           
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


                <br>

                 <div class="row mt-4">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"> Ordem de Serviços do Cliente</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <!--LISTAR TODOS OS ORÇAMENTOS -->

                      <?php
                        
                         $cpf = $_GET['cpf'];
                         $query = "select * from os where cliente = '$cpf' "; 
                        
                        

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
                            Produto
                          </th>
                          <th>
                            Total
                          </th>
                          <th>
                            Data Abertura
                          </th>
                            <th>
                            Data Fechamento
                          </th>
                           <th>
                            Garantia
                          </th>
                           <th>
                            Status
                          </th>
                          
                        </thead>
                        <tbody>
                         
                         <?php 

                          while($res_1 = mysqli_fetch_array($result)){
                            $produto = $res_1["produto"];
                            $total = $res_1["total"];
                           
                            $data_abertura = $res_1["data_abertura"];
                            $data_fechamento = $res_1["data_fechamento"];
                            $garantia = $res_1["garantia"];
                            $status = $res_1["status"];
                           
                            $id = $res_1["id"];
                            $data2 = implode('/', array_reverse(explode('-', $data_abertura)));
                             $data3 = implode('/', array_reverse(explode('-', $data_fechamento)));
                         
                            ?>

                            <tr>

                             <td><?php echo $produto; ?></td>
                             <td><?php echo $total; ?></td> 
                             <td><?php echo $data2; ?></td>
                             <td><?php echo $data3; ?></td>
                             <td><?php echo $garantia; ?></td>
                             <td><?php echo $status; ?></td>
                             
                           
                           
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








   