<?php
session_start();
require 'functions.php';

if(isset($_POST['asmName']) && $_POST['asmName']!="")
	$_SESSION['asmName']=$_POST['asmName'];

//############## Inserimento nel vettore (riga per riga)
$codice=$_POST['codice'];
$_SESSION['codice']=trim($codice);

$riga = array_map('trim', explode(PHP_EOL, $codice));
$riga = array_values(array_filter($riga));

for ($key=0; $key<count($riga); ++$key) {
	$temp=explode('#',$riga[$key]);
	$riga[$key]=(trim($temp[0])!='')?$temp[0]:'#'.$temp[1];
	$riga[$key]=trim($riga[$key]).PHP_EOL;
}
$k=count($riga);
//var_dump($riga,$k);exit;

//LIMIT INSTR AMOUNT
if($k>1000)
{
    $k=1000;
    $riga = array_slice($riga, $k);
}

//############## Decodifica dell'istruzioni e rilocazione delle label

$ERR='';
$indice=0;
$indice2=0;

while($indice<$k)
{
    $a=(strpos($riga[$indice],':',1) ? strpos($riga[$indice],':',1)+1 : 0); //a!=0 -> label
	//var_dump($a);
    if ($a==0)
    {
        // Controllo sulla riga vuota o commento
        if (ord($riga[$indice])!=13 && ord($riga[$indice])!=35)
        {
            $a=decodeIstr($riga[$indice]); // Decodifica della istruzione

            if ($a!='ERR')
            {
                $riga[$indice2]=$a; // Salva nel vettore
            }
            else
            {
                $ERR='ERROR: Instruction at line '.($indice+1); // Caso dell'errore
                break;

            }
            $indice2=$indice2+1;
        }
    }
    else
    {
        //####### Caso della Label
        $a=substr($riga[$indice],0,$a-1);
        if(!isset($dimTabRil)) $dimTabRil=0;
        $tabRil[$dimTabRil]=$indice2.'|'.$a; // Inserimento della label nella tab. di riloc.
        $dimTabRil=$dimTabRil+1;
    }
    $indice=$indice+1;
}

//######## Sost. delle label con indirizzi corispondenti
$indice=0;
while($indice<$indice2)
{
    $a=(strpos($riga[$indice],':',1) ? strpos($riga[$indice],':',1)+1 : 0);
    if ($a!=0)
    {
        $b=substr($riga[$indice],$a);
        $c2=substr($riga[$indice],0,$a-1);
        $b=trim($b);
        $b=cLabel($b,$tabRil,$dimTabRil);

        if ($b==='ERR')
        {
            if ($ERR=='')
                $ERR='ERROR: Label does not exist: '.explode(':',$riga[$indice])[1];
            break;
        }

        if (strlen($c2)>12)
        {
            $t=GMPToBin($b,12,1);
            $b1=substr($t,0,1).substr($t,2,6);
            $b2=substr($t,8,4).substr($t,1,1);
            $riga[$indice]=$b1.substr($c2,0,13).$b2.substr($c2,13,7);
        }
        else
        {
            $t=GMPToBin($b,20,1);
            $b=substr($t,0,1).substr($t,10,10).substr($t,9,1).substr($t,1,8);
            $riga[$indice]=$b.$c2;
        }
    }
    $indice=$indice+1;
}

require_once 'init.php';

if(!empty($_SESSION['codice'])) {
	$_SESSION['loaded']=true;
}
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
    <link href='../css/styles.css' rel='stylesheet' type='text/css'>
	<meta name="robots" content="noindex" />
</head>
<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' bgcolor='#666666'>
<?php
//######## In caso dell'errore stampa il messaggio
if ($ERR!='')
{
    print '<div align=center><br><font size=2 face=arial color=red><b>';
    print $ERR;
    print '</b></font></div>';
	exit();
//######## Altrimenti, stampa la lista
}
else
{
    $riga[$indice2]='00000000000000000000000000000000';
    $riga[$indice2+1]='00000000000000000000000000000000';
    $riga[$indice2+2]='00000000000000000000000000000000';
    $riga[$indice2+3]='00000000000000000000000000000000';
    $riga[$indice2+4]='00000000000000000000000000000000';
    $_SESSION['MemIstr']=$riga;
    $_SESSION['MemIstrDim']=$indice2;
}


$_SESSION['destra']='';
header('Location: leftPanel.php');
?>

