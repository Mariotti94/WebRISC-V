<?php
require_once 'functions.php';
function generateText($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0) {
  $text='<tr>';
  $text=$text.'<td rowspan="3" width="40" style="word-break: break-all;" align="center" bgcolor="white">'.BinToGMP($byte7.$byte6.$byte5.$byte4.$byte3.$byte2.$byte1.$byte0,0).'</td>';
  $text=$text.'<td width="40" style="word-break: break-all;" align="center" bgcolor="white">'.BinToGMP($byte3.$byte2.$byte1.$byte0,0).'</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte3.'<br>( '.BinToGMP($byte3,0).' )</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte2.'<br>( '.BinToGMP($byte2,0).' )</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte1.'<br>( '.BinToGMP($byte1,0).' )</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte0.'<br>( '.BinToGMP($byte0,0).' )</td>';
  $text=$text.'<td width="30" align="center" bgcolor="#333333" class="indice">'.$memIndex.'</td>';
  $text=$text.'</tr>';
  $text=$text.'<tr>';
  $text=$text.'<td colspan="6"><img src="../img/layout/x.gif" height="'.$height.'"></td>';
  $text=$text.'</tr>';
  $text=$text.'<tr>';
  $text=$text.'<td width="40" style="word-break: break-all;" align="center" bgcolor="white">'.BinToGMP($byte7.$byte6.$byte5.$byte4,0).'</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte7.'<br>( '.BinToGMP($byte7,0).' )</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte6.'<br>( '.BinToGMP($byte6,0).' )</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte5.'<br>( '.BinToGMP($byte5,0).' )</td>';
  $text=$text.'<td width="50" align="center" bgcolor="white">'.$byte4.'<br>( '.BinToGMP($byte4,0).' )</td>';
  $text=$text.'<td width="30" align="center" bgcolor="#333333" class="indice">'.($memIndex+4).'</td>';
  $text=$text.'</tr>';
  $text=$text.'<tr>';
  $text=$text.'<td colspan="6"><img src="../img/layout/x.gif" height="'.$height.'"></td>';
  $text=$text.'</tr>';
  return $text;
}
$height=0;
?>
<br>
<form action="leftPanel.php?dst=dati&tipo=parola" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the dword at address
        <select name="parola" class="form">
          <?php
          $memIndex=0;
          while($memIndex<=($_SESSION['maxMem']-8))
          {
            ?>
            <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
            <?php
            $memIndex=$memIndex+8;
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

<form action="leftPanel.php?dst=dati&tipo=serie" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 35px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display the dwords between<br>
        address
        <select name="parola1" class="form">
          <?php
          $memIndex=0;
          while($memIndex<=($_SESSION['maxMem']-8))
          {
            ?>
            <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
            <?php
            $memIndex=$memIndex+8;
          }
          ?>
        </select>
        and
        <select name="parola2" class="form">
          <?php
          $memIndex=0;
          while($memIndex<=($_SESSION['maxMem']-8))
          {
            ?>
            <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
            <?php
            $memIndex=$memIndex+8;
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

<form action="leftPanel.php?dst=dati&tipo=tutto" method="post" style="margin: 0px;">
  <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
    <tr>
      <td class="registro" align="center" width="100%" bgcolor="white">
        Display ALL Memory
      </td>
      <td align="left">
        <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
      </td>
    </tr>
  </table>
</form>

<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" style="margin-top: 5px;">
  <tr>
    <td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(dword)</td>
    <td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(word)</td>
    <td width="50" align="center" style="border:1px solid #666666">Byte 3<br>(dec.val.)</td>
    <td width="50" align="center" style="border:1px solid #666666">Byte 2<br>(dec.val.)</td>
    <td width="50" align="center" style="border:1px solid #666666">Byte 1<br>(dec.val.)</td>
    <td width="50" align="center" style="border:1px solid #666666">Byte 0<br>(dec.val.)</td>
    <td width="30" align="center" style="border:1px solid #666666">Addr.</td>
  </tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>

  <?php
  $memDati=$_SESSION['data'][$_SESSION['index']]['memDati'];
  $tipo=isset($_GET["tipo"])?$_GET["tipo"]:"";
  switch ($tipo)
  {
    case "tutto":
      $chunkText='';
      $chunkIndex=0;
      $chunkAmount=100;
      $memIndex=0;
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
        $chunkText=$chunkText.generateText($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+8;
        $chunkIndex++;
        if($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
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
      $chunkText=$chunkText.generateText($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
      echo $chunkText;
      break;
      
    case "serie":
      $chunkText='';
      $chunkIndex=0;
      $chunkAmount=100;
      $memIndex=$_POST["parola1"];
      $memIndexStop=$_POST["parola2"];
      $memIndex=intval($memIndex);
      $memIndexStop=intval($memIndexStop)+8;
      if ($memIndex>$memIndexStop)
      {
        print "<br><br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
        exit();
      }
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
        $chunkText=$chunkText.generateText($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0);
        $memIndex=$memIndex+8;
        $chunkIndex++;
        if($chunkIndex>=$chunkAmount) {
          echo $chunkText;
          $chunkText='';
          $chunkIndex=0;
        }
      }
      echo $chunkText;
      break;
  }
  ?>
</table>

