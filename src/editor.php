<?php
session_start();
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
	<script language='JavaScript' type='text/JavaScript'>
		window.onload = function() {
			//PANEL NAME
			if(top.frames[0].document.getElementById('mainLabel'))
				top.frames[0].document.getElementById('mainLabel').innerHTML="<font size=2>EDITOR</font>";
		};
        function textAreaName() {
			if (top.frames[2].document.getElementById('asmName').value=='') 
				top.frames[2].document.getElementById('asmName').value='handwritten.s';
        };
        function textAreaKeypress() {
			var totLines = top.frames[2].document.getElementById("asmTxt").value.split("\n").length;
			if (totLines>1000) {
				event.preventDefault();
			}
        };
        function textAreaPaste() {
			var totLines = top.frames[2].document.getElementById("asmTxt").value.split("\n").length;
			var clipLines = (event.clipboardData || window.clipboardData).getData('text').split("\n").length;
			if((totLines+clipLines-1)>1000) {
				event.preventDefault();
			}
        };
    </script>
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
			
			<form action="asmFile.php" name="prova" method="post" style="margin: 0px;">
			<table cellpadding="0" cellspacing="0" align="center" style="margin-top: 10px;">
				<tr style="height: 30px;">
					<td class="edMenuTd1" align="left">
						<table>
							<tr>
								<td align="center" class="testo" style="white-space: nowrap;">
									Examples List:
								</td>
								<td align="center">
										<select name="programma" class="form" style="width: 150px;" onchange="javascript:document.getElementById('btn_insert').click();">
											<option value="" selected>-----</option>
											<option value="calculator">Simple Calculator</option>
											<option value="memory">Memory References</option>
											<option value="factorial">Factorial</option>
											<option value="hazard">Data Hazard Example</option>
											<option value="stall">Stall Example</option>
											<option value="syscall">Syscall Example</option>
										</select>
								</td>
							</tr>
						</table>
					</td>
					<td class="edMenuTd2">
						<!-- has to be empty -->
					</td>
					<td class="edMenuTd3">
						<table>
							<tr>
								<td align="center" class="testo" id="btn_insertTd">
									<input type="submit" value="Insert in Textbox" class="form" name="btn_submit" style="width: 120px; padding: 1px; margin-right: 5px;" id="btn_insert">
								</td>
								<script language='JavaScript' type='text/JavaScript'>document.getElementById('btn_insertTd').style.display='none';</script>
								<td align="center" class="testo">
									<input type="submit" value="Clear Textbox" class="form" name="btn_submit" style="width: 120px; padding: 1px;">
								</td>
							</tr>
						</table>
					</td>
					<td class="edMenuTd4">
						<!-- has to be empty -->
					</td>
				</tr>
			</table>
			</form>
			
			<form action="assembler.php" method="post" target="MemReg" style="margin: 0px;">
			<table cellpadding="0" cellspacing="0" align="center" style="margin-top: -30px;" >
				<tr style="height: 30px;">
					<td class="edMenuTd1">
						<!-- has to be empty -->
					</td>
					<td class="edMenuTd2">
						<table>
							<tr>
								<td align="center">
									<input type="submit" value="Load in Memory" class="form" style="width: 120px; padding: 1px;">
								</td>
							</tr>
						</table>
					</td>
					<td class="edMenuTd3">
						<!-- has to be empty -->
					</td>
					<td class="edMenuTd4">
						<input type="hidden" id="asmName" name="asmName" value="">
						<table>
							<tr>
								<td align="center">
									<a href="executeStep.php?agg=return" target="Layout" class="link4 form" style="display: block; width: 116px; padding: 1px;" id="anlzPipe">Return to pipeline</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" align="center" style="margin-top: 10px; margin-bottom: 10px;">
				<tr>
					<td align="left" style="padding-left: 20px; padding-right: 20px;">
						<table class="testo" style="border-collapse: collapse;">
							<tr class="row top bottom">
								<td class="edInstrTd" align="center" colspan="3"><b>List of Instructions</b></td>
							</tr>
							<tr class="row top bottom">
								<td class="edInstrTd bRight" align="center" colspan="2"><b>RV64I</b></td>
								<td class="edInstrTd bLeft" align="center"><b>RV64M</b></td>
							</tr>
							<tr class="row top">
								<td class="edInstrTd">add s0, s1, s2</td>
								<td class="edInstrTd bRight">sb s0, 0(t0)</td>
								<td class="edInstrTd">div s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">addi t0, t1, 1</td>
								<td class="edInstrTd bRight">sh s0, 0(t0)</td>
								<td class="edInstrTd">rem s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">sub s0, s1, s2</td>
								<td class="edInstrTd bRight">sw s0, 0(t0)</td>
								<td class="edInstrTd">mul s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">and s0, s1, s2</td>
								<td class="edInstrTd bRight">sd s0, 0(t0)</td>
								<td class="edInstrTd bBot" valign="top" rowspan="17">mulh s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">andi s0, s1, 1</td>
								<td class="edInstrTd bRight">beq s0, s1, label</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">or s0, s1, s2</td>
								<td class="edInstrTd bRight">bne s0, s1, label</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">ori s0, s1, 1</td>
								<td class="edInstrTd bRight">slt s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">xor s0, s1, s2</td>
								<td class="edInstrTd bRight">slti s0, s1, 1</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">xori s0, s1, 1</td>
								<td class="edInstrTd bRight">sltu s0, s1, s2</td>
							</tr>
							<tr class="row">
								<td class="edInstrTd">sll s0, s1, s2</td>
								<td class="edInstrTd bRight">sltiu s0, s1, 1</td>
							</tr>
							<tr>
								<td class="edInstrTd bLeft">srl s0, s1, s2</td>
								<td class="edInstrTd  bRight">j label</td>
							</tr>
							<tr>
								<td class="edInstrTd bLeft">sra s0, s1, s2</td>
								<td class="edInstrTd bRight">jr ra</td>
							</tr>
							<tr>
								<td class="edInstrTd bLeft">slli s0, s1, 1</td>
								<td class="edInstrTd bRight">jal label</td>
							</tr>
							<tr>
								<td class="edInstrTd bLeft">srli s0, s1, 1</td>
								<td class="edInstrTd bRight">jalr t0, 0(ra)</td>
							</tr>
							<tr>
								<td class="edInstrTd bLeft">srai s0, s1, 1</td>
								<td class="edInstrTd bRight">ecall</td>
							</tr>
							<tr>
							<td class="edInstrTd bLeft">lb s0, 0(t0)</td>
							<td class="edInstrTd bRight bBot" valign="top" rowspan="5">ebreak</td>
							</tr>
							<tr><td class="edInstrTd bLeft">lh s0, 0(t0)</td></tr>
							<tr><td class="edInstrTd bLeft">lw s0, 0(t0)</td></tr>
							<tr><td class="edInstrTd bLeft">ld s0, 0(t0)</td></tr>
							<tr><td class="edInstrTd bLeft bBot">lbu s0, 0(t0)</td></tr>
						</table>
					</td>
					<td style="min-width: 580px; padding-right: 20px;">
						<div class="bBot bLeft bTop" style="height: 420px; overflow-x: auto; overflow-y: auto;">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td style="float: left; min-width: 30px;" bgcolor="#cccccc">
										<table width="100%" cellpadding="0" cellspacing="0" >
											<?php
											$i=0;
											while($i<1000)
											{
												?>
												<tr>
													<td align="right" valign="middle" class="numRiga"<?php if(!$i) echo ' style="padding-top: 1px;"';?>><?php echo $i+1;?></td>
												</tr>
												<?php $i=$i+1;
											} ?>
										</table>
									<td>
									<td style="min-width: 530px;">
										<textarea id="asmTxt" name="codice" class="form" style="border: 0px; margin: 0px; width: 100%;" rows="1000" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" onkeypress="javascript:textAreaName();textAreaKeypress();" onpaste="javascript:textAreaName();textAreaPaste();"><?php echo isset($_SESSION['codice'])?$_SESSION['codice']:'';?></textarea>
									</td>
								</tr>
							</table>
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

