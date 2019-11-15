<?php

if (empty($_SESSION['memIstrDim']))
{
	return;
}

if ($_SESSION['data'][$_SESSION['index']]['clock']>=$_SESSION['maxCycle'])
{
    echo "<div align=center><font color=red size=3><b>OVER ".$_SESSION['maxCycle']." CLOCK CYCLES</b></font></div>";
    exit();
}

//############################################

$agg=isset($_GET["agg"])?$_GET["agg"]:"forward";
$agg=$_SESSION['data'][0]['sysHold']?"hold":$agg;

if ($agg=="back")
{
	$_SESSION['index']+=1;
	$overBackLimit = (isset($_SESSION['data'][$_SESSION['index']]))?false:true;
	$_SESSION['index'] = ($overBackLimit)?(count($_SESSION['data'])-1):$_SESSION['index'];
	return;
}
if ($agg=="refresh" || $agg=="new" || $agg=="return" || $agg=="hold")
{
	return;
}
if ($agg=="forward" && $_SESSION['index']!=0)
{
	$_SESSION['index']-=1;
	return;
}
if ($agg=="forward" && !$_SESSION['data'][0]['finito'])
{
	array_unshift( $_SESSION['data'] , $_SESSION['data'][0]) ;
}

//############################################

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

if ($_SESSION['loaded'] && !$_SESSION['data'][0]['finito']) 
{	
	$_SESSION['start']=true;
}

if (!$_SESSION['data'][0]['finito'] && $_SESSION['start'])
{
    $_SESSION['data'][0]['clock']=$_SESSION['data'][0]['clock']+1;
}

//############################################
//IS JUMP

$isBranch = (BinToGMP(substr($istruzione,25,7),1)==hexdec(63))?true:false;
$typeBranch = (BinToGMP(substr($istruzione,17,3),1)==hexdec(0))?'beq':'bne';
$isJal = (BinToGMP(substr($istruzione,25,7),1)==hexdec('6F'))?true:false;
$isJalr = (BinToGMP(substr($istruzione,25,7),1)==hexdec(67))?true:false;

//############################################
//IS SYSCALL

$isSyscall = (BinToGMP(substr($istruzione,25,7),1)==hexdec(73))?true:false;

//############################################
//Stage WB

if (substr($MEM_WB_WB,1,1)=="1") //MemToReg check
{	
    $WBdata=$MEM_WB_DataR;
}
else
{
    $WBdata=$MEM_WB_Data;
}

if (substr($MEM_WB_WB,0,1)=="1") //RegWrite check
{	
    $registri[$MEM_WB_RegW]=$WBdata;
}

//############################################
//Stage M

//MemWrite check
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
            echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        $EX_MEM_RIS=intval($EX_MEM_RIS);
        if ($EX_MEM_RIS<=($_SESSION['maxMem']-8))
        {
            $memDati[$EX_MEM_RIS]=$byte8;
            $memDati[$EX_MEM_RIS+1]=$byte7;
            $memDati[$EX_MEM_RIS+2]=$byte6;
            $memDati[$EX_MEM_RIS+3]=$byte5;
			$memDati[$EX_MEM_RIS+4]=$byte4;
            $memDati[$EX_MEM_RIS+5]=$byte3;
            $memDati[$EX_MEM_RIS+6]=$byte2;
            $memDati[$EX_MEM_RIS+7]=$byte1;
        }
		else
		{
            echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
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
            echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        $EX_MEM_RIS=intval($EX_MEM_RIS);
        if ($EX_MEM_RIS<=($_SESSION['maxMem']-4))
        {
            $memDati[$EX_MEM_RIS]=$byte4;
            $memDati[$EX_MEM_RIS+1]=$byte3;
            $memDati[$EX_MEM_RIS+2]=$byte2;
            $memDati[$EX_MEM_RIS+3]=$byte1;
        }
		else
		{
            echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
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
            echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        $EX_MEM_RIS=intval($EX_MEM_RIS);
        if ($EX_MEM_RIS<=($_SESSION['maxMem']-2))
        {
            $memDati[$EX_MEM_RIS]=$byte2;
            $memDati[$EX_MEM_RIS+1]=$byte1;
        }
		else
		{
            echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
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

		if ($EX_MEM_RIS<=($_SESSION['maxMem']-1))
        {
			$memDati[$EX_MEM_RIS]=$dato;
		}
		else
		{
            echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
			exit();
        }
    }

}

//MemRead check
if (substr($EX_MEM_M,0,1)=="1")
{	
	

	if (substr($EX_MEM_M,2,2)=="11") //Load DWord
    {
        $prova=$EX_MEM_RIS%8;
        if ($prova!=0)
        {
            echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        if ($EX_MEM_RIS<=($_SESSION['maxMem']-8))
        {
            $byte1=$memDati[$EX_MEM_RIS];
            $byte2=$memDati[$EX_MEM_RIS+1];
            $byte3=$memDati[$EX_MEM_RIS+2];
            $byte4=$memDati[$EX_MEM_RIS+3];
			$byte5=$memDati[$EX_MEM_RIS+4];
			$byte6=$memDati[$EX_MEM_RIS+5];
			$byte7=$memDati[$EX_MEM_RIS+6];
			$byte8=$memDati[$EX_MEM_RIS+7];
            $temp_MEM_WB_DataR=$byte8.$byte7.$byte6.$byte5.$byte4.$byte3.$byte2.$byte1;
            $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
        }
        else
        {
            echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
			exit();
        }
    }
    else if (substr($EX_MEM_M,2,2)=="10") //Load Word
    {
        $prova=$EX_MEM_RIS%4;
        if ($prova!=0)
        {
            echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        if ($EX_MEM_RIS<=($_SESSION['maxMem']-4))
        {
            $byte1=$memDati[$EX_MEM_RIS];
            $byte2=$memDati[$EX_MEM_RIS+1];
            $byte3=$memDati[$EX_MEM_RIS+2];
            $byte4=$memDati[$EX_MEM_RIS+3];
            $temp_MEM_WB_DataR=$byte4.$byte3.$byte2.$byte1;
            $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
        }
        else
        {
			echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
			exit();
        }
    }
	else if (substr($EX_MEM_M,2,2)=="01") //Load Half
    {
        $prova=$EX_MEM_RIS%2;
        if ($prova!=0)
        {
            echo "<div align=center><font color=red size=3><b>ERROR: MISALIGNED MEMORY ADDRESS!</b></font></div>";
            exit();
        }

        if ($EX_MEM_RIS<=($_SESSION['maxMem']-2))
        {
            $byte1=$memDati[$EX_MEM_RIS];
            $byte2=$memDati[$EX_MEM_RIS+1];
            $temp_MEM_WB_DataR=$byte2.$byte1;
            $temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
        }
        else
        {
			echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
			exit();
        }
    }
    else if (substr($EX_MEM_M,2,2)=="00")
    {
		if ($EX_MEM_RIS<=($_SESSION['maxMem']-1))
        {
			$temp_MEM_WB_DataR=$memDati[$EX_MEM_RIS]; //Load Byte
			$temp_MEM_WB_DataR=BinToGMP($temp_MEM_WB_DataR,0);
		}
		else
        {
			echo "<div align=center><font color=red size=3><b>ERROR: OUT OF MEMORY RANGE [".$_SESSION['maxMem']."]!</b></font></div>";
			exit();
        }
	}
}

//############################################
//TEMP OP - FUNCT

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
if ($tipo=='I') //I
{
	if (($temp_ID_EX_campoOp==hexdec(13)) && ($temp_ID_EX_funct3==1 || $temp_ID_EX_funct3==5)) {
		$temp_ID_EX_imm=substr($istruzione,7,5);
		$temp_ID_EX_imm=str_repeat('0',59).$temp_ID_EX_imm;
	} else {
		$temp_ID_EX_imm=substr($istruzione,0,12);
		$temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
	}
}
if ($tipo=='S') //S
{
    $temp_ID_EX_imm=substr($istruzione,0,7).substr($istruzione,20,5);
    $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
}
if ($tipo=='SB') //SB
{
    $temp_ID_EX_imm=substr($istruzione,0,1).substr($istruzione,24,1).substr($istruzione,1,6).substr($istruzione,20,4);
    $temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],52).$temp_ID_EX_imm;
}
if ($tipo=='UJ') //UJ
{
    $temp_ID_EX_imm=substr($istruzione,0,1).substr($istruzione,12,8).substr($istruzione,11,1).substr($istruzione,1,10);
	$temp_ID_EX_imm=str_repeat($temp_ID_EX_imm[0],44).$temp_ID_EX_imm;
}
//############################################

$ID_EX_PC=$IF_ID_PC; //PC to propagate

//Possible new PC 1, jump address
$tempImm=$temp_ID_EX_imm;
$tempImm=BinToGMP($tempImm,0);

$newPC1=($IF_ID_PC*4+$tempImm*2)/4;

$newPC2=$tempPC+1; //Possible new PC 2, PC + 4

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

$ALUOp=substr($ID_EX_EX,0,2); //ALUOp from ID/EX.M registers

$aluCtrl=UnitaCtrlAlu($ALUOp,$ID_EX_funct7,$ID_EX_funct3,$ID_EX_campoOp);

$temp_EX_MEM_RIS=ALU($aluCtrl,$ALUdato1,$ALUdato2);

$temp_EX_MEM_RegW=$ID_EX_RD;

$temp_MEM_WB_WB=$EX_MEM_WB;
$temp_MEM_WB_Data=$EX_MEM_RIS;

$temp_EX_MEM_WB=$ID_EX_WB;
$temp_EX_MEM_M=$ID_EX_M;
$temp_MEM_WB_RegW=$EX_MEM_RegW;

//############################################

//********************************************
//HAZARDS: 
//LOAD->R,I (forwarding: M=>X)
//LOAD->SB (forwarding: M=>D)

$RL1=substr($istruzione,12,5); //rs1 instruction
$RL1=BinToGMP($RL1,1);

$RL2=substr($istruzione,7,5); //rs2 instruction
$RL2=BinToGMP($RL2,1);

$IsLW=substr($ID_EX_M,0,1); //MemRead

if ($IsLW=="1")
{
    if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0)
    {
		if ($stallo==0) {
			$stallo++; 
			if ($isBranch) {
				$stallo++; 
			}
		}
    }
}

$temp_ID_EX_Data1=$registri[$RL1]; //value of register rs1
$temp_ID_EX_Data2=$registri[$RL2]; //value of register rs2

//********************************************
//HAZARDS:
//R,I->SB (forwarding: X=>D)

$ctrl_EX=substr($ID_EX_WB,0,1); //RegWrite stage ex
if ($ctrl_EX=="1" && $isBranch)
{
	
    if (($ID_EX_RD==$RL1 || $ID_EX_RD==$RL2) && $ID_EX_RD!=0) {
		if ($stallo==0) {
			$stallo++;
		}
    }
}

//********************************************
//FORWARDING: ->SB

$ctrl_MEM=substr($EX_MEM_WB,0,1); //RegWrite stage mem
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
//JUMP CHECK

$branch=false;
$branchCheck=false;
if (!$_SESSION['IF_scarta'])
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
		if ($rd!=0) {
			$registri[$rd]=$tempPC;
		}
	}
	if ($isJalr) {
		$branch=true;
		$branchCheck=true;
		$rs1=substr($istruzione,12,5);
		$rs1=BinToGMP($rs1,1);
		$newPC1=$registri[$rs1]+gmp_intval(gmp_div(BinToGMP($temp_ID_EX_imm,0),4));
	}
}

//********************************************
//SYSCALL CHECK

if (!$_SESSION['IF_scarta'])
{
	if ($isSyscall) {
		if ($stallo==0) {
			if (!$_SESSION['data'][0]['sysStall']) {
				$_SESSION['data'][0]['sysStall']=true;
				$stallo+=3;
			}
			else {
				$_SESSION['data'][0]['sysStall']=false;
				if (substr($istruzione,11,1)=="1"){ //Ebreak
					$_SESSION['data'][0]['sysHold']=true;
					$_SESSION['data'][0]['sysBreak']=true;
				}
				else { //Ecall
					if ($registri[17]==1) {
						$_SESSION['data'][0]['sysConsole']=$_SESSION['data'][0]['sysConsole'].gmp_strval($registri[10]).PHP_EOL;
					}
					else if ($registri[17]==5) {
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

//********************************************
//Generate control signals

$PCsrc=$branch&&$branchCheck;

$IF_scarta=($PCsrc&&(!$stallo)&&$_SESSION['branchFlush'])?1:0; //branch(not stalled)
$ID_scarta=($stallo)?1:0; //stall, exception
$EX_scarta=0;  //exception

$newPC=IDMux($PCsrc,false,$newPC1,$newPC2);
$newPC=($stallo)?$tempPC:$newPC;

list($ctrl_EX,$ctrl_M,$ctrl_WB)=UnitaDiCtrl_ctrl($istruzione);

if ($stallo) {
	$temp_ID_EX_WB="00";
    $temp_ID_EX_M="0000";
    $temp_ID_EX_EX="000";
}
else {
	$temp_ID_EX_WB=$ctrl_WB;
    $temp_ID_EX_M=$ctrl_M;
    $temp_ID_EX_EX=$ctrl_EX;
}

$tempIstruzione=($stallo)?$istruzione:(($PCsrc&&$_SESSION['branchFlush'])?str_repeat('0',32):$memIstr[$tempPC]);

if (!$_SESSION['data'][0]['finito']) {
	$a=$_SESSION['data'][0]['ifIstruzione'];
	$b=$_SESSION['data'][0]['idIstruzione'];
	$c=$_SESSION['data'][0]['exIstruzione'];
	$d=$_SESSION['data'][0]['memIstruzione'];
	if (!$stallo)
	{
		if ($tempPC>=$_SESSION['memIstrDim']) {
			$_SESSION['data'][0]['ifIstruzione']=1002;
		}
		else {
			$_SESSION['data'][0]['ifIstruzione']=$tempPC;
		}

		$_SESSION['data'][0]['idIstruzione']=$a;
	}
	else
	{
		$_SESSION['data'][0]['idIstruzione']=1001; //stall;
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
	if ($_SESSION['data'][0]['idIstruzione']!=1001) {
		if ($_SESSION['data'][0]['ifIstruzione']!=1002) {
			$_SESSION['data'][0]['execTrail'][]=$memIstr[$tempPC];
			$_SESSION['data'][0]['execStage'][0]=count($_SESSION['data'][0]['execTrail'])-1;
		} else {
			$_SESSION['data'][0]['execStage'][0]="";
		}
	} else {
		$_SESSION['data'][0]['execStage'][1]="";
	}

	if ($_SESSION['data'][0]['idIstruzione']==1002) { //JUMP FLUSH
		$_SESSION['data'][0]['execStage'][1]="";
	}

	$stage=array("F","D","X","M","W");
	for ($i=0; $i<count($_SESSION['data'][0]['execStage']); ++$i) {
		if ($_SESSION['data'][0]['execStage'][$i]!=="-") {
			$_SESSION['data'][0]['pipeTable'][$_SESSION['data'][0]['clock']][$_SESSION['data'][0]['execStage'][$i]]=$stage[$i];
		}
	}

}

//############################################
//VISUALIZE PIPELINE

if (!$_SESSION['data'][0]['finito']) {
	$_SESSION['data'][0]['schemaData'] = array($ALUOp,$ALUdato1,$ALUdato2,$EX_MEM_DataW,$EX_MEM_DataW,$EX_MEM_M,$EX_MEM_M,$EX_MEM_RIS,$EX_MEM_RIS,$EX_MEM_RegW,$EX_MEM_WB,$EX_MEM_WB,$EX_scarta,$ID_EX_Data1,$ID_EX_Data1,$ID_EX_Data2,$ID_EX_Data2,$ID_EX_EX,$ID_EX_EX,$ID_EX_M,$ID_EX_M,$ID_EX_RD,$ID_EX_RS1,$ID_EX_RS2,$ID_EX_WB,$ID_EX_WB,$ID_EX_funct3,$ID_EX_funct7,$ID_EX_imm,$ID_EX_imm2,$ID_scarta,$IF_ID_PC,$IF_scarta,$MEM_WB_Data,$MEM_WB_DataR,$MEM_WB_DataR,$MEM_WB_RegW,$MEM_WB_WB,$MEM_WB_WB,$Mux3Ctrl,$Mux4Ctrl,$Mux5Ctrl,$PCsrc,$RL1,$RL2,$WBdata,$aluCtrl,$branch,$branchCheck,$ctrl_EX,$ctrl_M,$ctrl_WB,$isBranch,$isJal,$isJalr,$istruzione,$newPC,$newPC1,$newPC2,$stallo,$tempPC,$tempImm,$tempIstruzione);

	//IS FINISHED
	$_SESSION['data'][0]['finito'] = ($_SESSION['data'][0]['ifIstruzione']==1002) && ($_SESSION['data'][0]['idIstruzione']==1002) && ($_SESSION['data'][0]['exIstruzione']==1002) && ($_SESSION['data'][0]['memIstruzione']==1002) && ($_SESSION['data'][0]['wbIstruzione']==1002) && ($_SESSION['start']);
	if ($_SESSION['data'][0]['finito']) {
		return;
	}
}

//############################################
//SAVE TEMP DATA

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
$MEM_WB_DataR=isset($temp_MEM_WB_DataR)?$temp_MEM_WB_DataR:0;
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