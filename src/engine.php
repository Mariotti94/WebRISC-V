<?php
//############################################
//BOUNDS CHECK

if (empty($_SESSION['memIstrUse'])) {
  return;
}
if ($_SESSION['data'][$_SESSION['index']]['clock']>=$_SESSION['maxCycle']) {
  echo "<div align=center><font color=red size=3><b>OVER ".$_SESSION['maxCycle']." CLOCK CYCLES</b></font></div>";
  //RESET STATE
  $temp_codice=$_SESSION['codice'];
  $temp_branchRes=$_SESSION['branchRes'];
  $temp_forwarding=$_SESSION['forwarding'];
  $_SESSION = array();
  session_destroy();
  session_start();
  require_once 'init.php';
  $_SESSION['codice']=$temp_codice;
  $_SESSION['branchRes']=$temp_branchRes;
  $_SESSION['forwarding']=$temp_forwarding;
  exit();
}

//############################################
//EXECUTION TYPE

$agg=isset($_GET["agg"])?$_GET["agg"]:"forward";
$agg=$_SESSION['data'][0]['sysHold']?"hold":$agg;

if ($agg=="back") {
  $_SESSION['index']+=1;
  $overBackLimit = (isset($_SESSION['data'][$_SESSION['index']]))?false:true;
  $_SESSION['index'] = ($overBackLimit)?(count($_SESSION['data'])-1):$_SESSION['index'];
  return;
}
if ($agg=="refresh" || $agg=="new" || $agg=="return" || $agg=="hold") {
  return;
}
if ($agg=="forward" && $_SESSION['index']!=0) {
  $_SESSION['index']-=1;
  return;
}
if ($agg=="forward" && !$_SESSION['data'][0]['finito']) {
  array_unshift($_SESSION['data'], $_SESSION['data'][0]) ;
  $_SESSION['data'][0]['sysCall']=false;
}

//############################################
//GET SESSION DATA

//INSTRUCTION MEMORY
$memIstr=$_SESSION['memIstr'];
//REGISTERS
$registri=$_SESSION['data'][0]['registri'];
//DATA MEMORY
$memDati=$_SESSION['data'][0]['memDati'];

//STAGE IF
$tempPC=$_SESSION['PC'];
//STAGE ID
$ID_scarta=$_SESSION['ID_scarta'];
$EX_scarta=$_SESSION['EX_scarta'];
$IF_scarta=$_SESSION['IF_scarta'];
$istruzione=$_SESSION['istruzione'];
$IF_ID_PC=$_SESSION['IF_ID_PC'];
//STAGE EX
$ID_EX_WB=$_SESSION['ID_EX_WB'];
$ID_EX_M=$_SESSION['ID_EX_M'];
$ID_EX_EX=$_SESSION['ID_EX_EX'];
$ID_EX_PC=$_SESSION['ID_EX_PC'];
$ID_EX_Data1=$_SESSION['ID_EX_Data1'];
$ID_EX_Data2=$_SESSION['ID_EX_Data2'];
$ID_EX_imm=$_SESSION['ID_EX_imm'];
$ID_EX_RS1=$_SESSION['ID_EX_RS1'];
$ID_EX_RS2=$_SESSION['ID_EX_RS2'];
$ID_EX_RD=$_SESSION['ID_EX_RD'];
$ID_EX_campoOp=$_SESSION['ID_EX_campoOp'];
$ID_EX_funct3=$_SESSION['ID_EX_funct3'];
$ID_EX_funct7=$_SESSION['ID_EX_funct7'];
//STAGE MEM
$EX_MEM_WB=$_SESSION['EX_MEM_WB'];
$EX_MEM_M=$_SESSION['EX_MEM_M'];
$EX_MEM_RIS=$_SESSION['EX_MEM_RIS'];
$EX_MEM_DataW=$_SESSION['EX_MEM_DataW'];
$EX_MEM_RegW=$_SESSION['EX_MEM_RegW'];
//STAGE WB
$MEM_WB_WB=$_SESSION['MEM_WB_WB'];
$MEM_WB_DataR=$_SESSION['MEM_WB_DataR'];
$MEM_WB_Data=$_SESSION['MEM_WB_Data'];
$MEM_WB_RegW=$_SESSION['MEM_WB_RegW'];

//STALL
$stallo=($_SESSION['stallo']>0)?$_SESSION['stallo']-1:$_SESSION['stallo'];

if ($_SESSION['loaded'] && !$_SESSION['data'][0]['finito']) {
  $_SESSION['start']=true;
}

if (!$_SESSION['data'][0]['finito'] && $_SESSION['start']) {
  $_SESSION['data'][0]['clock']=$_SESSION['data'][0]['clock']+1;
}

//############################################
//CONTROL SIGNALS

$isBranch = (BinToGMP(substr($istruzione,25,7),1)==hexdec(63))?true:false;
$isJal = (BinToGMP(substr($istruzione,25,7),1)==hexdec('6F'))?true:false;
$isJalr = (BinToGMP(substr($istruzione,25,7),1)==hexdec(67))?true:false;

$isSyscall = (BinToGMP(substr($istruzione,25,7),1)==hexdec(73))?true:false;

//############################################
//Stage WB

if (substr($MEM_WB_WB,1,1)=="1") { //MemToReg MEM/WB
  $WBdata=$MEM_WB_DataR;
}
else {
  $WBdata=$MEM_WB_Data;
}

if (substr($MEM_WB_WB,0,1)=="1") //RegWrite MEM/WB
{
  if ($MEM_WB_RegW!=0) { //ignore x0
    $registri[$MEM_WB_RegW]=$WBdata;
  }
}

//############################################
//Stage M

if (substr($EX_MEM_M,1,1)=="1") //MemWrite EX/MEM
{
  if (substr($EX_MEM_M,2,2)=="11") //Save DWord
  {
    $insieme=GMPToBin($EX_MEM_DataW,64,0);
    $byte0=substr($insieme,0,8);
    $byte1=substr($insieme,8,8);
    $byte2=substr($insieme,16,8);
    $byte3=substr($insieme,24,8);
    $byte4=substr($insieme,32,8);
    $byte5=substr($insieme,40,8);
    $byte6=substr($insieme,48,8);
    $byte7=substr($insieme,56,8);
    $prova=$EX_MEM_RIS%8;
    if ($prova!=0) {
      echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
      exit();
    }

    $EX_MEM_RIS=intval($EX_MEM_RIS);
    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-8)) && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) ) {
      $memDati[$EX_MEM_RIS]=$byte7;
      $memDati[$EX_MEM_RIS+1]=$byte6;
      $memDati[$EX_MEM_RIS+2]=$byte5;
      $memDati[$EX_MEM_RIS+3]=$byte4;
      $memDati[$EX_MEM_RIS+4]=$byte3;
      $memDati[$EX_MEM_RIS+5]=$byte2;
      $memDati[$EX_MEM_RIS+6]=$byte1;
      $memDati[$EX_MEM_RIS+7]=$byte0;
    }
    else {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
  else if (substr($EX_MEM_M,2,2)=="10") //Save Word
  {
    $insieme=GMPToBin($EX_MEM_DataW,32,0);
    $byte0=substr($insieme,0,8);
    $byte1=substr($insieme,8,8);
    $byte2=substr($insieme,16,8);
    $byte3=substr($insieme,24,8);
    $prova=$EX_MEM_RIS%4;
    if ($prova!=0) {
      echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
      exit();
    }

    $EX_MEM_RIS=intval($EX_MEM_RIS);
    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-4))  && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) ) {
      $memDati[$EX_MEM_RIS]=$byte3;
      $memDati[$EX_MEM_RIS+1]=$byte2;
      $memDati[$EX_MEM_RIS+2]=$byte1;
      $memDati[$EX_MEM_RIS+3]=$byte0;
    }
    else {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
  else if (substr($EX_MEM_M,2,2)=="01") //Save Half
  {
    $insieme=GMPToBin($EX_MEM_DataW,16,0);
    $byte0=substr($insieme,0,8);
    $byte1=substr($insieme,8,8);
    $prova=$EX_MEM_RIS%2;
    if ($prova!=0) {
      echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
      exit();
    }

    $EX_MEM_RIS=intval($EX_MEM_RIS);
    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-2))  && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) ) {
      $memDati[$EX_MEM_RIS]=$byte1;
      $memDati[$EX_MEM_RIS+1]=$byte0;
    }
    else {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
  else if (substr($EX_MEM_M,2,2)=="00") //Save Byte
  {
    $dato=GMPToBin($EX_MEM_DataW,8,0);
    $lungh=strlen($dato);
    if ($lungh>8) {
      $dato=substr($dato,strlen($dato)-(8));
    }

    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-1))  && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) ) {
      $memDati[$EX_MEM_RIS]=$dato;
    }
    else {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
}

if (substr($EX_MEM_M,0,1)=="1") //MemRead EX/MEM
{
  if (substr($EX_MEM_M,2,2)=="11") //Load DWord
  {
    $prova=$EX_MEM_RIS%8;
    if ($prova!=0) {
      echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
      exit();
    }

    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-8)) && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) ) {
      $byte7=isset($memDati[$EX_MEM_RIS+7])?$memDati[$EX_MEM_RIS+7]:str_repeat('0',8);
      $byte6=isset($memDati[$EX_MEM_RIS+6])?$memDati[$EX_MEM_RIS+6]:str_repeat('0',8);
      $byte5=isset($memDati[$EX_MEM_RIS+5])?$memDati[$EX_MEM_RIS+5]:str_repeat('0',8);
      $byte4=isset($memDati[$EX_MEM_RIS+4])?$memDati[$EX_MEM_RIS+4]:str_repeat('0',8);
      $byte3=isset($memDati[$EX_MEM_RIS+3])?$memDati[$EX_MEM_RIS+3]:str_repeat('0',8);
      $byte2=isset($memDati[$EX_MEM_RIS+2])?$memDati[$EX_MEM_RIS+2]:str_repeat('0',8);
      $byte1=isset($memDati[$EX_MEM_RIS+1])?$memDati[$EX_MEM_RIS+1]:str_repeat('0',8);
      $byte0=isset($memDati[$EX_MEM_RIS])?$memDati[$EX_MEM_RIS]:str_repeat('0',8);
      $temp_MEM_WB_DataR=$byte7.$byte6.$byte5.$byte4.$byte3.$byte2.$byte1.$byte0;
      $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
    }
    else {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
  else if (substr($EX_MEM_M,2,2)=="10") //Load Word
  {
    $prova=$EX_MEM_RIS%4;
    if ($prova!=0) {
      echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
      exit();
    }

    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-4)) && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) )
    {
      $byte3=isset($memDati[$EX_MEM_RIS+3])?$memDati[$EX_MEM_RIS+3]:str_repeat('0',8);
      $byte2=isset($memDati[$EX_MEM_RIS+2])?$memDati[$EX_MEM_RIS+2]:str_repeat('0',8);
      $byte1=isset($memDati[$EX_MEM_RIS+1])?$memDati[$EX_MEM_RIS+1]:str_repeat('0',8);
      $byte0=isset($memDati[$EX_MEM_RIS])?$memDati[$EX_MEM_RIS]:str_repeat('0',8);
      $temp_MEM_WB_DataR=$byte3.$byte2.$byte1.$byte0;
      if (substr($EX_MEM_M,4,1)=="0") {
        $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
      }
      else { //unsigned
        $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,1);
      }
    }
    else
    {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
  else if (substr($EX_MEM_M,2,2)=="01") //Load Half
  {
    $prova=$EX_MEM_RIS%2;
    if ($prova!=0) {
      echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
      exit();
    }

    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-2))  && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) )
    {
      $byte1=isset($memDati[$EX_MEM_RIS+1])?$memDati[$EX_MEM_RIS+1]:str_repeat('0',8);
      $byte0=isset($memDati[$EX_MEM_RIS])?$memDati[$EX_MEM_RIS]:str_repeat('0',8);
      $temp_MEM_WB_DataR=$byte1.$byte0;
      if (substr($EX_MEM_M,4,1)=="0") {
        $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
      }
      else { //unsigned
        $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,1);
      }
    }
    else
    {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
  else if (substr($EX_MEM_M,2,2)=="00") //Load Byte
  {
    if ( ($EX_MEM_RIS<=($_SESSION['maxMem']-1))  && ($EX_MEM_RIS>=($_SESSION['maxMem']-$_SESSION['maxWritableMem'])) )
    {
      $temp_MEM_WB_DataR=isset($memDati[$EX_MEM_RIS])?$memDati[$EX_MEM_RIS]:str_repeat('0',8);
      if (substr($EX_MEM_M,4,1)=="0") {
        $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
      }
      else { //unsigned
        $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,1);
      }
    }
    else
    {
      echo "<div align=center><font color=red size=3><b>ERROR:<br>OUT OF WRITABLE MEMORY RANGE => [".$_SESSION['maxMem']." - ".($_SESSION['maxMem']-$_SESSION['maxWritableMem'])."]!</b></font></div>";
      exit();
    }
  }
}

//############################################
//DATA

$temp_ID_EX_op=substr($istruzione,25,7);
$temp_ID_EX_op=BinToGMP($temp_ID_EX_op,1);
$temp_ID_EX_funct3=substr($istruzione,17,3);
$temp_ID_EX_funct3=BinToGMP($temp_ID_EX_funct3,1);
$temp_ID_EX_funct7=substr($istruzione,0,7);
$temp_ID_EX_funct7=BinToGMP($temp_ID_EX_funct7,1);
$RL1=substr($istruzione,12,5); //rs1 regNum
$RL1=BinToGMP($RL1,1);
$RL2=substr($istruzione,7,5); //rs2 regNum
$RL2=BinToGMP($RL2,1);
$temp_ID_EX_Data1=$registri[$RL1]; //rs1 val
$temp_ID_EX_Data2=$registri[$RL2]; //rs2 val
$bDato1=$temp_ID_EX_Data1;
$bDato2=$temp_ID_EX_Data2;
if (!isset($temp_MEM_WB_DataR)) {
  $temp_MEM_WB_DataR=0;
}

//############################################
//IMMEDIATE GENERATOR

$tipo=instrType($temp_ID_EX_op);
$temp_ID_EX_imm=0;
if ($tipo=='I')
{
  if (($temp_ID_EX_op==hexdec(13)) && ($temp_ID_EX_funct3==1 || $temp_ID_EX_funct3==5)) {
    $temp_ID_EX_imm=substr($istruzione,6,6);
    $temp_ID_EX_imm=str_repeat('0',58).$temp_ID_EX_imm;
  }
  else {
    $temp_ID_EX_imm=substr($istruzione,0,12);
    $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
  }
}
if ($tipo=='S') {
  $temp_ID_EX_imm=substr($istruzione,0,7).substr($istruzione,20,5);
  $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
}
if ($tipo=='SB') {
  $temp_ID_EX_imm=substr($istruzione,0,1).substr($istruzione,24,1).substr($istruzione,1,6).substr($istruzione,20,4);
  $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
}
if ($tipo=='U') {
  $temp_ID_EX_imm=substr($istruzione,0,20);
  $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],32).$temp_ID_EX_imm.str_repeat('0',12);
}
if ($tipo=='UJ') {
  $temp_ID_EX_imm=substr($istruzione,0,1).substr($istruzione,12,8).substr($istruzione,11,1).substr($istruzione,1,10);
  $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],44).$temp_ID_EX_imm;
}

//############################################
//HAZARD DETECTION

//********************************************
//hazard: LOAD->R,I (forward: M=>X)
//hazard: LOAD->SB (forward: M=>D)

if (substr($ID_EX_M,0,1)=="1") //MemRead ID/EX
{
  if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0) //ignore x0
  {
    if ($stallo==0)
    {
      $stallo++;
      if ($isBranch || $_SESSION['forwarding']==0) {
        $stallo++;
      }
    }
  }
}

//********************************************
//hazard: R,I->SB (forward: X=>D)

if (substr($ID_EX_WB,0,1)=="1") //RegWrite ID/EX
{
  if ($isBranch)
  {
    if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0) //ignore x0
    {
      if ($stallo==0) {
        $stallo++;
        if ($_SESSION['forwarding']==0) {
          $stallo++;
        }
      }
    }
  }
}

//********************************************
//hazard: R,I->S (forward: M=>M)

if ($_SESSION['forwarding']==0)
{
  if (substr($EX_MEM_WB,0,1)=="1") //RegWrite EX/MEM
  {
    if ($EX_MEM_RegW==$ID_EX_RS2 && substr($ID_EX_M,1,1)=="1") {
      $stallo+=2;
    }
  }
}

//********************************************
//hazard: R,I->* (forward: X,M=>X)

if ($_SESSION['forwarding']==0)
{
  if (substr($ID_EX_WB,0,1)=="1") //RegWrite ID/EX
  {
    if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0) //ignore x0
    {
      if ($stallo==0) {
        $stallo+=2;
      }
    }
    if (($EX_MEM_RegW==$RL1 || $EX_MEM_RegW==$RL2) && $EX_MEM_RegW!=0) //ignore x0
    {
      if ($stallo==0) {
        $stallo++;
      }
    }
  }
}

//############################################
//FORWARDING

//********************************************
//forward: =>D (hazard: ->SB)

$MuxBranchCmp1="00";
$MuxBranchCmp2="00";

if ($_SESSION['forwarding']==1)
{
  if (substr($EX_MEM_WB,0,1)=="1") //RegWrite EX/MEM
  {
    if ($EX_MEM_RegW==$RL1 && $EX_MEM_RegW!=0) //ignore x0
    {
      if (substr($EX_MEM_WB,1,1)=="0") { //MemToReg EX/MEM
        $bDato1=$EX_MEM_RIS;
        $MuxBranchCmp1="01";
      }
      else {
        $bDato1=$temp_MEM_WB_DataR;
        $MuxBranchCmp1="10";
      }
    }

    if ($EX_MEM_RegW==$RL2 && $EX_MEM_RegW!=0) //ignore x0
    {
      if (substr($EX_MEM_WB,1,1)=="0") {
        $bDato2=$EX_MEM_RIS;
        $MuxBranchCmp2="01";
      }
      else {
        $bDato2=$temp_MEM_WB_DataR;
        $MuxBranchCmp2="10";
      }
    }
  }
}

//********************************************
//forward: =>X (hazard: ->R,I)
//forward: =>M (hazard: ->S)

$Mux3Ctrl="00";
$Mux4Ctrl="00";

if ($_SESSION['forwarding']==1)
{
  if ($ID_EX_RS1!=0) //ignore x0
  {
    if ($EX_MEM_RegW==$ID_EX_RS1 && substr($EX_MEM_WB,0,1)=="1") {
      $Mux3Ctrl="10";
    }
    else if ($MEM_WB_RegW==$ID_EX_RS1 && substr($MEM_WB_WB,0,1)=="1") {
      $Mux3Ctrl="01";
    }
  }

  if ($ID_EX_RS2!=0) //ignore x0
  {
    if ($EX_MEM_RegW==$ID_EX_RS2 && substr($EX_MEM_WB,0,1)=="1") {
      $Mux4Ctrl="10";
    }
    else if ($MEM_WB_RegW==$ID_EX_RS2 && substr($MEM_WB_WB,0,1)=="1") {
      $Mux4Ctrl="01";
    }
  }
}

//############################################
//SYSCALL CHECK

if (!$_SESSION['IF_scarta'])
{
  if ($isSyscall)
  {
    if ($stallo==0)
    {
      if (!$_SESSION['data'][0]['sysStall'])
      {
        $_SESSION['data'][0]['sysStall']=true;
        $stallo+=3;
      }
      else
      {
        $_SESSION['data'][0]['sysStall']=false;
        if (substr($istruzione,11,1)=="1") //Ebreak
        {
          $_SESSION['data'][0]['sysHold']=true;
          $_SESSION['data'][0]['sysBreak']=true;
        }
        else //Ecall
        {
          $_SESSION['data'][0]['sysCall']=true;
          if ($registri[17]=='1') {
            $_SESSION['data'][0]['sysConsole']=$_SESSION['data'][0]['sysConsole'].$registri[10].PHP_EOL;
          }
          else if ($registri[17]=='4') {
            $print_str='';
            $byte=$registri[10];
            while ($byte<($_SESSION['maxTextMem']+$_SESSION['maxStaticMem']) && isset($_SESSION['data'][0]['memDati'][$byte]) && $_SESSION['data'][0]['memDati'][$byte]!=str_repeat('0',8)) {
              $print_str=$print_str.chr(BinToGMP($_SESSION['data'][0]['memDati'][$byte],0));
              ++$byte;
            }
            $_SESSION['data'][0]['sysConsole']=$_SESSION['data'][0]['sysConsole'].$print_str.PHP_EOL;
          }
          else if ($registri[17]=='5') {
            $_SESSION['data'][0]['sysHold']=true;
            $_SESSION['data'][0]['sysInput']=true;
          }
          else {
            $_SESSION['data'][0]['sysHold']=true;
            $_SESSION['data'][0]['sysConsole']='SYSCALL ERROR';
          }
        }
      }
    }
  }
}

//############################################
//BRANCH COMPARATOR

$jump=false;
$branchCmp=true;
if (!$_SESSION['IF_scarta'])
{
  if ($isBranch)
  {
    $jump=true;
    if ($temp_ID_EX_funct3 == hexdec(0)) { //beq
      $branchCmp = ($bDato1==$bDato2)?true:false;
    }
    else if ($temp_ID_EX_funct3 == hexdec(1)) { //bne
      $branchCmp = ($bDato1!=$bDato2)?true:false;
    }
    else if ($temp_ID_EX_funct3 == hexdec(4)) { //blt
      $branchCmp = ($bDato1<$bDato2)?true:false;
    }
    else if ($temp_ID_EX_funct3 == hexdec(5)) { //bge
      $branchCmp = ($bDato1>=$bDato2)?true:false;
    }
    else if ($temp_ID_EX_funct3 == hexdec(6)) { //bltu
      $temp_bDato1=BinToGMP(GMPToBin($bDato1,64,0),1);
      $temp_bDato2=BinToGMP(GMPToBin($bDato2,64,0),1);
      $branchCmp = (gmp_cmp($temp_bDato1,$temp_bDato2)<0)?true:false;
    }
    else if ($temp_ID_EX_funct3 == hexdec(7)) { //bgeu
      $temp_bDato1=BinToGMP(GMPToBin($bDato1,64,0),1);
      $temp_bDato2=BinToGMP(GMPToBin($bDato2,64,0),1);
      $branchCmp = (gmp_cmp($temp_bDato1,$temp_bDato2)>=0)?true:false;
    }
  }
  if ($isJal||$isJalr)
  {
    $jump=true;
  }
}
$PCsrc=$jump&&$branchCmp;

//############################################
//ALU

$temp_ALUdato1=EXMux3($Mux3Ctrl,$ID_EX_Data1,$WBdata,$EX_MEM_RIS);
$Mux5Ctrl=substr($ID_EX_EX,2,2);
$ALUdato1=EXMux5($Mux5Ctrl,$temp_ALUdato1,$ID_EX_PC);

$temp_EX_MEM_DataW=EXMux4($Mux4Ctrl,$ID_EX_Data2,$WBdata,$EX_MEM_RIS);
$Mux6Ctrl=substr($ID_EX_EX,4,2);
$ID_EX_immVal=BinToGMP($ID_EX_imm,0);
$ALUdato2=EXMux6($Mux6Ctrl,$temp_EX_MEM_DataW,$ID_EX_immVal);

$ALUOp=substr($ID_EX_EX,0,2);

$aluCtrl=ctrlAlu($ALUOp,$ID_EX_funct7,$ID_EX_funct3,$ID_EX_campoOp);

$temp_EX_MEM_WB=$ID_EX_WB;
$temp_EX_MEM_M=$ID_EX_M;
$temp_EX_MEM_RIS=ALU($aluCtrl,$ALUdato1,$ALUdato2);
$temp_EX_MEM_RegW=$ID_EX_RD;

$temp_MEM_WB_WB=$EX_MEM_WB;
$temp_MEM_WB_Data=$EX_MEM_RIS;
$temp_MEM_WB_RegW=$EX_MEM_RegW;

//############################################
//DATA

$tempImm=BinToGMP($temp_ID_EX_imm,0);
$tempIstruzione=($stallo)?$istruzione:(($PCsrc&&($_SESSION['branchRes']==0))?str_repeat('0',32):$memIstr[$tempPC/4]);
$branchAddr=($IF_ID_PC+BinToGMP($temp_ID_EX_imm,0)*2);
$jalrAddr=$temp_ID_EX_Data1+gmp_intval(BinToGMP($temp_ID_EX_imm,0));
$newPC1=($isJalr)?$jalrAddr:$branchAddr;
$newPC2=$tempPC+4;
$newPC=IDMux($PCsrc,false,$newPC1,$newPC2);
$newPC=($stallo)?$tempPC:$newPC;

$IF_scarta=($PCsrc&&(!$stallo)&&($_SESSION['branchRes']==0))?1:0; //branch (ignore stall)
$ID_scarta=($stallo)?1:0; //stall, exception
$EX_scarta=0;  //exception

list($ctrl_EX,$ctrl_M,$ctrl_WB)=ctrlUnit($istruzione);
if ($stallo) {
  $temp_ID_EX_EX="000000";
  $temp_ID_EX_M="00000";
  $temp_ID_EX_WB="00";
}
else {
  $temp_ID_EX_EX=$ctrl_EX;
  $temp_ID_EX_M=$ctrl_M;
  $temp_ID_EX_WB=$ctrl_WB;
}

//############################################
//PIPELINE STATE

if (!$_SESSION['data'][0]['finito'])
{
  $a=$_SESSION['data'][0]['ifIstruzione'];
  $b=$_SESSION['data'][0]['idIstruzione'];
  $c=$_SESSION['data'][0]['exIstruzione'];
  $d=$_SESSION['data'][0]['memIstruzione'];
  if (!$stallo)
  {
    if (($tempPC/4)>=$_SESSION['memIstrUse']) {
      $_SESSION['data'][0]['ifIstruzione']=1002;
    }
    else {
      $_SESSION['data'][0]['ifIstruzione']=$tempPC/4;
    }
    $_SESSION['data'][0]['idIstruzione']=$a;
  }
  else
  {
    $_SESSION['data'][0]['idIstruzione']=1001; //stall
  }

  if ($_SESSION['IF_scarta']) {
    $_SESSION['data'][0]['idIstruzione']=1002;
  }

  $_SESSION['data'][0]['exIstruzione']=$b;
  $_SESSION['data'][0]['memIstruzione']=$c;
  $_SESSION['data'][0]['wbIstruzione']=$d;

  //EXECUTION TABLE
  for ($i=count($_SESSION['data'][0]['execStage'])-1; $i>0; --$i) {
    $_SESSION['data'][0]['execStage'][$i]=$_SESSION['data'][0]['execStage'][$i-1];
  }
  if ($_SESSION['data'][0]['idIstruzione']!=1001)
  {
    if ($_SESSION['data'][0]['ifIstruzione']!=1002) {
      $_SESSION['data'][0]['execTrail'][]=$memIstr[$tempPC/4];
      $_SESSION['data'][0]['execStage'][0]=count($_SESSION['data'][0]['execTrail'])-1;
    }
    else {
      $_SESSION['data'][0]['execStage'][0]="";
    }
  }
  else
  {
    $_SESSION['data'][0]['execStage'][1]="";
  }

  if ($_SESSION['data'][0]['idIstruzione']==1002) { //JUMP FLUSH
    $_SESSION['data'][0]['execStage'][1]="";
  }

  $stage=array("F","D","X","M","W");
  for ($i=0; $i<count($_SESSION['data'][0]['execStage']); ++$i)
  {
    if ($_SESSION['data'][0]['execStage'][$i]!=="-") {
      $_SESSION['data'][0]['pipeTable'][$_SESSION['data'][0]['clock']][$_SESSION['data'][0]['execStage'][$i]]=$stage[$i];
    }
  }
}

//############################################
//SAVE PIPELINE DATA

if (!$_SESSION['data'][0]['finito'])
{
  $_SESSION['data'][0]['schemaData'] = array($ALUOp,$ALUdato1,$ALUdato2,$EX_MEM_DataW,$EX_MEM_M,$EX_MEM_RIS,$EX_MEM_RegW,$EX_MEM_WB,$EX_scarta,$ID_EX_Data1,$ID_EX_Data2,$ID_EX_EX,$ID_EX_M,$ID_EX_PC,$ID_EX_RD,$ID_EX_RS1,$ID_EX_RS2,$ID_EX_WB,$ID_EX_campoOp,$ID_EX_funct3,$ID_EX_funct7,$ID_EX_immVal,$ID_scarta,$IF_ID_PC,$IF_scarta,$MEM_WB_Data,$MEM_WB_DataR,$MEM_WB_RegW,$MEM_WB_WB,$Mux3Ctrl,$Mux4Ctrl,$Mux5Ctrl,$Mux6Ctrl,$MuxBranchCmp1,$MuxBranchCmp2,$PCsrc,$RL1,$RL2,$WBdata,$aluCtrl,$jump,$branchAddr,$branchCmp,$ctrl_EX,$ctrl_M,$ctrl_WB,$isBranch,$isJalr,$istruzione,$jalrAddr,$newPC,$newPC1,$newPC2,$stallo,$tempImm,$tempIstruzione,$tempPC,$temp_ALUdato1,$temp_EX_MEM_DataW,$temp_EX_MEM_RIS,$temp_ID_EX_Data1,$temp_ID_EX_Data2,$temp_ID_EX_funct3,$temp_ID_EX_imm,$temp_MEM_WB_DataR);

  //END
  $_SESSION['data'][0]['finito'] = ($_SESSION['data'][0]['ifIstruzione']==1002) && ($_SESSION['data'][0]['idIstruzione']==1002) && ($_SESSION['data'][0]['exIstruzione']==1002) && ($_SESSION['data'][0]['memIstruzione']==1002) && ($_SESSION['data'][0]['wbIstruzione']==1002) && ($_SESSION['start']);
  if ($_SESSION['data'][0]['finito']) {
    return;
  }
}

//############################################
//SET SESSION DATA

$ID_EX_RS1=substr($istruzione,12,5);
$ID_EX_RS1=BinToGMP($ID_EX_RS1,1);
$ID_EX_RS2=substr($istruzione,7,5);
$ID_EX_RS2=BinToGMP($ID_EX_RS2,1);
$ID_EX_RD=substr($istruzione,20,5);
$ID_EX_RD=BinToGMP($ID_EX_RD,1);
$ID_EX_campoOp=$temp_ID_EX_op;
$ID_EX_funct3=$temp_ID_EX_funct3;
$ID_EX_funct7=$temp_ID_EX_funct7;

$ID_EX_WB=$temp_ID_EX_WB;
$ID_EX_M=$temp_ID_EX_M;
$ID_EX_EX=$temp_ID_EX_EX;
$ID_EX_PC=$IF_ID_PC;

$IF_ID_PC=($stallo)?$IF_ID_PC:$tempPC;
$ID_EX_imm=$temp_ID_EX_imm;
$ID_EX_Data1=$temp_ID_EX_Data1;
$ID_EX_Data2=$temp_ID_EX_Data2;
$EX_MEM_WB=$temp_EX_MEM_WB;
$EX_MEM_M=$temp_EX_MEM_M;
$EX_MEM_DataW=$temp_EX_MEM_DataW;
$EX_MEM_RIS=$temp_EX_MEM_RIS;
$EX_MEM_RegW=$temp_EX_MEM_RegW;
$MEM_WB_WB=$temp_MEM_WB_WB;
$MEM_WB_Data=$temp_MEM_WB_Data;
$MEM_WB_DataR=$temp_MEM_WB_DataR;
$MEM_WB_RegW=$temp_MEM_WB_RegW;

if (!$_SESSION['data'][0]['finito']) {
  //REGISTERS
  $_SESSION['data'][0]['registri']=$registri;
  //DATA MEMORY
  $_SESSION['data'][0]['memDati']=$memDati;

  //STAGE IF
  $_SESSION['PC']=$newPC;
  //STAGE ID
  $_SESSION['ID_scarta']=$ID_scarta;
  $_SESSION['EX_scarta']=$EX_scarta;
  $_SESSION['IF_scarta']=$IF_scarta;
  $_SESSION['istruzione']=$tempIstruzione;
  $_SESSION['IF_ID_PC']=$IF_ID_PC;
  //STAGE EX
  $_SESSION['ID_EX_WB']=$ID_EX_WB;
  $_SESSION['ID_EX_M']=$ID_EX_M;
  $_SESSION['ID_EX_EX']=$ID_EX_EX;
  $_SESSION['ID_EX_PC']=$ID_EX_PC;
  $_SESSION['ID_EX_Data1']=$ID_EX_Data1;
  $_SESSION['ID_EX_Data2']=$ID_EX_Data2;
  $_SESSION['ID_EX_imm']=$ID_EX_imm;
  $_SESSION['ID_EX_RS1']=$ID_EX_RS1;
  $_SESSION['ID_EX_RS2']=$ID_EX_RS2;
  $_SESSION['ID_EX_RD']=$ID_EX_RD;
  $_SESSION['ID_EX_campoOp']=$ID_EX_campoOp;
  $_SESSION['ID_EX_funct3']=$ID_EX_funct3;
  $_SESSION['ID_EX_funct7']=$ID_EX_funct7;
  //STAGE MEM
  $_SESSION['EX_MEM_WB']=$EX_MEM_WB;
  $_SESSION['EX_MEM_M']=$EX_MEM_M;
  $_SESSION['EX_MEM_RIS']=$EX_MEM_RIS;
  $_SESSION['EX_MEM_DataW']=$EX_MEM_DataW;
  $_SESSION['EX_MEM_RegW']=$EX_MEM_RegW;
  //STAGE WB
  $_SESSION['MEM_WB_WB']=$MEM_WB_WB;
  $_SESSION['MEM_WB_DataR']=$MEM_WB_DataR;
  $_SESSION['MEM_WB_Data']=$MEM_WB_Data;
  $_SESSION['MEM_WB_RegW']=$MEM_WB_RegW;

  //STALL
  $_SESSION['stallo']=$stallo;
}
?>