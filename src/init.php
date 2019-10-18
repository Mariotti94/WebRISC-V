<?php
//VERSION
$_SESSION['version']="1.2a";

//STATUS
$_SESSION['clock']=0;
$_SESSION['inserted']=false;
$_SESSION['loaded']=false;
$_SESSION['start']=false;
$_SESSION['finito']=false;

//MEMORIA DELLE ISTRUZIONI MemIstr(n) dove n = numero di istruzioni
$i=0;
while($i!=1000)
{
    $MemIstr[$i]=str_repeat('0',32);
    $i=$i+1;
}
$_SESSION['MemIstr']=$MemIstr;
$_SESSION['MemIstrDim']=0;

//REGISTRI
$i=0;
while($i!=32)
{
    $registri[$i]=0;
    $i=$i+1;
}

$registri[2]=5000;
$registri[8]=5000;
$_SESSION['registri']=$registri;
$HILO=0;
$_SESSION['HILO']=$HILO;

//MEMORIA DATI
$i=0;
while($i!=5000)
{
    $MemDati[$i]=str_repeat('0',8);
    $i=$i+1;
}
$_SESSION['MemDati']=$MemDati;

//STATO IF

$_SESSION['PC']=0;
$_SESSION['ifIstruzione']=1002;

//STATO ID

$_SESSION['idIstruzione']=1002;
$_SESSION['ID_scarta']=0;
$_SESSION['EX_scarta']=0;
$_SESSION['IF_scarta']=0;

$_SESSION['Istruzione']=str_repeat('0',32);
$_SESSION['IF_ID_PCpiu4']=0;
$_SESSION['IF_ID_IFscarta']=0;

//STATO EX

$_SESSION['exIstruzione']=1002;
$_SESSION['ID_EX_WB']='00';
$_SESSION['ID_EX_M']='0000';
$_SESSION['ID_EX_EX']='000';
$_SESSION['ID_EX_PCpiu4']='0';
$_SESSION['ID_EX_Data1']=0;
$_SESSION['ID_EX_Data2']=0;
$_SESSION['ID_EX_imm']=str_repeat('0',64);
$_SESSION['ID_EX_RS1']='0';
$_SESSION['ID_EX_RS2']='0';
$_SESSION['ID_EX_RD']='0';
$_SESSION['ID_EX_campoOp']=0;
$_SESSION['ID_EX_funct7']=0;
$_SESSION['ID_EX_funct3']=0;

//STATO MEM

$_SESSION['memIstruzione']=1002;
$_SESSION['EX_MEM_WB']='00';
$_SESSION['EX_MEM_M']='0000';
$_SESSION['EX_MEM_RIS']=0;
$_SESSION['EX_MEM_DataW']='0';
$_SESSION['EX_MEM_RegW']='0';

//STATO WB

$_SESSION['wbIstruzione']=1002;
$_SESSION['MEM_WB_WB']='00';
$_SESSION['MEM_WB_DataR']='0';
$_SESSION['MEM_WB_Data']='0';
$_SESSION['MEM_WB_RegW']='0';

//SEGNALI SULLO SCHEMA
$_SESSION['segDati']='checked';
$_SESSION['segCtrl']='checked';

//DATI SCHEMA
$_SESSION['schemaData']=array_fill(0, 65, 0);
$_SESSION['prev_schemaData']=array_fill(0, 65, 0);

//PIPE
$_SESSION['execTrail']=array();
$_SESSION['execStage']=array_fill(0, 5, "-");
$_SESSION['pipeTable']=array();

//STALLO
$_SESSION['stallo']=0;
?>
