<?php 
  if (isset($_GET['oferta'])){ 
    //Początek nagłówka
    require('header1.php'); 
    //Naglówek indywidualne tagi, skrypty i css tylko dla tej strony:
    require('classloader.php');
    $oid=$_GET['oferta'];
    $oferta=(new cOto())->getOfferDetail($oid);
    
    
    
    if (count($oferta)!=3){
      //nowa
      $nowaOferta=true;
    }
    else {
      if ($oferta[0]['otomotoid']!='')
        $nowaOferta=true;
      else{
        $nowaOferta=false;
      }
    }
      // testowa: "102abda7-daa2-6268-3974-5ee300703ce5"
      // testowa: "00000e8f-b977-4bae-502a-5eadedebddff"
  }
  else {
    $nowaOferta=true;
    // header('Location: https://wsinf.potkal.pl/prezentacja/404.php');
  }
  
?>
  <title>pOTO | Edycja oferty</title>

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
            <h1><?php echo $nowaOferta?'Dadawanie oferty':'Edycja oferty'?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $nowaOferta?'Nowa oferta':'Edycja oferty'?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Ogólne</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputMarka">Marka</label>
                <input type="text" id="inputMarka" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['marka'];?>">
              </div>
              <div class="form-group">
                <label for="inputModel">Model</label>
                <input type="text" id="inputModel" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['nazwa_krotka'];?>">
              </div>
              <div class="form-group">
                <label for="inputOpis">Opis</label>
                <textarea id="inputOpis" class="form-control" rows="4"><?php echo $nowaOferta?'':$oferta[0]['opis'];?></textarea>
              </div>
              <div class="form-group">
                <label for="inputLink">Link do galerii</label>
                <input type="text" id="inputLink" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['otomotolink'];?>">
              </div>
              <div class="form-group">
                <label for="inputMiasto">Miasto</label>
                <input type="text" id="inputMiasto" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['miasto'];?>">
              </div>
              <div class="form-group">
                <label for="inputWojewodztwo">Województwo</label>
                <input type="text" id="inputWojewodztwo" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['wojewodztwo'];?>">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Szczegóły auta</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputPrzebieg">Przebieg</label>
                <input type="number" id="inputPrzebieg" class="form-control"  value="<?php echo $nowaOferta?'':$oferta[0]['przebieg'];?>" step="1">
              </div>
              <div class="form-group">
                <label for="inputPojemnosc">Pojemność</label>
                <input type="number" id="inputPojemnosc" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['pojemnosc'];?>" step="1">
              </div>
              <div class="form-group">
                <label for="inputPaliwo">Rodzaj paliwa</label>
                <input type="text" id="inputPaliwo" class="form-control"  value="<?php echo $nowaOferta?'':$oferta[0]['paliwo'];?>" step="1">
              </div>
              <div class="form-group">
                <label for="inputRocznik">Rocznik</label>
                <input type="number" id="inputRocznik" class="form-control"  value="<?php echo $nowaOferta?'':$oferta[0]['rocznik'];?>" step="1">
              </div>
              <div class="form-group">
                <label for="inputCena">Cena</label>
                <div class="row col-md-12">
                  <div class="col-md-7">
                    <input type="number" id="inputCena" class="form-control" value="<?php echo $nowaOferta?'':$oferta[0]['cena'];?>">
                  </div>
                  <div class="c1ol-md-3">
                    <select name="waluta" id="inputWaluta" class="form-control">
                      <option value="PLN" <?php echo $nowaOferta?'selected':($oferta[0]['waluta']=='PLN')?'selected':'';?>>PLN</option>
                      <option value="EUR" <?php echo $nowaOferta?'':($oferta[0]['waluta']=='EUR')?'selected':'';?>>EUR</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="index.php" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
          <button type="button" onclick="saveOffer();" class="btn btn-success float-right"><i class="fa fa-save"></i> Zapisz</button>
        </div>
      </div>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
  $( document ).ready(function() {
    $('#lmdodawanieofert').addClass('active');
    
  });

  function saveOffer(){
    var data = new Object();
    var canSave=true;
    // Zebranie danych i walidacja pól
    data.marka=$('#inputMarka').val();
    if (data.marka.trim()=='')
      canSave=false;
    data.model=$('#inputModel').val();
    if (data.model.trim()=='')
      canSave=false;
    data.txt=$('#inputOpis').val();
    data.link=$('#inputLink').val();
    data.miasto=$('#inputMiasto').val();
    if (data.miasto.trim()=='')
      canSave=false;
    data.wojewodztwo=$('#inputWojewodztwo').val();
    if (data.wojewodztwo.trim()=='')
      canSave=false;
    
    data.przebieg=$('#inputPrzebieg').val();
    if (data.przebieg.trim()=='')
      canSave=false;
    data.pojemnosc=$('#inputPojemnosc').val();
    if (data.pojemnosc.trim()=='')
      canSave=false;
    data.paliwo=$('#inputPaliwo').val();
    if (data.paliwo.trim()=='')
      canSave=false;
    data.rocznik=$('#inputRocznik').val();
    if (data.rocznik.trim()=='')
      canSave=false;
    data.cena=$('#inputCena').val();
    if (data.cena.trim()=='')
      canSave=false;
    data.waluta=$('#inputWaluta').val();

    // console.log(data);
    if (canSave){
      $.ajax({
      type: "POST",
      url: "httpget/offer-edit_get.php",
      data: {dane:data,setOffer:'<?php echo (!$nowaOferta)?$oid:'';?>'},
    }).done(function( data ) {
      //console.log(data);
      window.location.href="https://wsinf.potkal.pl/prezentacja/index.php";
    })
    }
    else{
      alert('Występują będy w ofercie. Popraw je, aby zapisać tą ofertę.')
    }

  }
</script>

<?php 
  require('endpage.php'); 
?>