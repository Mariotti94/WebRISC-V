<?php
/**
 * WebRISC-V
 *
 * @copyright Copyright (c) 2019, Roberto Giorgi and Gianfranco Mariotti, University of Siena, Italy
 * @license   BSD-3-Clause
 */

session_start();
if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
require_once 'functions.php';
sanitizeArray($_POST);
require 'init.php';

if (isset($_POST['asmName']) && $_POST['asmName']!='')
  $_SESSION['asmName']=$_POST['asmName'];

$ERR='';

$codice=isset($_POST['codice'])?$_POST['codice']:'';
$_SESSION['codice']=trim($codice);

$codice = preg_replace('/\h+/',' ',$codice);        //fix whitespace
$codice = explode(PHP_EOL,$codice);                 //split to array
//strip comments and split label to own line
//do not disturb data segment strings
for ($i=0, $codiceCnt=count($codice); $i < $codiceCnt; ++$i)
{
  $enable=true;
  $delete=false;
  for ($j = 0, $stringLen=strlen($codice[$i]); $j < $stringLen; ++$j)
  {
    if ($delete) {
      $codice[$i]=substr_replace($codice[$i], ' ', $j, strlen($codice[$i][$j]));
      continue;
    }

    if ($codice[$i][$j]=='#')
    {
      if ($enable) {
        $codice[$i]=substr_replace($codice[$i], ' ', $j, strlen('#'));
        $delete=true;
        continue;
      }
    }

    if ($codice[$i][$j]=='"') {
      $enable=!$enable;
      continue;
    }

    if ($codice[$i][$j]==':')
    {
      if ($enable) {
          $codice[$i]=substr_replace($codice[$i], ':'.PHP_EOL, $j, strlen(':'));
          ++$stringLen;
      }
      continue;
    }
  }
}
$codice = explode(PHP_EOL,implode(PHP_EOL,$codice));
$codice = array_map('trim',$codice);
$codice = array_values(array_filter($codice, 'strlen'));
$codiceCnt=count($codice);

//subdivide array to segments
$currSeg='.text';
$segData=array();
$segText=array();
for ($i=0; $i<$codiceCnt; ++$i)
{
  if (strtolower($codice[$i])=='.data') {
    $currSeg='.data';
    continue;
  }
  if (strtolower($codice[$i])=='.text') {
    $currSeg='.text';
    continue;
  }
  if ($currSeg=='.data') {
    array_push($segData,$codice[$i]);
  }
  if ($currSeg=='.text') {
    array_push($segText,strtolower($codice[$i]));
  }
}

$segDataCnt=count($segData);
$segTextCnt=count($segText);
$relTabData=array();
$relTabText=array();

//****************************************************************
//1st: data segment
//decode directives
//make relocation table data segment

$pushRelTab=NULL;
$byteCnt=$_SESSION['maxTextMem'];
for ($i=0; $i<$segDataCnt; ++$i)
{
  $a=strpos($segData[$i],':',1) ? (strpos($segData[$i],':',1)+1) : 0; //colon check
  $b=strpos($segData[$i],'"',1) ? (strpos($segData[$i],'"',1)+1) : 0; //string check

  if ($a!=0 && $b==0) //label check
  {
    //label to insert in relocation table after directive check
    $pushRelTab=strtolower(substr($segData[$i],0,$a-1));
  }
  else
  {
    $directive=$segData[$i];
    $pos=strpos($directive,' ');
    if ($pos!==false) {
        $directive=substr_replace($directive,PHP_EOL,$pos,strlen(' '));
    }
    $directive=explode(PHP_EOL,$directive);
    $directive[0]=strtolower($directive[0]);

    if (count($directive)==1)
    {
      if ($ERR=='') {
        $ERR='ERROR:<br>No arguments in directive => '.$directive[0];
      }
      break;
    }

    if ($directive[0] == '.byte' || ($directive[0] == '.dword' && $_SESSION['XLEN']==64) || $directive[0] == '.half' || $directive[0] == '.word') {
      $args=$directive[1];
      $args=str_replace(',',' ',$args);
      $args=explode(' ', $args);
      $args=array_map('trim', $args);
      $args=array_values(array_filter($args, 'strlen'));
      $directive=array_merge(array($directive[0]), $args);
      $directiveCnt=count($directive);
    }

    if ($directive[0] == '.ascii' || $directive[0] == '.asciz' || $directive[0] == '.string')
    {
      $directive[1]=str_replace("\"",'',$directive[1]);
    }
    else
    {
      for ($j=1,$cnt=count($directive); $j<$cnt; ++$j)
      {
        if (!is_numeric($directive[$j]))
        {
          if ($ERR=='') {
            $ERR='ERROR:<br>Arguments of wrong type in directive => '.$directive[0];
          }
        }
      }
      if ($ERR!='') {
        break;
      }
    }

    if ($directive[0] == '.align')
    {
      if ($directive[1] != 0 && $directive[1] != 1 && $directive[1] != 2 && $directive[1] != 3)
      {
        if ($ERR=='') {
          $ERR='ERROR:<br>Arguments of wrong value in directive => '.$directive[0];
        }
        break;
      }
    }

    if ($directive[0] == '.align')
    {
      if ($directive[1] == 0) {
        continue;
      }
      $num=pow(2,$directive[1]);
      $byteCnt=($byteCnt-($byteCnt%$num))+$num;

      //BOUND CHECK
      if ($byteCnt>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem']))
      {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }
    }
    else if ($directive[0] == '.ascii')
    {
      $str=$directive[1];
      $arrStr=str_split($str);

      //BOUND CHECK
      if (($byteCnt+count($arrStr))>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL) {
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      foreach ($arrStr as $char) {
        $byte0=GMPToBin(ord($char),8,0);
        $_SESSION['data'][0]['memDati'][$byteCnt]=$byte0;
        ++$byteCnt;
      }
    }
    else if ($directive[0] == '.asciz' || $directive[0] == '.string')
    {
      $str=$directive[1];
      $arrStr=str_split($str);
      array_push($arrStr,"\0");

      //BOUND CHECK
      if (($byteCnt+count($arrStr))>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL) {
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      foreach ($arrStr as $char) {
        $byte0=GMPToBin(ord($char),8,0);
        $_SESSION['data'][0]['memDati'][$byteCnt]=$byte0;
        ++$byteCnt;
      }
    }
    else if ($directive[0] == '.byte')
    {
      //BOUND CHECK
      if (($byteCnt+1)>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL) {
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      for ($j=1; $j<$directiveCnt; ++$j) {
        $byte0=GMPToBin($directive[$j],8,0);
        $_SESSION['data'][0]['memDati'][$byteCnt]=$byte0;
        ++$byteCnt;
      }
    }
    else if ($directive[0] == '.dword' && $_SESSION['XLEN'] == 64)
    {
      //BOUND CHECK
      if (($byteCnt+8)>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL)
      {
        //align to boundary
        if ($byteCnt%8!=0) {
          $byteCnt=($byteCnt-($byteCnt%8))+8;
        }
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      for ($j=1; $j<$directiveCnt; ++$j) {
        $insieme=GMPToBin($directive[$j],64,0);
        $byte0=substr($insieme,0,8);
        $byte1=substr($insieme,8,8);
        $byte2=substr($insieme,16,8);
        $byte3=substr($insieme,24,8);
        $byte4=substr($insieme,32,8);
        $byte5=substr($insieme,40,8);
        $byte6=substr($insieme,48,8);
        $byte7=substr($insieme,56,8);
        $_SESSION['data'][0]['memDati'][$byteCnt]=$byte7;
        $_SESSION['data'][0]['memDati'][$byteCnt+1]=$byte6;
        $_SESSION['data'][0]['memDati'][$byteCnt+2]=$byte5;
        $_SESSION['data'][0]['memDati'][$byteCnt+3]=$byte4;
        $_SESSION['data'][0]['memDati'][$byteCnt+4]=$byte3;
        $_SESSION['data'][0]['memDati'][$byteCnt+5]=$byte2;
        $_SESSION['data'][0]['memDati'][$byteCnt+6]=$byte1;
        $_SESSION['data'][0]['memDati'][$byteCnt+7]=$byte0;
        $byteCnt+=8;
      }
    }
    else if ($directive[0] == '.half')
    {
      //BOUND CHECK
      if (($byteCnt+2)>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL)
      {
        //align to boundary
        if ($byteCnt%2!=0) {
          $byteCnt=($byteCnt-($byteCnt%2))+2;
        }
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      for ($j=1; $j<$directiveCnt; ++$j) {
        $insieme=GMPToBin($directive[$j],16,0);
        $byte0=substr($insieme,0,8);
        $byte1=substr($insieme,8,8);
        $_SESSION['data'][0]['memDati'][$byteCnt]=$byte1;
        $_SESSION['data'][0]['memDati'][$byteCnt+1]=$byte0;
        $byteCnt+=2;
      }
    }
    else if ($directive[0] == '.word')
    {
      //BOUND CHECK
      if (($byteCnt+4)>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL)
      {
        //align to boundary
        if ($byteCnt%4!=0) {
          $byteCnt=($byteCnt-($byteCnt%4))+4;
        }
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      for ($j=1; $j<$directiveCnt; ++$j) {
        $insieme=GMPToBin($directive[$j],32,0);
        $byte0=substr($insieme,0,8);
        $byte1=substr($insieme,8,8);
        $byte2=substr($insieme,16,8);
        $byte3=substr($insieme,24,8);
        $_SESSION['data'][0]['memDati'][$byteCnt]=$byte3;
        $_SESSION['data'][0]['memDati'][$byteCnt+1]=$byte2;
        $_SESSION['data'][0]['memDati'][$byteCnt+2]=$byte1;
        $_SESSION['data'][0]['memDati'][$byteCnt+3]=$byte0;
        $byteCnt+=4;
      }
    }
    else if ($directive[0] == '.space')
    {
      //BOUND CHECK
      if (($byteCnt+$directive[1])>($_SESSION['maxTextMem']+$_SESSION['maxStaticMem'])) {
        if ($ERR=='') {
          $ERR='ERROR:<br>Out of Static Data Segment Memory';
        }
        break;
      }

      if ($pushRelTab !== NULL) {
        array_push($relTabData,$byteCnt.'|'.$pushRelTab);
        $pushRelTab=NULL;
      }

      $byteCnt+=$directive[1];
    }
    else
    {
      if ($ERR=='') {
        $ERR='ERROR: Directive doesn\'t exist => '.$directive[0];
      }
      break;
    }
  }
}

//****************************************************************
//2nd: text segment
//decode instructions
//label to label_addr for instr having relTabData dependency
//make relocation table text segment

$instrCnt=0;
$temp_segText=array();
for ($i=0; $i<$segTextCnt; ++$i)
{
  $a=strpos($segText[$i],':',1) ? (strpos($segText[$i],':',1)+1) : 0; //a!=0 -> label
  if ($a==0)
  {
    $a=decodeIstr($segText[$i],$_SESSION['XLEN']);
    if ($a!='ERR')
    {
      if ($a!='MULTI')
      {
        $temp_segText[$instrCnt]=$a;
        ++$instrCnt;
      }
      else
      {
        $arrInstr=decodeMultiIstr($segText[$i],$instrCnt*4,$relTabData);
        if ($arrInstr[0]!='ERR')
        {
          foreach ($arrInstr as $instr) {
            $temp_segText[$instrCnt]=$instr;
            ++$instrCnt;
          }
        }
        else
        {
          if ($arrInstr[1]=='instr')
          {
            if ($ERR=='') {
              $ERR='ERROR:<br>Instruction not decodable => '.$segText[$i];
            }
          }
          else if ($arrInstr[1]=='label')
          {
            if ($ERR=='') {
              $ERR='ERROR:<br>Label does not exist: '.$arrInstr[2];
            }
          }
          break;
        }
      }
    }
    else
    {
      if ($ERR=='') {
        $ERR='ERROR:<br>Instruction not decodable => '.$segText[$i];
      }
      break;
    }
  }
  else
  {
    $a=substr($segText[$i],0,$a-1);
    array_push($relTabText,($instrCnt*4).'|'.$a);
  }
}
$segText=$temp_segText;

//check Text Segment bound
if ($instrCnt>($_SESSION['maxTextMem']/4))
{
  if ($ERR=='') {
    $ERR='ERROR:<br>Out of Text Segment Memory';
  }
}

//****************************************************************
//3rd: text segment
//label to label_addr for instr having relTabText dependency

for($i=0; $i<$instrCnt; ++$i)
{
  $a=(strpos($segText[$i],':',1) ? strpos($segText[$i],':',1)+1 : 0);
  if ($a!=0)
  {
    $b=substr($segText[$i],$a);
    $c=substr($segText[$i],0,$a-1);
    $b=trim($b);
    $b=cLabel($b,$relTabText);

    if ($b==='ERR')
    {
      if ($ERR=='') {
        $ERR='ERROR:<br>Label does not exist: '.explode(':',$segText[$i])[1];
      }
      break;
    }
    else
    {
      $b=(($b/4)-$i)*2;
    }

    if (strlen($c)>12)
    {
      $t=GMPToBin($b,12,0);
      $b1=substr($t,0,1).substr($t,2,6);
      $b2=substr($t,8,4).substr($t,1,1);
      $segText[$i]=$b1.substr($c,0,13).$b2.substr($c,13,7);
    }
    else
    {
      $t=GMPToBin($b,20,0);
      $b=substr($t,0,1).substr($t,10,10).substr($t,9,1).substr($t,1,8);
      $segText[$i]=$b.$c;
    }
  }
}

if ($ERR!='')
{
  require 'init.php';
  ?>
  <html>
  <head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <meta name="robots" content="noindex">
  </head>
  <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#666666">
  <?php
  echo '<div align=center><br><font size=2 face=arial color=red><b>';
  echo $ERR;
  echo '</b></font></div>';
  ?>
  </body>
  </html>
  <?php
  exit();
}
else
{
  $segText[$instrCnt]=str_repeat('0',32);
  $segText[$instrCnt+1]=str_repeat('0',32);
  $segText[$instrCnt+2]=str_repeat('0',32);
  $segText[$instrCnt+3]=str_repeat('0',32);
  $segText[$instrCnt+4]=str_repeat('0',32);
  if (!empty($_SESSION['codice'])) {
    $_SESSION['loaded']=true;
  }
  $_SESSION['memIstr']=$segText;
  $_SESSION['memIstrUse']=$instrCnt;
  header('Location: leftPanel.php');
}
?>

