<?php 
  if (isset($_GET['oferta'])){ 
    //Początek nagłówka
    require('header1.php'); 
    //Naglówek indywidualne tagi, skrypty i css tylko dla tej strony:
    require('classloader.php');
    $oferta=(new cOto())->getOfferDetail($_GET['oferta']);
    $history_date=array();
    $history_price=array();
    foreach ($oferta['history'] AS $h){
      $history_date[]=$h['date'];
      $history_price[]=$h['cena'];
    }
    
    if (count($oferta)!=3)
      header('Location: 404.php');

      // testowa: "102abda7-daa2-6268-3974-5ee300703ce5"
      // testowa: "00000e8f-b977-4bae-502a-5eadedebddff"
  }
  else {
    header('Location: 404.php');
    // header('Location: https://wsinf.potkal.pl/prezentacja/404.php');
  }
  
?>
  <title>pOTO | Szczegóły oferty</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<?php 
  require('top-menu.php'); 
  require('left-menu.php'); 
  //content:
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Szczegóły oferty</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Lista ofert</a></li>
              <li class="breadcrumb-item active">Szczegóły oferty</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">&nbsp;</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Przebieg</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $oferta['0']['przebieg'];?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Cena</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $oferta['0']['cena'].' '.$oferta['0']['waluta'];?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Rocznik</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $oferta['0']['rocznik'];?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-3">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Pojemność</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo $oferta['0']['pojemnosc'];?></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4><?php echo ucfirst($oferta['0']['marka']).' - '.$oferta['0']['nazwa_krotka'];?></h4>
                    <div class="post clearfix">
                      <div class="user-block">
                        <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image"> -->
                        <span class="username">
                          <a href="#"><?php echo $oferta['0']['miasto'];?></a>
                        </span>
                        <span class="description"><?php echo $oferta['0']['wojewodztwo'];?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?php echo $oferta['0']['opis'];?>
                      </p>

                      <p>
                        <a href="<?php echo ($oferta['0']['otomotolink']=='')? '#': $oferta['0']['otomotolink'];?>" class="link-black text-sm" target="_blank"><i class="fas fa-link mr-1"></i> Link do oferty</a>
                      </p>
                    </div>

                    
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <!-- solid sales graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Historia ceny
                </h3>

              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<?php 
  //stopki + zawsze wgrywane skrypty
  require('footer.php'); 
  //skrypty tylko dla tej strony:
?>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<script>

  // Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels  : <?php echo ($oferta['0']['otomotoid']!='')?json_encode($history_date):'[\''.date('Y-m-d').'\']';?>,
    datasets: [
      {
        label               : 'Cena auta',
        fill                : false,
        borderWidth         : 2,
        lineTension         : 0,
        spanGaps : true,
        borderColor         : '#efefef',
        pointRadius         : 3,
        pointHoverRadius    : 7,
        pointColor          : '#efefef',
        pointBackgroundColor: '#efefef',
        data                : <?php echo ($oferta['0']['otomotoid']!='')?json_encode($history_price):'['.$oferta['0']['cena'].']';?>
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false,
    },
    scales: {
      xAxes: [{
        ticks : {
          fontColor: '#efefef',
        },
        gridLines : {
          display : false,
          color: '#efefef',
          drawBorder: false,
        }
      }],
      yAxes: [{
        ticks : {
          stepSize: 5000,
          fontColor: '#efefef',
        },
        gridLines : {
          display : true,
          color: '#efefef',
          drawBorder: false,
        }
      }]
    }
  }

  var salesGraphChart = new Chart(salesGraphChartCanvas, { 
      type: 'line', 
      data: salesGraphChartData, 
      options: salesGraphChartOptions
    }
  )



















  console.log(<?php echo json_encode($history_date);?>);
  console.log(<?php echo count($oferta);?>);
  </script>


<?php 
  require('endpage.php'); 
?>