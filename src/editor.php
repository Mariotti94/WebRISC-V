<?php
session_start();
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
	<meta name="robots" content="noindex" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="70%" cellpadding="0" cellspacing="0" style="margin: auto;">
    <tr>
		<td>
		
			<div align="center" class="testo" style="margin-top: 10px">
                The purpose of this site is to allow students to test the functioning of a RISC-V processor which has a 5-stages pipeline.
				<br>
				The programs that can be tested must have no more than 1000 instructions (4kB Instruction Memory) and no more than 5kB of Data Memory.
            </div>
			
			<div align="center" style="margin-top: 20px;">
                ASSEMBLY EDITOR
            </div>
			
			<form action="asmFile.php" name="prova" method="post" style="margin:0px;">
			<table width="100%" cellpadding="0" cellspacing="0"  style="margin-top: 10px;">
				<tr style="height:30px; vertical-align:middle;">
					<td width="50%" align="left">
						<table style="margin-left:100px;">
							<tr>
								<td align="center" class="testo" style="white-space: nowrap;">
									Examples List:
								</td>
								<td align="center">
										<select name="programma" class="form" style="width:150px;" onchange="javascript:document.getElementById('btn_insert').click();">
											<option value="" selected>-----</option>
											<option value="calculator">Simple Calculator</option>
											<option value="memory">Memory References</option>
											<option value="factorial">Factorial</option>
											<option value="hazard">Data Hazard Example</option>
											<option value="stall">Stall Example</option>
											<option value="syscall">Syscall Example</option>
										</select>
								</td>
								<td align="center" class="testo" id="btn_insertTd">
									<input type="submit" value="Insert in Textbox" class="form" name="btn_submit" style="width:120px; padding: 1px;" id="btn_insert">
								</td>
								<script language='JavaScript' type='text/JavaScript'>document.getElementById('btn_insertTd').style.display='none';</script>
								<td align="center" class="testo">
									<input type="submit" value="Clear Textbox" class="form" name="btn_submit" style="width:120px; padding: 1px;">
								</td>
							</tr>
						</table>
					</td>
					<td width="50%">
						<!-- has to be empty -->
					</td>
				</tr>
			</table>
			</form>
			
			<form action="assembler.php" method="post" target="MemReg" style="margin:0px;">
			<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:-30px;" >
				<tr style="height:30px;">
					<td width="50%">
						<!-- has to be empty -->
					</td>
					<td width="50%">
						<input type="hidden" id="asmName" name="asmName" value="">
						<table style="margin-left:100px;">
							<tr>
								<td align="center">
									<input type="submit" value="Load in Memory" class="form" style="width:120px; padding: 1px;">
								</td>
								<td align="center">
									<a href="executeStep.php?agg=return" target="Layout" class="link4 form" style="display:block; width:116px; padding: 1px;" id="anlzPipe">Return to pipeline</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:10px;">
				<tr>
					<td width="30%" align="center">
						<table class="testo" style="border-collapse: collapse; margin: 5px;">
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
								<td class="minIstrWd bBot" valign="top" rowspan="17">mulh s0, s1, s2</td>
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
								<td class="minIstrWd bRight">sltu s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="minIstrWd">sll s0, s1, s2</td>
								<td class="minIstrWd bRight">sltiu s0, s1, 1</td>
							</tr>
							<tr>
								<td class="minIstrWd bLeft">srl s0, s1, s2</td>
								<td class="minIstrWd  bRight">j label</td>
							</tr>
							<tr>
								<td class="minIstrWd bLeft">sra s0, s1, s2</td>
								<td class="minIstrWd bRight">jr ra</td>
							</tr>
							<tr>
								<td class="minIstrWd bLeft">slli s0, s1, 1</td>
								<td class="minIstrWd bRight">jal label</td>
							</tr>
							<tr>
								<td class="minIstrWd bLeft">srli s0, s1, 1</td>
								<td class="minIstrWd bRight">jalr t0, 0(ra)</td>
							</tr>
							<tr>
								<td class="minIstrWd bLeft">srai s0, s1, 1</td>
								<td class="minIstrWd bRight">ecall</td>
							</tr>
							<tr>
							<td class="minIstrWd bLeft">lb s0, 0(t0)</td>
							<td class="minIstrWd bRight bBot" valign="top" rowspan="5">ebreak</td>
							</tr>
							<tr><td class="minIstrWd bLeft">lh s0, 0(t0)</td></tr>
							<tr><td class="minIstrWd bLeft">lw s0, 0(t0)</td></tr>
							<tr><td class="minIstrWd bLeft">ld s0, 0(t0)</td></tr>
							<tr><td class="minIstrWd bLeft bBot">lbu s0, 0(t0)</td></tr>
						</table>
					</td>
					<td width="70%">
						<div class="bBot bLeft bTop" style="height: 420px; width: 570px; overflow-x: auto; overflow-y: auto;">
							
									<div style="float:left;">
										<table width="100%" cellpadding="0" cellspacing="0" >
											<?php
											$i=0;
											while($i<1000)
											{
												?>
												<tr>
													<td align="right" valign="middle" bgcolor="#cccccc" class="numRiga"><?php echo $i+1;?></td>
												</tr>
												<?php $i=$i+1;
											} ?>
										</table>
									</div>
									
									<div  style="float:left;">
										<textarea id="asmTxt" class="form" style="border:0px; margin:0px;" name="codice" cols="70" rows="1000" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  onkeypress="javascript:if (document.getElementById('asmName').value=='') document.getElementById('asmName').value='handwritten.s';"><?php echo isset($_SESSION['codice'])?$_SESSION['codice']:'';?></textarea>
									</div>
								
						</div>
					</td>
				</tr>
			</table>
			</form>
			
		</td>
	</tr>
</table>
</body>
</html>

