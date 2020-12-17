<?php
session_start();
if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <script language='JavaScript' type='text/JavaScript'>
    function togglePipe() {
      if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='squashed') {
        document.getElementById('simplePipeTable').style.display='none';
        document.getElementById('squashedPipeTable').style.display='';
        document.getElementById('squashedLoopList').style.display='';
      }
      if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='normal') {
        document.getElementById('squashedPipeTable').style.display='none';
        document.getElementById('squashedLoopList').style.display='none';
        document.getElementById('simplePipeTable').style.display='';
      }
    };
  </script>
  <meta name="robots" content="noindex">
</head>
<body bgcolor="#f0f0f0" style="margin: 5px;">
<?php
  if (count($_SESSION['data'][$_SESSION['index']]['execTrail'])==0) {
    echo "<table style='border-collapse: collapse;'>";
    echo "<tr>";
    echo "<td align='center' style='padding-bottom: 10px;'>EXECUTION TABLE</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center' style='background-color: white; border: 1px solid;'>EMPTY</td>";
    echo "</tr>";
    echo "</table>";
    exit;
  }

  require_once 'functions.php';

  echo '<span id="loadingAlert" style="position: absolute; top: 5px;">LOADING...</span>';

  $clock=($_SESSION['data'][$_SESSION['index']]['finito'])?$_SESSION['data'][$_SESSION['index']]['clock']-1:$_SESSION['data'][$_SESSION['index']]['clock'];

  $rmInstrTrail=$_SESSION['data'][$_SESSION['index']]['execTrail'];
  $sequences=array();
  for ($startPos=0; $startPos<count($rmInstrTrail); $startPos++) {
    for ($sequenceLength=1; $sequenceLength<=(count($rmInstrTrail)-$startPos)/2; $sequenceLength++) {
      $sequencesAreEqual=true;
      for ($i=0; $i<$sequenceLength; $i++) {
        if (($rmInstrTrail[$startPos+$i]==NULL)||($rmInstrTrail[$startPos + $i]!=$rmInstrTrail[$startPos+$sequenceLength+$i])) {
          $sequencesAreEqual=false;
          break;
        }
      }
      if ($sequencesAreEqual) {
        $rmInstrTrail=array_merge(array_slice($rmInstrTrail,0,$startPos),array_fill(0, $sequenceLength, NULL),array_slice($rmInstrTrail,$startPos+$sequenceLength));
        array_push($sequences,array($startPos,$sequenceLength));
        $startPos=0;
        $sequenceLength=1;
      }
    }
  }

  $rmInstrList=array();
  $rmInstr=array(NULL,NULL);
  for ($i=0; $i<count($rmInstrTrail); $i++) {
    if ($rmInstrTrail[$i]===NULL) {
        if ($rmInstr[0]===NULL) $rmInstr[0]=$i;
        else $rmInstr[1]=$i;
      }
      else {
        if ($rmInstr[0]!=NULL && $rmInstr[1]!=NULL) {
          array_push($rmInstrList,$rmInstr);
          $rmInstr=array(NULL,NULL);
      }
    }
  }

  $repeat=array();
  for ($i=0; $i<count($rmInstrList); $i++) {
    $start=$rmInstrList[$i][0];
    $stop=$rmInstrList[$i][1];
    $rep=1;
    $step=0;
    for ($j=0; $j<count($sequences); $j++) {
      if ($sequences[$j][0]>=$start && $sequences[$j][0]<=$stop) {
        $rep++;
        $step=$sequences[$j][1];
      }
    }
    array_push($repeat,array($step,$rep));
  }

  $c=array();
  for ($i=0; $i<count($_SESSION['data'][$_SESSION['index']]['execTrail']); $i++) {
    for ($j=1; $j<=$clock; $j++) {
      if (isset($_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]))
        $c[$i][$j]=$_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i];
    }
  }

  $a=$c;
  $totReductCycle=0;
  for ($k=0; $k<count($rmInstrList); $k++) {
    $range=array(NULL,NULL);
    $i=$rmInstrList[$k][0];
    for ($j=1; $j<=$clock; $j++) {
      if (array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j]) && $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]=='F'){
        $range[0]=$j;
        break;
      }
    }
    $i=$rmInstrList[$k][1];
    for ($j=1; $j<=$clock; $j++) {
      if (array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j]) && $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]=='F'){
        $range[1]=$j;
        break;
      }
    }

    $temp=$a;
    $a=array();
    $b=array();
    foreach ($temp as $instr => $arr) {
      if ($instr<$rmInstrList[$k][0]) $a[$instr]=$arr;
      if ($instr>$rmInstrList[$k][1]) $b[$instr]=$arr;
    }

    $reductCycle=($range[1]-$range[0]+1);
    $totReductCycle+=$reductCycle;

    for ($i=0; $i<count($_SESSION['data'][$_SESSION['index']]['execTrail']); $i++) {
      for ($j=1; $j<=$clock; ++$j) {
        if (isset($b[$i][$j]))
          $a[$i][$j-$reductCycle]=$b[$i][$j];
      }
    }
  }

  $c=array();
  for ($i=0; $i<count($_SESSION['data'][$_SESSION['index']]['execTrail']); $i++) {
    for ($j=1; $j<=$clock; $j++) {
      if (isset($a[$i][$j]))
        $c[$j][$i]=$a[$i][$j];
    }
  }

  $finalInstrList=array();
  $finalCycleList=array();
  $markerList=array();
  for ($i=0; $i<count($rmInstrList); $i++) {
    $start=$rmInstrList[$i][1]+1;
    $stop=$start+$repeat[$i][0]-1;
    array_push($finalInstrList,array($rmInstrTrail[$start],$rmInstrTrail[$stop]));

    $range=array(NULL,NULL);
    for ($j=1; $j<=$clock; $j++) {
      if (array_key_exists($start, $c[$j]) && $c[$j][$start]=='F'){
        $range[0]=$j;
        break;
      }
    }
    for ($j=1; $j<=$clock; $j++) {
      if (array_key_exists($stop, $c[$j]) && $c[$j][$stop]=='F'){
        $range[1]=$j;
        break;
      }
    }

    $markerList[$range[0]]=-1;
    $markerList[$range[1]]=1;
    array_push($finalCycleList,$range);
  }

  // NORMAL PIPELINE DIAGRAM
  echo "<table id='simplePipeTable' style='border-collapse: collapse;'>";
  for ($i=0; $i<count($_SESSION['data'][$_SESSION['index']]['execTrail']); ++$i) {
    $a=$_SESSION['data'][$_SESSION['index']]['execTrail'][$i];
    if ($a===NULL) continue;
    $istruzione=encodeIstr($_SESSION['memIstr'][$a]);
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
        echo "<td style='background-color: white;' class='pipeTd'><div style='padding: 1px 2px;'>".$j."</div></td>";
      }
      echo "</tr>";
    }

    echo "<tr class='alternating'>";
    echo "<td class='pipeTd' style='min-width:125px;'>".$istruzione."</td>";
    for ($j=1; $j<=$clock; ++$j) {
      echo "<td class='pipeTd'>";
      if (array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j])){
        if ($j>1 && array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j-1]) && $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]==$_SESSION['data'][$_SESSION['index']]['pipeTable'][$j-1][$i])
          echo "<div style='padding: 1px 2px;'>-</div>";
        else {
          echo "<div style='padding: 1px 2px;'>".$_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]."</div>";
        }
      }
      echo "</td>";
    }
    echo "</tr>";
  }
  echo "</table>";

  // SQUASHED PIPELINE DIAGRAM
  echo "<table id='squashedPipeTable' style='border-collapse: collapse; display: none;'>";
  for ($i=0; $i<count($rmInstrTrail); ++$i) {
    $a=$rmInstrTrail[$i];
    if ($a===NULL) continue;
    $istruzione=encodeIstr($_SESSION['memIstr'][$a]);
    if ($i==0) {
      echo "<tr>";
      echo "<td align='center' colspan='".(($clock-$totReductCycle)+1)."' style='padding-bottom: 10px;'>EXECUTION TABLE</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td></td>";
      echo "<td style='background-color: white;' class='pipeTd' colspan='".($clock-$totReductCycle)."'>CPU Cycles</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td class='pipeTd' style='background-color: white; min-width:125px;'> Instruction</td>";
      for ($j=1; $j<=($clock-$totReductCycle); ++$j) {
        echo "<td style='background-color: white;' class='pipeTd'><div style='padding: 1px 2px;'>".$j."</div></td>";
      }
      echo "</tr>";
    }

    echo "<tr class='alternating'>";
    echo "<td class='pipeTd' style='min-width:125px;'>".$istruzione."</td>";
    for ($j=1; $j<=($clock-$totReductCycle); ++$j) {
      echo "<td class='pipeTd'>";
      if (array_key_exists($i, $c[$j])){
        if ($j>1 && array_key_exists($i, $c[$j-1]) && $c[$j][$i]==$c[$j-1][$i])
          echo "<div style='padding: 1px 2px;'>-</div>";
        else {
          if ($markerList!=NULL && array_key_exists($j,$markerList)) {
            if ($markerList[$j]==-1 && $c[$j][$i]=="F")
              echo "<div style='border-left: 2px solid red; padding: 1px 2px;'>".$c[$j][$i]."</div>";
            else if ($markerList[$j]==1 && $c[$j][$i]=="F")
              echo "<div style='border-right: 2px solid red; padding: 1px 2px;'>".$c[$j][$i]."</div>";
            else
              echo "<div style='padding: 1px 2px;'>".$c[$j][$i]."</div>";
          }
          else
            echo "<div style='padding: 1px 2px;'>".$c[$j][$i]."</div>";
        }
      }
      echo "</td>";
    }
    echo "</tr>";
  }
  echo "</table>";

  echo "<div id='squashedLoopList' style='display: none;'>";
  for ($i=0; $i<count($finalInstrList); $i++) {
    echo "<pre>LOOP #".$i." - '".encodeIstr($_SESSION['memIstr'][$finalInstrList[$i][0]])."' TO '".encodeIstr($_SESSION['memIstr'][$finalInstrList[$i][1]])."': ".($finalCycleList[$i][1]-$finalCycleList[$i][0]+1)." cycles ".$repeat[$i][1]." times</pre>";
  }
  echo "</div>";

  echo "<script language='JavaScript' type='text/JavaScript'>document.getElementById('loadingAlert').style.display='none';</script>";
  echo '<select id="togglePipe" style="position: absolute; top: 5px; width: 115px; font-size: 7pt" onchange="javascript: window.togglePipe();"><option value="normal" selected>FULL LOOPS</option><option value="squashed">SQUASHED LOOPS</option></select>';
?>
</body>
</html>