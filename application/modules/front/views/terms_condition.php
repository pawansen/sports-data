<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>BT Market</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>backend_asset/static_pages/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend_asset/static_pages/css/plugin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend_asset/static_pages/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend_asset/static_pages/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend_asset/static_pages/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>backend_asset/css/styleNew.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/modernizr-custom.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <main class="animsition">
        <!--Header sec start-->
     
        <!--Header sec end-->
        <!--Main container sec start-->
        <div class="main_container">


            <!--wallet-section-start-->
            <section class="wallet_sec privacy_sec mobile">
                <div class="container">
                  <div class="walletTab">
                        
                        <div class="tab-content">
                            
                            <div id="conditions" class="tab-pane fade in active">
                                <h3>TERMS & CONDITIONS</h3>
                                <?php echo $response->description;?>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

            <!--wallet-section-start-->



        </div>
        <!--Main container sec end-->
        <!--Footer sec start-->
     
        <!--Footer sec end-->
    </main>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/plugin.js"></script>
    <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/custom.js"></script>
</body>

</html>