<?php
//VERSION
$_SESSION['version']="1.5";

//LIMITS
$_SESSION['maxCycle']=1000;
$_SESSION['maxMem']=5000;

//STATUS
unset($_SESSION['data']);
$_SESSION['index']=0;
$_SESSION['data'][0]['clock']=0;
$_SESSION['inserted']=false;
$_SESSION['loaded']=false;
$_SESSION['start']=false;
$_SESSION['data'][0]['finito']=false;

//INSTRUCTION MEMORY
//1000 32-bit elements
$i=0;
while($i!=1000)
{
    $memIstr[$i]=str_repeat('0',32);
    $i=$i+1;
}
$_SESSION['memIstr']=$memIstr;
$_SESSION['memIstrDim']=0;

//REGISTERS
//32 64-bit elements
$i=0;
while($i!=32)
{
    $registri[$i]='0';
    $i=$i+1;
}

$registri[2]=strval($_SESSION['maxMem']);
$registri[8]=strval($_SESSION['maxMem']);
$_SESSION['data'][0]['registri']=$registri;

//DATA MEMORY
//maxMem 8-bit elements
$i=0;
while($i!=strval($_SESSION['maxMem']))
{
    $memDati[$i]=str_repeat('0',8);
    $i=$i+1;
}
$_SESSION['data'][0]['memDati']=$memDati;

//STAGE IF
$_SESSION['PC']=0;
$_SESSION['data'][0]['ifIstruzione']=1002;

//STAGE ID
$_SESSION['data'][0]['idIstruzione']=1002;
$_SESSION['ID_scarta']=0;
$_SESSION['EX_scarta']=0;
$_SESSION['IF_scarta']=0;
$_SESSION['istruzione']=str_repeat('0',32);
$_SESSION['IF_ID_PC']=0;
$_SESSION['IF_ID_IFscarta']=0;

//STAGE EX
$_SESSION['data'][0]['exIstruzione']=1002;
$_SESSION['ID_EX_WB']='00';
$_SESSION['ID_EX_M']='0000';
$_SESSION['ID_EX_EX']='000';
$_SESSION['ID_EX_PC']='0';
$_SESSION['ID_EX_Data1']=0;
$_SESSION['ID_EX_Data2']=0;
$_SESSION['ID_EX_imm']=str_repeat('0',64);
$_SESSION['ID_EX_RS1']='0';
$_SESSION['ID_EX_RS2']='0';
$_SESSION['ID_EX_RD']='0';
$_SESSION['ID_EX_campoOp']=0;
$_SESSION['ID_EX_funct7']=0;
$_SESSION['ID_EX_funct3']=0;

//STAGE MEM
$_SESSION['data'][0]['memIstruzione']=1002;
$_SESSION['EX_MEM_WB']='00';
$_SESSION['EX_MEM_M']='0000';
$_SESSION['EX_MEM_RIS']=0;
$_SESSION['EX_MEM_DataW']='0';
$_SESSION['EX_MEM_RegW']='0';

//STAGE WB
$_SESSION['data'][0]['wbIstruzione']=1002;
$_SESSION['MEM_WB_WB']='00';
$_SESSION['MEM_WB_DataR']='0';
$_SESSION['MEM_WB_Data']='0';
$_SESSION['MEM_WB_RegW']='0';

//SCHEMA SIGNALS
$_SESSION['segDati']='checked';
$_SESSION['segCtrl']='checked';

//EXECUTION TABLE
$_SESSION['data'][0]['execTrail']=array();
$_SESSION['data'][0]['execStage']=array_fill(0, 5, "-");
$_SESSION['data'][0]['pipeTable']=array();

//STALL
$_SESSION['stallo']=0;

//CONSOLE
$_SESSION['data'][0]['sysStall']=false;
$_SESSION['data'][0]['sysHold']=false;
$_SESSION['data'][0]['sysInput']=false;
$_SESSION['data'][0]['sysBreak']=false;
$_SESSION['data'][0]['sysConsole']='';

//DATA SCHEMA
$_SESSION['data'][0]['schemaData']=array_fill(0, 63, NULL);
?>
