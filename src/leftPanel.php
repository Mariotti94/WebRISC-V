<?php
session_start();
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/JavaScript">
        window.onload = function() {
            var counter=top.frames[1].document.getElementById('counter');
			var destraTop=top.frames[1].document.getElementById('destraTop');
			counter.style.marginTop=-(counter.offsetHeight+1);
			destraTop.style.marginTop=(counter.offsetHeight+1);
        };
    </script>
	<meta name="robots" content="noindex" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#D4D0C8">
<?php
$destra=isset($_GET['dst'])?$_GET["dst"]:"";

if (!$_SESSION['loaded'] || empty($_SESSION['codice'])) {
	$_SESSION['asmName']='not loaded';
}
else {
	if($_SESSION['asmName']=='not loaded')
		$_SESSION['asmName']='handwritten.s';
}

$_SESSION['finito'] = ($_SESSION['ifIstruzione']==1002) && ($_SESSION['idIstruzione']==1002) && ($_SESSION['exIstruzione']==1002) && ($_SESSION['memIstruzione']==1002) && ($_SESSION['wbIstruzione']==1002) && ($_SESSION['start']);
?>
<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" id="counter">
	<tr>
		<td align="center" width="40%" class="testoGrande"><?php echo $_SESSION['asmName']; ?></td>
		<td align="center" width="60%" class="testoGrande"><?php echo 'CYCLE: '.$_SESSION['clock'];  if($_SESSION['finito']) echo ' [END]';?></td>
	</tr>
	<?php for($i=0; $i<3; ++$i) { ?>
	<tr>
		<td><img src="../img/layout/x.gif" width="2"></td>
    </tr>
	<?php } ?>
	<tr>
        <td align="center" valign="middle"colspan="2">
		<span  style="border:1px solid; padding:2px;" >
			<a style="font-size:14px;" class="link4"  href="javascript:void(0);" onclick="javascript:window.open('pipeTable.php','','width=600 height=400');"> Execution Table </a>
		</span>
		</td>
	</tr>

	<?php for($i=0; $i<2; ++$i) { ?>
	<tr>
		<td><img src="../img/layout/x.gif" width="2"></td>
    </tr>
    <?php 
	}
	if ($_SESSION['finito'] ) { ?>
	<tr>
		<td><img src="../img/layout/x.gif" width="2"></td>
    </tr>
        <tr>
            <td align="center" valign="middle" bgcolor="black" height="20" colspan="2">
                <font size="2" face="arial" color="#00ff00"><b>
                        EXECUTION COMPLETED IN <br><?php echo $_SESSION['clock'];?> CLOCK CYCLES</b>
                </font>
            </td>
        </tr>
        <tr>
            <td><img src="../img/layout/x.gif" width="2"></td>
        </tr>
    <?php } ?>

	<tr>
		<td><img src="../img/layout/x.gif" width="2"></td>
    </tr>

    <tr>
        <td align="center" valign="middle" bgcolor="black" colspan="2">
		<?php
			$stall_start='<font size="2" face="arial" color="red">Stall in ';
			$stall_stop=' stage<br></font>';
			$empty_start='<font size="2" face="arial" color="#00ff00">Empty ';
			$empty_stop=' stage<br></font>';
			if ($_SESSION['ifIstruzione']==1001) {
				$stage="IF";
				echo $stall_start.$stage.$stall_stop;
			}
			if ($_SESSION['ifIstruzione']==1002) {
				$stage="IF";
				echo $empty_start.$stage.$empty_stop;
			}
			if ($_SESSION['idIstruzione']==1001) {
				$stage="ID";
				echo $stall_start.$stage.$stall_stop;
			}
			if ($_SESSION['idIstruzione']==1002) {
				$stage="ID";
				echo $empty_start.$stage.$empty_stop;
			}
			if ($_SESSION['exIstruzione']==1001) {
				$stage="EX";
				echo $stall_start.$stage.$stall_stop;
			}
			if ($_SESSION['exIstruzione']==1002) {
				$stage="EX";
				echo $empty_start.$stage.$empty_stop;
			}
			if ($_SESSION['memIstruzione']==1001) {
				$stage="MEM";
				echo $stall_start.$stage.$stall_stop;
			}
			if ($_SESSION['memIstruzione']==1002) {
				$stage="MEM";
				echo $empty_start.$stage.$empty_stop;
			}
			if ($_SESSION['wbIstruzione']==1001) {
				$stage="WB";
				echo $stall_start.$stage.$stall_stop;
			}
			if ($_SESSION['wbIstruzione']==1002) {
				$stage="WB";
				echo $empty_start.$stage.$empty_stop;
			}
		?>
        </td>
    </tr>	
		
</table>
	
<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#7B869A" id="destraTop">

    <tr>
        <td background="../img/layout/bg_destra_sin.gif"><img src="../img/layout/x.gif"></td>
        <td align="center" width="33%">
            <?php if ($destra=="")
            {
                $c1="#D4D0C8";
                $c2="white";
                $c3="white";
                ?>
                <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#D4D0C8" ID="Table1">
                    <tr>
                        <td width="5"><img src="../img/layout/bg_destra_active1.gif"></td>
                        <td valign="middle" align="center" background="../img/layout/bg_destra_active3.gif">
                            <a href="leftPanel.php" class="link3"><b>Instruction<br>Memory</b></a></td>
                        <td width="19"><img src="../img/layout/bg_destra_active2.gif"></td>
                    </tr>
                </table>
            <?php }
            else
            {
                ?>
                <table cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                        <td valign="middle" align="center">
                            <a href="leftPanel.php" class="link">Instruction<br>Memory</a></td>
                    </tr>
                </table>
            <?php } ?>
        </td>
        <td align="center" width="33%" valign="middle">
            <?php if ($destra=="dati")
            {
                $c1="white";
                $c2="#D4D0C8";
                $c3="white";
                ?>
                <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#D4D0C8">
                    <tr>
                        <td width="5"><img src="../img/layout/bg_destra_active1.gif"></td>
                        <td valign="middle" align="center" background="../img/layout/bg_destra_active3.gif">
                            <a href="leftPanel.php?dst=dati&tipo=tutto" class="link3"><b>Data<br>Memory</b></a></td>
                        <td width="19"><img src="../img/layout/bg_destra_active2.gif"></td>
                    </tr>
                </table>
            <?php }
            else
            {
                ?>
                <table cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                        <td valign="middle" align="center">
                            <a href="leftPanel.php?dst=dati&tipo=tutto" class="link">Data<br>Memory</a></td>
                    </tr>
                </table>
            <?php } ?>
        </td>
        <td align="center" width="33%">
            <?php if ($destra=="registri")
            {
                $c1="white";
                $c2="white";
                $c3="#D4D0C8";
                ?>
                <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#D4D0C8" ID="Table2">
                    <tr>
                        <td width="5"><img src="../img/layout/bg_destra_active1.gif"></td>
                        <td align="center" background="../img/layout/bg_destra_active3.gif">
                            <a href="leftPanel.php?dst=registri" class="link3"><b>Registers</b></a></td>
                        <td width="19"><img src="../img/layout/bg_destra_active2.gif"></td>
                    </tr>
                </table>
            <?php }
            else
            {
                ?>
                <a href="leftPanel.php?dst=registri" class="link">Registers</a>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td width="7" bgcolor="white"><img src="../img/layout/x.gif"></td>
        <td bgcolor="<?php echo $c1;?>"><img src="../img/layout/x.gif"></td>
        <td bgcolor="<?php echo $c2;?>"><img src="../img/layout/x.gif"></td>
        <td bgcolor="<?php echo $c3;?>"><img src="../img/layout/x.gif"></td>
    </tr>
</table>


<?php
switch ($destra)
{
    case "registri":
        require "registers.php";
        break;

    case "dati":
        require "dataMem.php";
        break;

    default:
        require "instrMem.php";
        break;
}
?>

</body></html>

