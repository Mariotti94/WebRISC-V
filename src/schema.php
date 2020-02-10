<?php
list($ALUOp,$ALUdato1,$ALUdato2,$EX_MEM_DataW,$EX_MEM_M,$EX_MEM_RIS,$EX_MEM_RegW,$EX_MEM_WB,$EX_scarta,$ID_EX_Data1,$ID_EX_Data2,$ID_EX_EX,$ID_EX_M,$ID_EX_PC,$ID_EX_RD,$ID_EX_RS1,$ID_EX_RS2,$ID_EX_WB,$ID_EX_campoOp,$ID_EX_funct3,$ID_EX_funct7,$ID_EX_immVal,$ID_scarta,$IF_ID_PC,$IF_scarta,$MEM_WB_Data,$MEM_WB_DataR,$MEM_WB_RegW,$MEM_WB_WB,$Mux3Ctrl,$Mux4Ctrl,$Mux5Ctrl,$Mux6Ctrl,$MuxBranchCmp1,$MuxBranchCmp2,$PCsrc,$RL1,$RL2,$WBdata,$aluCtrl,$jump,$branchAddr,$branchCmp,$ctrl_EX,$ctrl_M,$ctrl_WB,$isBranch,$isJalr,$istruzione,$jalrAddr,$newPC,$newPC1,$newPC2,$stallo,$tempImm,$tempIstruzione,$tempPC,$temp_ALUdato1,$temp_EX_MEM_DataW,$temp_EX_MEM_RIS,$temp_ID_EX_Data1,$temp_ID_EX_Data2,$temp_ID_EX_funct3,$temp_ID_EX_imm,$temp_MEM_WB_DataR) = $_SESSION['data'][$_SESSION['index']]['schemaData'];
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <link href="../css/schema.css" rel="stylesheet" type="text/css">
  <script language='JavaScript' type='text/JavaScript' src="../js/schema.js"></script>
  <?php
  $agg=isset($_GET["agg"])?$_GET["agg"]:"";
  if ($agg!="new") {
  ?>
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
  <?php
  }
  ?>
  <meta name="robots" content="noindex">
</head>
<body id="schemaBody">

  <table cellpadding="0" cellspacing="0" class="elemento and">
    <tr><td valign="middle" align="center"><font size="1">AND</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento if_mux">
    <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento if_som">
    <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="pc">
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

  <div align="center" class="if_id if_id_latch">
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

  <table cellpadding="0" cellspacing="0" class="elemento id_som1">
    <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento id_som2">
    <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento registri">
    <tr><td valign="top" align="center">
        <font size="1">
          <div align="left" style="position:absolute; top:6%;">READ REG 1</div>
          <div align="left" style="position:absolute; top:16%;">READ REG 2</div>
          <div align="right" style="position:absolute; right:1%; top:32%;">READ DATA 1</div>
          <div align="right" style="position:absolute; right:1%; top:42%;">READ DATA 2</div>
          <div align="center" style="position:absolute; left:15%; top:61%;"><b>REGISTERS</b></div>
          <div align="left" style="position:absolute; top:77%;">WRITE REG</div>
          <div align="left" style="position:absolute; top:87%;">WRITE DATA</div>
        </font>
      </td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento or">
    <tr><td valign="middle" align="center"><font size="1">OR</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento id_mux1">
    <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento id_mux2">
    <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento branch_cmp">
    <tr><td valign="middle" align="center"><font size="1">BRANCH CMP</font></td></tr>
  </table>

  <div align="center" class="id_ex id_ex_latch">
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
    <table style="width:37px; height:295px;" cellpadding="0" cellspacing="0" border="0" bgcolor="yellow">
      <tr>
        <td><img src="../img/layout/x.gif"></td>
      </tr>
    </table>
  </div>

  <span class="csr_label">CSR UNIT</span>
  <table cellpadding="0" cellspacing="0" class="elemento cause">
    <tr><td valign="middle" align="center"><font size="1">SCAUSE</font></td></tr>
  </table>
  <table cellpadding="0" cellspacing="0" class="elemento epc">
    <tr><td valign="middle" align="center"><font size="1">SEPC</font></td></tr>
  </table>
  <span style="position:absolute; left:630px; top:200px; font-size:20px;">...</span>

  <?php if($_SESSION['forwarding']==1) 
  {
  ?>
    <table cellpadding="0" cellspacing="0" class="elemento ex_mux3">
      <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
    </table>

    <table cellpadding="0" cellspacing="0" class="elemento ex_mux4">
      <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
    </table>
    
    <table cellpadding="0" cellspacing="0" class="elemento forward_alu">
      <tr>
        <td valign="middle" align="center">
          <font size="1">FORWARDING UNIT ALU</font>
        </td>
      </tr>
    </table>
    
    <table cellpadding="0" cellspacing="0" class="elemento forward_branch">
      <tr><td valign="middle" align="center"><font size="1">FORWARDING UNIT BRANCH</font></td></tr>
    </table>
  <?php 
  }
  ?>

  <table cellpadding="0" cellspacing="0" class="elemento ex_mux5">
    <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
  </table>

  <table cellpadding="0" cellspacing="0" class="elemento ex_mux6">
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

  <div align="center" class="ex_mem ex_mem_latch">
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
    <table style="width:37px; height:295px;" cellpadding="0" cellspacing="0" border="0" bgcolor="blue">
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

  <div align="center" class="mem_wb mem_wb_latch">
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
    <table style="width:37px; height:300px;" cellpadding="0" cellspacing="0" border="0" bgcolor="green">
      <tr>
        <td><img src="../img/layout/x.gif"></td>
      </tr>
    </table>
  </div>

  <table cellpadding="0" cellspacing="0" class="elemento wb_mux">
    <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
  </table>

  <?php
  // DATA SIGNALS
  if ($_SESSION['segDati']!="")
  {
    if($_SESSION['forwarding']==0) {
      ?>
      <div style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:-2; pointer-events:none;">
        <img src="../img/content/segnali_dati_no_forwarding.gif">
      </div>
      <?php
    }
    else {
      ?>
      <div style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:-2; pointer-events:none;">
        <img src="../img/content/segnali_dati_forwarding.gif">
      </div>
      <?php
    }
  }
  //CONTROL SIGNALS
  if ($_SESSION['segCtrl']!="")
  {
    if($_SESSION['forwarding']==0) {
      ?>
      <div style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:-1; pointer-events:none;">
        <img src="../img/content/segnali_controllo_no_forwarding.gif">
      </div>
      <?php
    }
    else {
      ?>
      <div style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:-1; pointer-events:none;">
        <img src="../img/content/segnali_controllo_forwarding.gif">
      </div>
      <?php
    }
  }
  ?>

  <!--#### LINK TO ELEMENTS-->
  <div style="z-index:2" class="istruzioni">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=istruzioni&PC=<?php echo isset($tempPC)?$tempPC:0;?>&istr=<?php echo isset($tempIstruzione)?$tempIstruzione:str_repeat('0',32);?>','','width=450,height=300');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION MEMORY">
    </a>
  </div>

  <div style="z-index:2" class="if_som">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=if_som&newPC=<?php echo isset($tempPC)?$tempPC:0;?>&PCpiu4=<?php echo isset($tempPC)?($tempPC+4):0;?>','','width=300,height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ADDER 1">
    </a>
  </div>

  <div style="z-index:2" class="if_mux">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=if_mux&newPC=<?php echo isset($newPC)?$newPC:0;?>&PCpiu4=<?php echo isset($newPC2)?$newPC2:0;?>&salto=<?php echo isset($newPC1)?$newPC1:0;?>&ctrl1=<?php echo isset($PCsrc)?(int)$PCsrc:0;?>&ctrl2=<?php echo 0;?>','','width=400,height=340');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION FETCH MULTIPLEXER">
    </a>
  </div>

  <div style="z-index:2" class="and">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=and&ctrl1=<?php echo isset($branchCmp)?(int)$branchCmp:1;?>&ctrl2=<?php echo isset($jump)?(int)$jump:0;?>&ris=<?php echo isset($PCsrc)?(int)$PCsrc:0;?>','','width=300,height=270');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="LOGIC AND">
    </a>
  </div>

  <div style="z-index:2" class="pc">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=pc&newPC=<?php echo isset($newPC)?$newPC:0;?>&PC=<?php echo isset($tempPC)?$tempPC:0;?>&ctrl=<?php echo isset($stallo)?(($stallo)?1:0):0;?>','','width=300,height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="PROGRAM COUNTER">
    </a>
  </div>

  <div style="z-index:2" class="criticita">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=criticita&rl1=<?php echo isset($RL1)?$RL1:0;?>&rl2=<?php echo isset($RL2)?$RL2:0;?>&stallo=<?php echo isset($stallo)?(($stallo)?1:0):0;?>&mem=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>&wb=<?php echo isset($EX_MEM_WB)?$EX_MEM_WB:0;?>&rd=<?php echo isset($ID_EX_RD)?$ID_EX_RD:0;?>','','width=400,height=270');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="HAZARD DETECTION UNIT">
    </a>
  </div>

  <div style="z-index:2" class="controllo">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=controllo&istr=<?php echo isset($istruzione)?substr($istruzione,17,3).substr($istruzione,25,7):str_repeat('0',10);?>&salta=<?php echo isset($jump)?(int)$jump:0;?>&ecc=<?php echo 0;?>&wb=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&mem=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',5);?>&ex=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',6);?>&if_scarta=<?php echo isset($IF_scarta)?$IF_scarta:0;?>&id_scarta=<?php echo isset($ID_scarta)?$ID_scarta:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>&isbranch=<?php echo isset($isBranch)?(int)$isBranch:0;?>&isjalr=<?php echo isset($isJalr)?(int)$isJalr:0;?>','','width=450,height=300');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="CONTROL UNIT">
    </a>
  </div>

  <div style="z-index:2" class="id_mux1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=id_mux1&ctrl=<?php echo isset($stallo)?(($stallo)?1:0):0;?>&wb=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&mem=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',5);?>&ex=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',6);?>&wb2=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&mem2=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',5);?>&ex2=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',6);?>','','width=360,height=280');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION DECODE MULTIPLEXER">
    </a>
  </div>

  <div style="z-index:2" class="or">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=or&stallo=<?php echo isset($stallo)?(($stallo)?1:0):0;?>&id_scarta=<?php echo isset($ID_scarta)?$ID_scarta:0;?>','','width=300,height=280');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="LOGIC OR">
    </a>
  </div>

  <div style="z-index:2" class="registri">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=registri&DL1=<?php echo isset($temp_ID_EX_Data1)?$temp_ID_EX_Data1:0;?>&DL2=<?php echo isset($temp_ID_EX_Data2)?$temp_ID_EX_Data2:0;?>&RL1=<?php echo isset($RL1)?$RL1:0;?>&RL2=<?php echo isset($RL2)?$RL2:0;?>&RW=<?php echo isset($MEM_WB_RegW)?$MEM_WB_RegW:0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>&RegWrite=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,0,1):0;?>','','width=400,height=380');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="32 REGISTERS (32-BIT)">
    </a>
  </div>

  <div style="z-index:2" class="branch_cmp">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=branch_cmp&data1=<?php echo isset($temp_ID_EX_Data1)?$temp_ID_EX_Data1:0;?>&data2=<?php echo isset($temp_ID_EX_Data2)?$temp_ID_EX_Data2:0;?>&aludata=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&memdata=<?php echo isset($temp_MEM_WB_DataR)?$temp_MEM_WB_DataR:0;?>&isbranch=<?php echo isset($isBranch)?(int)$isBranch:0;?>&funct3=<?php echo isset($temp_ID_EX_funct3)?$temp_ID_EX_funct3:0;?>&mux1=<?php echo isset($MuxBranchCmp1)?$MuxBranchCmp1:0;?>&mux2=<?php echo isset($MuxBranchCmp2)?$MuxBranchCmp2:0;?>&out=<?php echo isset($branchCmp)?(int)$branchCmp:1;?>','','width=400,height=320');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EQUAL">
    </a>
  </div>

  <div style="z-index:2" class="immgen">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=immgen&dato=<?php echo isset($istruzione)?$istruzione:str_repeat('0',32);?>&esteso=<?php echo isset($temp_ID_EX_imm)?$temp_ID_EX_imm:str_repeat('0',64);?>','','width=400,height=230');">
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
  
  <div style="z-index:2" class="ex_mux1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux1&dato=<?php echo isset($ID_EX_WB)?$ID_EX_WB:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 1">
    </a>
  </div>

  <div style="z-index:2" class="ex_mux5">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux5&op1=<?php echo isset($temp_ALUdato1)?$temp_ALUdato1:0;?>&op2=<?php echo isset($ID_EX_PC)?$ID_EX_PC:0;?>&ris=<?php echo isset($ALUdato1)?$ALUdato1:0;?>&ctrl=<?php echo isset($Mux5Ctrl)?$Mux5Ctrl:0;?>','','width=380,height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 5">
    </a>
  </div>

  <div style="z-index:2" class="ex_mux6">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux6&op1=<?php echo isset($temp_EX_MEM_DataW)?$temp_EX_MEM_DataW:0;?>&op2=<?php echo isset($ID_EX_immVal)?$ID_EX_immVal:0;?>&ris=<?php echo isset($ALUdato2)?$ALUdato2:0;?>&ctrl=<?php echo isset($Mux6Ctrl)?$Mux6Ctrl:0;?>','','width=380,height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 6">
    </a>
  </div>

  <div style="z-index:2" class="id_mux2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=id_mux2&op1=<?php echo isset($branchAddr)?$branchAddr:0;?>&op2=<?php echo isset($jalrAddr)?$jalrAddr:0;?>&ris=<?php echo isset($newPC1)?$newPC1:0;?>&ctrl=<?php echo isset($isJalr)?(int)$isJalr:0;?>','','width=380,height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 5">
    </a>
  </div>

  <div style="z-index:2" class="ex_mux2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux2&dato=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 2">
    </a>
  </div>

  <div style="z-index:2" class="alu">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=alu&valore1=<?php echo isset($ALUdato1)?$ALUdato1:0;?>&valore2=<?php echo isset($ALUdato2)?$ALUdato2:0;?>&ris=<?php echo isset($temp_EX_MEM_RIS)?$temp_EX_MEM_RIS:0;?>&ctrl=<?php echo (isset($aluCtrl)&&($aluCtrl!=''))?$aluCtrl:"00010";?>','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ARITHMETIC LOGIC UNIT">
    </a>
  </div>

  <div style="z-index:2" class="controlloalu">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=controlloalu&funct=<?php echo isset($ID_EX_funct7)?(isset($ID_EX_funct3)?(isset($ID_EX_campoOp)?GMPToBin($ID_EX_funct7,7,1)[1].GMPToBin($ID_EX_funct7,7,1)[6].GMPToBin($ID_EX_funct3,3,1).GMPToBin($ID_EX_campoOp,7,1)[3]:str_repeat('0',6)):str_repeat('0',6)):str_repeat('0',6);?>&aluOp=<?php echo isset($ALUOp)?$ALUOp:str_repeat('0',2);?>&ctrl=<?php echo (isset($aluCtrl)&&($aluCtrl!=''))?$aluCtrl:"00010";?>','','width=350,height=220');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ALU CONTROL UNIT">
    </a>
  </div>

  <?php if($_SESSION['forwarding']==1) 
  {
  ?>
    <div style="z-index:2" class="ex_mux3">
      <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux3&DL1=<?php echo isset($ID_EX_Data1)?$ID_EX_Data1:0;?>&mem_wb=<?php echo isset($WBdata)?$WBdata:0;?>&ex_mem=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo isset($Mux3Ctrl)?$Mux3Ctrl:0;?>&ris=<?php echo isset($ALUdato1)?$ALUdato1:0;?>','','width=400,height=250');">
      <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 3">
      </a>
    </div>
    
    <div style="z-index:2" class="ex_mux4">
      <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ex_mux4&DL1=<?php echo isset($ID_EX_Data2)?$ID_EX_Data2:0;?>&mem_wb=<?php echo isset($WBdata)?$WBdata:0;?>&ex_mem=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo isset($Mux4Ctrl)?$Mux4Ctrl:0;?>&ris=<?php echo isset($temp_EX_MEM_DataW)?$temp_EX_MEM_DataW:0;?>','','width=400,height=250');">
      <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 4">
      </a>
    </div>

    <div style="z-index:2" class="forward_alu">
      <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=forward_alu&rs1=<?php echo isset($ID_EX_RS1)?$ID_EX_RS1:0;?>&rs2=<?php echo isset($ID_EX_RS2)?$ID_EX_RS2:0;?>&mux1=<?php echo isset($Mux4Ctrl)?$Mux4Ctrl:0;?>&mux2=<?php echo isset($Mux3Ctrl)?$Mux3Ctrl:0;?>&regW1=<?php echo isset($EX_MEM_RegW)?$EX_MEM_RegW:0;?>&regW2=<?php echo isset($MEM_WB_RegW)?$MEM_WB_RegW:0;?>&mem1=<?php echo isset($EX_MEM_WB)?substr($EX_MEM_WB,0,1):0;?>&mem2=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,0,1):0;?>','','width=450,height=350');">
      <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="FORWARDING UNIT 1">
      </a>
    </div>

    <div style="z-index:2" class="forward_branch">
      <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=forward_branch&rs1=<?php echo isset($RL1)?$RL1:0;?>&rs2=<?php echo isset($RL2)?$RL2:0;?>&rd=<?php echo isset($EX_MEM_RegW)?$EX_MEM_RegW:0;?>&regwr=<?php echo isset($EX_MEM_WB)?substr($EX_MEM_WB,0,1):0;?>&memreg=<?php echo isset($EX_MEM_WB)?substr($EX_MEM_WB,1,1):0;?>&mux1=<?php echo isset($MuxBranchCmp1)?$MuxBranchCmp1:0;?>&mux2=<?php echo isset($MuxBranchCmp2)?$MuxBranchCmp2:0;?>','','width=450,height=350');">
      <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="FORWARDING UNIT 2">
      </a>
    </div>
  <?php
  }
  ?>

  <div style="z-index:2" class="memdati">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memdati&memW=<?php echo isset($EX_MEM_M)?substr($EX_MEM_M,1,1):0;?>&memR=<?php echo isset($EX_MEM_M)?substr($EX_MEM_M,0,1):0;?>&ind=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&DS=<?php echo isset($EX_MEM_DataW)?$EX_MEM_DataW:0;?>&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>','','width=350,height=380');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="DATA MEMORY">
    </a>
  </div>

  <div style="z-index:2" class="wb_mux">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=wb_mux&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo isset($MEM_WB_WB)?substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1)):0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=380,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="WRITE BACK MULTIPLEXER">
    </a>
  </div>

  <div style="z-index:2" class="id_som1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=id_som1&ifidPC=<?php echo isset($IF_ID_PC)?$IF_ID_PC:0;?>&immsl=<?php echo isset($tempImm)?$tempImm*2:0;?>&output=<?php echo isset($branchAddr)?$branchAddr:0;?>','','width=300,height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ADDER 2">
    </a>
  </div>

  <div style="z-index:2" class="id_som2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=id_som2&imm=<?php echo isset($tempImm)?$tempImm:0;?>&rs1=<?php echo isset($temp_ID_EX_Data1)?$temp_ID_EX_Data1:0;?>&output=<?php echo isset($jalrAddr)?$jalrAddr:0;?>','','width=300,height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ADDER 3">
    </a>
  </div>

  <div style="z-index:2" class="sl1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=sl1&input=<?php echo isset($tempImm)?GMPToBin($tempImm,64,0):str_repeat('0',64);?>&output=<?php echo isset($tempImm)?GMPToBin($tempImm*2,64,0):str_repeat('0',64);?>','','width=400,height=230');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="SHIFT LEFT 1">
    </a>
  </div>


  <!--#### REGISTRI DELLA PIPELINE-->

  <div class="if_id if_id_latch" style="width:40px; height:293px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ifid','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="IF/ID LATCHES">
    </a>
  </div>

  <div class="id_ex id_ex_latch" style="width:40px; height:412px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idex','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX LATCHES">
    </a>
  </div>

  <div class="ex_mem ex_mem_latch" style="width:40px; height:376px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmem','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM LATCHES">
    </a>
  </div>

  <div class="mem_wb mem_wb_latch" style="width:40px; height:346px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memwb','','width=350,height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="MEM/WB LATCHES">
    </a>
  </div>

  <div class="id_ex id_ex_wb" style="width:40px; height:35px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexwb&dataIn=<?php echo isset($ctrl_WB)?$ctrl_WB:str_repeat('0',2);?>&dataOut=<?php echo isset($ID_EX_WB)?$ID_EX_WB:str_repeat('0',2);?>','','width=290,height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.WB REGISTER">
    </a>
  </div>

  <div class="id_ex id_ex_mem" style="width:40px; height:35px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexmem&dataIn=<?php echo isset($ctrl_M)?$ctrl_M:str_repeat('0',5);?>&dataOut=<?php echo isset($ID_EX_M)?$ID_EX_M:str_repeat('0',5);?>','','width=290,height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.MEM REGISTER">
    </a>
  </div>

  <div class="id_ex id_ex_ex" style="width:40px; height:35px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexex&dataIn=<?php echo isset($ctrl_EX)?$ctrl_EX:str_repeat('0',6);?>&dataOut=<?php echo isset($ID_EX_EX)?$ID_EX_EX:str_repeat('0',6);?>','','width=290,height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.EX REGISTER">
    </a>
  </div>

  <div class="ex_mem ex_mem_wb" style="width:40px; height:35px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmemwb&dataIn=<?php echo isset($ID_EX_WB)?$ID_EX_WB:str_repeat('0',2);?>&dataOut=<?php echo isset($EX_MEM_WB)?$EX_MEM_WB:str_repeat('0',2);?>','','width=290,height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM.WB REGISTER">
    </a>
  </div>

  <div class="ex_mem ex_mem_mem" style="width:40px; height:35px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmemmem&dataIn=<?php echo isset($ID_EX_M)?$ID_EX_M:str_repeat('0',5);?>&dataOut=<?php echo isset($EX_MEM_M)?$EX_MEM_M:str_repeat('0',5);?>','','width=290,height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM.MEM REGISTER">
    </a>
  </div>

  <div class="mem_wb mem_wb_wb" style="width:40px; height:35px; z-index:2">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memwbwb&dataIn=<?php echo isset($EX_MEM_WB)?$EX_MEM_WB:str_repeat('0',2);?>&dataOut=<?php echo isset($MEM_WB_WB)?$MEM_WB_WB:str_repeat('0',2);?>','','width=290,height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="MEM/WB.WB REGISTER">
    </a>
  </div>

</body>
</html>

