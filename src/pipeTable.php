<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
	<meta name="robots" content="noindex" />
</head>
<body bgcolor="#F0F0F0" style="margin-left:5px; margin-top:5px;" >

<table  style="border-collapse: collapse;">
<?php
	session_start();
	require 'functions.php';
	$clock=($_SESSION['finito'])?$_SESSION['clock']-1:$_SESSION['clock'];
	
	for ($i=0; $i<count($_SESSION['execTrail']); ++$i) {
		$a=$_SESSION['execTrail'][$i];
		$op=substr($a,25,7);
		$funct3=substr($a,17,3);
		$funct7=substr($a,0,7);

		$tipo=instrType(BinToInt($op,1));
		$oper=instrName(BinToInt($op,1),BinToInt($funct3,1),BinToInt($funct7,1));
		$istruzione='';

		if($tipo=="R")
		{
			$rd=substr($a,20,5);
			$rs1=substr($a,12,5);
			$rs2=substr($a,7,5);
			$istruzione=$oper." ".codRegister(BinToInt($rd,1)).", ".codRegister(BinToInt($rs1,1)).", ".codRegister(BinToInt($rs2,1));
		}
		else if($tipo=="I")
		{
			$rd=substr($a,20,5);
			$rs1=substr($a,12,5);
			$imm=substr($a,0,12);
			$check=BinToInt($op,1);
			if($check==hexdec(3) || $check==hexdec(67))
			{
				$istruzione=$oper." ".codRegister(BinToInt($rd,1)).", ".BinToInt($imm,0)."(".codRegister(BinToInt($rs1,1)).")";
			}
			else
			{
				$istruzione=$oper." ".codRegister(BinToInt($rd,1)).", ".codRegister(BinToInt($rs1,1)).", ".BinToInt($imm,0);
			}

		}
		else if($tipo=="S")
		{
			$imm=substr($a,0,7).substr($a,20,5);
			$rs1=substr($a,12,5);
			$rs2=substr($a,7,5);
			$istruzione=$oper." ".codRegister(BinToInt($rs2,1)).", ".BinToInt($imm,0)."(".codRegister(BinToInt($rs1,1)).")";
		}
		else if($tipo=="SB")
		{
			$imm=substr($a,0,1).substr($a,24,1).substr($a,1,6).substr($a,20,4).'0';
			$rs1=substr($a,12,5);
			$rs2=substr($a,7,5);
			$istruzione=$oper." ".codRegister(BinToInt($rs1,1)).", ".codRegister(BinToInt($rs2,1)).", ".BinToInt($imm,0);
		}
		else if($tipo=="U")
		{
			$rd=substr($a,20,5);
			$imm=substr($a,0,20);
			$istruzione=$oper." ".codRegister(BinToInt($rd,1)).", ".BinToInt($imm,0);
		}
		else if($tipo=="UJ")
		{
			$rd=substr($a,20,5);
			$imm=substr($a,0,1).substr($a,12,8).substr($a,11,1).substr($a,1,10).'0';
			$istruzione=$oper." ".codRegister(BinToInt($rd,1)).", ".BinToInt($imm,0);
		}
		
	
		if($i==0) {
			echo "<tr>";
		    echo "<td></td>";
			echo "<td style='background-color: white;' class='pipeTd' colspan='".$clock."'>CPU Cycles</td>";
			echo "</tr>";
			echo "<tr>";
		    echo "<td class='pipeTd' style='background-color: white; min-width:125px;'> Instruction</td>";
			for ($j=1; $j<=$clock; ++$j) {
				echo "<td style='background-color: white;' class='pipeTd'>".$j."</td>";
			}
			echo "</tr>";
		}
			
		echo "<tr class='alternating'>";
		echo "<td class='pipeTd' style='min-width:125px;'>".$istruzione."</td>";
		for ($j=1; $j<=$clock; ++$j) {
			echo "<td class='pipeTd'>";
			if(array_key_exists($i, $_SESSION['pipeTable'][$j])){
				if($j>1 && array_key_exists($i, $_SESSION['pipeTable'][$j-1]) && $_SESSION['pipeTable'][$j][$i]==$_SESSION['pipeTable'][$j-1][$i])
					echo "-";
				else
					echo $_SESSION['pipeTable'][$j][$i];
			}
			echo "</td>";
		}
		echo "</tr>";
	}
		
?>
</table>
</body>
</html>