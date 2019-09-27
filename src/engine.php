<?php
//############################################

$agg=isset($_GET["agg"])?$_GET["agg"]:"";
if ($agg=="back")
{
	//RESTORE PREVIOUS DATA
	$_SESSION['start'] = $_SESSION['prev_start'];
	$_SESSION['clock']=$_SESSION['prev_clock'];
	$_SESSION['finito']=$_SESSION['prev_finito'];
	$_SESSION['HILO']=$_SESSION['prev_HILO'];
	$_SESSION['ifIstruzione']=$_SESSION['prev_ifIstruzione'];
	$_SESSION['idIstruzione']=$_SESSION['prev_idIstruzione'];
	$_SESSION['exIstruzione']=$_SESSION['prev_exIstruzione'];
	$_SESSION['memIstruzione']=$_SESSION['prev_memIstruzione'];
	$_SESSION['wbIstruzione']=$_SESSION['prev_wbIstruzione'];
	$_SESSION['MemIstr']=$_SESSION['prev_MemIstr'];
	$_SESSION['registri']=$_SESSION['prev_registri'];
	$_SESSION['MemDati']=$_SESSION['prev_MemDati'];
	$_SESSION['PC']=$_SESSION['prev_PC'];
	$_SESSION['ID_scarta']=$_SESSION['prev_ID_scarta'];
	$_SESSION['EX_scarta']=$_SESSION['prev_EX_scarta'];
	$_SESSION['IF_scarta']=$_SESSION['prev_IF_scarta'];
	$_SESSION['Istruzione']=$_SESSION['prev_Istruzione'];
	$_SESSION['IF_ID_PCpiu4']=$_SESSION['prev_IF_ID_PCpiu4'];
	$_SESSION['IF_ID_IFscarta']=$_SESSION['prev_IF_ID_IFscarta'];
	$_SESSION['ID_EX_WB']=$_SESSION['prev_ID_EX_WB'];
	$_SESSION['ID_EX_M']=$_SESSION['prev_ID_EX_M'];
	$_SESSION['ID_EX_EX']=$_SESSION['prev_ID_EX_EX'];
	$_SESSION['ID_EX_PCpiu4']=$_SESSION['prev_ID_EX_PCpiu4'];
	$_SESSION['ID_EX_Data1']=$_SESSION['prev_ID_EX_Data1'];
	$_SESSION['ID_EX_Data2']=$_SESSION['prev_ID_EX_Data2'];
	$_SESSION['ID_EX_imm']=$_SESSION['prev_ID_EX_imm'];
	$_SESSION['ID_EX_RS1']=$_SESSION['prev_ID_EX_RS1'];
	$_SESSION['ID_EX_RS2']=$_SESSION['prev_ID_EX_RS2'];
	$_SESSION['ID_EX_RD']=$_SESSION['prev_ID_EX_RD'];
	$_SESSION['ID_EX_campoOp']=$_SESSION['prev_ID_EX_campoOp'];
	$_SESSION['ID_EX_funct3']=$_SESSION['prev_ID_EX_funct3'];
	$_SESSION['ID_EX_funct7']=$_SESSION['prev_ID_EX_funct7'];
	$_SESSION['EX_MEM_WB']=$_SESSION['prev_EX_MEM_WB'];
	$_SESSION['EX_MEM_M']=$_SESSION['prev_EX_MEM_M'];
	$_SESSION['EX_MEM_RIS']=$_SESSION['prev_EX_MEM_RIS'];
	$_SESSION['EX_MEM_DataW']=$_SESSION['prev_EX_MEM_DataW'];
	$_SESSION['EX_MEM_RegW']=$_SESSION['prev_EX_MEM_RegW'];
	$_SESSION['MEM_WB_WB']=$_SESSION['prev_MEM_WB_WB'];
	$_SESSION['MEM_WB_DataR']=$_SESSION['prev_MEM_WB_DataR'];
	$_SESSION['MEM_WB_Data']=$_SESSION['prev_MEM_WB_Data'];
	$_SESSION['MEM_WB_RegW']=$_SESSION['prev_MEM_WB_RegW'];
	
	$_SESSION['execTrail']=$_SESSION['prev_execTrail'];
	$_SESSION['execStage']=$_SESSION['prev_execStage'];
	$_SESSION['pipeTable']=$_SESSION['prev_pipeTable'];
	$_SESSION['stallo']=$_SESSION['prev_stallo'];
}

//############################################
//Dati da ripristinare

//MEMORIA DELLE ISTRUZIONI 
$MemIstr=$_SESSION['MemIstr']; //1000 elementi di 32 bit
//REGISTRI
$registri=$_SESSION['registri']; //32 elementi di 64 bit
//MEMORIA DATI
$MemDati=$_SESSION['MemDati']; //5000 elementi di 8 bit

//STATO IF
$PC=$_SESSION['PC'];

//STATO ID
$ID_scarta=$_SESSION['ID_scarta'];
$EX_scarta=$_SESSION['EX_scarta'];
$IF_scarta=$_SESSION['IF_scarta'];
$istruzione=$_SESSION['Istruzione'];
$IF_ID_PCpiu4=$_SESSION['IF_ID_PCpiu4'];

//STATO EX
$ID_EX_WB=$_SESSION['ID_EX_WB'];
$ID_EX_M=$_SESSION['ID_EX_M'];
$ID_EX_EX=$_SESSION['ID_EX_EX'];
$ID_EX_PCpiu4=$_SESSION['ID_EX_PCpiu4'];
$ID_EX_Data1=$_SESSION['ID_EX_Data1'];
$ID_EX_Data2=$_SESSION['ID_EX_Data2'];
$ID_EX_imm=$_SESSION['ID_EX_imm'];
$ID_EX_RS1=$_SESSION['ID_EX_RS1'];
$ID_EX_RS2=$_SESSION['ID_EX_RS2'];
$ID_EX_RD=$_SESSION['ID_EX_RD'];
$ID_EX_campoOp=$_SESSION['ID_EX_campoOp'];
$ID_EX_funct3=$_SESSION['ID_EX_funct3'];
$ID_EX_funct7=$_SESSION['ID_EX_funct7'];

//STATO MEM
$EX_MEM_WB=$_SESSION['EX_MEM_WB'];
$EX_MEM_M=$_SESSION['EX_MEM_M'];
$EX_MEM_RIS=$_SESSION['EX_MEM_RIS'];
$EX_MEM_DataW=$_SESSION['EX_MEM_DataW'];
$EX_MEM_RegW=$_SESSION['EX_MEM_RegW'];

//STATO WB
$MEM_WB_WB=$_SESSION['MEM_WB_WB'];
$MEM_WB_DataR=$_SESSION['MEM_WB_DataR'];
$MEM_WB_Data=$_SESSION['MEM_WB_Data'];
$MEM_WB_RegW=$_SESSION['MEM_WB_RegW'];

//############################################
//EXECUTION STATUS

$a=$_SESSION['ifIstruzione'];
$b=$_SESSION['idIstruzione'];
$c=$_SESSION['exIstruzione'];
$d=$_SESSION['memIstruzione'];
$e=$_SESSION['wbIstruzione'];
if ($a==1002)
{
    $a=2;
}
else if ($a==1001)
{
    $a=1;
}
else
{
    $a=0;
}
if ($b==1002)
{
    $b=2;
}
else if ($b==1001)
{
    $b=1;
}
else
{
    $b=0;
}
if ($c==1002)
{
    $c=2;
}
else if ($c==1001)
{
    $c=1;
}
else
{
    $c=0;
}
if ($d==1002)
{
    $d=2;
}
else if ($d==1001)
{
    $d=1;
}
else
{
    $d=0;
}
if ($e==1002)
{
    $e=2;
}
else if ($e==1001)
{
    $e=1;
}
else
{
    $e=0;
}

//STALLO
$stallo=($_SESSION['stallo']>0)?$_SESSION['stallo']-1:$_SESSION['stallo'];

//############################################
//OUT OF CLOCK

if ($_SESSION['clock']>1000)
{
    print "<div align=center><font color=red size=3><b>OVER 1000 CLOCK CYCLES</b></font></div>";
    exit();
}

//############################################

if ( $agg=="refresh" || $agg=="new" ||  $agg=="back" )
{
	if ($agg=="refresh")	{
		$_SESSION['segDati']=isset($_POST["segDati"])?$_POST["segDati"]:"";
		$_SESSION['segCtrl']=isset($_POST["segCtrl"])?$_POST["segCtrl"]:"";
	}
	
	if( $agg=="back" ){
		//RESTORE PREVIOUS SCHEMA DATA
		list($ALUdato1,$ALUdato2,$AluOP,$EX_MEM_DataW,$EX_MEM_M,$EX_MEM_RIS,$EX_MEM_RegW,$EX_MEM_WB,$EX_scarta,$ID_EX_Data1,$ID_EX_Data2,$ID_EX_EX,$ID_EX_M,$ID_EX_RD,$ID_EX_RS1,$ID_EX_RS2,$ID_EX_WB,$ID_EX_funct3,$ID_EX_funct7,$ID_EX_imm2,$ID_scarta,$IF_scarta,$MEM_WB_Data,$MEM_WB_DataR,$MEM_WB_RegW,$MEM_WB_WB,$Mux3Ctrl,$Mux4Ctrl,$Mux5Ctrl,$PC,$PCsrc,$RL1,$RL2,$WBdata,$aluCtrl,$bDato1,$bDato2,$branch,$branchCheck,$ctrl_EX,$ctrl_M,$ctrl_WB,$isBranch,$isJal,$isJalr,$istruzione,$newPC,$newPC1,$newPC2,$stallo,$temp_EX_MEM_DataW,$temp_EX_MEM_M,$temp_EX_MEM_RIS,$temp_EX_MEM_WB,$temp_ID_EX_Data1,$temp_ID_EX_Data2,$temp_ID_EX_EX,$temp_ID_EX_M,$temp_ID_EX_WB,$temp_ID_EX_imm,$temp_IF_ID_PCpiu4,$temp_Istruzione,$temp_MEM_WB_DataR,$temp_MEM_WB_WB,$temp_PC)=$_SESSION['prev_schemaData'];
	}

	require_once "schema.php";
	exit();
}

//############################################
 
if(empty($_SESSION['MemIstrDim'])) 
{
	require_once "schema.php";
	exit();
}

//############################################

$_SESSION['prev_start'] = $_SESSION['start'];
$_SESSION['prev_finito']=$_SESSION['finito'];

if($a==2 && $b==2 && $c==2 && $d==2 && $e==2 && $_SESSION['start'])
{
	$_SESSION['finito']=true;
	require_once "schema.php";
	exit();
}

//############################################
//SAVE PREVIOUS SCHEMA DATA

$_SESSION['prev_schemaData'] = $_SESSION['schemaData'];

//############################################

if($_SESSION['loaded'] ) 
{	
	$_SESSION['start']=true;
}

//############################################

if (!$_SESSION['finito'] && $_SESSION['start'])
{
	$_SESSION['prev_clock']=$_SESSION['clock'];
    $_SESSION['clock']=$_SESSION['clock']+1;
}

//############################################
//IS JUMP

$isBranch = (BinToGMP(substr($istruzione,25,7),1)==hexdec(63))?true:false;
$typeBranch = (BinToGMP(substr($istruzione,17,3),1)==hexdec(0))?'beq':'bne';
$isJal = (BinToGMP(substr($istruzione,25,7),1)==hexdec('6F'))?true:false;
$isJalr = (BinToGMP(substr($istruzione,25,7),1)==hexdec(67))?true:false;

//############################################

//Stato WB, salvataggio dato nel registro
if (substr($MEM_WB_WB,1,1)=="1")
{	//Scelta del valore da salvare
    $WBdata=$MEM_WB_DataR;
}
else
{
    $WBdata=$MEM_WB_Data;
}

if (substr($MEM_WB_WB,0,1)=="1")
{	//Salvataggio (ma soltanto se RegWrite = 1)
    $registri[$MEM_WB_RegW]=$WBdata;
}

//############################################
//Riferimenti alla memoria dati

//Caso di una Save in memoria (MemWrite = 1)
if (substr($EX_MEM_M,1,1)=="1")
{
	if (substr($EX_MEM_M,2,2)=="11") //Save DWord
    {
        $insieme=GMPToBin($EX_MEM_DataW,64,0);
        $byte1=substr($insieme,0,8);
        $byte2=substr($insieme,8,8);
        $byte3=substr($insieme,16,8);
        $byte4=substr($insieme,24,8);
		$byte5=substr($insieme,32,8);
        $byte6=substr($insieme,40,8);
        $byte7=substr($insieme,48,8);
        $byte8=substr($insieme,56,8);
        $prova=$EX_MEM_RIS%8;
        if ($prova!=0)
        {
            print "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        $EX_MEM_RIS=intval($EX_MEM_RIS);
        if ($EX_MEM_RIS<=4992)
        {
            $MemDati[$EX_MEM_RIS]=$byte8;
            $MemDati[$EX_MEM_RIS+1]=$byte7;
            $MemDati[$EX_MEM_RIS+2]=$byte6;
            $MemDati[$EX_MEM_RIS+3]=$byte5;
			$MemDati[$EX_MEM_RIS+4]=$byte4;
            $MemDati[$EX_MEM_RIS+5]=$byte3;
            $MemDati[$EX_MEM_RIS+6]=$byte2;
            $MemDati[$EX_MEM_RIS+7]=$byte1;
        }
		else
		{
            print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
			exit();
        }
    }
    else if (substr($EX_MEM_M,2,2)=="10") //Save Word
    {
        $insieme=GMPToBin($EX_MEM_DataW,32,0);
        $byte1=substr($insieme,0,8);
        $byte2=substr($insieme,8,8);
        $byte3=substr($insieme,16,8);
        $byte4=substr($insieme,24,8);
        $prova=$EX_MEM_RIS%4;
        if ($prova!=0)
        {
            print "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        $EX_MEM_RIS=intval($EX_MEM_RIS);
        if ($EX_MEM_RIS<=4996)
        {
            $MemDati[$EX_MEM_RIS]=$byte4;
            $MemDati[$EX_MEM_RIS+1]=$byte3;
            $MemDati[$EX_MEM_RIS+2]=$byte2;
            $MemDati[$EX_MEM_RIS+3]=$byte1;
        }
		else
		{
            print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
			exit();
        }
    }
	else if (substr($EX_MEM_M,2,2)=="01") //Save Half
    {
        $insieme=GMPToBin($EX_MEM_DataW,16,0);
        $byte1=substr($insieme,0,8);
        $byte2=substr($insieme,8,8);
        $prova=$EX_MEM_RIS%2;
        if ($prova!=0)
        {
            print "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        $EX_MEM_RIS=intval($EX_MEM_RIS);
        if ($EX_MEM_RIS<=4998)
        {
            $MemDati[$EX_MEM_RIS]=$byte2;
            $MemDati[$EX_MEM_RIS+1]=$byte1;
        }
		else
		{
            print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
			exit();
        }
    }
    else if (substr($EX_MEM_M,2,2)=="00") //Save Byte
    {
        $dato=GMPToBin($EX_MEM_DataW,8,0); 
        $lungh=strlen($dato);
        if ($lungh>8)
        {
            $dato=substr($dato,strlen($dato)-(8));
        }

		if ($EX_MEM_RIS<=4999)
        {
			$MemDati[$EX_MEM_RIS]=$dato;
		}
		else
		{
            print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
			exit();
        }
    }

}

//Caso di una Load (MemRead = 1)
if (substr($EX_MEM_M,0,1)=="1")
{	
	//var_dump($registri);

	if (substr($EX_MEM_M,2,2)=="11") //Load DWord
    {
        $prova=$EX_MEM_RIS%8;
        if ($prova!=0)
        {
            print "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        if ($EX_MEM_RIS<=4992)
        {
            $byte1=$MemDati[$EX_MEM_RIS];
            $byte2=$MemDati[$EX_MEM_RIS+1];
            $byte3=$MemDati[$EX_MEM_RIS+2];
            $byte4=$MemDati[$EX_MEM_RIS+3];
			$byte5=$MemDati[$EX_MEM_RIS+4];
			$byte6=$MemDati[$EX_MEM_RIS+5];
			$byte7=$MemDati[$EX_MEM_RIS+6];
			$byte8=$MemDati[$EX_MEM_RIS+7];
            $temp_MEM_WB_DataR=$byte8.$byte7.$byte6.$byte5.$byte4.$byte3.$byte2.$byte1;
            $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
        }
        else
        {
            print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
            //$temp_MEM_WB_DataR=1;
			exit();
        }
    }
    else if (substr($EX_MEM_M,2,2)=="10") //Load Word
    {
        $prova=$EX_MEM_RIS%4;
        if ($prova!=0)
        {
            print "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        if ($EX_MEM_RIS<=4996)
        {
            $byte1=$MemDati[$EX_MEM_RIS];
            $byte2=$MemDati[$EX_MEM_RIS+1];
            $byte3=$MemDati[$EX_MEM_RIS+2];
            $byte4=$MemDati[$EX_MEM_RIS+3];
            $temp_MEM_WB_DataR=$byte4.$byte3.$byte2.$byte1;
            $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
        }
        else
        {
			print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
            //$temp_MEM_WB_DataR=1;
			exit();
        }
    }
	else if (substr($EX_MEM_M,2,2)=="01") //Load Half
    {
        $prova=$EX_MEM_RIS%2;
        if ($prova!=0)
        {
            print "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        if ($EX_MEM_RIS<=4998)
        {
            $byte1=$MemDati[$EX_MEM_RIS];
            $byte2=$MemDati[$EX_MEM_RIS+1];
            $temp_MEM_WB_DataR=$byte2.$byte1;
            $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
        }
        else
        {
			print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
            //$temp_MEM_WB_DataR=1;
			exit();
        }
    }
    else if (substr($EX_MEM_M,2,2)=="00")
    {
		if ($EX_MEM_RIS<=4999)
        {
			$temp_MEM_WB_DataR=$MemDati[$EX_MEM_RIS]; //Load Byte
			$temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
		}
		else
        {
			print "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE!</b></font></div>";
            //$temp_MEM_WB_DataR=1;
			exit();
        }
	}
}

//############################################
//TEMP OP FUNCT

$temp_ID_EX_campoOp=substr($istruzione,25,7);
$temp_ID_EX_campoOp=BinToGMP($temp_ID_EX_campoOp,1);
$temp_ID_EX_funct3=substr($istruzione,17,3);
$temp_ID_EX_funct3=BinToGMP($temp_ID_EX_funct3,1);
$temp_ID_EX_funct7=substr($istruzione,0,7);
$temp_ID_EX_funct7=BinToGMP($temp_ID_EX_funct7,1);

//############################################
//IMMEDIATE GENERATOR

$tipo=instrType($temp_ID_EX_campoOp);
$temp_ID_EX_imm=0;
if($tipo=='I') //I
{
	if( ($temp_ID_EX_campoOp==hexdec(13)) && ($temp_ID_EX_funct3==1 || $temp_ID_EX_funct3==5) )	{
		$temp_ID_EX_imm=substr($istruzione,7,5);
		$temp_ID_EX_imm=str_repeat("0",59).$temp_ID_EX_imm;
	} else {
		$temp_ID_EX_imm=substr($istruzione,0,12);
		$temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
	}
}
if($tipo=='S') //S
{
    $temp_ID_EX_imm=substr($istruzione,0,7).substr($istruzione,20,5);
    $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
}
if($tipo=='SB') //SB
{
    $temp_ID_EX_imm=substr($istruzione,0,1).substr($istruzione,24,1).substr($istruzione,1,6).substr($istruzione,20,4);
    $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
}
if($tipo=='UJ') //UJ
{
    $temp_ID_EX_imm=substr($istruzione,0,1).substr($istruzione,12,8).substr($istruzione,11,1).substr($istruzione,1,10);
    $temp_ID_EX_imm=str_repeat('0',44).$temp_ID_EX_imm;
}
//############################################

$temp_IF_ID_PCpiu4=$PC+1; //Aggiornamento del PC per la istruzione corrente

$ID_EX_PCpiu4=$IF_ID_PCpiu4; //PC da propagare

$newPC1=$temp_ID_EX_imm;
$newPC1=BinToGMP($newPC1,1); //Possibile nuovo PC 1, intero

$newPC2=$temp_IF_ID_PCpiu4; //Posibile nuovo PC 2, PC + 4

//############################################
//FORWARDING

$Mux3Ctrl="00";
if ($EX_MEM_RegW==$ID_EX_RS1 && substr($EX_MEM_WB,0,1)=="1")
{
    $Mux3Ctrl="10";
}
if ($MEM_WB_RegW==$ID_EX_RS1 && substr($MEM_WB_WB,0,1)=="1")
{
    $Mux3Ctrl="01";
}

$Mux4Ctrl="00";
if ($EX_MEM_RegW==$ID_EX_RS2 && substr($EX_MEM_WB,0,1)=="1")
{
    $Mux4Ctrl="10";
}
if ($MEM_WB_RegW==$ID_EX_RS2 && substr($MEM_WB_WB,0,1)=="1")
{
    $Mux4Ctrl="01";
}

//############################################
//ALU

$ALUdato1=EXMux3($Mux3Ctrl,$ID_EX_Data1,$WBdata,$EX_MEM_RIS);

$temp_EX_MEM_DataW=EXMux4($Mux4Ctrl,$ID_EX_Data2,$WBdata,$EX_MEM_RIS);

$Mux5Ctrl=substr($ID_EX_EX,2,1);
$ID_EX_imm2=BinToGMP($ID_EX_imm,0);
$ALUdato2=EXMux5($Mux5Ctrl,$temp_EX_MEM_DataW,$ID_EX_imm2);

$AluOP=substr($ID_EX_EX,0,2); //AluOP sono bit del registro ID/EX.M

$aluCtrl=UnitaCtrlAlu($AluOP,$ID_EX_funct7,$ID_EX_funct3,$ID_EX_campoOp);

$_SESSION['prev_HILO']=$_SESSION['HILO'];

$temp_EX_MEM_RIS=ALU($aluCtrl,$ALUdato1,$ALUdato2);

$temp_EX_MEM_RegW=$ID_EX_RD;

$temp_MEM_WB_WB=$EX_MEM_WB;
$temp_MEM_WB_Data=$EX_MEM_RIS;

$temp_EX_MEM_WB=$ID_EX_WB;
$temp_EX_MEM_M=$ID_EX_M;
$temp_MEM_WB_RegW=$EX_MEM_RegW;

//############################################
//STALL

//********************************************
//HAZARD DETECTION
//LOAD->R,I (M=>X), LOAD->SB (M=>D)

$RL1=substr($istruzione,12,5); //Campo rs1 dell'istruzione
$RL1=BinToGMP($RL1,1);

$RL2=substr($istruzione,7,5); //Campo rs2 dell'istruzione
$RL2=BinToGMP($RL2,1);

$IsLW=substr($ID_EX_M,0,1); //Segnale di controllo MemRead

if ($IsLW=="1")
{
    if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0)
    {
		if($stallo==0) {
			$stallo++; 
			if($isBranch) {
				$stallo++; 
			}
		}
    }
}

$temp_ID_EX_Data1=$registri[$RL1]; //Dato letto 1, valore corispodente al registro rs1
$temp_ID_EX_Data2=$registri[$RL2]; //Dato letto 2, valore corispodente al registro rs2

//********************************************
//stallo(invisibile per l'utente) [caso del branch]
//Se uno dei due registri da confrontare  uguale a registro destinazione nello stato successivo (ex) stallo
//R,I->SB (X=>D)

$ctrl_EX=substr($ID_EX_WB,0,1); //Regwrite nello stato ex
if ($ctrl_EX=="1" && $isBranch)
{
	//var_dump($ID_EX_RD,$RL1,$RL2); exit;
    if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0) {
		if($stallo==0) {
			$stallo++;
		}
    }
}

//********************************************
//forwarding (invisibile per l'utente) [caso del branch]
//Se uno dei due registri da confrontare  uguale a registro destinazione nello stato mem propagare il nuovo valore

$ctrl_MEM=substr($EX_MEM_WB,0,1); //Regwrite nello stato mem
$bDato1=$temp_ID_EX_Data1;
$bDato2=$temp_ID_EX_Data2;
if ($ctrl_MEM=="1")
{
    if ($EX_MEM_RegW==$RL1)
    {
        if (substr($EX_MEM_WB,1,1)=="0") {
            $bDato1=$EX_MEM_RIS;
        }
        else {
            $bDato1=$temp_MEM_WB_DataR;
        }
    }

    if ($EX_MEM_RegW==$RL2)
    {
        if (substr($EX_MEM_WB,1,1)=="0") {
            $bDato2=$EX_MEM_RIS;
        }
        else {
            $bDato2=$temp_MEM_WB_DataR;
        }
    }
}

//********************************************
//IS JUMP CHECK
$branch=false;
$branchCheck=false;
if(!$_SESSION['IF_scarta'])
{
	if ($isBranch) {
		$branch=true;
		if ($typeBranch == 'beq'){
			$branchCheck = ($bDato1==$bDato2)?true:false;
		}
		else if ($typeBranch == 'bne'){
			$branchCheck = ($bDato1!=$bDato2)?true:false;
		}
	}
	if ($isJal) {
		$branch=true;
		$branchCheck=true;
		$rd=substr($istruzione,20,5);
		$rd=BinToGMP($rd,1);
		if($rd!=0) {
			$registri[$rd]=$PC;
		}
	}
	if ($isJalr) {
		$branch=true;
		$branchCheck=true;
		$rs1=substr($istruzione,12,5);
		$rs1=BinToGMP($rs1,1);
		$newPC1=$registri[$rs1]+BinToGMP($temp_ID_EX_imm,0);
	}
}

//********************************************
//Generazioni dei segnali di controllo
$PCsrc=$branch&&$branchCheck;
//var_dump($branch,$branchCheck,$PCsrc,$bDato1,$bDato2);
$IF_scarta=($PCsrc&&(!$stallo)&&$_SESSION['branchFlush'])?1:0; //branch (not stalled)
$ID_scarta=($stallo)?1:0; //stall,exception
$EX_scarta=0;  //exception

$temp_PC=IDMux($PCsrc,false,$newPC1,$newPC2);
$newPC=($stallo)?$PC:$temp_PC;

list($ctrl_EX,$ctrl_M,$ctrl_WB)=UnitaDiCtrl_ctrl($istruzione);

if($stallo) {
	$temp_ID_EX_WB="00";
    $temp_ID_EX_M="0000";
    $temp_ID_EX_EX="000";
}
else {
	$temp_ID_EX_WB=$ctrl_WB;
    $temp_ID_EX_M=$ctrl_M;
    $temp_ID_EX_EX=$ctrl_EX;
}

$temp_Istruzione=($stallo)?$istruzione:(($PCsrc&&$_SESSION['branchFlush'])?str_repeat('0',32):$MemIstr[$PC]);
$temp_IF_ID_PCpiu4=$PC+1;

$_SESSION['prev_ifIstruzione']=$_SESSION['ifIstruzione'];
$_SESSION['prev_idIstruzione']=$_SESSION['idIstruzione'];
$_SESSION['prev_exIstruzione']=$_SESSION['exIstruzione'];
$_SESSION['prev_memIstruzione']=$_SESSION['memIstruzione'];
$_SESSION['prev_wbIstruzione']=$_SESSION['wbIstruzione'];

$a=$_SESSION['ifIstruzione'];
$b=$_SESSION['idIstruzione'];
$c=$_SESSION['exIstruzione'];
$d=$_SESSION['memIstruzione'];
if (!$stallo)
{
	if ($PC>=$_SESSION['MemIstrDim']) {
		$_SESSION['ifIstruzione']=1002;
	}
	else {
		$_SESSION['ifIstruzione']=$PC;
	}

	$_SESSION['idIstruzione']=$a;
}
else
{
	$_SESSION['idIstruzione']=1001; //stallo;
}

if($_SESSION['IF_scarta']) { //&& !$PCsrc) {
	$_SESSION['idIstruzione']=1002;
}

$_SESSION['exIstruzione']=$b;
$_SESSION['memIstruzione']=$c;
$_SESSION['wbIstruzione']=$d;

//SAVE PREVIOUS PIPE
$_SESSION['prev_execTrail']=$_SESSION['execTrail'];
$_SESSION['prev_execStage']=$_SESSION['execStage'];
$_SESSION['prev_pipeTable']=$_SESSION['pipeTable'];

//PIPE TABLE
for ($i=count($_SESSION['execStage'])-1; $i>0; --$i) {
	$_SESSION['execStage'][$i]=$_SESSION['execStage'][$i-1];
}
if($_SESSION['idIstruzione']!=1001) {
	if($_SESSION['ifIstruzione']!=1002) {
		$_SESSION['execTrail'][]=$MemIstr[$PC];
		$_SESSION['execStage'][0]=count($_SESSION['execTrail'])-1;
	} else {
		$_SESSION['execStage'][0]="";
	}
} else {
	$_SESSION['execStage'][1]="";
}

if($_SESSION['idIstruzione']==1002) { //jump flush
	$_SESSION['execStage'][1]="";
}

$stage=array("F","D","X","M","W");
for ($i=0; $i<count($_SESSION['execStage']); ++$i) {
	if($_SESSION['execStage'][$i]!=="-") {
		$_SESSION['pipeTable'][$_SESSION['clock']][$_SESSION['execStage'][$i]]=$stage[$i];
	}
}
//var_dump($_SESSION['execStage'],$_SESSION['execTrail'],$_SESSION['pipeTable']);
//############################################
//SAVE SCHEMA DATA

$_SESSION['schemaData'] = array($ALUdato1,$ALUdato2,$AluOP,$EX_MEM_DataW,$EX_MEM_M,$EX_MEM_RIS,$EX_MEM_RegW,$EX_MEM_WB,$EX_scarta,$ID_EX_Data1,$ID_EX_Data2,$ID_EX_EX,$ID_EX_M,$ID_EX_RD,$ID_EX_RS1,$ID_EX_RS2,$ID_EX_WB,$ID_EX_funct3,$ID_EX_funct7,$ID_EX_imm2,$ID_scarta,$IF_scarta,$MEM_WB_Data,$MEM_WB_DataR,$MEM_WB_RegW,$MEM_WB_WB,$Mux3Ctrl,$Mux4Ctrl,$Mux5Ctrl,$PC,$PCsrc,$RL1,$RL2,$WBdata,$aluCtrl,$bDato1,$bDato2,$branch,$branchCheck,$ctrl_EX,$ctrl_M,$ctrl_WB,$isBranch,$isJal,$isJalr,$istruzione,$newPC,$newPC1,$newPC2,$stallo,$temp_EX_MEM_DataW,$temp_EX_MEM_M,$temp_EX_MEM_RIS,$temp_EX_MEM_WB,$temp_ID_EX_Data1,$temp_ID_EX_Data2,$temp_ID_EX_EX,$temp_ID_EX_M,$temp_ID_EX_WB,$temp_ID_EX_imm,$temp_IF_ID_PCpiu4,$temp_Istruzione,isset($temp_MEM_WB_DataR)?$temp_MEM_WB_DataR:0,$temp_MEM_WB_WB,$temp_PC);

//############################################
//VISUALIZE PIPELINE

require_once "schema.php";

//############################################
//SALVATAGGIO DATI TEMPORANEI

$ID_EX_RS1=substr($istruzione,12,5);
$ID_EX_RS1=BinToGMP($ID_EX_RS1,1);
$ID_EX_RS2=substr($istruzione,7,5);
$ID_EX_RS2=BinToGMP($ID_EX_RS2,1);
$ID_EX_RD=substr($istruzione,20,5);
$ID_EX_RD=BinToGMP($ID_EX_RD,1);
$ID_EX_campoOp=$temp_ID_EX_campoOp;
$ID_EX_funct3=$temp_ID_EX_funct3;
$ID_EX_funct7=$temp_ID_EX_funct7;

$ID_EX_WB=$temp_ID_EX_WB;
$ID_EX_M=$temp_ID_EX_M;
$ID_EX_EX=$temp_ID_EX_EX;

$PC=$newPC;

$istruzione=$temp_Istruzione;
$IF_ID_PCpiu4=$temp_IF_ID_PCpiu4;
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
$MEM_WB_DataR=isset($temp_MEM_WB_DataR)?$temp_MEM_WB_DataR:0;
$MEM_WB_RegW=$temp_MEM_WB_RegW;

//######################################

$_SESSION['prev_MemIstr']=$_SESSION['MemIstr'];
$_SESSION['prev_registri']=$_SESSION['registri'];
$_SESSION['prev_MemDati']=$_SESSION['MemDati'];
$_SESSION['prev_PC']=$_SESSION['PC'];
$_SESSION['prev_ID_scarta']=$_SESSION['ID_scarta'];
$_SESSION['prev_EX_scarta']=$_SESSION['EX_scarta'];
$_SESSION['prev_IF_scarta']=$_SESSION['IF_scarta'];
$_SESSION['prev_Istruzione']=$_SESSION['Istruzione'];
$_SESSION['prev_IF_ID_PCpiu4']=$_SESSION['IF_ID_PCpiu4'];
$_SESSION['prev_IF_ID_IFscarta']=$_SESSION['IF_ID_IFscarta'];
$_SESSION['prev_ID_EX_WB']=$_SESSION['ID_EX_WB'];
$_SESSION['prev_ID_EX_M']=$_SESSION['ID_EX_M'];
$_SESSION['prev_ID_EX_EX']=$_SESSION['ID_EX_EX'];
$_SESSION['prev_ID_EX_PCpiu4']=$_SESSION['ID_EX_PCpiu4'];
$_SESSION['prev_ID_EX_Data1']=$_SESSION['ID_EX_Data1'];
$_SESSION['prev_ID_EX_Data2']=$_SESSION['ID_EX_Data2'];
$_SESSION['prev_ID_EX_imm']=$_SESSION['ID_EX_imm'];
$_SESSION['prev_ID_EX_RS1']=$_SESSION['ID_EX_RS1'];
$_SESSION['prev_ID_EX_RS2']=$_SESSION['ID_EX_RS2'];
$_SESSION['prev_ID_EX_RD']=$_SESSION['ID_EX_RD'];
$_SESSION['prev_ID_EX_campoOp']=$_SESSION['ID_EX_campoOp'];
$_SESSION['prev_ID_EX_funct3']=$_SESSION['ID_EX_funct3'];
$_SESSION['prev_ID_EX_funct7']=$_SESSION['ID_EX_funct7'];
$_SESSION['prev_EX_MEM_WB']=$_SESSION['EX_MEM_WB'];
$_SESSION['prev_EX_MEM_M']=$_SESSION['EX_MEM_M'];
$_SESSION['prev_EX_MEM_RIS']=$_SESSION['EX_MEM_RIS'];
$_SESSION['prev_EX_MEM_DataW']=$_SESSION['EX_MEM_DataW'];
$_SESSION['prev_EX_MEM_RegW']=$_SESSION['EX_MEM_RegW'];
$_SESSION['prev_MEM_WB_WB']=$_SESSION['MEM_WB_WB'];
$_SESSION['prev_MEM_WB_DataR']=$_SESSION['MEM_WB_DataR'];
$_SESSION['prev_MEM_WB_Data']=$_SESSION['MEM_WB_Data'];
$_SESSION['prev_MEM_WB_RegW']=$_SESSION['MEM_WB_RegW'];

//######################################
//SALVATAGGIO DATI PER IL PROSSIMO CICLO DI CLOCK

//MEMORIA DELLE ISTRUZIONI 
$_SESSION['MemIstr']=$MemIstr; //1000 elementi di 32 bit;
//REGISTRI
$_SESSION['registri']=$registri; //32 elementi di 32 bit;
//MEMORIA DATI
$_SESSION['MemDati']=$MemDati; //5000 elementi di 8 bit;

//STATO IF
$_SESSION['PC']=$PC;

//STATO ID
$_SESSION['ID_scarta']=$ID_scarta;
$_SESSION['EX_scarta']=$EX_scarta;
$_SESSION['IF_scarta']=$IF_scarta;
$_SESSION['Istruzione']=$istruzione;
$_SESSION['IF_ID_PCpiu4']=$IF_ID_PCpiu4;

//STATO EX
$_SESSION['ID_EX_WB']=$ID_EX_WB;
$_SESSION['ID_EX_M']=$ID_EX_M;
$_SESSION['ID_EX_EX']=$ID_EX_EX;
$_SESSION['ID_EX_PCpiu4']=$ID_EX_PCpiu4;
$_SESSION['ID_EX_Data1']=$ID_EX_Data1;
$_SESSION['ID_EX_Data2']=$ID_EX_Data2;
$_SESSION['ID_EX_imm']=$ID_EX_imm;
$_SESSION['ID_EX_RS1']=$ID_EX_RS1;
$_SESSION['ID_EX_RS2']=$ID_EX_RS2;
$_SESSION['ID_EX_RD']=$ID_EX_RD;
$_SESSION['ID_EX_campoOp']=$ID_EX_campoOp;
$_SESSION['ID_EX_funct3']=$ID_EX_funct3;
$_SESSION['ID_EX_funct7']=$ID_EX_funct7;

//STATO MEM
$_SESSION['EX_MEM_WB']=$EX_MEM_WB;
$_SESSION['EX_MEM_M']=$EX_MEM_M;
$_SESSION['EX_MEM_RIS']=$EX_MEM_RIS;
$_SESSION['EX_MEM_DataW']=$EX_MEM_DataW;
$_SESSION['EX_MEM_RegW']=$EX_MEM_RegW;

//STATO WB
$_SESSION['MEM_WB_WB']=$MEM_WB_WB;
$_SESSION['MEM_WB_DataR']=$MEM_WB_DataR;
$_SESSION['MEM_WB_Data']=$MEM_WB_Data;
$_SESSION['MEM_WB_RegW']=$MEM_WB_RegW;

//############################################
		
//SALVATAGGIO STALLO
$_SESSION['prev_stallo']=$_SESSION['stallo'];
$_SESSION['stallo']=$stallo;

?>