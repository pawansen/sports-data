<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FAQ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend_asset/static_pages/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend_asset/css/styleNew.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>backend_asset/static_pages/js/bootstrap.min.js"></script>



    </head>
    <body>
        <!-- 
        <section  id="faq_top_bar">
                <div  class="container">
                <div><a  href="inventory.html"><img src="<?php echo base_url(); ?>assets/web/images/back.png" class="top_img"></a>
                        <span class="heading_page_text">
                                
                                j FAQ 
                        </span>
                        </div>
                </div>
         </section>
        -->



        <section  id="faq_page">
            <div class="container">
                <br />
                <br />


                <div class="panel-group" id="accordion">
                    <!--<div class="faqHeader">FAQ</div>-->
                    <?php
                    if (!empty($response)) {
                        foreach ($response as $key=>$rows) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key;?>"><?php echo $rows->question;?></a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $key;?>" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <?php echo $rows->answer;?>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </section>
    </body>
</html>
