<?php
session_start();
if (isset($_POST['btnReadInt'])){
	$_SESSION['data'][0]['sysHold']=false;
	$_SESSION['data'][0]['sysInput']=false;
	$_SESSION['data'][0]['registri'][10]= (($num=preg_replace('~\D~','',$_POST['txtReadInt']))!='') ? $num : '0' ;
	echo "<script language='JavaScript' type='text/JavaScript'>window.close();</script>";
}

if (isset($_POST['btnBreak'])){
	$_SESSION['data'][0]['sysHold']=false;
	$_SESSION['data'][0]['sysBreak']=false;
	echo "<script language='JavaScript' type='text/JavaScript'>window.close();</script>";
}

$sysman = "VALID SYSCALLS MANUAL".PHP_EOL;
$sysman = $sysman."Syscall code in a7, Argument in a0".PHP_EOL;
$sysman = $sysman."SYSCALL CODES:".PHP_EOL;
$sysman = $sysman."Print Int = 1".PHP_EOL;
$sysman = $sysman."Read Int= 5".PHP_EOL;
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
	<meta name="robots" content="noindex" />
</head>
<body bgcolor="#f0f0f0" style="margin: 5px;" >

<div>
	<div>
		<pre style="width: 301px; text-align:center; margin:0px; padding: 5px 10px; background: white; border: 2px dashed;"><?php echo $sysman; ?></pre>
		<br>
		<div style="width: 315px; padding: 5px; background: white; border: 1px solid;">
			CONSOLE
			<pre style="min-height:90px; margin:0px; padding: 5px 10px; background: black; color: white;"><?php echo ($_SESSION['data'][$_SESSION['index']]['sysConsole']!='') ? $_SESSION['data'][$_SESSION['index']]['sysConsole'] : 'EMPTY'; ?></pre>
		</div>
	</div>

	<?php if ($_SESSION['data'][0]['sysInput']) { ?>
	<div style="margin: 5px;">
		<form action="" method="post">
		Input:<br>
		<input type="number" name="txtReadInt">
		<input type="submit" value="Submit" name="btnReadInt" >
		</form>
	</div>
	<?php } ?>
	
	<?php if ($_SESSION['data'][0]['sysBreak']) { ?>
	<div style="margin: 5px;">
		<form action="" method="post">
		<input type="submit" value="Continue" name="btnBreak" >
		</form>
	</div>
	<?php } ?>
</div>

</body>
</html>