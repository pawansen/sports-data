<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo getConfig('site_name');?></title>
</head>

<body style="background:#f2f2f2;">

    <table border="0" cellpadding="0" cellspacing="0" style="font-family:arial; height:auto; width:800px; margin:30px auto; max-width:100%;">
        <tbody>
            <tr>
                <td align="left" style="background: #ffa610;padding: 8px 78px 0;">
                    <img style="max-width:150px;max-height: 72px;" src="<?php echo base_url() . getConfig('site_logo');?>" alt="playwinfantasy.com">
                     <h2><?php echo $message1;?></h2>

                </td>
            </tr>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="650" style="border: 1px solid #ddd9;background: #fff;margin: 20px 0;border-radius: 5px;">

                        <tbody>
                            <tr>
                                <td align="left" style="padding:20px 5px; line-height:24px; color:#333;line-height: 26px;">
                                    <h3><?php echo $message2;?></h3>
                                    <p style="margin:0; padding:15px;">
                                        Hi  <?php echo $user;?>,<br><br>
                                    <?php echo $message3;?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding:20px 5px; line-height:24px; color:#333;line-height: 26px;">
                                    <p style="margin:0; padding:15px;">
                                        <a href="<?php echo base_url();?>"> Visit Fabulous6</a>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 100%;background: #e5e5e5;padding: 30px 0;text-align: center;">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <p style="margin: 0;">Copyright © Playwin-fantasy.com. All rights reserved.</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>
            <tr>
                <td align="center" style="background: #ffa610;padding: 8px 25px 0;">
                    <img style="max-width:150px;max-height: 53px;" src="<?php echo base_url() . getConfig('site_logo');?>" alt="playwinfantasy.com">


                </td>
            </tr>


        </tbody>
    </table>




</body>

</html>


