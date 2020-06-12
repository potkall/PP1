
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prezentacja API | Logowanie</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="dist/css/custom.min.css" rel="stylesheet">

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="checkout.php" method="POST" autocomplete="off" runat="server">
							<!-- <input type="hidden" name="l" value="<?php echo $l;?>"/> -->
              <h1>LOGOWANIE</h1>
              <div>
                <input type="text" class="form-control" placeholder="login" name="user" required="" autocomplete="off"/>
              </div>
							<input type="text" disabled="disabled" style="display:none">
              <div>
                <input type="password" class="form-control" placeholder="hasło" name="pass" required="" autocomplete="off"/>
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" href="checkout.php">ZALOGUJ</button>
              </div>
              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                    <?php if (isset($_GET['proby'])):?>
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-warning"></i> Nieprawidłowy login lub hasło!</h4>
                            </div>
                    <?php endif;?>
                  <h1><i class="fa fa-hand-o-right"></i> WSINF</h1>
                  <p>POTKAL ©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
