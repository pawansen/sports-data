
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $site; ?> - Welcome</title>
        <meta name="viewport" content="width=device-width" />
       <style type="text/css">
            @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                body[yahoo] .buttonwrapper { background-color: transparent !important; }
                body[yahoo] .button { padding: 0 !important; }
                body[yahoo] .button a { background-color: #9b59b6; padding: 15px 25px !important; }
            }

            @media only screen and (min-device-width: 601px) {
                .content-email { width: 600px !important; background-color: #ffffff;}
                .col387 { width: 387px !important; }
                .content_email_header { width: 600px !important; }
            }

            a.button_confirm_email {
    border: 0;
    outline: 0;
    border-radius: 5px;
    background-color: #B7D30B;
    box-shadow: 0 18px 8px rgba(0,0,0,0.05);
    -webkit-box-shadow: 0 8px 8px rgba(0,0,0,0.05);
    display: block;
    letter-spacing: 1px;
    padding: 13px 22px;
    color: #FFFFFF;
    font-size: 16px;
    cursor: pointer;
    text-decoration:none;
}
        </style>
    </head>
    <body bgcolor="#f2f2f2" style="margin: 0; padding: 0;" yahoo="fix">
        <!--[if (gte mso 9)|(IE)]>
        <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
        <![endif]-->
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content_email_header">
            <tr>
                <td style="padding: 30px 10px 30px 10px;">
                   
                </td>
            </tr>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content-email">
            
           <tr>
                <td align="center" style="padding: 24px 20px 8px 20px; color: #545454; font-family: Arial, sans-serif; font-size: 30px; font-weight: bold;">
                    <img src="<?php echo base_url() . getConfig('site_logo'); ?>" alt="" width="170"  style="display:block;" />
                   
                </td>
            </tr>

            <tr>
                <td align="left"  style="padding: 20px 45px 20px 45px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                    Hi,
                    
                </td>
            </tr>
              <tr>
                <td align="left"  style="padding: 5px 45px 5px 45px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                    <b>It's time to confirm your email address.</b>
                    
                </td>
            </tr>
            <tr>
                <td align="left"  style="padding: 15px 45px 15px 45px; color: #555555; font-family: Arial, sans-serif; font-size: 14px; line-height: 26px;">
                <?php echo $content;?></b>
                    
                </td>
            </tr>
            <tr>
                <td align="left"  style="padding: 15px 45px 15px 45px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                    <a class="button_confirm_email" href="<?php echo $active_url;?>" >Confirm my email address</a>
                </td>
            </tr>

            <tr>
                <td align="left"  style="padding: 40px 45px 15px 45px; color: #555555; font-family: Arial, sans-serif; font-size: 14px; line-height: 26px;">
                If you don't know why you got this email, please tell us straight away so we can fix this for you.
                </td>
            </tr>



            <tr>
                <td align="left"  style="padding: 40px 45px 45px 45px; color: #555555; font-family: Arial, sans-serif; font-size: 14px; line-height: 26px; border-bottom: 1px solid #f6f6f6;">
                    Thanks<br>
                    The  <?php echo $site; ?> Team

                </td>
            </tr>
        </table>

        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content_email_header">
            <tr>
                <td style="padding: 30px 10px 5px 10px;">

                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                2019 &copy; <b><a href="#" style="color: #555555;"> <?php echo $site; ?>.</a></b> &nbsp;All rights reserved

                            </td>

                        </tr>
                    </table>
                   
                </td>
            </tr>
             <tr >
                <td align="center" width="100%" style="padding: 2px 10px 2px 10px; color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                <?php echo $site_meta_title;?>
                </td>
            </tr>
            <tr >
                <td align="center" width="100%" style="padding: 2px 10px 30px 10px; color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                <?php echo $site; ?> <br>
                </td>
            </tr>
            
        </table>




        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]--> 
    </body>
</html>