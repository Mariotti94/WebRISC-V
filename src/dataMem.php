<?php
require_once 'functions.php';
$height=0;
?>
<br>
<form action="leftPanel.php?dst=dati&tipo=tutto" method="post" style="margin: 0px;">
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
<form action="leftPanel.php?dst=dati&tipo=dynamic" method="post" style="margin: 0px;">
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
<form action="leftPanel.php?dst=dati&tipo=static" method="post" style="margin: 0px;">
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
<form action="leftPanel.php?dst=dati&tipo=serie" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 35px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the dwords between<br>
        address
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
        and
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
<form action="leftPanel.php?dst=dati&tipo=parola" method="post" style="margin: 0px;">
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

<?php
$tabStart='<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" style="margin-top: 5px;">';
$tabStart=$tabStart.'<tr>';
$tabStart=$tabStart.'<td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(dword)</td>';
$tabStart=$tabStart.'<td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(word)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 3<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 2<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 1<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="50" align="center" style="border:1px solid #666666">Byte 0<br>(dec.val.)</td>';
$tabStart=$tabStart.'<td width="30" align="center" style="border:1px solid #666666">Addr.</td>';
$tabStart=$tabStart.'</tr>';
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
    case "tutto":
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
        $chunkText=$chunkText.generateTextH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

      case "dynamic":
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
        $chunkText=$chunkText.generateTextH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

      case "static":
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
        $chunkText=$chunkText.generateTextH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

    case "parola":
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
      $chunkText=$chunkText.generateTextH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
      echo $tabStart;
      echo $chunkText;
      echo $tabEnd;
      break;

    case "serie":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop)-8;
      if ($memIndex<=$memIndexStop)
      {
        echo "<br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
      echo $tabStart;
      while($memIndex>$memIndexStop)
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateTextH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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
    case "tutto":
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
        $chunkText=$chunkText.generateTextL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

      case "dynamic":
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
        $chunkText=$chunkText.generateTextL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

      case "static":
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
        $chunkText=$chunkText.generateTextL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

    case "parola":
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
      $chunkText=$chunkText.generateTextL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
      echo $tabStart;
      echo $chunkText;
      echo $tabEnd;
      break;

    case "serie":
      $chunkText='';
      $chunkIndex=0;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop)+8;
      if ($memIndex>=$memIndexStop)
      {
        echo "<br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
      echo $tabStart;
      while($memIndex<$memIndexStop)
      {
        $byte7=isset($memDati[$memIndex+7])?$memDati[$memIndex+7]:str_repeat('0',8);
        $byte6=isset($memDati[$memIndex+6])?$memDati[$memIndex+6]:str_repeat('0',8);
        $byte5=isset($memDati[$memIndex+5])?$memDati[$memIndex+5]:str_repeat('0',8);
        $byte4=isset($memDati[$memIndex+4])?$memDati[$memIndex+4]:str_repeat('0',8);
        $byte3=isset($memDati[$memIndex+3])?$memDati[$memIndex+3]:str_repeat('0',8);
        $byte2=isset($memDati[$memIndex+2])?$memDati[$memIndex+2]:str_repeat('0',8);
        $byte1=isset($memDati[$memIndex+1])?$memDati[$memIndex+1]:str_repeat('0',8);
        $byte0=isset($memDati[$memIndex])?$memDati[$memIndex]:str_repeat('0',8);
        $chunkText=$chunkText.generateTextL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
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

