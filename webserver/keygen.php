<?php
$var_hostname=@$_POST['hostname'];
$var_svcontact=@$_POST['svcontact'];

if(empty($var_hostname)) {
	echo '<form action="" method="post">
	hostname:
	<input type="text" name="hostname" value="" maxlength="100" />
	<br />
	sv_contact:
	<input type="text" name="svcontact" value="" maxlength="100" />
	<br /><br />
	<input type="submit" value="Submit" />
	</form>';
} else {
	$szInput=$var_hostname.$var_svcontact;

	$iInputLen=strlen($szInput);

	$Hex=array(
		0x0000007A,0x00000062,0x00000044,0x00000067,
		0x00000067,0x0000001F,0x00000060,0x0000001C,
		0x0000004C,0x00000040,0x00000042,0x0000003A,
		0x00000017,0x0000003C,0x00000013,0x00000032,
		0x00000012,0xFFFFFFEF,0x00000021,0xFFFFFFE7,
		0xFFFFFFE6,0xFFFFFFFF,0xFFFFFFE0,0xFFFFFFF7,
		0xFFFFFFF2,0xFFFFFFD1,0x00000007,0xFFFFFFDC,
		0x00000004,0xFFFFFFD5,0xFFFFFFCC,0xFFFFFFE7
	);

	global $szFinal;

	for($k=0; $k<(32+$iInputLen); $k++) {
		$szFinal=$szFinal."0";
	}

	for($i=0; $i<32; $i++) {
		$szFinal[$i]=chr($Hex[$i]);
	}

	for($j=32; $j<(32+$iInputLen); $j++) {
		$szFinal[$j]=$szInput[($j-32)];
	}

	$szMD5=md5($szFinal);

	printf("Click the link below to download your customized \"superban.id\" file. <br /> Place this file within \"/addons/amxmodx/configs/\"");

	$finaltext=$var_hostname.' :|: '.$szMD5;
	$customfile=$szMD5.'.'.rand();
	$file = fopen($customfile, "w");
	fwrite($file,$finaltext); 
	fclose($file);

	echo '<br /><br />';

	echo '<a href="'.$customfile.'" download="superban.id">superban.id</a>';
}
?>
