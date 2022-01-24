<?php
/**
 * WebRISC-V
 *
 * @copyright Copyright (c) 2019, Roberto Giorgi and Gianfranco Mariotti, University of Siena, Italy
 * @license   BSD-3-Clause
 */

if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
require_once 'functions.php';
$height=0;
?>
<br>
<?php if ($_SESSION['XLEN']==64) {?>
<form action="leftPanel.php?dst=dati&tipo=dtutto" method="post" style="margin: 0px;">
<?php } else {?>
<form action="leftPanel.php?dst=dati&tipo=wtutto" method="post" style="margin: 0px;">
<?php }?>
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the entire [Data] Memory
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<?php if ($_SESSION['XLEN']==64) {?>
<form action="leftPanel.php?dst=dati&tipo=ddynamic" method="post" style="margin: 0px;">
<?php } else {?>
<form action="leftPanel.php?dst=dati&tipo=wdynamic" method="post" style="margin: 0px;">
<?php }?>
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the [Dynamic Data] segment
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<?php if ($_SESSION['XLEN']==64) {?>
<form action="leftPanel.php?dst=dati&tipo=dstatic" method="post" style="margin: 0px;">
<?php } else {?>
<form action="leftPanel.php?dst=dati&tipo=wstatic" method="post" style="margin: 0px;">
<?php }?>
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the [Static Data] segment
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<?php if ($_SESSION['XLEN']==64) {?>
<form action="leftPanel.php?dst=dati&tipo=dserie" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 35px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the dwords at address<br>
        from
        <select name="parola1" class="form">
          <?php
          if ($_SESSION['memDatiShow']==0)
          {
            $memIndex=($_SESSION['maxMem']-8);
            while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex-8;
            }
          }
          else
          {
            $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
            while($memIndex<=($_SESSION['maxMem']-8))
            {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex+8;
            }
          }
          ?>
        </select>
        to
        <select name="parola2" class="form">
          <?php
          if ($_SESSION['memDatiShow']==0)
          {
            $memIndex=($_SESSION['maxMem']-8);
            while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex-8;
            }
          }
          else
          {
            $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
            while($memIndex<=($_SESSION['maxMem']-8))
            {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex+8;
            }
          }
          ?>
        </select>
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<form action="leftPanel.php?dst=dati&tipo=dparola" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the dword at address
        <select name="parola" class="form">
          <?php
          if ($_SESSION['memDatiShow']==0)
          {
            $memIndex=($_SESSION['maxMem']-8);
            while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex-8;
            }
          }
          else
          {
            $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
            while($memIndex<=($_SESSION['maxMem']-8)) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex+8;
            }
          }
          ?>
        </select>
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<?php } else {?>
<form action="leftPanel.php?dst=dati&tipo=wserie" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 35px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the words at address<br>
        from
        <select name="parola1" class="form">
          <?php
          if ($_SESSION['memDatiShow']==0)
          {
            $memIndex=($_SESSION['maxMem']-4);
            while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex-4;
            }
          }
          else
          {
            $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
            while($memIndex<=($_SESSION['maxMem']-4))
            {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex+4;
            }
          }
          ?>
        </select>
        to
        <select name="parola2" class="form">
          <?php
          if ($_SESSION['memDatiShow']==0)
          {
            $memIndex=($_SESSION['maxMem']-4);
            while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex-4;
            }
          }
          else
          {
            $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
            while($memIndex<=($_SESSION['maxMem']-4))
            {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex+4;
            }
          }
          ?>
        </select>
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<form action="leftPanel.php?dst=dati&tipo=wparola" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the word at address
        <select name="parola" class="form">
          <?php
          if ($_SESSION['memDatiShow']==0)
          {
            $memIndex=($_SESSION['maxMem']-4);
            while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex-4;
            }
          }
          else
          {
            $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
            while($memIndex<=($_SESSION['maxMem']-4)) {
              ?>
              <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
              <?php
              $memIndex=$memIndex+4;
            }
          }
          ?>
        </select>
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>
<?php }?>

<?php
$tabStart='<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" style="margin-top: 5px;">';
$tabStart=$tabStart.'<tr>';
if ($_SESSION['XLEN']==64)
  $tabStart=$tabStart.'<td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(dword)</td>';
$tabStart=$tabStart.'<td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(word)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 3<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 2<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 1<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 0<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="30" align="center" style="border:1px solid #666666">Addr.</td>';
$tabStart=$tabStart.'</tr>';
$tabStart=$tabStart.'<tr>';
$tabStart=$tabStart.'<td colspan="4"><img src="../img/layout/x.gif" height="'.$height.'"></td>';
$tabStart=$tabStart.'</tr>';
$tabEnd='</table>';

$memDati=$_SESSION['data'][$_SESSION['index']]['memDati'];
$tipo=isset($_GET["tipo"])?$_GET["tipo"]:"";
$chunkAmount=intval(($_SESSION['maxWritableMem']/8)/4);
$chunkAmount=($chunkAmount>128)?$chunkAmount:128;

if ($_SESSION['memDatiShow']==0)
{
  switch ($tipo)
  {
    case "dtutto":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-8);
      echo $tabStart;
      while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem']))
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "ddynamic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-8);
      echo $tabStart;
      while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxDynamicMem']))
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "dstatic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-8);
      echo $tabStart;
      while($memIndex>=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-$_SESSION['maxStaticMem']))
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    case "dparola":
      $chunkText='';
      $memIndex=$_POST["parola"];
      $memIndex=intval($memIndex);
      $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
      $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
      $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
      $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
      $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
      $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
      $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
      $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
      $chunkText=$chunkText.generateDWordsH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
      echo $tabStart;
      echo $chunkText;
      echo $tabEnd;
      break;

    case "dserie":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop);
      if ($memIndex<$memIndexStop)
      {
        echo "<br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
      echo $tabStart;
      while($memIndex>=$memIndexStop)
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    case "wtutto":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-4);
      echo $tabStart;
      while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxWritableMem']))
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsH2L($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "wdynamic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-4);
      echo $tabStart;
      while($memIndex>=($_SESSION['maxMem']-$_SESSION['maxDynamicMem']))
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsH2L($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "wstatic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-4);
      echo $tabStart;
      while($memIndex>=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-$_SESSION['maxStaticMem']))
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsH2L($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    case "wparola":
      $chunkText='';
      $memIndex=$_POST["parola"];
      $memIndex=intval($memIndex);
      $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
      $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
      $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
      $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
      $chunkText=$chunkText.generateWordsH2L($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
      echo $tabStart;
      echo $chunkText;
      echo $tabEnd;
      break;

    case "wserie":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop);
      if ($memIndex<$memIndexStop)
      {
        echo "<br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
      echo $tabStart;
      while($memIndex>=$memIndexStop)
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsH2L($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex-4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    default:
      echo "<div align='center' style='margin-top:20px;'><b>SELECT MEMORY<br>TO DISPLAY HERE</b>";
      ?>
      <table cellpadding="0" cellspacing="0" border="0" class="registro" style='margin-top: 5px;'>
        <tr>
          <td width="130" align="center" style="padding: 15px 5px 15px 2px;">
            <div style="border: 1px solid black; margin-top: 5px; height: 95px;"><div style="margin-top: 6px;">Stack &#8595;</div><div style="margin-top: 60px;">Dynamic Data &#8593;</div></div>
            <div style="border: 1px solid black; margin-top: -1px; height: 50px;"><div style="margin-top: 33px;">Static Data</div></div>
            <div style="border: 1px solid black; margin-top: -1px; height: 50px;"><div style="margin-top: 33px;">Text</div></div>
          </td>
          <td width="65" valign="top" align="left">
            <div style="height: 20px; margin-top: 14px;">&#8592; SP: <?php echo strval($_SESSION['maxWritableMem']+$_SESSION['maxTextMem']);?></div>
            <div style="height: 20px; margin-top: 122px;">&#8592; GP: <?php echo strval($_SESSION['maxTextMem']);?></div>
            <div style="height: 20px; margin-top: 31px;">&#8592; 0</div>
          </td>
        </tr>
      </table>
      <?php
      echo "</div>";
      break;
  }
}
else
{
  switch ($tipo)
  {
    case "dtutto":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
      echo $tabStart;
      while($memIndex<=($_SESSION['maxMem']-8))
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "ddynamic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-$_SESSION['maxDynamicMem']);
      echo $tabStart;
      while($memIndex<=($_SESSION['maxMem']-8))
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "dstatic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-$_SESSION['maxStaticMem']);
      echo $tabStart;
      while($memIndex<=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-8))
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    case "dparola":
      $chunkText='';
      $memIndex=$_POST["parola"];
      $memIndex=intval($memIndex);
      $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
      $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
      $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
      $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
      $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
      $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
      $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
      $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
      $chunkText=$chunkText.generateDWordsL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
      echo $tabStart;
      echo $chunkText;
      echo $tabEnd;
      break;

    case "dserie":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop);
      if ($memIndex>$memIndexStop)
      {
        echo "<br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
      echo $tabStart;
      while($memIndex<=$memIndexStop)
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateDWordsL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+8;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    case "wtutto":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-$_SESSION['maxWritableMem']);
      echo $tabStart;
      while($memIndex<=($_SESSION['maxMem']-4))
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsL2H($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "wdynamic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=($_SESSION['maxMem']-$_SESSION['maxDynamicMem']);
      echo $tabStart;
      while($memIndex<=($_SESSION['maxMem']-4))
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsL2H($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

      case "wstatic":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-$_SESSION['maxStaticMem']);
      echo $tabStart;
      while($memIndex<=(($_SESSION['maxMem']-$_SESSION['maxDynamicMem'])-4))
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsL2H($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    case "wparola":
      $chunkText='';
      $memIndex=$_POST["parola"];
      $memIndex=intval($memIndex);
      $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
      $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
      $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
      $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
      $chunkText=$chunkText.generateWordsL2H($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
      echo $tabStart;
      echo $chunkText;
      echo $tabEnd;
      break;

    case "wserie":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop);
      if ($memIndex>$memIndexStop)
      {
        echo "<br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
      echo $tabStart;
      while($memIndex<=$memIndexStop)
      {
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateWordsL2H($height,$memIndex,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+4;
        $chunkIndex++;
        if ($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      echo $tabEnd;
      break;

    default:
      echo "<div align='center' style='margin-top:20px;'><b>SELECT MEMORY<br>TO DISPLAY HERE</b>";
      ?>
      <table cellpadding="0" cellspacing="0" border="0" class="registro" style='margin-top: 5px;'>
        <tr>
          <td width="130" align="center" style="padding: 15px 5px 15px 2px;">
            <div style="border: 1px solid black; margin-top: 5px; height: 50px;"><div style="margin-top: 5px;">Text</div></div>
            <div style="border: 1px solid black; margin-top: -1px; height: 50px;"><div style="margin-top: 6px;">Static Data</div></div>
            <div style="border: 1px solid black; margin-top: -1px; height: 95px;"><div style="margin-top: 6px;">Dynamic Data &#8595;</div><div style="margin-top: 60px;">Stack &#8593;</div></div>
          </td>
          <td width="65" valign="top" align="left">
            <div style="height: 20px; margin-top: 19px;">&#8592; 0</div>
            <div style="height: 20px; margin-top: 32px;">&#8592; GP: <?php echo strval($_SESSION['maxTextMem']);?></div>
            <div style="height: 20px; margin-top: 120px;">&#8592; SP: <?php echo strval($_SESSION['maxWritableMem']+$_SESSION['maxTextMem']);?></div>
          </td>
        </tr>
      </table>
      <?php
      echo "</div>";
      break;
  }
}
?>

