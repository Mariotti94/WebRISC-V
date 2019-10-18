<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
	<meta name="robots" content="noindex" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="100%" height="100%" bgcolor="#ffffcc">
    <tr>
        <td align="center" valign="top">
            <?php
            if(isset($_GET['el']))
            {
                $elemento=$_GET["el"];
                $elemento=strtolower($elemento);
                switch ($elemento)
                {
                    case "epc": //EPC:
                        ?>
                        <div align="center" class="testoGrande"><b>EPC</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds the EPC value.
                        </div>
                        <form action="javascript:window.close()" method="post">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form">
                        </form>
                        <?php
                        break;
						
					case "cause": //CAUSE:
                        ?>
                        <div align="center" class="testoGrande"><b>CAUSE</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds the exception CAUSE.
                        </div>
                        <form action="javascript:window.close()" method="post">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form">
                        </form>
                        <?php
                        break;
						
					case "if_som": //SOMMATORE IF, CALCOLO NUOVO PC:
                        $PC=$_GET["newPC"];
                        $PCpiu4=$_GET["PCpiu4"];
                        ?>
                        <div align="center" class="testoGrande"><b>ADDER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">This unit updates the PC</div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0" align="center">
                            <tr><td align="right" class="testo">PC = <?php     echo $PC*4;?><br><br>Constant = 4
                                </td>
                                <td align="center">
                                    <table width="50" height="50" cellpadding="0" cellspacing="0" class="elemento">
                                        <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo">Result = <?php     echo $PCpiu4*4;?></td>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form">
                        </form>
                        <?php
                        break;
						
					case "pc": //REGISTRO PC:
                        $newPC=$_GET["newPC"];
                        $PC=$_GET["PC"];
                        $stallo=$_GET["ctrl"];
                        ?>
                        <div align="center" class="testoGrande"><b>PROGRAM COUNTER (PC) REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">This register is updated only if the control signal is zero (if the hazard detection unit does not signal a stall)</div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">New PC = <?php     echo $newPC*4;?>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">Stall = <?php     echo $stallo;?></font>
									<br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center"><font size="1">PC</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">PC = <?php     echo $PC*4;?></td>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "istruzioni": //MEMORIA DELLE ISTRUZIONI:
                        $PC=$_GET["PC"];
                        $istruzione=$_GET["istr"];
                        ?>
                        <div align="center" class="testoGrande"><b>INSTRUCTION MEMORY</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This is where the instructions are fetched from.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">Address (PC) = <?php     echo $PC*4;?>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <table width="60" height="150" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="top" align="center">
                                                <font size="1">INSTRUCTION<br>MEMORY
                                                    <br><br><br><br>
                                                    <div align="left">ADDRESS</div>
                                                    <br><br>
                                                    <div align="right">READ INSTRUCTION</div>
                                                </font>
                                            </td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%"><br><br><br><br><br><br>Instruction = <?php     echo '<br>'.substr($istruzione,0,16).'<br>'.substr($istruzione,16,16);?></td>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form2">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>


                        <?php
                        break;
						
					case "if_mux": //IF MUX:
                        $nextPC=$_GET["newPC"];
                        $PCpiu4=$_GET["PCpiu4"];
                        $salto=$_GET["salto"];
                        $ctrl1=$_GET["ctrl1"];
                        $ctrl2=$_GET["ctrl2"];
                        ?>
                        <div align="center" class="testoGrande"><b>MUX - New PC</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This multiplexer selects the new program counter value based on the two control signals. The first control signal decides whether a jump should happen or not. The second control signal tells if there was an exception.
                            00 -> next instruction.
                            01 -> exception handling address (fixed).
                            10 -> jump target address.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <br><br><br>
                                    Branch Target Address = <?php     echo $salto*4;?><br>
                                    Fixed Address = 1C090000<br>
                                    PC + 4 = <?php     echo $PCpiu4*4;?><br>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <table cellpadding="5" cellspacing="5" border="0" >
                                        <tr><td align="center" valign="middle" class="testo">
                                                <font color="red" size="1">PCsrc<br><?php     echo $ctrl1;?></font>
                                            </td>
                                            <td align="center" valign="middle" class="testo">
                                                <font color="red" size="1">Exception<br><?php     echo $ctrl2;?></font>
                                            </td></tr>
                                    </table>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">10<br>01<br>00</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <br><br><br>
                                    New PC = <?php echo ($ctrl1=='1')?$salto*4:$nextPC*4;?></td>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form3">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>
                        <?php
                        break;
						
					case "and": //AND LOGICO:
                        $ctrl1=$_GET["ctrl1"];
                        $ctrl2=$_GET["ctrl2"];
                        $ris=$_GET["ris"];
                        ?>
                        <div align="center" class="testoGrande"><b>AND LOGICO</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This gate generates the MUX control signal "PCsrc". This signal is high when
                            the control units detects a jump instruction and the jump comparator
                            check is satisfied.
                        </div>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr>
                                <td align="center" class="testo" width="33%">
                                    <table cellpadding="5" cellspacing="5" border="0" >
                                        <tr>
                                            <td align="center" valign="middle" class="testo">
                                                <font color="red" size="1">IsJump<br><?php     echo $ctrl1;?></font>
                                            </td>
											<td align="center" valign="middle" class="testo">
                                                <font color="red" size="1">JumpCtrl<br><?php     echo $ctrl2;?></font>
                                            </td>
										</tr>
                                    </table>
                                    <table width="40" height="40" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center"><font size="1">AND</font></td></tr>
                                    </table>
                                    <font color="red">PCsrc = <?php     echo $ris;?></font>
                                </td></tr>
                        </table>
                        <hr size="1" width="60%" noshade>
                        <form action="javascript:window.close()" method="post" ID="Form4">
                            <input type="submit" value="Close This Window" class="form" >
                        </form>
                        <?php
                        break;
						
					case "criticita": //UNITA' DI RILEVAMENTO DELLE CRITICITA':
                        $RL1=$_GET["rl1"];
                        $RL2=$_GET["rl2"];
                        $stallo=$_GET["stallo"];
                        $mem=$_GET["mem"];
                        $mem=substr($mem,0,1);
                        $rd=$_GET["rd"];
                        ?>
                        <div align="center" class="testoGrande"><b>HAZARD DETECTION UNIT</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This unit detects hazard conditions and produces control signals accordingly.
                            In the case of 'lw' instruction (ID/EX.RegisterRD = IF/ID.RegisterRs1 <font color=blue>or</font> ID/EX.RegisterRD = IF/ID.RegisterRs2 <font color=blue>and</font>
                            ID/EX.MemRead = 1) a 'nop' must be inserted in the pipeline.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo">
                                    <font color=red>Stall = <?php     echo $stallo;?></font><br>
                                    <font color=red>Stall = <?php     echo $stallo;?></font><br>
                                    Read Register 1 = <?php     echo $RL1;?><br>
                                    Read Register 2 = <?php     echo $RL2;?><br>
                                    ID/EX.RegisterRD = <?php     echo $rd;?>
                                </td>
                                <td align="center">
                                    <table width="80" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center">
                                                <font size="1">HAZARD DETECTION UNIT<br></font>
                                            </td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo">
                                    <font color=red>Stall = <?php     echo $stallo;?></font><br>
                                    <br>
                                    <font color=red>ID/EX.MemRead = <?php     echo $mem;?></font><br>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form">
                        </form>
                        <?php
                        break;
						
					case "controllo": //UNITA' DI CONTROLLO:
                        $istr=$_GET["istr"];
                        $salta=$_GET["salta"];
                        $ecc=$_GET["ecc"];
                        $wb=$_GET["wb"];
                        $mem=$_GET["mem"];
                        $ex=$_GET["ex"];
                        $if_scarta=$_GET["if_scarta"];
                        $id_scarta=$_GET["id_scarta"];
                        $ex_scarta=$_GET["ex_scarta"];
                        ?>
                        <div align="center" class="testoGrande"><b>CONTROL UNIT</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This unit is a combinational network, which generates the control signals for all stages based on the values of OP and FUNCT fields.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
								
                                    <font color=red>Exception = <?php     echo $ecc;?></font><br>
                                    <font color=red>Jump = <?php     echo $salta;?></font><br>
                                    <br>
								<div style="float:right" align="left">	
                                    Instruction = <?php     echo '<br>'.substr($istr,0,16).'<br>'.substr($istr,16,16);?>
								</div>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <table width="50" height="100" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center">
                                                <font size="1">CONTROL<BR>UNIT<br></font>
                                            </td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <font color=red>IF.Flush = <?php     echo $if_scarta;?></font><br>
                                    <font color=red>ID.Flush = <?php     echo $id_scarta;?></font><br>
                                    <font color=red>EX.Flush = <?php     echo $ex_scarta;?><br>
                                        <br>
                                        Control.WB = <?php     echo $wb;?><br>
                                        Control.M = <?php     echo $mem;?><br>
                                        Control.EX = <?php     echo $ex;?></font>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "or": //OR LOGICO:
                        $stallo=$_GET["stallo"];
                        $id_scarta=$_GET["id_scarta"];
                        ?>
                        <div align="center" class="testoGrande"><b>LOGIC OR</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This gate generates a signal for driving a MUX, which flushes the pipeline stages in case of stall or exception.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr>
                                <td align="center" class="testo">
                                    <table cellpadding="5" cellspacing="5" border="0" >
                                        <tr><td align="center" valign="middle" class="testo">
                                                <font color="red" size="1">Stall<br><?php     echo $stallo;?></font>
                                            </td>
                                            <td align="center" valign="middle" class="testo">
                                                <font color="red" size="1">ID.flush<br><?php     echo $id_scarta;?></font>
                                            </td></tr>
                                    </table>
                                    <table width="40" height="40" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center"><font size="1">OR</font></td></tr>
                                    </table>
                                    <font color="red">Result = <?php     echo $stallo;?></font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form5">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "idmux": //ID MULTIPLEXER:
                        $wb=$_GET["wb"];
                        $mem=$_GET["mem"];
                        $ex=$_GET["ex"];
                        $wb2=$_GET["wb2"];
                        $mem2=$_GET["mem2"];
                        $ex2=$_GET["ex2"];
                        $ctrl=$_GET["ctrl"];
                        ?>
                        <div align="center" class="testoGrande"><b>INSTRUCTION DECODE MUX</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This multiplexer should forward the control signals in ID/EX registers or, in case of stall, force all signals to zero.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color="red"><br></rb>
                                        Control.WB = <?php     echo $wb;?><br>
                                        Control.M = <?php     echo $mem;?><br>
                                        Control.EX = <?php     echo $ex;?><br>
                                        <br>
                                        00 0000 000
                                    </font>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">Control = <?php     echo $ctrl;?></font><br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <font color="red"><br><br>
                                        ID/EX.WB = <?php     echo $wb;?><br>
                                        ID/EX.M = <?php     echo $mem;?><br>
                                        ID/EX.EX = <?php     echo $ex;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form2">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "uguale": //UGUALE =:
                        $DL1=$_GET["DL1"];
                        $DL2=$_GET["DL2"];
                        $ris=$_GET["ris"];
                        $isBranch=$_GET["isBranch"];
						$isJal=$_GET["isJal"];
						$isJalr=$_GET["isJalr"];
                        $str="NOT A JUMP";
                        if ($isBranch)
                        {
                            $str="Jump (Branch)";
                        }
                        if ($isJal)
                        {
                            $str="Jump (Jal)";
                        }
                        if ($isJalr)
                        {
                            $str="Jump (Jalr)";
                        }
                        ?>
                        <div align="center" class="testoGrande"><b>JUMP COMPARATOR</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This comparator verifies if the operand of a branch instruction
                            are equal and the branch condition is satisfied.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr>
                                <td align="right" class="testo" width="33%">
                                    <font color="red">
                                        <?php     echo $str;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    Read Data 1 = <?php     echo $DL1;?>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center"><font size="1">=</font></td></tr>
                                    </table>
                                    Read Data 2 = <?php     echo $DL2;?>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <?php
                                    if ($isBranch || $isJal || $isJalr)
                                    {
                                        ?>
                                        <font color="red">
                                            Result = <?php       echo $ris;?><br>
                                        </font>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form6">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "segno": //IMM. GENERATOR:
                        $esteso=$_GET["esteso"];
                        $dato=$_GET["dato"];
                        ?>
                        <div align="center" class="testoGrande"><b>IMMEDIATE GENERATOR</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            From the 32-bit instruction a 64-bit immediate should be generated,
							<br>
                            since the ALU processes 64-bit data.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center" style="table-layout: fixed;">
                            <tr>
                                <td align="right" class="testo" width="33%" style="word-break:break-word; white-space: normal;">
								<div style="float:right" align="left">
                                    Instruction =<br><?php     echo substr($dato,0,16).'<br>'.substr($dato,16,16);?>
								</div>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <table width="60" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center">
                                                <font size="1">IMM<br>GEN<br></font>
                                            </td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%" style="word-break:break-word; white-space: normal;">
                                    Generated Immediate =<br><?php     echo substr($esteso,0,16).'<br>'.substr($esteso,16,16).'<br>'.substr($esteso,32,16).'<br>'.substr($esteso,48,16);?>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form3">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "registri": //Registri:
                        $RL1=$_GET["RL1"];
                        $RL2=$_GET["RL2"];
                        $DL1=$_GET["DL1"];
                        $DL2=$_GET["DL2"];
                        $RW=$_GET["RW"];
                        $WBdata=$_GET["WBdata"];
                        $RegWrite=$_GET["RegWrite"];
                        ?>
                        <div align="center" class="testoGrande"><b>REGISTERS</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This are is the register file: 32 32-bit registers. In the first half of
                            a clock cycle, the values coming from the Write-back stage should be written.
                            In the second half of a clock cycle, the values specified by the values <b>rs</b>
                            and <b>rt</b> are read.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr>
                                <td align="right" class="testo" width="33%" valign="top">
                                    <br><br><br>
                                    Read Register 1 = <?php     echo $RL1;?><br><br>
                                    Read Register 2 = <?php     echo $RL2;?><br><br><br><br><br>
                                    Write Register = <?php     echo $RW;?><br><br><br>
                                    Write Data = <?php     echo $WBdata;?><br>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">RegWrite = <?php     echo $RegWrite;?></font>
                                    <table width="90" height="150" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="top" align="center">
                                                <font size="1">
                                                    <div align="right">READ DATA 1</div>
													<br>
                                                    <div align="left">READ REG 1</div>
                                                    <br>
													<div align="left">READ REG 2</div>
                                                    <br>
                                                    <div align="center"><b>REGISTERS</b></div>
                                                    <br><br>
                                                    <div align="left">WRITE REG</div>
                                                    <div align="right">READ DATA 2</div>
													<br>
                                                    <div align="left">WRITE DATA</div>
                                                </font>
                                            </td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="top" class="testo" width="33%">
                                    <br><br>
                                    Read Data 1 = <?php     echo $DL1;?>
                                    <br><br><br><br><br><br><br><br><br>
                                    Read Data 2 = <?php     echo $DL2;?>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form4">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmux1": //EX MULTIPLEXER 1:
                        $ex_scarta=$_GET["ex_scarta"];
                        $dato=$_GET["dato"];
                        ?>
                        <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 1</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This MUX is needed to set to zero all control signals for Write Back stage,
                            otherwise those signals will propagate normally.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color="red">
                                        <br><br>
                                        ID.EX.WB = <?php     echo $dato;?><br><br>
                                        00
                                    </font>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">EX.Flush = <?php     echo $ex_scarta;?></font><br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <font color="red"><br><br>
                                        EX.MEM.WB = <?php     echo $dato;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form2">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmux2": //EX MULTIPLEXER 2:
                        $ex_scarta=$_GET["ex_scarta"];
                        $dato=$_GET["dato"];
                        ?>
                        <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 2</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            In case of exception, this MUX is needed to set to zero all control signals for
                            MEM stage, otherwise those signals will propagate normally.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color="red">
                                        <br><br>
                                        ID.EX.M = <?php     echo $dato;?><br><br>
                                        0000
                                    </font>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">EX.Flush = <?php     echo $ex_scarta;?></font><br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <font color="red"><br><br>
                                        EX.MEM.M = <?php     echo $dato;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmux3": //EXECUTE MULTIPLEXER 3:
                        $DL1=$_GET["DL1"];
                        $mem_wb=$_GET["mem_wb"];
                        $ex_mem=$_GET["ex_mem"];
                        $ctrl=$_GET["ctrl"];
                        $ris=$_GET["ris"];
                        ?>
                        <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 3</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This MUX allows to choose whether the ALU first operand should come from the
                            previous (ID) stage or from the MEM or WB stage (depending on the decision of
                            the forwarding unit).
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%" valign="top">
                                    <br>
                                    ID/EX.Read_Data 1 = <?php     echo $DL1;?><br>
                                    MEM/WB.Data = <?php     echo $mem_wb;?><br>
                                    EX/MEM.Data = <?php     echo $ex_mem;?><br>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">00<br>01<br>10</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
									<br>
                                    <font color="red" size="1">Control = <?php     echo $ctrl;?></font>
                                </td>
                                <td align="left" valign="top" class="testo" width="33%">
                                    <br><br>
                                    ALU Operand 1 = <?php     echo $ris;?></td>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form3">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmux4": //EXECUTE MULTIPLEXER 4:
                        $DL1=$_GET["DL1"];
                        $mem_wb=$_GET["mem_wb"];
                        $ex_mem=$_GET["ex_mem"];
                        $ctrl=$_GET["ctrl"];
                        $ris=$_GET["ris"];
                        ?>
                        <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 4</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This MUX allows to choose whether the ALU second operand should come from the
                            previous (ID) stage or from the MEM or WB stage (depending on the decision of
                            the forwarding unit).
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%" valign="top">
                                    <br>
                                    ID/EX.Read_Data 2 = <?php     echo $DL1;?><br>
                                    MEM/WB.Data = <?php     echo $mem_wb;?><br>
                                    EX/MEM.Data = <?php     echo $ex_mem;?><br>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">00<br>01<br>10</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
									<br>
                                    <font color="red" size="1">Control = <?php     echo $ctrl;?></font>
                                </td>
                                <td align="left" valign="top" class="testo" width="33%">
                                    <br><br>
                                    ALU Operand 2 = <?php     echo $ris;?></td>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form4">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmux5": //EX MULTIPLEXER 5:
                        $op1=$_GET["op1"];
                        $op2=$_GET["op2"];
                        $ris=$_GET["ris"];
                        $ctrl=$_GET["ctrl"];
                        ?>
                        <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 5</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This MUX allows to choose whether the ALU second operand should come
                            from previous MUX or from an immediate value in the instruction
                            (e.g. 'addi' or 'lw'/'sw').
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="38%">
                                    <br><br>
                                    ID.EX.Data_Register 2 = <?php     echo $op1;?><br><br>
                                    ID.EX.Immediate_Register = <?php     echo $op2;?>
                                </td>
                                <td align="center" class="testo" width="24%">
                                    <font color="red">AluSrc = <?php     echo $ctrl;?></font><br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="38%">
                                    <br><br>
                                    ALU Operand 2 = <?php     echo $ris;?>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form6">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>


                        <?php
                        break;
						
					case "exmux6": //EX MULTIPLEXER 6:
                        $RegDest=$_GET["RegDest"];
                        $rt=$_GET["rt"];
                        $rd=$_GET["rd"];
                        $rDest=$_GET["rDest"];
                        ?>
                        <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 6</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            The destionation register con be also specified by RT (e.g. 'lw' or 'sw'),
                            not always by RD field. In such case, this MUX will forward the right register
                            index to the WB stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="30%">
                                    <br><br>
                                    ID.EX.Register RD = <?php     echo $rd;?><br><br>
                                    ID.EX.Register RT = <?php     echo $rt;?>
                                </td>
                                <td align="center" class="testo" width="30%">
                                    <font color="red">RegDst = <?php     echo $RegDest;?></font><br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">1<br><br>0</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="40%">
                                    <br><br>
                                    EX.MEM.Register RD = <?php     echo $rDest;?>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form5">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "alu": //ALU:
                        $valore1=$_GET["valore1"];
                        $valore2=$_GET["valore2"];
                        $ris=$_GET["ris"];
                        $ctrl=$_GET["ctrl"];
                        ?>
                        <div align="center" class="testoGrande"><b>ARITHMETIC LOGIC UNIT</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            The ALU executes an operation on the two source operands based on its control signals: 000=AND, 001=OR, 010=ADD, 110=SUB, 111=SET_ON_LESS_THAN.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="30%">
                                    ALU operand 1 = <?php     echo $valore1;?><br><br>
                                    ALU operand 2 = <?php     echo $valore2;?>
                                    <br><br><br>
                                </td>
                                <td align="center" class="testo" width="30%">
                                    <table width="50" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center"><font size="1"><b>ALU</b></font></td></tr>
                                    </table>
                                    <br>
                                    <font color="red">Control = <?php     echo $ctrl;?></font>
                                </td>
                                <td align="left" valign="middle" class="testo" width="40%">
                                    Result = <?php     echo $ris;?>
                                    <br><br><br>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form8">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>


                        <?php
                        break;
						
					case "propagazione": //UNITA' DI PROPAGAZIONE:
                        $rs1=$_GET["rs1"];
						$rs2=$_GET["rs2"];
                        $mux1=$_GET["mux1"];
                        $mux2=$_GET["mux2"];
                        $regW1=$_GET["regW1"];
                        $regW2=$_GET["regW2"];
                        $mem1=$_GET["mem1"];
                        $mem2=$_GET["mem2"];
                        ?>
                        <div align="center" class="testoGrande"><b>FORWARDING UNIT</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            The forwarding unit solves some of the problems caused by data hazards.
                            There are two cases when this unit modifies the pipeline behavior:<br><br>
                            <div align="left"> 1] the instruction in MEM stage writes into some register (in such case EX_MEM_RegWrite = 1) and the result from EX stage is the value to be written back.
                            </div>
                            <div align="left"> 2]  the instruction in WB stage writes into some register
                                (in such case MEM_WB_RegWrite = 1) and the result from MEM stage is the value to be written back.
                            </div>
                            <br>
                            When one of the possible four cases happens, then the forwarding unit enables the corresponding MUX and data is forwarded.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo">
                                    <font color=red>Ctrl MUX 4 = <?php     echo $mux1;?></font><br>
                                    <font color=red>Ctrl MUX 3 = <?php     echo $mux2;?></font><br>
                                    ID/EX.Register RS1 = <?php     echo $rs1;?><br>
                                    ID/EX.Register RS2 = <?php     echo $rs2;?><br>
                                </td>
                                <td align="center">
                                    <table width="80" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center">
                                                <font size="1">FORWARDING UNIT<br></font>
                                            </td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo">
                                    EX/MEM.Register RD = <?php     echo $regW1;?><br>
                                    <font color=red>EX/MEM.RegWrite = <?php     echo $mem1;?></font><br>
                                    MEM/WB.Register RD = <?php     echo $regW2;?><br>
                                    <font color=red>MEM/WB.RegWrite = <?php     echo $mem2;?></font><br>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form7">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form">
                        </form>

                        <?php
                        break;
						
					case "controlloalu": //UNITA' DI CONTROLLO DELLA ALU:
                        $ctrl=$_GET["ctrl"];
                        $funct=$_GET["funct"];
                        $aluOp=$_GET["aluOp"];
                        ?>
                        <div align="center" class="testoGrande"><b>ALU CONTROL UNIT</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">


                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <br><br>Istr[30,14-12] = <?php     echo $funct;?><br><br>
                                    <font color=red>ALUOp = <?php     echo $aluOp;?></font>
                                </td>
                                <td align="center" class="testo"  width="33%">
                                    <font color=red>Result = <?php     echo $ctrl;?></font>
									<br><br>
                                    <table width="40" height="60" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="middle" align="center">
                                                <font size="1">ALU<br>CONTROL<br>UNIT<br></font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <br>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form9">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "wbmux": //WB MULTIPLEXER:
                        $DL=$_GET["DL"];
                        $DC=$_GET["DC"];
                        $ctrl=$_GET["ctrl"];
                        $WBdata=$_GET["WBdata"];
                        ?>
                        <div align="center" class="testoGrande"><b>WRITE BACK MULTIPLEXER </b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This MUX selects whether the value - to be written back in register -
                            should come from MEM (e.g. in case of 'lw' instruction) or EX stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <br><br>
                                    MEM/WB.ReadData = <?php     echo $DL;?><br><br>
                                    MEM/WB.CalcData = <?php     echo $DC;?>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">MemToReg = <?php     echo $ctrl;?></font><br><br>
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr>
                                            <td><div style="font-size: 8px;color:#666666;">1<br><br>0</div></td>
                                            <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%">
                                    <font color="red"><br><br>
                                        Result = <?php     echo $WBdata;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form2">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "memdati": //MEMORIA DATI:
                        $memW=$_GET["memW"];
                        $memR=$_GET["memR"];
                        $ind=$_GET["ind"];
                        $DS=$_GET["DS"];
                        $DL=$_GET["DL"];

                        ?>
                        <div align="center" class="testoGrande"><b>DATA MEMORY</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            The Data Memory will provide a value when MemRead is active ('lw') or
                            will store a value when MemWrite is active ('sw').
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <br><br><br><br><br>
                                    Address = <?php     echo $ind;?><br><br><br><br><br><br>
                                    Write Data = <?php     echo $DS;?>
                                </td>
                                <td align="center" class="testo" width="33%">
                                    <font color="red">MemWrite = <?php     echo $memW;?></font>
                                    <table width="60" height="150" cellpadding="0" cellspacing="0" class="elemento" >
                                        <tr><td valign="top" align="center">
                                                <font size="1"><br>DATA<br>MEMORY<br>
                                                    <br><br><br>
                                                    <div align="left">ADDRESS</div>
                                                    <br><br>
                                                    <div align="right">READ<br>DATA</div>
                                                    <br>
                                                    <div align="left">WRITE<br>DATA</div>
                                                </font>
                                            </td></tr>
                                    </table>
                                    <font color="red">MemRead = <?php     echo $memR;?></font>
                                </td>
                                <td align="left" valign="middle" class="testo" width="33%"><br><br><br><br><br><br>
                                    <?php     if ($DL!="")
                                    {
                                        ?>
                                        Read Data= <?php       echo $DL;?>
                                    <?php     }
                                    else
                                    {
                                        ?>
                                        <font color="red">NO DATA</font>
                                    <?php     } ?>
                                </td></tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					
					case "ifid": //IF/ID LATCH
                        ?>
                        <div align="center" class="testoGrande"><b>IF/ID LATCH</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register is a latch that separates IF and ID stages.
                        </div>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "idex": //ID/MEM LATCH
                        ?>
                        <div align="center" class="testoGrande"><b>ID/EX LATCH</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register is a latch that separates ID and EX stages.
                        </div>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmem": //EX/MEM LATCH
                        ?>
                        <div align="center" class="testoGrande"><b>EX/MEM LATCH</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register is a latch that separates EX and MEM stages.
                        </div>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "memwb": //MEM/WB LATCH
                        ?>
                        <div align="center" class="testoGrande"><b>MEM/WB LATCH</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register is a latch that separates MEM and WB stages.
                        </div>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>
                        <?php
                        break;
						
					case "idexwb": //REGISTRO ID/EX.WB:
                        $dataIn=$_GET["dataIn"];
                        $dataOut=$_GET["dataOut"];
                        ?>
                        <div align="center" class="testoGrande"><b>ID/EX.WB REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds control signals for WB stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color = "red">
                                        New Value = <?php     echo $dataIn;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="20%">
                                    <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif" >
                                        <tr>
                                            <td valign="middle" align="center">
                                                <font size="1">WB
                                                </font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="46%">
                                    <font color = "red">
                                        Old Value = <?php     echo $dataOut;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form4">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "idexmem": //REGISTRO ID/EX.MEM:
                        $dataIn=$_GET["dataIn"];
                        $dataOut=$_GET["dataOut"];
                        ?>
                        <div align="center" class="testoGrande"><b>ID/EX.MEM REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds control signals for MEM stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color = "red">
                                        New Value = <?php     echo $dataIn;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="20%">
                                    <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif" >
                                        <tr>
                                            <td valign="middle" align="center">
                                                <font size="1">M
                                                </font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="46%">
                                    <font color = "red">
                                        Old Value = <?php     echo $dataOut;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form1">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "idexex": //REGISTRO ID/EX.EX:
                        $dataIn=$_GET["dataIn"];
                        $dataOut=$_GET["dataOut"];
                        ?>
                        <div align="center" class="testoGrande"><b>ID/EX.EX REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds control signals for EX stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color = "red">
                                        New Value = <?php     echo $dataIn;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="20%">
                                    <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                                        <tr>
                                            <td valign="middle" align="center">
                                                <font size="1">EX
                                                </font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="46%">
                                    <font color = "red">
                                        Old Value = <?php     echo $dataOut;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form3">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmemwb": //REGISTRO EX/MEM.WB:
                        $dataIn=$_GET["dataIn"];
                        $dataOut=$_GET["dataOut"];
                        ?>
                        <div align="center" class="testoGrande"><b>EX/MEM.WB REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds control signals for WB stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color = "red">
                                        New Value = <?php     echo $dataIn;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="20%">
                                    <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif" >
                                        <tr>
                                            <td valign="middle" align="center">
                                                <font size="1">WB
                                                </font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="46%">
                                    <font color = "red">
                                        Old Value = <?php     echo $dataOut;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form4">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "exmemmem": //REGISTRO ID/EX.MEM:
                        $dataIn=$_GET["dataIn"];
                        $dataOut=$_GET["dataOut"];
                        ?>
                        <div align="center" class="testoGrande"><b>ID/EX.MEM REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds control signals for MEM stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color = "red">
                                        New Value = <?php     echo $dataIn;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="20%">
                                    <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif" >
                                        <tr>
                                            <td valign="middle" align="center">
                                                <font size="1">M
                                                </font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="46%">
                                    <font color = "red">
                                        Old Value = <?php     echo $dataOut;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form5">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
						
					case "memwbwb": //REGISTRO MEM/WB.WB:
                        $dataIn=$_GET["dataIn"];
                        $dataOut=$_GET["dataOut"];
                        ?>
                        <div align="center" class="testoGrande"><b>MEM/WB.WB REGISTER</b></div>
                        <hr size="1" width="60%" noshade>
                        <div align="center" class="testoGrande">
                            This register holds control signals for WB stage.
                        </div>
                        <br>
                        <table width="100%" cellpadding="0" cellspacing="0"  align="center">
                            <tr><td align="right" class="testo" width="33%">
                                    <font color = "red">
                                        New Value = <?php     echo $dataIn;?>
                                    </font>
                                </td>
                                <td align="center" class="testo" width="20%">
                                    <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_MEM_WB.gif" >
                                        <tr>
                                            <td valign="middle" align="center">
                                                <font size="1">WB
                                                </font>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="left" valign="middle" class="testo" width="46%">
                                    <font color = "red">
                                        Old Value = <?php     echo $dataOut;?>
                                    </font>
                                </td>
                            </tr>
                        </table>
                        <form action="javascript:window.close()" method="post" ID="Form6">
                            <hr size="1" width="60%" noshade>
                            <input type="submit" value="Close This Window" class="form" >
                        </form>

                        <?php
                        break;
                }
            }
            else
            {
                ?>
                missing parameters
                <?php
            }
            ?>
        </td>
    </tr>
</table>

</body>
</html>

