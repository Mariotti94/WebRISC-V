<?php
session_start();
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <script language='JavaScript' type='text/JavaScript'>
    window.onload = function() {
      //RESIZE FLOATING BOX
      var counter=top.frames[1].document.getElementById('counter');
      var destraTop=top.frames[1].document.getElementById('destraTop');
      counter.style.marginTop=-(counter.offsetHeight+1);
      destraTop.style.marginTop=(counter.offsetHeight+1);
      //DEACTIVATE BUTTONS
      var backButton=top.frames[0].document.getElementById('backButton');
      var stepButton=top.frames[0].document.getElementById('stepButton');
      var allButton=top.frames[0].document.getElementById('allButton');
      if (<?php echo (!$_SESSION['data'][$_SESSION['index']]['clock'])?'true':'false'; ?>) {
        backButton.getElementsByTagName('a')[0].setAttribute('class','link4disabled');
      }
      else {
        backButton.getElementsByTagName('a')[0].setAttribute('class','link4');
      }
      if (<?php echo ($_SESSION['data'][$_SESSION['index']]['finito']||!$_SESSION['loaded'])?'true':'false'; ?>) {
        stepButton.getElementsByTagName('a')[0].setAttribute('class','link4disabled');
        allButton.getElementsByTagName('a')[0].setAttribute('class','link4disabled');
      }
      else {
        stepButton.getElementsByTagName('a')[0].setAttribute('class','link4');
        allButton.getElementsByTagName('a')[0].setAttribute('class','link4');
      }
      //INSTRUCTION MEMORY: SCROLL INSTRUCTIONS INTO VIEW
      if (top.frames[1].document.getElementById('memIstr')) {
        if (top.frames[1].document.getElementById('ifStage')) {
          top.frames[1].document.getElementById('ifStage').scrollIntoView({block: 'center'});
          top.frames[1].scrollBy(0,-(window.innerHeight/5));
        } else if (top.frames[1].document.getElementById('idStage')) {
          top.frames[1].document.getElementById('idStage').scrollIntoView({block: 'center'});
          top.frames[1].scrollBy(0,-(window.innerHeight/5));
        } else if (top.frames[1].document.getElementById('exStage')) {
          top.frames[1].document.getElementById('exStage').scrollIntoView({block: 'center'});
          top.frames[1].scrollBy(0,-(window.innerHeight/5));
        } else if (top.frames[1].document.getElementById('memStage')) {
          top.frames[1].document.getElementById('memStage').scrollIntoView({block: 'center'});
          top.frames[1].scrollBy(0,-(window.innerHeight/5));
        } else if (top.frames[1].document.getElementById('wbStage')) {
          top.frames[1].document.getElementById('wbStage').scrollIntoView({block: 'center'});
          top.frames[1].scrollBy(0,-(window.innerHeight/5));
        }
      }
    };
  </script>
  <meta name="robots" content="noindex">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#d4d0c8">
<?php
$destra=isset($_GET['dst'])?$_GET["dst"]:"";

if (!$_SESSION['loaded'] || empty($_SESSION['codice'])) {
  $_SESSION['asmName']='not loaded';
}
else {
  if ($_SESSION['asmName']=='not loaded')
    $_SESSION['asmName']='handwritten.s';
}
?>
<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" id="counter">
  <tr>
    <td width="50%" style="padding: 4px 0px 4px 16px;" class="testoGrande" id="asmNameTd"><?php echo $_SESSION['asmName']; ?></td>
    <td align="right" width="50%" style="padding: 4px 16px 4px 0px;" class="testoGrande"><?php if(!$_SESSION['data'][$_SESSION['index']]['finito']) echo 'current cycle: <span id="cycleCount">'.(($_SESSION['data'][$_SESSION['index']]['clock']!=0)?$_SESSION['data'][$_SESSION['index']]['clock']:'-').'</span>'; ?>
</td>
  </tr>
  <tr>
    <td align="center" valign="middle" colspan="2">
      <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
      <td align="center" width="50%" style="padding: 0px 3px 0px 6px;">
      <a style="font-size: 14px; display: block; border: 1px solid black; padding: 2px 5px;" class="link4"  href="javascript:void(0);" onclick="javascript:window.open('pipeTable.php','','width=600,height=400');">EXECUTION TABLE</a>
      </td>
      <td align="center" width="50%" style="padding: 0px 6px 0px 3px;">
      <a style="font-size: 14px;  display: block; border: 1px solid black; padding: 2px 37px 2px 38px; " class="link4"  href="javascript:void(0);" onclick="javascript:window.open('console.php','','width=600,height=400');">CONSOLE</a>
      </td>
      </tr>
      </table>
    </td>
  </tr>
  
  <?php  
  if ($_SESSION['data'][0]['sysHold']) { 
    for($i=0; $i<3; ++$i) { 
  ?>
  <tr>
    <td><img src="../img/layout/x.gif" width="2"></td>
  </tr>
  <?php } ?>
    <tr>
      <td align="center" valign="middle" colspan="2">
        <span style="padding:2px 5px; border:1px solid red; color:red; font-size: 15px;" id="consoleAlert">CONSOLE INTERACTION ALERT</span>
        <script language='JavaScript' type='text/JavaScript'>window.open('console.php','','width=600,height=400');</script>
      </td>
    </tr>
  <?php } ?>

  <?php for($i=0; $i<2; ++$i) { ?>
  <tr>
    <td><img src="../img/layout/x.gif" width="2"></td>
  </tr>
  <?php 
  }
  if ($_SESSION['data'][$_SESSION['index']]['finito']) { ?>
  <tr>
    <td><img src="../img/layout/x.gif" width="2"></td>
  </tr>
    <tr>
      <td align="center" valign="middle" bgcolor="black" height="20" colspan="2">
        <font size="2" face="arial" color="#00ff00">
          <b>EXECUTION COMPLETED IN <br><?php echo $_SESSION['data'][$_SESSION['index']]['clock']-1;?> CLOCK CYCLES</b>
        </font>
      </td>
    </tr>
    <tr>
      <td><img src="../img/layout/x.gif" width="2"></td>
    </tr>
  <?php } ?>

  <tr>
    <td><img src="../img/layout/x.gif" width="2"></td>
  </tr>

  <tr>
    <td align="center" valign="middle" bgcolor="black" colspan="2">
    <?php
      $stall_start='<font size="2" face="arial" color="red">Stall in ';
      $stall_stop=' stage<br></font>';
      $empty_start='<font size="2" face="arial" color="#00ff00">Empty ';
      $empty_stop=' stage<br></font>';
      if ($_SESSION['data'][$_SESSION['index']]['ifIstruzione']==1001) {
        $stage="IF";
        echo $stall_start.$stage.$stall_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['ifIstruzione']==1002) {
        $stage="IF";
        echo $empty_start.$stage.$empty_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['idIstruzione']==1001) {
        $stage="ID";
        echo $stall_start.$stage.$stall_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['idIstruzione']==1002) {
        $stage="ID";
        echo $empty_start.$stage.$empty_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['exIstruzione']==1001) {
        $stage="EX";
        echo $stall_start.$stage.$stall_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['exIstruzione']==1002) {
        $stage="EX";
        echo $empty_start.$stage.$empty_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['memIstruzione']==1001) {
        $stage="MEM";
        echo $stall_start.$stage.$stall_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['memIstruzione']==1002) {
        $stage="MEM";
        echo $empty_start.$stage.$empty_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['wbIstruzione']==1001) {
        $stage="WB";
        echo $stall_start.$stage.$stall_stop;
      }
      if ($_SESSION['data'][$_SESSION['index']]['wbIstruzione']==1002) {
        $stage="WB";
        echo $empty_start.$stage.$empty_stop;
      }
    ?>
    </td>
  </tr>  
    
</table>
  
<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#7b869a" id="destraTop">

  <tr>
    <td background="../img/layout/bg_destra_sin.gif"><img src="../img/layout/x.gif"></td>
    <td align="center" width="33%">
      <?php if ($destra=="")
      {
        $c1="#d4d0c8";
        $c2="white";
        $c3="white";
        ?>
        <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#d4d0c8">
          <tr>
            <td width="5"><img src="../img/layout/bg_destra_active1.gif"></td>
            <td valign="middle" align="center" background="../img/layout/bg_destra_active3.gif">
              <a href="leftPanel.php" class="link3"><b>Instruction<br>Memory</b></a></td>
            <td width="19"><img src="../img/layout/bg_destra_active2.gif"></td>
          </tr>
        </table>
      <?php }
      else
      {
        ?>
        <table cellpadding="0" cellspacing="0" border="0" align="center">
          <tr>
            <td valign="middle" align="center">
              <a href="leftPanel.php" class="link">Instruction<br>Memory</a></td>
          </tr>
        </table>
      <?php } ?>
    </td>
    <td align="center" width="33%" valign="middle">
      <?php if ($destra=="dati")
      {
        $c1="white";
        $c2="#d4d0c8";
        $c3="white";
        ?>
        <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#d4d0c8">
          <tr>
            <td width="5"><img src="../img/layout/bg_destra_active1.gif"></td>
            <td valign="middle" align="center" background="../img/layout/bg_destra_active3.gif">
              <a href="leftPanel.php?dst=dati&tipo=tutto" class="link3"><b>Data<br>Memory</b></a></td>
            <td width="19"><img src="../img/layout/bg_destra_active2.gif"></td>
          </tr>
        </table>
      <?php }
      else
      {
        ?>
        <table cellpadding="0" cellspacing="0" border="0" align="center">
          <tr>
            <td valign="middle" align="center">
              <a href="leftPanel.php?dst=dati&tipo=tutto" class="link">Data<br>Memory</a></td>
          </tr>
        </table>
      <?php } ?>
    </td>
    <td align="center" width="33%">
      <?php if ($destra=="registri")
      {
        $c1="white";
        $c2="white";
        $c3="#d4d0c8";
        ?>
        <table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#d4d0c8">
          <tr>
            <td width="5"><img src="../img/layout/bg_destra_active1.gif"></td>
            <td align="center" background="../img/layout/bg_destra_active3.gif">
              <a href="leftPanel.php?dst=registri" class="link3"><b>Registers</b></a></td>
            <td width="19"><img src="../img/layout/bg_destra_active2.gif"></td>
          </tr>
        </table>
      <?php }
      else
      {
        ?>
        <a href="leftPanel.php?dst=registri" class="link">Registers</a>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <td width="7" bgcolor="white"><img src="../img/layout/x.gif"></td>
    <td bgcolor="<?php echo $c1;?>"><img src="../img/layout/x.gif"></td>
    <td bgcolor="<?php echo $c2;?>"><img src="../img/layout/x.gif"></td>
    <td bgcolor="<?php echo $c3;?>"><img src="../img/layout/x.gif"></td>
  </tr>
</table>


<?php
switch ($destra)
{
  case "registri":
    require_once 'registers.php';
    break;

  case "dati":
    require_once 'dataMem.php';
    break;

  default:
    require_once 'instrMem.php';
    break;
}
?>

</body>
</html>

