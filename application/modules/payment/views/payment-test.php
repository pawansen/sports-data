<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo $PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<input type="text" name="MID" value="<?php echo $MID ?>">
                        <input type="text" name="ORDER_ID" value="<?php echo $ORDER_ID ?>">
                        <input type="text" name="CUST_ID" value="<?php echo $CUST_ID ?>">
                        <input type="text" name="INDUSTRY_TYPE_ID" value="<?php echo $INDUSTRY_TYPE_ID ?>">
                        <input type="text" name="CHANNEL_ID" value="<?php echo $CHANNEL_ID ?>">
                        <input type="text" name="TXN_AMOUNT" value="<?php echo $TXN_AMOUNT ?>">
                        <input type="text" name="WEBSITE" value="<?php echo $WEBSITE ?>">
			<input type="text" name="CHECKSUMHASH" value="<?php echo $CHECKSUMHASH ?>">
                        <input type="text" name="CALLBACK_URL" value="<?php echo $CALLBACK_URL ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>