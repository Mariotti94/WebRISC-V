<?php
session_start();
require_once 'functions.php';

if (isset($_POST['asmName']) && $_POST['asmName']!="")
  $_SESSION['asmName']=$_POST['asmName'];

$codice=$_POST['codice'];
$_SESSION['codice']=trim($codice);

$codice = preg_replace('/\h+/', ' ', $codice);
$codice = preg_replace('/:/', ':'.PHP_EOL, $codice);
$riga = array_map('trim', explode(PHP_EOL, $codice));
$riga = array_values(array_filter($riga));

for ($key=0; $key<count($riga); ++$key) {
  $temp=explode('#',$riga[$key]);
  $riga[$key]=(trim($temp[0])!='')?$temp[0]:'#'.$temp[1];
  $riga[$key]=trim($riga[$key]).PHP_EOL;
}
$k=count($riga);


//LIMIT NUMBER OF INSTRUCTIONS
if ($k>1000)
{
  $k=1000;
  $riga = array_slice($riga, $k);
}

//##########################################
//Decode instructions e relocate labels

$ERR='';
$indice=0;
$total=0;

while($indice<$k)
{
  $a=(strpos($riga[$indice],':',1) ? strpos($riga[$indice],':',1)+1 : 0); //a!=0 -> label
  
  if ($a==0)
  {
    // control for empty or comment rows
    if (ord($riga[$indice])!=13 && ord($riga[$indice])!=35)
    {
      $a=decodeIstr($riga[$indice]);

      if ($a!='ERR')
      {
        $riga[$total]=$a;
      }
      else
      {
        $ERR='ERROR: Instruction at line '.($indice+1);
        break;

      }
      $total=$total+1;
    }
  }
  else
  {
    $a=substr($riga[$indice],0,$a-1);
    if (!isset($dimTabRil)) $dimTabRil=0;
    $tabRil[$dimTabRil]=$total.'|'.$a; //insert label in relocation table
    $dimTabRil=$dimTabRil+1;
  }
  $indice=$indice+1;
}
$riga=array_slice($riga, 0, $total);

//label to address
$indice=0;
while($indice<$total)
{
  $a=(strpos($riga[$indice],':',1) ? strpos($riga[$indice],':',1)+1 : 0);
  if ($a!=0)
  {
    $b=substr($riga[$indice],$a);
    $c=substr($riga[$indice],0,$a-1);
    $b=trim($b);
    $b=cLabel($b,$tabRil,$dimTabRil);

    if ($b==='ERR') {
      if ($ERR=='')
        $ERR='ERROR: Label does not exist: '.explode(':',$riga[$indice])[1];
      break;
    }
    else {    
      $b=($b-$indice)*2;
    }

    if (strlen($c)>12)
    {
      $t=GMPToBin($b,12,0);
      $b1=substr($t,0,1).substr($t,2,6);
      $b2=substr($t,8,4).substr($t,1,1);
      $riga[$indice]=$b1.substr($c,0,13).$b2.substr($c,13,7);
    }
    else
    {
      $t=GMPToBin($b,20,0);
      $b=substr($t,0,1).substr($t,10,10).substr($t,9,1).substr($t,1,8);
      $riga[$indice]=$b.$c;
    }
  }
  $indice=$indice+1;
}

require_once 'init.php';

if (!empty($_SESSION['codice'])) {
  $_SESSION['loaded']=true;
}

if ($ERR!='')
{
  ?>
  <html>
  <head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
    <link href='../css/main.css' rel='stylesheet' type='text/css'>
    <meta name="robots" content="noindex">
  </head>
  <body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' bgcolor='#666666'>
  <?php
  print '<div align=center><br><font size=2 face=arial color=red><b>';
  print $ERR;
  print '</b></font></div>';
  ?>
  </body>
  </html>
  <?php
  exit();
}
else
{
  $riga[$total]=str_repeat('0',32);
  $riga[$total+1]=str_repeat('0',32);
  $riga[$total+2]=str_repeat('0',32);
  $riga[$total+3]=str_repeat('0',32);
  $riga[$total+4]=str_repeat('0',32);
  $_SESSION['memIstr']=$riga;
  $_SESSION['memIstrDim']=$total;
  header('Location: leftPanel.php');
}
?>

