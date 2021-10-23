<?php
include('conexao.php');
$status = 10;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Movimentações</title>


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

      <select class="form-control mr-2" id="category" name="status">
         <option value="Todos">Todas</option> 
          <option value="Entrada">Entradas</option> 
           <option value="Saída">Saídas</option> 
           
             
      </select>

      <input name="dataInicial" class="form-control mr-sm-2" type="date" placeholder="Pesquisar" aria-label="Pesquisar">
       <input name="dataFinal" class="form-control mr-sm-2" type="date" placeholder="Pesquisar" aria-label="Pesquisar">
      <button name="buttonPesquisar" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
    </form>
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
                    <h4 class="card-title"> Movimentações</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <!--LISTAR TODOS OS ORÇAMENTOS -->

                      <?php


                        if(isset($_GET['buttonPesquisar'])){

                            $dataInicial = $_GET['dataInicial'];
                            $dataFinal = $_GET['dataFinal'];
                             $status = $_GET['status'];

                            if ($dataInicial == ''){
                              $dataInicial = Date('Y-m-d');
                            }

                            if ($dataFinal == ''){
                              $dataFinal = Date('Y-m-d');
                            }

                            if($status != 'Todos'){
                            
                             $query = "select * from movimentacoes where (data >= '$dataInicial' and data <= '$dataFinal') and tipo = '$status' order by data asc";

                            }else{
                               $query = "select * from movimentacoes where data >= '$dataInicial' and data <= '$dataFinal' order by data asc";
                            }
                          
                                                

                        }else{
                         $query = "select * from movimentacoes where data = curDate() order by id asc"; 
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
                            Tipo
                          </th>
                          <th>
                            Movimento
                          </th>
                          <th>
                            Valor
                          </th>
                           <th>
                            Funcionário
                          </th>
                            <th>
                            Data 
                          </th>
                          
                           
                        </thead>
                        <tbody>
                         
                         <?php 

                          while($res_1 = mysqli_fetch_array($result)){
                            $tipo = $res_1["tipo"];
                            $movimento = $res_1["movimento"];
                            $valor = $res_1["valor"];
                            $funcionario = $res_1["funcionario"];
                            $data = $res_1["data"];
                           
                            $id = $res_1["id"];

                             $data2 = implode('/', array_reverse(explode('-', $data)));
                             
                           
                            $id = $res_1["id"];


                           

                            
                         
                            ?>

                            <tr>

                             

                              <?php
                              if($tipo == 'Entrada'){
                              ?>
                              <td><font color="green"><?php echo $tipo; ?></font></td>
                              <?php 
                              }else{
                                ?>
                              <td><font color="red"><?php echo $tipo; ?></font></td>

                               <?php 
                                }  ?>

                           
                             <td><?php echo $movimento; ?></td>

                              <?php
                              if($tipo == 'Entrada'){
                              ?>
                              <td><font color="green">R$ <?php echo $valor; ?></font></td>
                              <?php 
                              }else{
                                ?>
                              <td><font color="red">R$ <?php echo $valor; ?></font></td>

                               <?php 
                                }  ?>
                              

                             <td><?php echo $funcionario; ?></td> 
                            
                             <td><?php echo $data2; ?></td>
                          
                             
                           
                            
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


            <?php
                        //TOTALIZAR OS VALORES DE ENTRADAS

                        if(isset($_GET['buttonPesquisar'])){

                            $dataInicial = $_GET['dataInicial'];
                            $dataFinal = $_GET['dataFinal'];
                             $status = $_GET['status'];

                            if ($dataInicial == ''){
                              $dataInicial = Date('Y-m-d');
                            }

                            if ($dataFinal == ''){
                              $dataFinal = Date('Y-m-d');
                            }

                            
                            
                             $query_entradas = "select SUM(valor) as total from movimentacoes where (data >= '$dataInicial' and data <= '$dataFinal') and tipo = 'Entrada' order by data asc";

                             $query_saidas = "select SUM(valor) as total from movimentacoes where (data >= '$dataInicial' and data <= '$dataFinal') and tipo = 'Saída' order by data asc";
                            
                          
                                                

                        }else{
                         $query_entradas = "select SUM(valor) as total from movimentacoes where data = curDate() and tipo = 'Entrada' order by id asc";

                         $query_saidas = "select SUM(valor) as total from movimentacoes where data = curDate() and tipo = 'Saída' order by id asc"; 
                        }

                        

                        $result_entradas = mysqli_query($conexao, $query_entradas);

                       $result_saidas = mysqli_query($conexao, $query_saidas);

                        
                           while($res_1 = mysqli_fetch_array($result_entradas)){
                            $total_entradas = $res_1["total"];


                             while($res_2 = mysqli_fetch_array($result_saidas)){
                            $total_saidas = $res_2["total"];

                        

                           ?>


             <div class="row mt-3">
              
                <div class="col-md-6">
                  <font size="3">Total Entradas : <font color="green"> R$ 
                    <?php
                    if($total_entradas == '' || $status == 'Saída'){
                      echo 0; 
                    }else{
                    echo $total_entradas;
                    }  
                    ?></font> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Total Saídas : <font color="red"> R$  
                   <?php
                    if($total_saidas == '' || $status == 'Entrada'){
                      echo 0; 
                    }else{
                    echo $total_saidas;
                    }  
                    ?> 
                   </font>
                 </font>
                 
                
                </div>

                 <div class="col-md-6">
                 
                  <p align="right">  <font size="3">Saldo Total :
                    <?php

                    if($status == 'Entrada'){
                      $total_saidas = 0;
                    }


                    if($status == 'Saída'){
                      $total_entradas = 0;
                    }

                    $total = $total_entradas - $total_saidas;  
                    if ($total >= 0){
                     echo '<font color="green"> R$ '  .$total. ',00 </font>';
                    } else{
                     echo '<font color="red">  R$ '  .$total. ',00 </font>';
                    }
                    ?>
                  </font> </p>
                
                </div>
             
              </div>


              <?php } } ?>


</body>
</html>


