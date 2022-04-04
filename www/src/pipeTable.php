<?php
/**
 * WebRISC-V
 *
 * @copyright Copyright (c) 2019, Roberto Giorgi and Gianfranco Mariotti, University of Siena, Italy
 * @license   BSD-3-Clause
 */

session_start();
if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="icon" href="../img/content/favicon.ico" type="image/x-icon">
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <script language='JavaScript' type='text/JavaScript'>
    function togglePipeType() {
      pipeCut=!pipeCut;
      if (pipeCut) {
        document.getElementById('btnPipeType').innerText='Show Entire Table';
        document.getElementById('labelPipeTypeExp').style.display='none';
        document.getElementById('simplePipeTable').style.display='none';
        document.getElementById('squashedPipeTable').style.display='none';
        document.getElementById('squashedLoopList').style.display='none';
        if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='squashed') {
          document.getElementById('labelPipeType').style.display=(pipeCutSquash)?'':'none';
          document.getElementById('simplePipeTableCut').style.display='none';
          document.getElementById('squashedPipeTableCut').style.display='';
          document.getElementById('squashedLoopListCut').style.display='';
        }
        if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='normal') {
          document.getElementById('labelPipeType').style.display='';
          document.getElementById('squashedPipeTableCut').style.display='none';
          document.getElementById('squashedLoopListCut').style.display='none';
          document.getElementById('simplePipeTableCut').style.display='';
        }
      }
      else {
        document.getElementById('btnPipeType').innerText='Show Last 50 Entries';
        document.getElementById('labelPipeType').style.display='none';
        document.getElementById('simplePipeTableCut').style.display='none';
        document.getElementById('squashedPipeTableCut').style.display='none';
        document.getElementById('squashedLoopListCut').style.display='none';
        if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='squashed') {
          document.getElementById('labelPipeTypeExp').style.display=(pipeCutSquash)?'':'none';
          document.getElementById('simplePipeTable').style.display='none';
          document.getElementById('squashedPipeTable').style.display='';
          document.getElementById('squashedLoopList').style.display='';
        }
        if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='normal') {
          document.getElementById('labelPipeTypeExp').style.display='';
          document.getElementById('squashedPipeTable').style.display='none';
          document.getElementById('squashedLoopList').style.display='none';
          document.getElementById('simplePipeTable').style.display='';
        }
      }
    }
    function togglePipe() {
      if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='squashed') {
        if (pipeCut) {
          if (pipeCutSquash) {
            document.getElementById('labelPipeType').style.display='';
            document.getElementById('btnPipeType').style.display='';
            document.getElementById('togglePipe').style.top='67px';
          }
          else {
            document.getElementById('labelPipeType').style.display='none';
            document.getElementById('btnPipeType').style.display='none';
            document.getElementById('togglePipe').style.top='35px';
          }
          document.getElementById('simplePipeTableCut').style.display='none';
          document.getElementById('squashedPipeTableCut').style.display='';
          document.getElementById('squashedLoopListCut').style.display='';
        }
        else {
          if (pipeCutSquash) {
            document.getElementById('labelPipeTypeExp').style.display='';
            document.getElementById('btnPipeType').style.display='';
            document.getElementById('togglePipe').style.top='67px';
          }
          else {
            document.getElementById('labelPipeTypeExp').style.display='none';
            document.getElementById('btnPipeType').style.display='none';
            document.getElementById('togglePipe').style.top='35px';
          }
          document.getElementById('simplePipeTable').style.display='none';
          document.getElementById('squashedPipeTable').style.display='';
          document.getElementById('squashedLoopList').style.display='';
        }
      }
      if (document.getElementById('togglePipe') && document.getElementById('togglePipe').value=='normal') {
        if (pipeCut) {
          document.getElementById('labelPipeType').style.display='';
          document.getElementById('btnPipeType').style.display='';
          document.getElementById('togglePipe').style.top='67px';
          document.getElementById('squashedPipeTableCut').style.display='none';
          document.getElementById('squashedLoopListCut').style.display='none';
          document.getElementById('simplePipeTableCut').style.display='';
        }
        else {
          if (pipeCutFull) {
            document.getElementById('labelPipeTypeExp').style.display='';
            document.getElementById('btnPipeType').style.display='';
            document.getElementById('togglePipe').style.top='67px';
          }
          else {
            document.getElementById('labelPipeTypeExp').style.display='none';
            document.getElementById('btnPipeType').style.display='none';
            document.getElementById('togglePipe').style.top='35px';
          }
          document.getElementById('squashedPipeTable').style.display='none';
          document.getElementById('squashedLoopList').style.display='none';
          document.getElementById('simplePipeTable').style.display='';
        }
      }
    };
  </script>
  <meta name="robots" content="noindex">
</head>
<body bgcolor="#f0f0f0" style="margin: 5px;">
<?php
  $trailLen=count($_SESSION['data'][$_SESSION['index']]['execTrail']);
  if ($trailLen==0) {
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
  $block=array();
  for ($startPos=0; $startPos<$trailLen; $startPos++) {
    for ($distance=1; $distance<($trailLen-$startPos); $distance++) {
      $sequencesAreEqual=true;
      for ($i=0; $i<$distance; $i++) {
        if (($startPos+$distance+$i)>=$trailLen) {
          $sequencesAreEqual=false;
          break;
        }
        if ($rmInstrTrail[$startPos + $i]!=$rmInstrTrail[$startPos+$distance+$i]) {
          $sequencesAreEqual=false;
          break;
        }
      }
      if ($sequencesAreEqual) {
        $reps=1;
        $do=true;
        while($do) {
          $reps++;
          for ($i=0; $i<$distance; $i++) {
            if (($startPos+$distance*$reps+$i)>=$trailLen) {
              $do=false;
              break;
            }
            if ($rmInstrTrail[$startPos+$i]!=$rmInstrTrail[$startPos+$distance*$reps+$i]) {
              $do=false;
              break;
            }
          }
        }
        array_push($block,array($startPos,$distance,$reps));
        $startPos=$startPos+$distance*$reps-1;
        break;
      }
    }
  }

  foreach ($block as $elem) {
    $start=$elem[0];
    $length=$elem[1]*($elem[2]-1);
    for ($i=0; $i<$length; $i++) {
      $rmInstrTrail[$start+$i]=NULL;
    }
  }

  $rmInstrList=array();
  $rmInstr=array(NULL,NULL);
  for ($i=0; $i<$trailLen; $i++) {
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

  $a=array();
  for ($i=0; $i<$trailLen; $i++) {
    for ($j=1; $j<=$clock; $j++) {
      if (isset($_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i]))
        $a[$i][$j]=$_SESSION['data'][$_SESSION['index']]['pipeTable'][$j][$i];
    }
  }

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

    for ($i=0; $i<$trailLen; $i++) {
      for ($j=1; $j<=$clock; ++$j) {
        if (isset($b[$i][$j]))
          $a[$i][$j-$reductCycle]=$b[$i][$j];
      }
    }
  }

  $c=array();
  for ($i=0; $i<$trailLen; $i++) {
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
    $stop=$start+$block[$i][1]-1;
    array_push($finalInstrList,array($rmInstrTrail[$start],$rmInstrTrail[$stop]));

    $range=array(NULL,NULL);
    for ($j=1; $j<=($clock-$totReductCycle); $j++) {
      if (array_key_exists($start, $c[$j]) && $c[$j][$start]=='F'){
        $range[0]=$j;
        break;
      }
    }
    for ($j=1; $j<=($clock-$totReductCycle); $j++) {
      if (array_key_exists($stop, $c[$j]) && $c[$j][$stop]=='F'){
        $range[1]=$j;
        break;
      }
    }

    $markerList[$range[0]]=-1;
    $markerList[$range[1]]=1;
    array_push($finalCycleList,$range);
  }

  $clockCut=50;
  echo "<button id='btnPipeType' style='display: none; margin-right: 5px; margin-bottom: 10px;' onclick='javascript: window.togglePipeType();'>Show Entire Table</button>";
  echo "<span id='labelPipeType' style='display: none; position: absolute; white-space: nowrap; top: 7px;'>ALERT: entire table may take much time to render, now showing only last {$clockCut} clock ticks</span>";
  echo "<span id='labelPipeTypeExp' style='display: none; position: absolute; white-space: nowrap; top: 7px;'>ALERT: entire table may take much time to render, now showing entire table</span>";

  // NORMAL PIPELINE DIAGRAM (CUT)
  echo "<table id='simplePipeTableCut' style='border-collapse: collapse; display: none;'>";
  $startj=(($clock-$clockCut)>0?($clock-$clockCut):1);
  $active = true;
  for ($i=0; $i<$trailLen; ++$i) {
    $a=$_SESSION['data'][$_SESSION['index']]['execTrail'][$i];
    if ($a===NULL) continue;
    $istruzione=encInstr($_SESSION['memIstr'][$a]);
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
      for ($j=$startj; $j<=$clock; ++$j) {
        echo "<td style='background-color: white;' class='pipeTd'><div style='padding: 1px 2px;'>".$j."</div></td>";
      }
      echo "</tr>";
    }

    if ($active) {
    $present=false;
    for ($j=$startj; $j<=$clock; ++$j) {
      if (array_key_exists($i, $_SESSION['data'][$_SESSION['index']]['pipeTable'][$j])){
        $present=true;
      }
    }
    if ($present==false) continue;
    }
    $active=false;

    echo "<tr class='alternating'>";
    echo "<td class='pipeTd' style='min-width:125px;'>".$istruzione."</td>";
    for ($j=$startj; $j<=$clock; ++$j) {
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

  // SQUASHED PIPELINE DIAGRAM (CUT)
  echo "<table id='squashedPipeTableCut' style='border-collapse: collapse; display: none;'>";
  $startj=(($clock-$totReductCycle-$clockCut)>0?($clock-$totReductCycle-$clockCut):1);
  $active=true;
  $markerstart=false;
  for ($i=0; $i<$trailLen; ++$i) {
    $a=$rmInstrTrail[$i];
    if ($a===NULL) continue;
    $istruzione=encInstr($_SESSION['memIstr'][$a]);
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
      for ($j=$startj; $j<=($clock-$totReductCycle); ++$j) {
        echo "<td style='background-color: white;' class='pipeTd'><div style='padding: 1px 2px;'>".$j."</div></td>";
      }
      echo "</tr>";
    }

    if ($active) {
    $present=false;
    for ($j=$startj; $j<=($clock-$totReductCycle); ++$j) {
      if (array_key_exists($i, $c[$j])){
        $present=true;
      }
    }
    if ($present==false) continue;
    }
    $active=false;

    echo "<tr class='alternating'>";
    echo "<td class='pipeTd' style='min-width:125px;'>".$istruzione."</td>";
    for ($j=$startj; $j<=($clock-$totReductCycle); ++$j) {
      echo "<td class='pipeTd'>";
      if (array_key_exists($i, $c[$j])){
        if ($j>1 && array_key_exists($i, $c[$j-1]) && $c[$j][$i]==$c[$j-1][$i])
          echo "<div style='padding: 1px 2px;'>-</div>";
        else {
          if ($markerList!=NULL && array_key_exists($j,$markerList)) {
            if ($markerList[$j]==-1 && $c[$j][$i]=="F") {
              echo "<div style='border-left: 2px solid red; padding: 1px 2px;'>".$c[$j][$i]."</div>";
              $markerstart=true;
            }
            else if ($markerList[$j]==1 && $c[$j][$i]=="F" && $markerstart)
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

  echo "<div id='squashedLoopListCut' style='display: none;'>";
  for ($i=0; $i<count($finalInstrList); $i++) {
    if ($startj<=$finalCycleList[$i][0]) {
      echo "<pre>LOOP #".$i." - '".encInstr($_SESSION['memIstr'][$finalInstrList[$i][0]])."' TO '".encInstr($_SESSION['memIstr'][$finalInstrList[$i][1]])."': ".($finalCycleList[$i][1]-$finalCycleList[$i][0]+1)." cycles ".$block[$i][2]." times</pre>";
    }
  }
  echo "</div>";


  // NORMAL PIPELINE DIAGRAM
  echo "<table id='simplePipeTable' style='border-collapse: collapse; display: none;'>";
  for ($i=0; $i<$trailLen; ++$i) {
    $a=$_SESSION['data'][$_SESSION['index']]['execTrail'][$i];
    if ($a===NULL) continue;
    $istruzione=encInstr($_SESSION['memIstr'][$a]);
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
  for ($i=0; $i<$trailLen; ++$i) {
    $a=$rmInstrTrail[$i];
    if ($a===NULL) continue;
    $istruzione=encInstr($_SESSION['memIstr'][$a]);
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
    echo "<pre>LOOP #".$i." - '".encInstr($_SESSION['memIstr'][$finalInstrList[$i][0]])."' TO '".encInstr($_SESSION['memIstr'][$finalInstrList[$i][1]])."': ".($finalCycleList[$i][1]-$finalCycleList[$i][0]+1)." cycles ".$block[$i][2]." times</pre>";
  }
  echo "</div>";

  echo "<script language='JavaScript' type='text/JavaScript'>document.getElementById('loadingAlert').style.display='none';</script>";
  echo '<select id="togglePipe" style="position: absolute; top: 35px; left: 10px; width: 115px; font-size: 7pt" onchange="javascript: window.togglePipe();"><option value="normal" selected>FULL LOOPS</option><option value="squashed">SQUASHED LOOPS</option></select>';
  if ($clock>$clockCut) {
    ?>
    <script language='JavaScript' type='text/JavaScript'>
      pipeCut=true;
      pipeCutFull=true;
      <?php if ($clock-$totReductCycle>$clockCut) {?>pipeCutSquash=true;<?php } else {?>pipeCutSquash=false;<?php }?>
      document.getElementById('togglePipe').style.top='67px';
      document.getElementById('simplePipeTableCut').style.display='';
      document.getElementById('labelPipeType').style.display='';
      document.getElementById('btnPipeType').style.display='';
    </script>
    <?php
  }
  else {
    echo "<script language='JavaScript' type='text/JavaScript'>document.getElementById('simplePipeTable').style.display='';</script>";
  }
?>
</body>
</html>