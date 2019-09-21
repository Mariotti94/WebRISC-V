<?php
session_start();
require_once "src/init.php";
if (isset($_GET['reset']) && $_GET['reset']=='yes')
{
    $_SESSION['codice']='';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="icon" href="img/content/favicon.ico" type="image/x-icon">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<frameset rows="112,*" frameborder="NO" border="0" framespacing="0">
    <frame src="src/header.php" name="Header" scrolling="NO" noresize >
    <frameset cols="340,*" frameborder="NO" border="0" framespacing="0">
        <frame src="src/leftPanel.php" name="MemIstr" scrolling="YES">
        <frame src="src/executeStep.php" name="Body" scrolling="YES" noresize>
    </frameset>
</frameset>
<noframes>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    </body>
</noframes>
</html>

