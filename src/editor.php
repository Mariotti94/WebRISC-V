<?php
session_start();
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
	<?php
	if(isset($_POST['btnBranchPred'])){
		require "init.php";
		$_SESSION['codice']='';
		if($_POST['selectBranchPred']=="flush")
			$_SESSION['branchFlush']=true;
		if($_POST['selectBranchPred']=="delay_slot")
			$_SESSION['branchFlush']=false;
	?>
    <script language="JavaScript" type="text/JavaScript">
        window.onload = function() {
            var rFrame=top.frames[1];
            rFrame.document.location.reload();

            if(!top.frames[0].document.getElementById('toggleHover').checked)	{
                top.frames[2].popup_unset();
            }
            else {
                top.frames[2].popup_set();
            }
        };
    </script>
	<?php
	}
	?>
	<meta name="robots" content="noindex" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table align="center" width="80%" cellpadding="0" cellspacing="0" ID="Table1">
    <tr>
		<td align="center" valign="top">
            <div align="justify" class="testo">
                <br>
                The purpose of this site is to allow students to test the functioning of a RISC-V processor which has a 5-stages pipeline. The programs that can be tested must have no more than 1000 instructions (4kB Instruction Memory) and no more than 5kB of Data Memory.
            </div>
            <div align="center" class="testo">
            </div> 
			<br>
            <table align="center" width="60%" cellpadding="0" cellspacing="0">
				<tr>
                    <td align="center" valign="middle" colspan="2">
                        EXECUTION OPTIONS
                    </td>
				</tr>
				<tr>
                    <td align="center" valign="middle" width="30%" class="testo">
                        Jump Control Hazard Resolution
                    </td>
                    <td align="center" valign="middle">
                        <br>
                        <form action="" method="post">
                            <select name="selectBranchPred" class="form" style="width:150px;" >
                                <option value="flush" <?php if($_SESSION['branchFlush']) {?> selected <?php } ?> >Flush Instruction</option>
                                <option value="delay_slot" <?php if(!$_SESSION['branchFlush']) {?> selected <?php } ?>>Execute Delay Slot</option>
                            </select>
                            <input type="submit" value="Select" name="btnBranchPred" class="form" style="width:60px;">
                        </form>
                    </td>
				</tr>
			</table>
			
			<table align="center" width="60%" cellpadding="0" cellspacing="0" ID="Table4">
				<tr>
                    <td align="center" valign="middle" colspan="2">
                        ASSEMBLY EDITOR
                    </td>
				</tr>
                <tr>
                    <td align="center" valign="middle" width="30%" class="testo">
                        Load-and-Play Examples
                    </td>
                    <td align="center" valign="middle">
                        <br>
                        <form action=<?php if($_SESSION['branchFlush']){echo "asmFlush.php";} else{ echo "asmDelay.php";} ?> name="prova" method="post" ID="Form2">
                            <select name="programma" class="form" style="width:150px;">
                                <option value="handwritten" selected>Empty Text Box</option>
                                <option value="calculator">Simple Calculator</option>
                                <option value="memory">Memory References</option>
                                <option value="factorial">Factorial</option>
                                <option value="hazard">Data Hazard Example</option>
                                <option value="stall">Stall Example</option>
                            </select>
                            <input type="submit" value="1] Insert" id="Submit1" name="Submit1" class="form" style="width:60px;">
                        </form>
                    </td>
				</tr>
            </table>
			
			<table>
			<tr>
			<td align="center" valign="top">
			<div style="margin-top: 20px;">
				<table class="testo" style="border-collapse: collapse;">
					<tr class="row top bottom">
						<td class="minIstrWd" align="center" colspan="3"><b>List of Instructions</b></td>
					</tr>
					<tr class="row top bottom">
						<td class="minIstrWd bRight" align="center" colspan="2"><b>RV64I</b></td>
						<td class="minIstrWd bLeft" align="center"><b>RV64M</b></td>
					</tr>
					<tr class="row top">
						<td class="minIstrWd">add s0, s1, s2</td>
						<td class="minIstrWd bRight">sb s0, 0(t0)</td>
						<td class="minIstrWd">div s0, s1, s2</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">addi t0, t1, 1</td>
						<td class="minIstrWd bRight">sh s0, 0(t0)</td>
						<td class="minIstrWd">rem s0, s1, s2</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">sub s0, s1, s2</td>
						<td class="minIstrWd bRight">sw s0, 0(t0)</td>
						<td class="minIstrWd">mul s0, s1, s2</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">and s0, s1, s2</td>
						<td class="minIstrWd bRight">sd s0, 0(t0)</td>
						<td class="minIstrWd bBot" valign="top" rowspan="26">mulh s0, s1, s2</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">andi s0, s1, 1</td>
						<td class="minIstrWd bRight">beq s0, s1, label</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">or s0, s1, s2</td>
						<td class="minIstrWd bRight">bne s0, s1, label</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">ori s0, s1, 1</td>
						<td class="minIstrWd bRight">slt s0, s1, s2</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">xor s0, s1, s2</td>
						<td class="minIstrWd bRight">slti s0, s1, 1</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">xori s0, s1, 1</td>
						<td class="minIstrWd">sltu s0, s1, s2</td>
					</tr>
					<tr class="row">
						<td class="minIstrWd">sll s0, s1, s2</td>
						<td class="minIstrWd">sltiu s0, s1, 1</td>
					</tr>
					<tr>
						<td class="minIstrWd bLeft">srl s0, s1, s2</td>
						<td class="minIstrWd">j label</td>
					</tr>
					<tr>
						<td class="minIstrWd bLeft">sra s0, s1, s2</td>
						<td class="minIstrWd">jr ra</td>
					</tr>
					<tr>
						<td class="minIstrWd bLeft">slli s0, s1, 1</td>
						<td class="minIstrWd">jal label</td>
					</tr>
					<tr>
						<td class="minIstrWd bLeft">srli s0, s1, 1</td>
						<td class="minIstrWd bBot" valign="top" rowspan="12">jalr t0, 0(ra)</td>
					</tr>
					<tr><td class="minIstrWd bLeft">srai s0, s1, 1</td></tr>
					<tr><td class="minIstrWd bLeft">lb s0, 0(t0)</td></tr>
					<tr><td class="minIstrWd bLeft">lh s0, 0(t0)</td></tr>
					<tr><td class="minIstrWd bLeft">lw s0, 0(t0)</td></tr>
					<tr><td class="minIstrWd bLeft">ld s0, 0(t0)</td></tr>
					<tr><td class="minIstrWd bLeft bBot">lbu s0, 0(t0)</td></tr>
				</table>
			</div>
			</td>
			
			<td valign="top">
            <div align="center">
                <form action="assembler.php" name="alem" method="post" ID="Form1" target="MemIstr">
					<input type="hidden" id="asmName" name="asmName" value="">
					<table cellpadding="0" cellspacing="2" border="0" style="margin-top:-5px; margin-bottom:5px;">
						<tr>
							<td><input type="submit" value="2] Load the following program" ID="Submit1" NAME="Submit1" class="form"></td>
							<td align="center" class="form"><a href="executeStep.php?agg=new" target="Body" class="link4">&nbsp;3] Analyze pipeline&nbsp;</a></td>
                        </tr>
                    </table>
                    <div id="Layer1" class="bBot bLeft bTop" style="height: 340px; z-index: 1; overflow-x: auto; overflow-y: auto;">
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" ID="Table2">
                            <tr>
                                <td width="10" >
                                    <table align="center" width="100%" cellpadding="0" cellspacing="0" ID="Table3">
                                        <?php
                                        $i=0;
                                        while($i<1000)
                                        {
                                            ?>
                                            <tr>
												<td align="right" valign="middle" bgcolor="#cccccc" class="numRiga" <?php if($i==0) echo "style='padding-top: 3px;'" ?>><?php   echo $i+1;?></td>
											</tr>
                                            <?php   $i=$i+1;
                                        } ?>
                                    </table>
                                </td>
                                <td align="left" valign="top">
                                    <textarea  style="width:400px; border:0px;" name="codice" cols="70" rows="1000" class="form" ID="Textarea1" onkeypress="javascript:if(document.getElementById('asmName').value=='') document.getElementById('asmName').value='handwritten.s';"><?php echo isset($_SESSION['codice'])?$_SESSION['codice']:'';?></textarea>
                                </td></tr>
                        </table>
                    </div>
				</form>
            </div>
			</td>
			</tr>
			</table>
			
        </td>
	</tr>
</table>
</body>
</html>

