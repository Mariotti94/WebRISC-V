<?php
session_start();
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <meta name="robots" content="noindex">
</head>
<body bgcolor="#f0f0f0" style="margin: 5px;">

<table  style="border-collapse: collapse;">
<?php
  require_once 'functions.php';
  $clock=($_SESSION['data'][$_SESSION['index']]['finito'])?$_SESSION['data'][$_SESSION['index']]['clock']-1:$_SESSION['data'][$_SESSION['index']]['clock'];

  for ($i=0; $i<count($_SESSION['data'][$_SESSION['index']]['execTrail']); ++$i) {
    $a=$_SESSION['data'][$_SESSION['index']]['execTrail'][$i];
    $op=substr($a,25,7);
    $funct3=substr($a,17,3);
    $funct7=substr($a,0,7);
    $rs2=substr($a,7,5);

    $tipo=instrType(BinToGMP($op,1));
    $oper=instrName(BinToGMP($op,1),BinToGMP($funct3,1),BinToGMP($funct7,1),BinToGMP($rs2,1));

    $istruzione='';

    if ($tipo=="R")
    {
      $rd=substr($a,20,5);
      $rs1=substr($a,12,5);
      $rs2=substr($a,7,5);
      $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".codRegister(BinToGMP($rs2,1));
    }
    else if ($tipo=="I")
    {
      $rd=substr($a,20,5);
      $rs1=substr($a,12,5);
      $imm=substr($a,0,12);
      $check=BinToGMP($op,1);
      if ($check==hexdec(3) || $check==hexdec(67))
      {
        $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,0)."(".codRegister(BinToGMP($rs1,1)).")";
      }
      else
      {
        if (BinToGMP($op,1)==hexdec(13) && (BinToGMP($funct3,1)==1 || BinToGMP($funct3,1)==5) )
          $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".BinToGMP(substr($a,7,5),0);
        else if (BinToGMP($op,1)!=hexdec(73) )
          $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".BinToGMP($imm,0);
        else
          $istruzione=$oper;
      }

    }
    else if ($tipo=="S")
    {
      $imm=substr($a,0,7).substr($a,20,5);
      $rs1=substr($a,12,5);
      $rs2=substr($a,7,5);
      $istruzione=$oper." ".codRegister(BinToGMP($rs2,1)).", ".BinToGMP($imm,0)."(".codRegister(BinToGMP($rs1,1)).")";
    }
    else if ($tipo=="SB")
    {
      $imm=substr($a,0,1).substr($a,24,1).substr($a,1,6).substr($a,20,4).'0';
      $rs1=substr($a,12,5);
      $rs2=substr($a,7,5);
      $istruzione=$oper." ".codRegister(BinToGMP($rs1,1)).", ".codRegister(BinToGMP($rs2,1)).", ".BinToGMP($imm,0)*2;
    }
    else if ($tipo=="U")
    {
      $rd=substr($a,20,5);
      $imm=substr($a,0,20);
      $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,0);
    }
    else if ($tipo=="UJ")
    {
      $rd=substr($a,20,5);
      $imm=substr($a,0,1).substr($a,12,8).substr($a,11,1).substr($a,1,10).'0';
      $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,0)*2;
    }


    if ($i==0) {
      echo "<tr>";
      echo "<td align='center' colspan='".($clock+1)."' style='padding-bottom: 10px;'>EXECUTION TABLE</td>";
      echo "</tr>";
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
      if (array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j])){
        if ($j>1 && array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j-1]) && $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]==$_SESSION['data'][$_SESSION['index']]['pipeTable'][$j-1][$i])
          echo "-";
        else
          echo $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i];
      }
      echo "</td>";
    }
    echo "</tr>";
  }

  if (count($_SESSION['data'][$_SESSION['index']]['execTrail'])==0) {
    echo "<tr>";
    echo "<td align='center' style='padding-bottom: 10px;'>EXECUTION TABLE</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center' style='background-color: white; border: 1px solid;'>EMPTY</td>";
    echo "</tr>";
  }

?>
</table>
</body>
</html>