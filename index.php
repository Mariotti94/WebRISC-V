<?php
session_start();
require_once 'src/init.php';
$_SESSION['codice']='';
$_SESSION['branchFlush']=true;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="icon" href="img/content/favicon.ico" type="image/x-icon">
    <link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<frameset rows="130,*" frameborder="no" border="0" framespacing="0">
    <frame src="src/header.php" name="Header" scrolling="no" noresize>
    <frameset cols="340,*" frameborder="no" border="0" framespacing="0">
        <frame src="src/leftPanel.php" name="MemReg" scrolling="yes" noresize>
        <frame src="src/executeStep.php" name="Layout" scrolling="yes" noresize>
    </frameset>
</frameset>
<noframes>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    </body>
</noframes>
</html>

