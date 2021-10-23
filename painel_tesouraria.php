<?php 

session_start();
include('verificar_login.php');

include('conexao.php');

?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SysTec Freitas
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          SysTec Freitas
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="">
            <a href="movimentacoes.php">
              <i class="nc-icon nc-circle-10"></i>
              <p>Movimentações</p>
            </a>
          </li>
          <li>
            <a href="gastos.php">
              <i class="nc-icon nc-diamond"></i>
              <p>Gastos</p>
            </a>
          </li>
          <li>
            <a href="vendas.php">
              <i class="nc-icon nc-pin-3"></i>
              <p>Vendas</p>
            </a>
          </li>
          <li>
            <a href="pagamentos.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Pagamentos</p>
            </a>
          </li>
           <li>
            <a href="compras.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Compras</p>
            </a>
          </li>
          
         
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"></a>
          </div>
         
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
             
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                	<?php echo $_SESSION['nome_usuario']; ?>
                  <i class="nc-icon nc-bell-55"></i>
                  <p>

                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Sair</a>

                <?php 
                if($_SESSION['cargo_usuario'] == 'Administrador' || $_SESSION['cargo_usuario'] == 'Gerente'){
                  

                 ?>

                  <a class="dropdown-item" href="painel_admin.php">Painél do Administrador</a>
                 <a class="dropdown-item" href="painel_tesouraria.php">Painél da Tesouraria</a>

                 <?php } ?>

                </div>
              </li>
             
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-email-85 text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Serviços</p>
                      <?php

                          //TOTALIZAR OS SERVIÇOS

                          $query_servicos = "select sum(valor) as total from movimentacoes where data = curDate() and movimento = 'Serviço' order by id asc"; 
                          $result_servicos = mysqli_query($conexao, $query_servicos);
                          
                           while($res_serv = mysqli_fetch_array($result_servicos)){
                            ?>
                              <p class="card-title"><small>R$ <?php echo $res_serv['total']; 
                              
                              ?></small>

                               <?php
                            }

                          ?>
                      
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <?php 
                  $query_servicos = "select * from movimentacoes where data = curDate() and movimento = 'Serviço' order by id asc"; 
                          $result_servicos = mysqli_query($conexao, $query_servicos);
                  $numero_servicos = mysqli_num_rows($result_servicos);
                  
                  ?>
                  <i class="fa fa-refresh"></i> Total de Serviços: <?php echo $numero_servicos; ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Vendas</p>

                      <?php

                          //TOTALIZAR DAS VENDAS

                          $query_vendas = "select sum(valor) as total from vendas where data = curDate() and status = 'Efetuada' order by id asc"; 
                          $result_vendas = mysqli_query($conexao, $query_vendas);
                          
                           while($res_vendas = mysqli_fetch_array($result_vendas)){
                            ?>
                              <p class="card-title"><small>R$ <?php echo $res_vendas['total']; 
                              
                              ?></small>

                               <?php
                            }

                          ?>

                     
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                   <?php 
                  $query_vendas = "select * from vendas where data = curDate() and status = 'Efetuada' order by id asc"; 
                          $result_vendas = mysqli_query($conexao, $query_vendas);
                  $numero_vendas = mysqli_num_rows($result_vendas);
                  
                  ?>
                  <i class="fa fa-refresh"></i> Total de Vendas: <?php echo $numero_vendas; ?></a>
                 
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Gastos</p>
                       <?php

                          //TOTALIZAR OS GASTOS

                          $query_gastos = "select sum(valor) as total from gastos where data = curDate() order by id asc"; 
                          $result_gastos = mysqli_query($conexao, $query_gastos);
                          
                           while($res_gastos = mysqli_fetch_array($result_gastos)){
                            ?>
                              <p class="card-title"><small>R$ <?php echo $res_gastos['total']; 
                              
                              ?></small>

                               <?php
                            }

                          ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                   <?php 
                  $query_gastos = "select * from gastos where data = curDate() order by id asc"; 
                          $result_gastos = mysqli_query($conexao, $query_gastos);
                  $numero_gastos = mysqli_num_rows($result_gastos);
                  
                  ?>
                  <i class="fa fa-refresh"></i> Total de Gastos: <?php echo $numero_gastos; ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-bank text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Saldo Diário</p>
                       <?php

                          //TOTALIZAR OS GASTOS

                          $query_entradas = "select sum(valor) as total_entradas from movimentacoes where data = curDate() and tipo = 'Entrada' order by id asc"; 
                          $result_entradas = mysqli_query($conexao, $query_entradas);
                          
                           while($res_entradas = mysqli_fetch_array($result_entradas)){


                            //totalizar as saidas
                            $query_saidas = "select sum(valor) as total_saidas from movimentacoes where data = curDate() and tipo = 'Saída' order by id asc"; 
                          $result_saidas = mysqli_query($conexao, $query_saidas);
                          
                           while($res_saidas = mysqli_fetch_array($result_saidas)){

                            ?>
                              <p class="card-title"><small>

                                <?php
                               $total = $res_entradas['total_entradas'] - $res_saidas['total_saidas'];  
                              if ($total >= 0){
                               echo '<font color="green"> R$ '  .$total. ',00 </font>';
                              } else{
                               echo '<font color="red">  R$ '  .$total. ',00 </font>';
                              } 

                              
                              ?></small>

                               <?php
                            } }

                          ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                   <?php 
                  $query_mov = "select * from movimentacoes where data = curDate() order by id asc"; 
                          $result_mov = mysqli_query($conexao, $query_mov);
                  $numero_mov = mysqli_num_rows($result_mov);
                  
                  ?>
                  <i class="fa fa-refresh"></i> Total Movimentações: <?php echo $numero_mov; ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>


<p class="mt-5">ÚLTIMAS MOVIMENTAÇÕES</p>
        <hr >

        <div class="row">

          <?php 

           $query = "select * from movimentacoes where data >= curDate()  order by id desc limit 4";

            $result = mysqli_query($conexao, $query);
                        //$dado = mysqli_fetch_array($result);
                        $row = mysqli_num_rows($result);

                         if($row == ''){

                            echo "<h5> Não existem movimentações Hoje!! </h5>";

                        }else{

                            while($res_1 = mysqli_fetch_array($result)){
                            $tipo = $res_1["tipo"];
                            $movimento = $res_1["movimento"];
                            $valor = $res_1["valor"];
                            $funcionario = $res_1["funcionario"];

                            


           ?>

           <?php 

           if($tipo == 'Entrada'){

            ?>
             <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header" style="font-size: 16px"><?php echo $movimento ?></div>
                <div class="card-body">
                  <h5 class="card-title">R$ <?php echo $valor ?></h5>
                  <p class="card-text"><?php echo $funcionario ?></p>
                </div>
              </div>
          </div>
            <?php
           }else{

             ?>
              <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header" style="font-size: 16px"><?php echo $movimento ?></div>
                <div class="card-body">
                  <h5 class="card-title">R$ <?php echo $valor ?></h5>
                  <p class="card-text"><?php echo $funcionario ?></p>
                </div>
              </div>
          </div>
            <?php

           } }

            ?>

         

        <?php } ?>

        


        </div>


      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">SYSTEC FREITAS</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, Treinamento PHP <i class="fa fa-heart heart"></i> Hugo Vasconcelos
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>





