<?php
session_start();
if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
require_once 'functions.php';
sanitizeArray($_GET);
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="icon" href="../img/content/favicon.ico" type="image/x-icon">
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <meta name="robots" content="noindex">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" bgcolor="#ffffcc">
  <tr>
    <td align="center" valign="top">
      <?php
      if (isset($_GET['el']))
      {
        $elemento=$_GET["el"];
        $elemento=strtolower($elemento);
        switch ($elemento)
        {
          case "epc": //EPC
            ?>
            <div align="center" class="testoGrande"><b>SEPC</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds the Supervisor level EPC value.
            </div>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "cause": //CAUSE
            ?>
            <div align="center" class="testoGrande"><b>SCAUSE</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds the Supervisor level exception CAUSE.
            </div>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "if_som": //IF ADDER
            $PC=isset($_GET["newPC"])?$_GET["newPC"]:"";
            $PCpiu4=isset($_GET["PCpiu4"])?$_GET["PCpiu4"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ADDER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">This unit updates the PC</div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
              <tr>
                <td align="right" class="testo" width="33%">PC = <?php echo $PC;?><br><br>Constant = 4
                </td>
                <td align="center" width="33%">
                  <table width="50" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">Result = <?php echo $PCpiu4;?></td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "id_som1": //ID ADDER 1
            $ifidPC=isset($_GET["ifidPC"])?$_GET["ifidPC"]:"";
            $immsl=isset($_GET["immsl"])?$_GET["immsl"]:"";
            $output=isset($_GET["output"])?$_GET["output"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ADDER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">This unit creates the branch address</div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  PC = <?php echo $ifidPC;?>
                  <table><tr class="testo"><td>Shifted<br>Immediate</td><td>=</td><td><?php echo $immsl;?></td></tr></table>
                </td>
                <td align="center" width="33%">
                  <table width="50" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">Result = <?php echo $output;?></td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "id_som2": //ID ADDER 2
            $imm=isset($_GET["imm"])?$_GET["imm"]:"";
            $rs1=isset($_GET["rs1"])?$_GET["rs1"]:"";
            $output=isset($_GET["output"])?$_GET["output"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ADDER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">This unit creates the jalr address</div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <table style="margin-bottom: 5px;"><tr class="testo"><td>Immediate</td><td>=</td><td><?php echo $imm;?></td></tr></table>
                  Read Data 1 = <?php echo $rs1;?>
                </td>
                <td align="center" width="33%">
                  <table width="50" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">Result = <?php echo $output;?></td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "pc": //PC
            $newPC=isset($_GET["newPC"])?$_GET["newPC"]:"";
            $PC=isset($_GET["PC"])?$_GET["PC"]:"";
            $stallo=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            ?>
            <div align="center" class="testoGrande"><b>PROGRAM COUNTER (PC) REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">This register is updated only if the control signal is zero (if the hazard detection unit does not signal a stall)</div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">New PC = <?php echo $newPC;?></td>
                <td align="center" class="testo" width="33%">
                  <font color="red">Stall = <?php echo $stallo;?></font>
                  <br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1">PC</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">PC = <?php echo $PC;?></td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "istruzioni": //INSTRUCTION MEMORY
            $PC=isset($_GET["PC"])?$_GET["PC"]:"";
            $istruzione=isset($_GET["istr"])?$_GET["istr"]:"";
            ?>
            <div align="center" class="testoGrande"><b>INSTRUCTION MEMORY</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This is where the instructions are fetched from.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">Address (PC) = <?php echo $PC;?></td>
                <td align="center" class="testo" width="33%">
                  <table width="60" height="150" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="top" align="center">
                        <font size="1">INSTRUCTION<br>MEMORY
                          <br><br><br><br>
                          <div align="left">ADDRESS</div>
                          <br><br>
                          <div align="right">READ INSTRUCTION</div>
                        </font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%"><br><br><br><br><br><br>Instruction = <?php echo '<br>'.substr($istruzione,0,16).'<br>'.substr($istruzione,16,16);?></td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "if_mux": //IF MUX
            $newPC=isset($_GET["newPC"])?$_GET["newPC"]:"";
            $PCpiu4=isset($_GET["PCpiu4"])?$_GET["PCpiu4"]:"";
            $salto=isset($_GET["salto"])?$_GET["salto"]:"";
            $ctrl1=isset($_GET["ctrl1"])?$_GET["ctrl1"]:"";
            $ctrl2=isset($_GET["ctrl2"])?$_GET["ctrl2"]:"";
            ?>
            <div align="center" class="testoGrande"><b>INSTRUCTION FETCH MULTIPLEXER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This multiplexer selects the new program counter value based on the two control signals.
              <br>The first control signal decides whether a jump should happen or not.
              <br>The second control signal tells if there was an exception.
              <table>
              <tr><td class="testoGrande">
              00 -> next instruction.
              </td></tr>
              <tr><td class="testoGrande">
              01 -> exception handling address (fixed).
              </td></tr>
              <tr><td class="testoGrande">
              10 -> jump target address.
              </td></tr>
              </table>
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <br><br><br>
                  Jump Target Address = <?php echo $salto;?><br>
                  Exception Address<br>
                  PC + 4 = <?php echo $PCpiu4;?><br>
                </td>
                <td align="center" class="testo" width="33%">
                  <table cellpadding="5" cellspacing="5" border="0">
                    <tr>
                      <td align="center" valign="middle" class="testo">
                        <font color="red" size="1">PCsrc<br><?php echo $ctrl1;?></font>
                      </td>
                      <td align="center" valign="middle" class="testo">
                        <font color="red" size="1">Exception<br><?php echo $ctrl2;?></font>
                      </td>
                    </tr>
                  </table>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">10<br>01<br>00</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <br><br><br>
                  New PC = <?php echo ($ctrl1=='1')?$salto:$PCpiu4;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "and": //AND
            $ctrl1=isset($_GET["ctrl1"])?$_GET["ctrl1"]:"";
            $ctrl2=isset($_GET["ctrl2"])?$_GET["ctrl2"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
            ?>
            <div align="center" class="testoGrande"><b>LOGIC AND</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This gate generates the MUX control signal "PCsrc". This signal is high when
              the control units detects a jump instruction and the jump comparator
              check is satisfied.
            </div>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="center" class="testo" width="33%">
                  <table cellpadding="5" cellspacing="5" border="0">
                    <tr>
                      <td align="center" valign="middle" class="testo">
                        <font color="red" size="1">BranchCmp<br><?php echo $ctrl1;?></font>
                      </td>
                      <td align="center" valign="middle" class="testo">
                        <font color="red" size="1">Jump<br><?php echo $ctrl2;?></font>
                      </td>
                    </tr>
                  </table>
                  <table width="40" height="40" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1">AND</font></td></tr>
                  </table>
                  <font color="red">PCsrc = <?php echo $ris;?></font>
                </td>
              </tr>
            </table>
            <hr size="1" width="60%" noshade>
            <form action="javascript:window.close()" method="post">
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "criticita": //HAZARD DETECTION UNIT
            $RL1=isset($_GET["rl1"])?$_GET["rl1"]:"";
            $RL2=isset($_GET["rl2"])?$_GET["rl2"]:"";
            $stallo=isset($_GET["stallo"])?$_GET["stallo"]:"";
            $mem=isset($_GET["mem"])?$_GET["mem"]:"";
            $mem=substr($mem,0,1);
            $wb=isset($_GET["wb"])?$_GET["wb"]:"";
            $wb=substr($wb,0,1);
            $id_rd=isset($_GET["id_rd"])?$_GET["id_rd"]:"";
            $ex_rd=isset($_GET["ex_rd"])?$_GET["ex_rd"]:"";
            ?>
            <div align="center" class="testoGrande"><b>HAZARD DETECTION UNIT</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This unit detects hazard conditions and produces control signals accordingly.<br>
              Example: In the case of previous 'lw' instruction using the same destination register as the current 'add' instruction input register (ID/EX.RegisterRD = IF/ID.RegisterRS1 <font color=blue>OR</font> ID/EX.RegisterRD = IF/ID.RegisterRS2 <font color=blue>AND</font> ID/EX.MemRead = 1) <?php if ($_SESSION['forwarding']==0) {?>two<?php } else {?>one<?php }?> 'nop' must be inserted in the pipeline.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo">
                  <font color=red>Stall = <?php echo $stallo;?></font><br>
                  IF/ID.RegisterRS1 = <?php echo $RL1;?><br>
                  IF/ID.RegisterRS2 = <?php echo $RL2;?><br>
                  ID/EX.RegisterRD = <?php echo $id_rd;?><?php if ($_SESSION['forwarding']==0) {?><br>
                  EX/MEM.RegisterRD = <?php echo $ex_rd;?><?php }?>
                </td>
                <td align="center">
                  <table width="80" height="80" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">HAZARD DETECTION UNIT<br></font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo">
                  <font color=red>Stall = <?php echo $stallo;?></font><br><br>
                  <font color=red>ID/EX.MemRead = <?php echo $mem;?></font><br>
                  <?php if ($_SESSION['forwarding']==0) {?><font color=red>EX/MEM.RegWrite = <?php echo $wb;?></font><br><?php }?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "controllo": //CONTROL UNIT
            $istr=isset($_GET["istr"])?$_GET["istr"]:"";
            $salta=isset($_GET["salta"])?$_GET["salta"]:"";
            $ecc=isset($_GET["ecc"])?$_GET["ecc"]:"";
            $wb=isset($_GET["wb"])?$_GET["wb"]:"";
            $mem=isset($_GET["mem"])?$_GET["mem"]:"";
            $ex=isset($_GET["ex"])?$_GET["ex"]:"";
            $if_scarta=isset($_GET["if_scarta"])?$_GET["if_scarta"]:"";
            $id_scarta=isset($_GET["id_scarta"])?$_GET["id_scarta"]:"";
            $ex_scarta=isset($_GET["ex_scarta"])?$_GET["ex_scarta"]:"";
            $isbranch=isset($_GET["isbranch"])?$_GET["isbranch"]:"";
            $isjalr=isset($_GET["isjalr"])?$_GET["isjalr"]:"";
            ?>
            <div align="center" class="testoGrande"><b>CONTROL UNIT</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This unit is a combinational network, which generates the control signals for all stages
              according to the values of the OP and FUNCT3 fields.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color=red>Exception = <?php echo $ecc;?></font><br>
                  <font color=red>Jump = <?php echo $salta;?></font><br><br>
                  Instr[14-12,6-0] = <?php echo $istr;?>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="50" height="140" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">CONTROL<BR>UNIT<br></font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                <font color=red>
                  IF.Flush = <?php echo $if_scarta;?><br>
                  ID.Flush = <?php echo $id_scarta;?><br>
                  EX.Flush = <?php echo $ex_scarta;?><br><br>
                  Control.WB = <?php echo $wb;?><br>
                  Control.M = <?php echo $mem;?><br>
                  Control.EX = <?php echo $ex;?><br><br>
                  IsBranch = <?php echo $isbranch;?><br>
                  IsJalr = <?php echo $isjalr;?>
                </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "or": //OR
            $stallo=isset($_GET["stallo"])?$_GET["stallo"]:"";
            $id_scarta=isset($_GET["id_scarta"])?$_GET["id_scarta"]:"";
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
                  <table cellpadding="5" cellspacing="5" border="0">
                    <tr>
                      <td align="center" valign="middle" class="testo">
                        <font color="red" size="1">Stall<br><?php echo $stallo;?></font>
                      </td>
                      <td align="center" valign="middle" class="testo">
                        <font color="red" size="1">ID.flush<br><?php echo $id_scarta;?></font>
                      </td>
                    </tr>
                  </table>
                  <table width="40" height="40" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1">OR</font></td></tr>
                  </table>
                  <font color="red">Result = <?php echo $stallo;?></font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "id_mux1": //ID MULTIPLEXER 1
            $wb=isset($_GET["wb"])?$_GET["wb"]:"";
            $mem=isset($_GET["mem"])?$_GET["mem"]:"";
            $ex=isset($_GET["ex"])?$_GET["ex"]:"";
            $wb2=isset($_GET["wb2"])?$_GET["wb2"]:"";
            $mem2=isset($_GET["mem2"])?$_GET["mem2"]:"";
            $ex2=isset($_GET["ex2"])?$_GET["ex2"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ID MULTIPLEXER 1</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This multiplexer should forward the control signals in ID/EX registers or,
              in case of stall or flush, force all signals to zero.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color="red"><br>
                    Control.WB = <?php echo $wb;?><br>
                    Control.M = <?php echo $mem;?><br>
                    Control.EX = <?php echo $ex;?><br>
                    <br>
                    00 00000 000000
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <font color="red">Control = <?php echo $ctrl;?></font><br><br>
                  <table width="30" height="80" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">0<br><br><br>1</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color="red"><br><br>
                    ID/EX.WB = <?php echo $wb;?><br>
                    ID/EX.M = <?php echo $mem;?><br>
                    ID/EX.EX = <?php echo $ex;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "branch_cmp": //BRANCH COMPARATOR
            $data1=isset($_GET["data1"])?$_GET["data1"]:"";
            $data2=isset($_GET["data2"])?$_GET["data2"]:"";
            $aludata=isset($_GET["aludata"])?$_GET["aludata"]:"";
            $memdata=isset($_GET["memdata"])?$_GET["memdata"]:"";
            $isbranch=isset($_GET["isbranch"])?$_GET["isbranch"]:"";
            $funct3=isset($_GET["funct3"])?$_GET["funct3"]:"";
            $mux1=isset($_GET["mux1"])?$_GET["mux1"]:"";
            $mux2=isset($_GET["mux2"])?$_GET["mux2"]:"";
            $out=isset($_GET["out"])?$_GET["out"]:"";
            ?>
            <div align="center" class="testoGrande"><b>BRANCH COMPARATOR</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This comparator, if the instruction is a branch, selects the operands to
              compare based on the control signals from the forwarding unit and verifies
              them according to the type of branch [seen from FUNCT3].
              If the instruction is not a branch, the output is always 1.
            </div>
            <br>

            <table width="100%" cellpadding="0" cellspacing="0" align="center">
              <tr>
                <td colspan="3" align="center" class="testo" style="padding-bottom: 10px;">
                  <font color="red">BranchCmp = <?php echo $out;?></font>
                </td>
              </tr>
              <tr>
                <td align="right" class="testo" width="33%" valign="top">
                  <br>
                  <font color="red">IsBranch = <?php echo $isbranch;?></font><br><br>
                  IF/ID.Funct3 = <?php echo $funct3;?><?php if ($_SESSION['forwarding']==1) {?><br><br>
                  <font color="red">Ctrl MUX 1 Branch = <?php echo $mux1;?></font><br><br>
                  <font color="red">Ctrl MUX 2 Branch = <?php echo $mux2;?></font><?php }?>
                </td>
                <td align="center" class="testo" width="33%">
                   <table width="80" <?php if ($_SESSION['forwarding']==1) {?>height="110"<?php } else {?>height="60"<?php }?> cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">BRANCH<br>CMP<br></font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="top" class="testo" width="33%">
                  <br>
                  Read_Data1 = <?php echo $data1;?><br><br>
                  Read_Data2 = <?php echo $data2;?><?php if ($_SESSION['forwarding']==1) {?><br><br>
                  EX/MEM.AluData = <?php echo $aludata;?><br><br>
                  EX/MEM.MemData = <?php echo $memdata;?>
                  <?php }?>
                </td>
              </tr>
            </table>

            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "immgen": //IMMEDIATE GENERATOR
            $esteso=isset($_GET["esteso"])?$_GET["esteso"]:"";
            $dato=isset($_GET["dato"])?$_GET["dato"]:"";
            ?>
            <div align="center" class="testoGrande"><b>IMMEDIATE GENERATOR</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              From the 32-bit instruction a 64-bit immediate should be generated,
              since the ALU processes 64-bit data.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center" style="table-layout: fixed;">
              <tr>
                <td align="right" class="testo" width="33%">
                  <div style="float:right" align="left">
                    Instruction =<br><?php echo substr($dato,0,16).'<br>'.substr($dato,16,16);?>
                  </div>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="60" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">IMM<br>GEN<br></font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  Generated Immediate =<br><?php echo substr($esteso,0,16).'<br>'.substr($esteso,16,16).'<br>'.substr($esteso,32,16).'<br>'.substr($esteso,48,16);?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "sl1": //SHIFT LEFT 1
            $input=isset($_GET["input"])?$_GET["input"]:"";
            $output=isset($_GET["output"])?$_GET["output"]:"";
            ?>
            <div align="center" class="testoGrande"><b>SHIFT LEFT 1</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              Shift the immediate 1 bit to the left.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center" style="table-layout: fixed;">
              <tr>
                <td align="right" class="testo" width="33%">
                  <div style="float:right" align="left">
                    Immediate =<br><?php echo substr($input,0,16).'<br>'.substr($input,16,16).'<br>'.substr($input,32,16).'<br>'.substr($input,48,16);?>
                  </div>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="50" height="40" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">SHIFT<br>LEFT 1</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  Shifted Immediate =<br><?php echo substr($output,0,16).'<br>'.substr($output,16,16).'<br>'.substr($output,32,16).'<br>'.substr($output,48,16);?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "registri": //REGISTER FILE
            $RL1=isset($_GET["RL1"])?$_GET["RL1"]:"";
            $RL2=isset($_GET["RL2"])?$_GET["RL2"]:"";
            $DL1=isset($_GET["DL1"])?$_GET["DL1"]:"";
            $DL2=isset($_GET["DL2"])?$_GET["DL2"]:"";
            $RW=isset($_GET["RW"])?$_GET["RW"]:"";
            $WBdata=isset($_GET["WBdata"])?$_GET["WBdata"]:"";
            $RegWrite=isset($_GET["RegWrite"])?$_GET["RegWrite"]:"";
            ?>
            <div align="center" class="testoGrande"><b>REGISTERS</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This are is the register file: 32 64-bit registers. In the first half of
              a clock cycle, the values coming from the Write-back stage should be written.
              In the second half of a clock cycle, the values specified by the values <b>rs1</b>
              and <b>rs2</b> are read.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0" align="center">
              <tr>
                <td colspan="3" align="center" class="testo" style="padding-bottom: 10px;">
                  <font color="red">RegWrite = <?php echo $RegWrite;?></font>
                </td>
              </tr>
              <tr>
                <td align="right" class="testo" width="33%" valign="top">
                  IF/ID.RegisterRS1 = <?php echo $RL1;?><br><br>
                  IF/ID.RegisterRS2 = <?php echo $RL2;?><br><br><br><br><br><br><br><br>
                  MEM/WB.RegisterRD = <?php echo $RW;?><br><br>
                  WB.Data = <?php echo $WBdata;?><br>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="90" height="150" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="top" align="center">
                        <font size="1">
                          <div align="left">READ REG 1</div><br>
                          <div align="left">READ REG 2</div><br>
                          <div align="right">READ DATA 1</div><br>
                          <div align="right">READ DATA 2</div><br>
                          <div align="center"><b>REGISTERS</b></div><br>
                          <div align="left">WRITE REG</div><br>
                          <div align="left">WRITE DATA</div>
                        </font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="top" class="testo" width="33%">
                  <br><br><br><br>
                  Read_Data1 = <?php echo $DL1;?><br><br>
                  Read_Data2 = <?php echo $DL2;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "ex_mux1": //EX MULTIPLEXER 1
            $ex_scarta=isset($_GET["ex_scarta"])?$_GET["ex_scarta"]:"";
            $dato=isset($_GET["dato"])?$_GET["dato"]:"";
            ?>
            <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 1</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This MUX is needed to set to zero all control signals for Write Back stage,
              otherwise those signals will propagate normally.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color="red">
                    <br><br>
                    ID.EX.WB = <?php echo $dato;?><br><br>
                    00
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <font color="red">EX.Flush = <?php echo $ex_scarta;?></font><br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <br><br><font color="red">EX.MEM.WB = <?php echo $dato;?></font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "ex_mux2": //EX MULTIPLEXER 2
            $ex_scarta=isset($_GET["ex_scarta"])?$_GET["ex_scarta"]:"";
            $dato=isset($_GET["dato"])?$_GET["dato"]:"";
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
                    ID.EX.M = <?php echo $dato;?><br><br>
                    0000
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <font color="red">EX.Flush = <?php echo $ex_scarta;?></font><br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <br><br><font color="red">EX.MEM.M = <?php echo $dato;?></font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "ex_mux3": //EX MULTIPLEXER 3
            $DL1=isset($_GET["DL1"])?$_GET["DL1"]:"";
            $mem_wb=isset($_GET["mem_wb"])?$_GET["mem_wb"]:"";
            $ex_mem=isset($_GET["ex_mem"])?$_GET["ex_mem"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
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
              <tr>
                <td align="right" class="testo" width="33%" valign="top">
                  <br>
                  ID/EX.ReadData1 = <?php echo $DL1;?><br>
                  WB.Data = <?php echo $mem_wb;?><br>
                  EX/MEM.Data = <?php echo $ex_mem;?><br>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="30" height="60" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">00<br>01<br>10</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                  <br>
                  <font color="red" size="1">Control = <?php echo $ctrl;?></font>
                </td>
                <td align="left" valign="top" class="testo" width="33%">
                  <br><br>
                  Temp ALU Operand 1 = <?php echo $ris;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "ex_mux4": //EX MULTIPLEXER 4
            $DL1=isset($_GET["DL1"])?$_GET["DL1"]:"";
            $mem_wb=isset($_GET["mem_wb"])?$_GET["mem_wb"]:"";
            $ex_mem=isset($_GET["ex_mem"])?$_GET["ex_mem"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
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
              <tr>
                <td align="right" class="testo" width="33%" valign="top">
                  <br>
                  ID/EX.ReadData2 = <?php echo $DL1;?><br>
                  WB.Data = <?php echo $mem_wb;?><br>
                  EX/MEM.Data = <?php echo $ex_mem;?><br>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="30" height="60" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">00<br>01<br>10</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                  <br>
                  <font color="red" size="1">Control = <?php echo $ctrl;?></font>
                </td>
                <td align="left" valign="top" class="testo" width="33%">
                  <br><br>
                  Temp ALU Operand 2 = <?php echo $ris;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "ex_mux5": //EX MULTIPLEXER 5
            $op1=isset($_GET["op1"])?$_GET["op1"]:"";
            $op2=isset($_GET["op2"])?$_GET["op2"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            ?>
            <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 5</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This MUX allows to choose whether the ALU first operand should be
              the previous MUX result, the PC or zero.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="38%">
                  <br><br>
                  <?php if ($_SESSION['forwarding']==1) {?>Temp ALU Operand 1 = <?php } else {?> ID/EX.ReadData1 = <?php } echo $op1;?><br>
                  ID.EX.PC = <?php echo $op2;?><br>
                  0
                </td>
                <td align="center" class="testo" width="24%">
                  <font color="red">AluSrc1 = <?php echo $ctrl;?></font><br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">00<br>01<br>10</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="38%">
                  <br><br>
                  ALU Operand 1 = <?php echo $ris;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "ex_mux6": //EX MULTIPLEXER 6
            $op1=isset($_GET["op1"])?$_GET["op1"]:"";
            $op2=isset($_GET["op2"])?$_GET["op2"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            ?>
            <div align="center" class="testoGrande"><b>EXECUTE MULTIPLEXER 6</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This MUX allows to choose whether the ALU second operand should be
              the previous MUX result, the immediate value or 4.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="38%">
                  <br><br>
                  <?php if ($_SESSION['forwarding']==1) {?>Temp ALU Operand 2 = <?php } else {?> ID/EX.ReadData2 = <?php } echo $op1;?><br>
                  ID.EX.Immediate = <?php echo $op2;?><br>
                  4
                </td>
                <td align="center" class="testo" width="24%">
                  <font color="red">AluSrc2 = <?php echo $ctrl;?></font><br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">00<br>01<br>10</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="38%">
                  <br><br>
                  ALU Operand 2 = <?php echo $ris;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "id_mux2": //ID MULTIPLEXER 2
            $op1=isset($_GET["op1"])?$_GET["op1"]:"";
            $op2=isset($_GET["op2"])?$_GET["op2"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ID MULTIPLEXER 2</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This MUX allows to confirm whether the jump address is from a branch/jal or a jalr.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr><td align="right" class="testo" width="38%">
                  <br><br>
                  Branch Address = <?php echo $op1;?><br><br>
                  Jalr Address = <?php echo $op2;?>
                </td>
                <td align="center" class="testo" width="24%">
                  <font color="red">IsJalr = <?php echo $ctrl;?></font><br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">0<br><br>1</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="38%">
                  <br><br>
                  Jump Target Address = <?php echo $ris;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "alu": //ALU
            $valore1=isset($_GET["valore1"])?$_GET["valore1"]:"";
            $valore2=isset($_GET["valore2"])?$_GET["valore2"]:"";
            $ris=isset($_GET["ris"])?$_GET["ris"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ARITHMETIC LOGIC UNIT</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              The ALU executes an operation on the two source operands based on its control signal.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  ALU operand 1 = <?php echo $valore1;?><br><br>
                  ALU operand 2 = <?php echo $valore2;?><br><br><br>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="50" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center"><font size="1"><b>ALU</b></font></td></tr>
                  </table>
                  <br>
                  <font color="red">Control = <?php echo $ctrl;?></font>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  Result = <?php echo $ris;?>
                </td>
                <br><br><br>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "forward_alu": //FORWARDING UNIT
            $rs1=isset($_GET["rs1"])?$_GET["rs1"]:"";
            $rs2=isset($_GET["rs2"])?$_GET["rs2"]:"";
            $mux1=isset($_GET["mux1"])?$_GET["mux1"]:"";
            $mux2=isset($_GET["mux2"])?$_GET["mux2"]:"";
            $regW1=isset($_GET["regW1"])?$_GET["regW1"]:"";
            $regW2=isset($_GET["regW2"])?$_GET["regW2"]:"";
            $mem1=isset($_GET["mem1"])?$_GET["mem1"]:"";
            $mem2=isset($_GET["mem2"])?$_GET["mem2"]:"";
            ?>
            <div align="center" class="testoGrande"><b>FORWARDING UNIT ALU</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              The forwarding unit solves some of the problems caused by data hazards.
              There are two cases when this unit modifies the pipeline behavior:
              <br>
              <table>
                <tr>
                  <td class="testoGrande">
                    1] the instruction in MEM stage writes into some register (in such case EX_MEM_RegWrite = 1) and the result from EX stage is the value to be written back.
                  </td>
                </tr>
                <tr>
                  <td class="testoGrande">
                    2] the instruction in WB stage writes into some register (in such case MEM_WB_RegWrite = 1) and the result from MEM stage is the value to be written back.
                  </td>
                </tr>
              </table>
              When one of the possible four cases happens, then the forwarding unit enables the corresponding MUX and data is forwarded.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color=red>Ctrl MUX 4 = <?php echo $mux1;?></font><br>
                  <font color=red>Ctrl MUX 3 = <?php echo $mux2;?></font><br>
                  ID/EX.RegisterRS1 = <?php echo $rs1;?><br>
                  ID/EX.RegisterRS2 = <?php echo $rs2;?><br>
                </td>
                <td align="center" width="33%">
                  <table width="80" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">FORWARDING UNIT<br></font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  EX/MEM.RegisterRD = <?php echo $regW1;?><br>
                  <font color=red>EX/MEM.RegWrite = <?php echo $mem1;?></font><br>
                  MEM/WB.RegisterRD = <?php echo $regW2;?><br>
                  <font color=red>MEM/WB.RegWrite = <?php echo $mem2;?></font><br>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "forward_branch": //FORWARDING UNIT
            $rs1=isset($_GET["rs1"])?$_GET["rs1"]:"";
            $rs2=isset($_GET["rs2"])?$_GET["rs2"]:"";
            $rd=isset($_GET["rd"])?$_GET["rd"]:"";
            $regwr=isset($_GET["regwr"])?$_GET["regwr"]:"";
            $memreg=isset($_GET["memreg"])?$_GET["memreg"]:"";
            $mux1=isset($_GET["mux1"])?$_GET["mux1"]:"";
            $mux2=isset($_GET["mux2"])?$_GET["mux2"]:"";
            ?>
            <div align="center" class="testoGrande"><b>FORWARDING UNIT BRANCH</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              The forwarding unit solves some of the problems caused by data hazards.
              There are two cases when this unit modifies the pipeline behavior:
              <br>
              <table>
                <tr>
                  <td class="testoGrande">
                    1] the instruction in MEM stage writes into some register (EX_MEM_RegWrite = 1) and the result from EX stage is the value to be written back (EX_MEM_MemToReg= 0).
                  </td>
                </tr>
                <tr>
                  <td class="testoGrande">
                    2] the instruction in MEM stage writes into some register (EX_MEM_RegWrite = 1) and the result from MEM stage is the value to be written back (EX_MEM_MemToReg= 1).
                  </td>
                </tr>
              </table>
              When one of the possible four cases happens, then the forwarding unit enables the corresponding MUX and data is forwarded.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color=red>Ctrl MUX 1 Branch = <?php echo $mux1;?></font><br>
                  <font color=red>Ctrl MUX 2 Branch = <?php echo $mux2;?></font><br>
                  IF/ID.RegisterRS1 = <?php echo $rs1;?><br>
                  IF/ID.RegisterRS2 = <?php echo $rs2;?><br>
                </td>
                <td align="center" width="33%">
                  <table width="80" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">FORWARDING UNIT<br></font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  EX/MEM.RegisterRD = <?php echo $rd;?><br>
                  <font color=red>EX/MEM.RegWrite = <?php echo $regwr;?></font><br>
                  <font color=red>EX/MEM.MemToReg = <?php echo $memreg;?></font><br>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "controlloalu": //ALU CONTROL UNIT
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            $funct=isset($_GET["funct"])?$_GET["funct"]:"";
            $aluOp=isset($_GET["aluOp"])?$_GET["aluOp"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ALU CONTROL UNIT</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande"></div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <br><br>
                  <font color=red>ALUOp = <?php echo $aluOp;?></font><br><br>
                  Instr[30,25,14-12,3] = <?php echo $funct;?>
                </td>
                <td align="center" class="testo"  width="33%">
                  <font color=red>Result = <?php echo $ctrl;?></font>
                  <br><br>
                  <table width="40" height="60" cellpadding="0" cellspacing="0" class="elemento">
                    <tr><td valign="middle" align="center">
                        <font size="1">ALU<br>CONTROL<br>UNIT<br></font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%"></td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "wb_mux": //WB MULTIPLEXER
            $DL=isset($_GET["DL"])?$_GET["DL"]:"";
            $DC=isset($_GET["DC"])?$_GET["DC"]:"";
            $ctrl=isset($_GET["ctrl"])?$_GET["ctrl"]:"";
            $WBdata=isset($_GET["WBdata"])?$_GET["WBdata"]:"";
            ?>
            <div align="center" class="testoGrande"><b>WRITE BACK MULTIPLEXER </b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This MUX selects whether the value - to be written back in register -
              should come from MEM (e.g. in case of 'lw' instruction) or EX stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <br><br>
                  MEM/WB.MemData = <?php echo $DL;?><br><br>
                  MEM/WB.ExData = <?php echo $DC;?>
                </td>
                <td align="center" class="testo" width="33%">
                  <font color="red">MemToReg = <?php echo $ctrl;?></font><br><br>
                  <table width="30" height="50" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td><div style="font-size: 8px;color:#666666;">1<br><br>0</div></td>
                      <td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <br><br>
                  Result = <?php echo $WBdata;?>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "memdati": //DATA MEMORY
            $memW=isset($_GET["memW"])?$_GET["memW"]:"";
            $memR=isset($_GET["memR"])?$_GET["memR"]:"";
            $ind=isset($_GET["ind"])?$_GET["ind"]:"";
            $DS=isset($_GET["DS"])?$_GET["DS"]:"";
            $DL=isset($_GET["DL"])?$_GET["DL"]:"";
            ?>
            <div align="center" class="testoGrande"><b>DATA MEMORY</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              The Data Memory will provide a value when MemRead is active ('lw') or
              will store a value when MemWrite is active ('sw').
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
              <td colspan="3" align="center" class="testo" style="padding-bottom: 10px;">
              <font color="red">MemWrite = <?php echo $memW;?></font>
              </td>
              </tr>
              <tr>
                <td align="right" class="testo" width="33%">
                  <br><br><br><br><br>
                  Address = <?php echo $ind;?><br><br><br><br><br><br>
                  Write Data = <?php echo $DS;?>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="60" height="150" cellpadding="0" cellspacing="0" class="elemento">
                    <tr>
                      <td valign="top" align="center">
                        <font size="1">
                          <br>
                          DATA<br>MEMORY<br>
                          <br><br><br>
                          <div align="left">ADDRESS</div>
                          <br><br>
                          <div align="right">READ<br>DATA</div>
                          <br>
                          <div align="left">WRITE<br>DATA</div>
                        </font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%"><br><br><br><br><br><br>
                  <?php if ($DL!="") {
                    ?>
                    Read Data= <?php echo $DL;?>
                  <?php }
                  else {
                    ?>
                    <font color="red">NO DATA</font>
                  <?php
                  }?>
                </td>
              </tr>
              <tr>
                <td colspan="3" align="center" class="testo" style="padding-top: 10px;">
                  <font color="red">MemRead = <?php echo $memR;?></font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
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
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "idex": //ID/EX LATCH
            ?>
            <div align="center" class="testoGrande"><b>ID/EX LATCH</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register is a latch that separates ID and EX stages.
            </div>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
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
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
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
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "idexwb": //ID/EX.WB REGISTER
            $dataIn=isset($_GET["dataIn"])?$_GET["dataIn"]:"";
            $dataOut=isset($_GET["dataOut"])?$_GET["dataOut"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ID/EX.WB REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds control signals for WB stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color = "red">
                    New Value = <?php echo $dataIn;?>
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">WB</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color = "red">
                    Old Value = <?php echo $dataOut;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "idexmem": //ID/EX.MEM REGISTER
            $dataIn=isset($_GET["dataIn"])?$_GET["dataIn"]:"";
            $dataOut=isset($_GET["dataOut"])?$_GET["dataOut"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ID/EX.MEM REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds control signals for MEM stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color = "red">
                    New Value = <?php echo $dataIn;?>
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">M</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color = "red">
                    Old Value = <?php echo $dataOut;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "idexex": //ID/EX.EX REGISTER
            $dataIn=isset($_GET["dataIn"])?$_GET["dataIn"]:"";
            $dataOut=isset($_GET["dataOut"])?$_GET["dataOut"]:"";
            ?>
            <div align="center" class="testoGrande"><b>ID/EX.EX REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds control signals for EX stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color = "red">
                    New Value = <?php echo $dataIn;?>
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">EX</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color = "red">
                    Old Value = <?php echo $dataOut;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "exmemwb": //EX/MEM.WB REGISTER
            $dataIn=isset($_GET["dataIn"])?$_GET["dataIn"]:"";
            $dataOut=isset($_GET["dataOut"])?$_GET["dataOut"]:"";
            ?>
            <div align="center" class="testoGrande"><b>EX/MEM.WB REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds control signals for WB stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color = "red">
                    New Value = <?php echo $dataIn;?>
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">WB</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color = "red">
                    Old Value = <?php echo $dataOut;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "exmemmem": //EX/MEM.MEM REGISTER
            $dataIn=isset($_GET["dataIn"])?$_GET["dataIn"]:"";
            $dataOut=isset($_GET["dataOut"])?$_GET["dataOut"]:"";
            ?>
            <div align="center" class="testoGrande"><b>EX/MEM.MEM REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds control signals for MEM stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color = "red">
                    New Value = <?php echo $dataIn;?>
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">M</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color = "red">
                    Old Value = <?php echo $dataOut;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;

          case "memwbwb": //MEM/WB.WB REGISTER
            $dataIn=isset($_GET["dataIn"])?$_GET["dataIn"]:"";
            $dataOut=isset($_GET["dataOut"])?$_GET["dataOut"]:"";
            ?>
            <div align="center" class="testoGrande"><b>MEM/WB.WB REGISTER</b></div>
            <hr size="1" width="60%" noshade>
            <div align="center" class="testoGrande">
              This register holds control signals for WB stage.
            </div>
            <br>
            <table width="100%" cellpadding="0" cellspacing="0"  align="center">
              <tr>
                <td align="right" class="testo" width="33%">
                  <font color = "red">
                    New Value = <?php echo $dataIn;?>
                  </font>
                </td>
                <td align="center" class="testo" width="33%">
                  <table width="35" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_MEM_WB.gif">
                    <tr>
                      <td valign="middle" align="center">
                        <font size="1">WB</font>
                      </td>
                    </tr>
                  </table>
                </td>
                <td align="left" valign="middle" class="testo" width="33%">
                  <font color = "red">
                    Old Value = <?php echo $dataOut;?>
                  </font>
                </td>
              </tr>
            </table>
            <form action="javascript:window.close()" method="post">
              <hr size="1" width="60%" noshade>
              <input type="submit" value="Close This Window" class="form">
            </form>
            <?php
            break;
        }
      }
      else
      {
        ?>
        ERROR: Missing parameters
        <?php
      }
      ?>
    </td>
  </tr>
</table>
</body>
</html>

