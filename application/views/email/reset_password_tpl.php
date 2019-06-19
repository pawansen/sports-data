<!DOCTYPE html>
<html lang="en">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo getConfig('site_name');?></title>
</head>

<body style="background:#f2f2f2;">

     <table border="0" cellpadding="0" cellspacing="0" style="font-family:arial; height:auto; width:800px; margin:30px auto; max-width:100%;">
            <tr>
                    <td align="left" style="background:#f69a57;padding: 8px 78px 0;">
                        <img style="max-width:150px;" src="<?php echo base_url() . getConfig('site_logo');?>" alt="logo">
                      <!--   <p style="float: right;color: #fff;margin: 0;line-height: 47px;">2 Crore + Users</p> -->
                      
                    </td>
                </tr>   
        <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="650" style="border: 1px solid #ddd9;background: #fff;margin: 20px 0;border-radius: 5px;">
                       
                        <tr>
                            <td align="left" style="padding:20px 5px; line-height:24px; color:#333;line-height: 26px;">
                                <p style="margin:0; padding:15px;">
                                Hi <?php echo $user;?>,<br><br>
                                    Warm welcome from <?php echo getConfig('site_name');?> team. We just received a request from your ID associated with us to change of password. We hope that the process was smooth and neat. Please let us know your feedback on our official email ID mentioned in the website.     </p>
                             <p style="margin:0; padding:15px;">
                                  Kindly notify us quickly if you haven't send us the request do send Email to us from your registered email address.</p> </td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                        <table style="width: 100%;background: #e5e5e5;padding: 30px 0;text-align: center;">
                            <tr>
                                <td align="right">
                                    <a href="#"><img src="<?php echo base_url()?>Front-End/images/app_store.png" style="max-width: 100px;" ></a>
                                </td>
                                <td align="left">
                                        <a href="#"><img src="<?php echo base_url()?>Front-End/images/google_play.png" style="max-width: 100px;" alt=""></a>
                                    </td>
                            </tr>
                            <tr>
                                <td  align="right"><a  href="#" style="color: #666;text-decoration:none;padding-right:5px; ">Contact Us</a></td>
                                <td  align="left"><a href="#" style="color: #666;text-decoration:none;padding-left:5px; ">Fair Play</a></td>
                            </tr>
                            <tr>
                                <td colspan="2"><p style="margin: 0;">Copyright © <?php echo getConfig('site_name');?>. All rights reserved.</p></td>
                            </tr>
                        </table>
                        </td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
            
            
        </table>
    
</body>

</html>
