<?php
list($ALUOp,$ALUdato1,$ALUdato2,$EX_MEM_DataW,$EX_MEM_DataW,$EX_MEM_M,$EX_MEM_M,$EX_MEM_RIS,$EX_MEM_RIS,$EX_MEM_RegW,$EX_MEM_WB,$EX_MEM_WB,$EX_scarta,$ID_EX_Data1,$ID_EX_Data1,$ID_EX_Data2,$ID_EX_Data2,$ID_EX_EX,$ID_EX_EX,$ID_EX_M,$ID_EX_M,$ID_EX_RD,$ID_EX_RS1,$ID_EX_RS2,$ID_EX_WB,$ID_EX_WB,$ID_EX_funct3,$ID_EX_funct7,$ID_EX_imm,$ID_EX_imm2,$ID_scarta,$IF_ID_PC,$IF_scarta,$MEM_WB_Data,$MEM_WB_DataR,$MEM_WB_DataR,$MEM_WB_RegW,$MEM_WB_WB,$MEM_WB_WB,$Mux3Ctrl,$Mux4Ctrl,$Mux5Ctrl,$PCsrc,$RL1,$RL2,$WBdata,$aluCtrl,$branch,$branchCheck,$ctrl_EX,$ctrl_M,$ctrl_WB,$isBranch,$isJal,$isJalr,$istruzione,$newPC,$newPC1,$newPC2,$stallo,$tempPC,$tempImm,$tempIstruzione) = $_SESSION['data'][$_SESSION['index']]['schemaData'];
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/schema.css" rel="stylesheet" type="text/css">
	<script language='JavaScript' type='text/JavaScript' src="../js/schema.js"></script>
    <script language='JavaScript' type='text/JavaScript'>
        window.onload = function() {
			//PANEL NAME
			if(top.frames[0].document.getElementById('mainLabel'))
				top.frames[0].document.getElementById('mainLabel').innerHTML="SCHEMA LAYOUT";
			//RELOAD LEFT PANEL
            var rFrame=top.frames[1];
            if (rFrame)
				rFrame.document.location.reload();
			//SET/UNSET POPUPS
            if (top.frames[0]) {
				if (top.frames[0].document.getElementById('toggleHover') && top.frames[0].document.getElementById('toggleHover').checked) {
					top.frames[2].popup_set();
				}
				else {
					top.frames[2].popup_unset();
				}
			}
        };
    </script>
	<meta name="robots" content="noindex" />
</head>
<body id="schemaBody">

	<table cellpadding="0" cellspacing="0" class="elemento and">
		<tr><td valign="middle" align="center" ><font size="1">AND</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento if_mux">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento if_som">
		<tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento pc">
		<tr><td valign="middle" align="center" bgcolor="pink"><font size="1">PC</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento istruzioni">
		<tr><td valign="top" align="center">
				<font size="1"><b>INSTR<br>MEMORY</b>
					<div align="left" style="position:absolute; top:42%;">ADDRESS</div>
					<div align="right" style="position:absolute; right:1%; top:60%;">READ<br>INSTR</div>
				</font>
			</td></tr>
	</table>

	<div align="center" style="position:absolute; left:154px; top:208px;">
	<font size="1">IF/ID</font>
	<table style="width:37px; height:282px;" cellpadding="0" cellspacing="0" border="0" bgcolor="red">
		<tr>
			<td><img src="../img/layout/x.gif"></td>
		</tr>
	</table>
	</div>

	<table cellpadding="0" cellspacing="0" class="elemento criticita">
		<tr><td valign="middle" align="center">
				<font size="1">HAZARD DETECTION UNIT<br></font>
			</td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento controllo">
		<tr><td valign="middle" align="center">
				<font size="1">CONTROL<BR>UNIT<br></font>
			</td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento immgen">
		<tr><td valign="middle" align="center">
				<font size="1">IMM<br>GEN<br></font>
			</td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento sl1">
		<tr><td valign="middle" align="center"><font size="1">SHIFT<br>LEFT 1</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento id_som">
		<tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento registri">
		<tr><td valign="top" align="center">
				<font size="1">
					<div align="right">READ DATA 1</div>
					<div align="left" style="position:absolute; top:12%;">READ REG 1</div>
					<div align="left" style="position:absolute; top:28%;">READ REG 2</div>
					<div align="center" style="position:absolute; left:15%; top:48%;"><b>REGISTERS</b></div>
					<div align="left" style="position:absolute; top:69%;">WRITE REG</div>
					<div align="left" style="position:absolute; top:90%;">WRITE DATA</div>
					<div align="right" style="position:absolute; right:1%; top:80%;">READ DATA 2</div>
				</font>
			</td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento or">
		<tr><td valign="middle" align="center"><font size="1">OR</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento id_mux">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento uguale">
		<tr><td valign="middle" align="center"><font size="1">=</font></td></tr>
	</table>

	<div align="center" style="position:absolute; left:453px; top:93px;">
		<font size="1">ID/EX</font>
		<table style="width:37px; height:35px;" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
			<tr>
				<td valign="middle" align="center">
					<font size="1">WB
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#666666" style="height: 5px"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
		</table>
		<table style="width:37px; height:35px;" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
			<tr>
				<td valign="middle" align="center">
					<font size="1">M
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#666666" style="height: 5px"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
		</table>
		<table style="width:37px; height:35px;" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
			<tr>
				<td valign="middle" align="center">
					<font size="1">EX
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#666666" style="height: 5px"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
		</table>
		<table style="width:37px; height:295px;" cellpadding="0" cellspacing="0" border="0" bgcolor="yellow" >
			<tr>
				<td><img src="../img/layout/x.gif"></td>
			</tr>
		</table>
	</div>

	<table cellpadding="0" cellspacing="0" class="elemento cause">
		<tr><td valign="middle" align="center"><font size="1">SCAUSE</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento epc">
		<tr><td valign="middle" align="center"><font size="1">SEPC</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento ex_mux3">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento ex_mux4">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento ex_mux5">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento ex_mux1">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento ex_mux2">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento alu">
		<tr><td valign="middle" align="center"><font size="1"><b>ALU</b></font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento controlloalu">
		<tr><td valign="middle" align="center">
				<font size="1">ALU<br>CONTROL<br>UNIT</font></td></tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="elemento propagazione">
		<tr>
			<td valign="middle" align="center">
				<font size="1">FORWARDING UNIT<br></font>
			</td>
		</tr>
	</table>

	<div align="center" style="position:absolute; left:737px; top:128px;">
		<font size="1">EX/MEM</font>
		<table style="width:37px; height:35px;" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif">
			<tr>
				<td valign="middle" align="center">
					<font size="1">WB
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#666666" style="height: 5px"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
		</table>
		<table style="width:37px; height:35px;" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif">
			<tr>
				<td valign="middle" align="center">
					<font size="1">M
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#666666" style="height: 5px"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
		</table>
		<table style="width:37px; height:295px;" cellpadding="0" cellspacing="0" border="0" bgcolor="blue" >
			<tr>
				<td><img src="../img/layout/x.gif"></td>
			</tr>
		</table>
	</div>

	<table cellpadding="0" cellspacing="0" class="elemento memdati">
		<tr><td valign="top" align="center">
			<font size="1"><b>DATA<br>MEMORY</b>
				<div align="left" style="position:absolute; top:43%;">ADDRESS</div>
				<div align="right" style="position:absolute; right:1%; top:65%;">READ<br>DATA</div>
				<div align="left" style="position:absolute; top:85%;">WRITE DATA</div>
			</font>
		</td></tr>
	</table>

	<div align="center" style="position:absolute; left:907px; top:160px;">
		<font size="1">MEM/WB</font>
		<table style="width:37px; height:35px;" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_MEM_WB.gif">
			<tr>
				<td valign="middle" align="center">
					<font size="1">WB
					</font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#666666" style="height: 5px"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
		</table>
		<table style="width:37px; height:300px;" cellpadding="0" cellspacing="0" border="0" bgcolor="green" >
			<tr>
				<td><img src="../img/layout/x.gif"></td>
			</tr>
		</table>
	</div>

	<table cellpadding="0" cellspacing="0" class="elemento wb_mux">
		<tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
	</table>

	<!--#### SEGNALI DI DATI-->
	<?php
	if ($_SESSION['segDati']!="")
	{
		?>
		<div style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:-2; pointer-events:none;">
			<img src="../img/content/segnali_Dati.gif">
		</div>
		<?php 
	} ?>
	<!--#### SEGNALI DI CONTROLLO-->
	<?php if ($_SESSION['segCtrl']!="")
	{
		?>
		<div style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:-1; pointer-events:none;">
			<img src="../img/content/segnali_Controllo.gif">
		</div>
		<?php
	} ?>

	<!--#### LINK AGLI ELEMENTI-->
	<div style="z-index:2" class="istruzioni">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=istruzioni&PC=<?php echo isset($tempPC)?$tempPC*4:0;?>&istr=<?php echo isset($tempIstruzione)?$tempIstruzione:str_repeat('0',32);?>','','width=450,height=300');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION MEMORY">
		</a>
	</div>

	<div style="z-index:2" class="if_som">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=if_som&newPC=<?php echo isset($tempPC)?$tempPC*4:0;?>&PCpiu4=<?php echo isset($tempPC)?($tempPC+1)*4:0;?>','','width=300,height=200');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ADDER 1">
		</a>
	</div>

	<div style="z-index:2" class="if_mux">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=if_mux&newPC=<?php echo isset($newPC)?$newPC*4:0;?>&PCpiu4=<?php echo isset($newPC2)?$newPC2*4:0;?>&salto=<?php echo isset($newPC1)?$newPC1*4:0;?>&ctrl1=<?php echo isset($PCsrc)?(int)$PCsrc:0;?>&ctrl2=<?php echo 0;?>','','width=400,height=340');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION FETCH MULTIPLEXER">
		</a>
	</div>

	<div style="z-index:2" class="and">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=and&ctrl1=<?php echo isset($branchCheck)?(int)$branchCheck:0;?>&ctrl2=<?php echo isset($branch)?(int)$branch:0;?>&ris=<?php echo isset($PCsrc)?(int)$PCsrc:0;?>','','width=300,height=270');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="LOGIC AND">
		</a>
	</div>

	<div style="z-index:2" class="pc">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=pc&newPC=<?php echo isset($newPC)?$newPC*4:0;?>&PC=<?php echo isset($tempPC)?$tempPC*4:0;?>&ctrl=<?php echo isset($stallo)?(($stallo)?1:0):0;?>','','width=300,height=240');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="PROGRAM COUNTER">
		</a>
	</div>

	<div style="z-index:2" class="criticita">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=criticita&rl1=<?php echo isset($RL1)?$RL1:0;?>&rl2=<?php echo isset($RL2)?$RL2:0;?>&stallo=<?php echo isset($stallo)?(($stallo)?1:0):0;?>&mem=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>&rd=<?php echo isset($ID_EX_RD)?$ID_EX_RD:0;?>','','width=400,height=270');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="HAZARD DETECTION UNIT">
		</a>
	</div>

	<div style="z-index:2" class="controllo">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=controllo&istr=<?php echo isset($istruzione)?$istruzione:str_repeat('0',32);?>&salta=<?php echo isset($branch)?(int)$branch:0;?>&ecc=<?php echo 0;?>&wb=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&mem=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',4);?>&ex=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',3);?>&if_scarta=<?php echo isset($IF_scarta)?$IF_scarta:0;?>&id_scarta=<?php echo isset($ID_scarta)?$ID_scarta:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=450,height=270');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="CONTROL UNIT">
		</a>
	</div>

	<div style="z-index:2" class="id_mux">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=id_mux&ctrl=<?php echo isset($stallo)?(($stallo)?1:0):0;?>&wb=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&mem=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',4);?>&ex=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',3);?>&wb2=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&mem2=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',4);?>&ex2=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',3);?>','','width=300,height=240');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION DECODE MULTIPLEXER">
		</a>
	</div>

	<div style="z-index:2" class="or">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=or&stallo=<?php echo isset($stallo)?(($stallo)?1:0):0;?>&id_scarta=<?php echo isset($ID_scarta)?$ID_scarta:0;?>','','width=300,height=280');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="LOGIC OR">
		</a>
	</div>

	<div style="z-index:2" class="registri">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=registri&DL1=<?php echo isset($ID_EX_Data1)?$ID_EX_Data1:0;?>&DL2=<?php echo isset($ID_EX_Data2)?$ID_EX_Data2:0;?>&RL1=<?php echo isset($RL1)?$RL1:0;?>&RL2=<?php echo isset($RL2)?$RL2:0;?>&RW=<?php echo isset($MEM_WB_RegW)?$MEM_WB_RegW:0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>&RegWrite=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,0,1):0;?>','','width=380,height=380');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="32 REGISTERS (32-BIT)">
		</a>
	</div>

	<div style="z-index:2" class="uguale">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=uguale&DL1=<?php echo isset($ID_EX_Data1)?$ID_EX_Data1:0;?>&DL2=<?php echo isset($ID_EX_Data2)?$ID_EX_Data2:0;?>&ris=<?php echo isset($branchCheck)?(($branchCheck)?"true":"false"):"false";?>&isBranch=<?php echo isset($isBranch)?(int)$isBranch:0;?>&isJal=<?php echo isset($isJal)?(int)$isJal:0;?>&isJalr=<?php echo isset($isJalr)?(int)$isJalr:0;?>','','width=300,height=260');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EQUAL">
		</a>
	</div>

	<div style="z-index:2" class="immgen">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=immgen&dato=<?php echo $istruzione;?>&esteso=<?php echo isset($ID_EX_imm)?(($ID_EX_imm==0)?str_repeat('0',64):$ID_EX_imm):str_repeat('0',64);?>','','width=400,height=230');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="IMMEDIATE GENERATOR 32 TO 64 BITS">
		</a>
	</div>

	<div style="z-index:2" class="cause">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=cause','','width=300,height=120');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="CAUSE">
		</a>
	</div>

	<div style="z-index:2" class="epc">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=epc','','width=300,height=120');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EPC">
		</a>
	</div>

	<div style="z-index:2" class="ex_mux3">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux3&DL1=<?php echo isset($ID_EX_Data1)?$ID_EX_Data1:0;?>&mem_wb=<?php echo isset($WBdata)?$WBdata:0;?>&ex_mem=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo isset($Mux3Ctrl)?$Mux3Ctrl:0;?>&ris=<?php echo isset($ALUdato1)?$ALUdato1:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 3">
		</a>
	</div>

	<div style="z-index:2" class="ex_mux4">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux4&DL1=<?php echo isset($ID_EX_Data2)?$ID_EX_Data2:0;?>&mem_wb=<?php echo isset($WBdata)?$WBdata:0;?>&ex_mem=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo isset($Mux4Ctrl)?$Mux4Ctrl:0;?>&ris=<?php echo isset($EX_MEM_DataW)?$EX_MEM_DataW:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 4">
		</a>
	</div>

	<div style="z-index:2" class="ex_mux1">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux1&dato=<?php echo isset($ID_EX_WB)?$ID_EX_WB:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 1">
		</a>
	</div>

	<div style="z-index:2" class="ex_mux5">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux5&op1=<?php echo isset($EX_MEM_DataW)?$EX_MEM_DataW:0;?>&op2=<?php echo isset($ID_EX_imm2)?$ID_EX_imm2:0;?>&ris=<?php echo isset($ALUdato2)?$ALUdato2:0;?>&ctrl=<?php echo isset($Mux5Ctrl)?$Mux5Ctrl:0;?>','','width=380,height=240');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 5">
		</a>
	</div>

	<div style="z-index:2" class="ex_mux2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux2&dato=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 2">
		</a>
	</div>

	<div style="z-index:2" class="alu">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=alu&valore1=<?php echo isset($ALUdato1)?$ALUdato1:0;?>&valore2=<?php echo isset($ALUdato2)?$ALUdato2:0;?>&ris=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo (isset($aluCtrl)&&($aluCtrl!=''))?$aluCtrl:"0010";?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ARITHMETIC LOGIC UNIT">
		</a>
	</div>

	<div style="z-index:2" class="controlloalu">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=controlloalu&funct=<?php echo isset($ID_EX_funct7)?(isset($ID_EX_funct3)?GMPToBin($ID_EX_funct7,7,1)[1].GMPToBin($ID_EX_funct3,3,1):0):0;?>&aluOp=<?php echo isset($ALUOp)?$ALUOp:str_repeat('0',2);?>&ctrl=<?php echo (isset($aluCtrl)&&($aluCtrl!=''))?$aluCtrl:"0010";?>','','width=350,height=220');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ALU CONTROL UNIT">
		</a>
	</div>

	<div style="z-index:2" class="propagazione">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=propagazione&rs1=<?php echo isset($ID_EX_RS1)?$ID_EX_RS1:0;?>&rs2=<?php echo isset($ID_EX_RS2)?$ID_EX_RS2:0;?>&mux1=<?php echo isset($Mux4Ctrl)?$Mux4Ctrl:0;?>&mux2=<?php echo isset($Mux3Ctrl)?$Mux3Ctrl:0;?>&regW1=<?php echo isset($EX_MEM_RegW)?$EX_MEM_RegW:0;?>&regW2=<?php echo isset($MEM_WB_RegW)?$MEM_WB_RegW:0;?>&mem1=<?php echo isset($EX_MEM_WB)?substr($EX_MEM_WB,0,1):0;?>&mem2=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,0,1):0;?>','','width=450,height=350');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="FORWARDING UNIT">
		</a>
	</div>

	<div style="z-index:2" class="memdati">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memdati&memW=<?php echo isset($EX_MEM_WB)?substr($EX_MEM_WB,strlen($EX_MEM_WB)-(1)):0;?>&memR=<?php echo isset($EX_MEM_WB)?substr($EX_MEM_WB,0,1):0;?>&ind=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&DS=<?php echo isset($EX_MEM_DataW)?$EX_MEM_DataW:0;?>&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>','','width=350,height=380');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="DATA MEMORY">
		</a>
	</div>

	<div style="z-index:2" class="wb_mux">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=wb_mux&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1)):0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="WRITE BACK MULTIPLEXER">
		</a>
	</div>

	<div style="z-index:2" class="id_som">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=id_som&ifidPC=<?php echo isset($IF_ID_PC)?$IF_ID_PC*4:0;?>&immsl=<?php echo isset($tempImm)?$tempImm*2:0;?>&output=<?php echo isset($newPC1)?$newPC1*4:0;?>','','width=300,height=200');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ADDER 2">
		</a>
	</div>

	<div style="z-index:2" class="sl1">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=sl1&input=<?php echo isset($tempImm)?GMPToBin($tempImm,64,0):str_repeat('0',64);?>&output=<?php echo isset($tempImm)?GMPToBin($tempImm*2,64,0):str_repeat('0',64);?>','','width=400,height=230');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="SHIFT LEFT 1">
		</a>
	</div>


	<!--#### REGISTRI DELLA PIPELINE-->

	<div style="position:absolute; left:152px; top:220px; width:40px; height:285px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ifid&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1)):0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="IF/ID LATCHES">
		</a>
	</div>

	<div style="position:absolute; left:453px; top:205px; width:40px; height:300px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idex&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1)):0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX LATCHES">
		</a>
	</div>

	<div style="position:absolute; left:738px; top:205px; width:40px; height:300px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmem&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1)):0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM LATCHES">
		</a>
	</div>

	<div style="position:absolute; left:908px; top:205px; width:40px; height:300px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memwb&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1)):0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350,height=250');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="MEM/WB LATCHES">
		</a>
	</div>

	<div style="position:absolute; left:452px; top:100px; width:40px; height:35px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexwb&dataIn=<?php echo isset($ID_EX_WB)?$ID_EX_WB:str_repeat('0',2);?>&dataOut=<?php echo isset($ID_EX_WB)?$ID_EX_WB:str_repeat('0',2);?>','','width=290,height=190');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.WB REGISTER">
		</a>
	</div>

	<div style="position:absolute; left:452px; top:135px; width:40px; height:35px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexmem&dataIn=<?php echo isset($ID_EX_M)?$ID_EX_M:str_repeat('0',4);?>&dataOut=<?php echo isset($ID_EX_M)?$ID_EX_M:str_repeat('0',4);?>','','width=290,height=190');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.MEM REGISTER">
		</a>
	</div>

	<div style="position:absolute; left:452px; top:170px; width:40px; height:35px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexex&dataIn=<?php echo isset($ID_EX_EX)?$ID_EX_EX:str_repeat('0',3);?>&dataOut=<?php echo isset($ID_EX_EX)?$ID_EX_EX:str_repeat('0',3);?>','','width=290,height=190');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.EX REGISTER">
		</a>
	</div>

	<div style="position:absolute; left:737px; top:135; width:40px; height:35px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmemwb&dataIn=<?php echo isset($EX_MEM_WB)?$EX_MEM_WB:str_repeat('0',2);?>&dataOut=<?php echo isset($EX_MEM_WB)?$EX_MEM_WB:str_repeat('0',2);?>','','width=290,height=190');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM.WB REGISTER">
		</a>
	</div>

	<div style="position:absolute; left:737px; top:170px; width:40px; height:35px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmemmem&dataIn=<?php echo isset($EX_MEM_M)?$EX_MEM_M:str_repeat('0',4);?>&dataOut=<?php echo isset($EX_MEM_M)?$EX_MEM_M:str_repeat('0',4);?>','','width=290,height=190');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM.MEM REGISTER">
		</a>
	</div>

	<div style="position:absolute; left:909px; top:170px; width:40px; height:35px; z-index:2">
		<a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memwbwb&dataIn=<?php echo isset($MEM_WB_WB)?$MEM_WB_WB:str_repeat('0',2);?>&dataOut=<?php echo isset($MEM_WB_WB)?$MEM_WB_WB:str_repeat('0',2);?>','','width=290,height=190');">
		<img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="MEM/WB.WB REGISTER">
		</a>
	</div>

</body>
</html>

