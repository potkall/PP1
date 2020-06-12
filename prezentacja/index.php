<?php 
  //Początek nagłówka
  require('header1.php'); 
  //Naglówek indywidualne tagi, skrypty i css tylko dla tej strony:
?>
  <title>pOTO | Projekt PP</title>
  

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Data Tables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ion Slider -->
  <link rel="stylesheet" href="plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
<?php 
  require('top-menu.php'); 
  require('left-menu.php'); 
  //content:
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Lista ofert</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Lista ofert</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="box_info_1">&nbsp;</h3>

                <p>Ilość ofert</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="box_info_2">&nbsp;</h3>

                <p>Ilość dzisiejszych pytań</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="box_info_3" style="font-weight: 100;">&nbsp;</h3>

                <p>Ostatnia synchronizacja</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="box_info_4">&nbsp;</h3>

                <p>Wszystkich zapytań</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="col-md-12">
              <div class="card box-primary">
                <div class="card-header with-border"></div>
                <div class="card-body overlay-wrapper">
                  <h5>Filtry</h5>
                  <div class="row">
                    <div class="col-lg-3 col-6">
                      <label>Marka</label>
                      <select class="select2" id="filtr1" style="width:100%;"></select>
                    </div>
                    <div class="col-lg-3 col-6" style="padding:0px 30px;">
                      <label>Cena</label>
                      <input class="" id="filtr2"></input>
                    </div>
                    <div class="col-lg-3 col-6" style="padding:0px 30px;">
                      <label>Rok produkcji</label>
                      <input class="" id="filtr3" style="width:100%;"></input>
                    </div>
                    <div class="col-lg-3 col-6">
                      <label>OtoMoto/Inne</label>
                      <select class="select2" id="filtr4" style="width:100%;"></select>
                    </div>
                  </div>
                  <div class="row" style="margin-top:25px;">
                    <table class="table no-margin" style="width:100%;" id="tabela_oferty" ></table>
                  </div>
                </div>
                <div id="loading" class=""></div>                  
              </div>
            </div>
          </section>
            

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php 
  //stopki + zawsze wgrywane skrypty
  require('footer.php'); 
  //skrypty tylko dla tej strony:
?>





<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Ion Slider -->
<script src="plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>


<script>
  $( document ).ready(function() {
    $('#lmlistaofert').addClass('active');
    AddLoading('loading');
    getBoxess();
    getOffers();

    $('#filtr2').ionRangeSlider({
      min     : 0,
      max     : 50000,
      from    : 0,
      to      : 50000,
      type    : 'double',
      step    : 1,
      prefix  : 'PLN ',
      prettify: false,
      hasGrid : true,
      onFinish: function (data) {
        refreshOffers();
      }
    });

    $('#filtr3').ionRangeSlider({
      min     : 1900,
      max     : 2020,
      from    : 1900,
      to      : 2020,
      type    : 'double',
      step    : 1,
      prefix  : '',
      prettify: false,
      hasGrid : true,
      onFinish: function (data) {
        refreshOffers();
      }
    });

  });

  function delOffer(oid){
    if (confirm('Czy na pewno chcesz usunąć ofertę?')){
      $.getJSON( "httpget/index_get.php?delOffer="+oid, function(d) {
        console.log(d);
        refreshOffers();
      });
    }
  }

  function editOffer(offerId){
    window.open("https://wsinf.potkal.pl/prezentacja/offer-edit.php?oferta="+offerId);
  }

  function showOffer(offerId){
    window.open("https://wsinf.potkal.pl/prezentacja/offer-detail.php?oferta="+offerId,"_blank");
  }


  function createFilters(filtersObj){
    //Select2 - marka
    var tmp=new Array();
    for (let i = 0; i < filtersObj.marka.length; i++) {
      tmp[i]={'id':i,'text':filtersObj.marka[i]};      
    }
    $('#filtr1').select2({data:tmp, multiple:true,placeholder:'wybierz z listy'})

    //cena
    tmp = $('#filtr2').data("ionRangeSlider");
    tmp.update({
      to: filtersObj.cena, 
      max: filtersObj.cena 
    });

    //rocznik
    tmp = $('#filtr3').data("ionRangeSlider");
    tmp.update({
      to: filtersObj.rocznik.max, 
      max: filtersObj.rocznik.max,
      from: filtersObj.rocznik.min, 
      min: filtersObj.rocznik.min
    });
    
    //skad
    $('#filtr4').select2({data:filtersObj.skad, multiple:true,placeholder:'wybierz z listy'});

    //enable events
    $('.select2').on('change',function(){
      refreshOffers();
    });
  }

  function getBoxess(){
    var jqxhr = $.getJSON( "httpget/index_get.php?getBoxess", function(d) {
      for (i=0;i<4;i++)
        $('#box_info_'+(i+1)).html(d[i]);
    });
  }

  function refreshOffers(){
    //przygotowanie linku
    var filters='';
    var tmp='';
    if ($('#filtr1').val().length>0){
      filters+='&marka=';
      for (let i = 0; i < $('#filtr1').val().length; i++) 
        tmp+=','+$('#filtr1').select2('data')[i]['text'];
        filters+=tmp.substring(1);
    }

    filters+='&cena=';
    filters+=$('#filtr2').val().replace(';','-');

    filters+='&rocznik=';
    filters+=$('#filtr3').val().replace(';','-');

    if ($('#filtr4').val().length>0){
      filters+='&nieoto=';
      tmp='';
      for (let i = 0; i < $('#filtr4').val().length; i++) 
        tmp+=','+$('#filtr4').select2('data')[i]['id'];
        filters+=tmp.substring(1);
    }
    refreshTableOffers(filters);
  }

  function refreshTableOffers(filters){
    AddLoading('loading');
    var dt = $('#tabela_oferty').dataTable().api();
    dt.ajax.url("httpget/index_get.php?getOffers&filters="+filters).load(function(){RemoveLoading('loading')});
  }

  function getOffers(){
    $('#tabela_oferty').DataTable( {
      "ajax": {
        "url": 'httpget/index_get.php',
        "type": "GET",
        "data": { getOffers:'' },
        "complete":function(e){
          console.log(e.responseJSON);
          RemoveLoading('loading');
          if (e.responseJSON.createfilters)
            createFilters(e.responseJSON.filters);
        }
      },
      "dom": '<"top"flp<"clear">>rt<"bottom"ip<"clear">>',
      "destroy":true,
      "responsive":true,
      "iDisplayLength":50,
      "deferRender":true,
      "select":true,
      "ordering":true,
      "processing":true,
      "rowId":"id",
      "language": {
        "url": "plugins/datatables/pol.json"
      },
      responsive: true,
      columns: [{
          title: "Marka",
          orderable:true,
          data:'marka',
          width:"10%"
        },
        {
          title:"Model",
          orderable:true,
          data:'model',
          width:"20%"
        },
        {
          title:"Miasto",
          orderable:true,
          data:'miasto'
        },
        {
          title:"Cena",
          orderable:true,
          data:'cena',
          width:"10%"
        },
        {
          title:"Paliwo",
          orderable:true,
          data:'paliwo'
        },
        {
          title:"Rocznik",
          orderable:true,
          data:'rocznik',
          width:"10%"
        },
        {
          title:"",
          orderable:true,
          data:'btns',
          width:"15%"
        }
      ],
      "order": [[0, 'DESC']]
    });
  }

  function AddLoading(elemid){
    $('#'+elemid).addClass('overlay');
    $('#'+elemid).html('<i class="fas fa-3x fa-sync-alt fa-spin"></i><div class="text-bold pt-2">Czekaj...</div>');
  }

  function RemoveLoading(elemid){
    $('#'+elemid).removeClass('overlay');
    $('#'+elemid).html('');
  }

</script>

<?php 
  require('endpage.php'); 
?>