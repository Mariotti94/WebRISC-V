<?php
//#############################################################################
//###################FUNZIONI CONVERSIONE E ELEMENTI###########################
//#############################################################################

//#############################################################################
//###### Funzione che converte una stringa GMP in un numero binario
function GMPToBin($str,$lunghezza,$istruzione)
{
	$str=strval($str);
    $num=$str;
    $str=gmp_strval(gmp_abs($str));
    $risultato='';

    while($str!="1" && $str!="0")
    {
        $i=gmp_strval(gmp_mod($str,"2"));
        $str=gmp_div_q(gmp_sub($str,$i),"2");
        $risultato=$i.$risultato;

    }
    if ($str!="0")
    {
        $risultato="1".$risultato;
    }
    else
    {
        $risultato="0";
    }

    if ($istruzione!=1) //numero
    {
        if (gmp_cmp($num,0)>=0)
        {
            if (strlen($risultato)<$lunghezza)
            {
                $i=$lunghezza-strlen($risultato);
                while($i!=0)
                {
                    $risultato="0".$risultato;
                    $i=$i-1;
                }
            }
        }
        else
        {
            $risultato=twoComplement($risultato);
            if (strlen($risultato)<$lunghezza)
            {
                $i=$lunghezza-strlen($risultato);
                while($i!=0)
                {
                    $risultato="1".$risultato;
                    $i=$i-1;
                }
            }
        }
    }
    else //istruzione
    {
        if (strlen($risultato)<$lunghezza)
        {
            $i=$lunghezza-strlen($risultato);
            while($i!=0)
            {
                $risultato="0".$risultato;
                $i=$i-1;
            }
        }
    }

    $function_ret=(strlen($risultato)>$lunghezza)?str_repeat("1",$lunghezza):$risultato;
    return $function_ret;
}
//#############################################################################

//#############################################################################
//#### Funzione che converte un numero binario in una stringa GMP
function BinToGMP($str,$istruzione)
{
    $lunghezza=strlen($str);
    if ($lunghezza!=0)
    {
        if( $str[0]=='1' && $lunghezza!=1 && $istruzione!=1)
        {
            $str=twoComplement($str);
            $j=0;
            $k="0";
            $l=0;
            while($lunghezza!=$l)
            {
                $i=substr($str,$lunghezza-1,1);
                $k=gmp_add($k,(gmp_mul($i,gmp_pow("2",strval($j)))));
                $j=$j+1;
                $lunghezza=$lunghezza-1;
            }
            $function_ret=gmp_strval(gmp_neg($k));
        }
        else
        {
            $j=0;
            $k="0";
            $l=0;
            while($lunghezza!=$l)
            {
                $i=substr($str,$lunghezza-1,1);
                $k=gmp_add($k,(gmp_mul($i,gmp_pow("2",strval($j)))));
                $j=$j+1;
                $lunghezza=$lunghezza-1;
            }
            $function_ret=gmp_strval($k);
        }
    }
    else
    {
        $function_ret="0";
    }

    return $function_ret;
}
//#############################################################################

//#############################################################################
//#### Funzione complemento a due binario
function twoComplement($str)
{
    $n = strlen($str);
    // Traverse the string to get first '1' from the last of string
    for ($i = $n-1 ; $i >= 0 ; $i--)
        if ($str[$i] == '1')
            break;
    // If there exists no '1' exit
    if ($i == -1)
        return $str;

    // Continue traversal after the position of first '1'
    for ($k = $i-1 ; $k >= 0; $k--)
    {
        //flip the values
        if ($str[$k] == '1')
            $str[$k] = '0';
        else
            $str[$k] = '1';
    }

    return $str;
}
//#############################################################################

//#############################################################################
function ALU($controllo,$dato1,$dato2)
{
	$dato1=strval($dato1);
    $dato2=strval($dato2);
	
    switch ($controllo)
    {
        case "0000": //AND:
            $risultato=gmp_strval(gmp_and($dato1,$dato2));
            break;

        case "0011": //XOR:
            $risultato=gmp_strval(gmp_xor($dato1,$dato2));
            break;

        case "0001": //OR:
            $risultato=gmp_strval(gmp_or($dato1,$dato2));
            break;

        case "0010": //SOMMA:
            $risultato=gmp_strval(gmp_add($dato1,$dato2));
            break;

        case "0110": //SOTTRAZIONE:
            $risultato=gmp_strval(gmp_sub($dato1,$dato2));
            break;

        case "0111": //SET ON LESS THAN:
            if (gmp_cmp($dato1,$dato2)<0)
            {
                $risultato="1";
            }
            else
            {
                $risultato="0";
            }
            break;

        case "0100": //SET ON LESS THAN IMMEDIATE UNSIGNED:
            $dato1=gmp_abs($dato1); //valore assoluto
            $dato2=gmp_abs($dato2);
            if (gmp_cmp($dato1,$dato2)<0)
            {
                $risultato="1";
            }
            else
            {
                $risultato="0";
            }
            break;

        case "1000": //mul
            $HILO=gmp_strval(gmp_mul($dato1,$dato2));
            $_SESSION['HILO']=$HILO;
            $HILO_bin=GMPToBin($HILO,128,0);
            $risultato=BinToGMP(substr($HILO_bin,64,64),0);
            break;

        case "1001": //div
            $HI_val=gmp_strval(gmp_mod($dato1,$dato2));
            $LO_val=gmp_strval(gmp_div_q(gmp_sub($dato1,$HI_val),$dato2));
            $HILO_val=GMPToBin($HI_val,64,0).GMPToBin($LO_val,64,0);
            $HILO=BinToGMP($HILO_val,0);
            $_SESSION['HILO']=$HILO;
            $risultato=$LO_val;
            break;

        case "1010": //mulh
            $HILO=gmp_strval(gmp_mul($dato1,$dato2));
            $_SESSION['HILO']=$HILO;
            $HILO_bin=GMPToBin($HILO,128,0);
            $risultato=BinToGMP(substr($HILO_bin,0,64),0);
            break;

        case "1011": //rem
            $HI_val=gmp_strval(gmp_mod($dato1,$dato2));
            $LO_val=gmp_strval(gmp_div_q(gmp_sub($dato1,$HI_val),$dato2));
            $HILO_val=GMPToBin($HI_val,64,0).GMPToBin($LO_val,64,0);
            $HILO=BinToGMP($HILO_val,0);
            $_SESSION['HILO']=$HILO;
            $risultato=$HI_val;
            break;

		case "1110": //SLL:
			$risultato=GMPToBin($dato1,64,0);
			$risultato=substr($risultato,$dato2).str_repeat('0',$dato2);
			$risultato=BinToGMP($risultato,0);
            break;

		case "1101": //SRL:
			$risultato=GMPToBin($dato1,64,0);
			$risultato=str_repeat('0',$dato2).substr($risultato,0,-$dato2);
			$risultato=BinToGMP($risultato,0);
            break;
			
        case "1111": //SRA:
            $risultato=GMPToBin($dato1,64,0);
			$risultato=str_repeat($risultato[0],$dato2).substr($risultato,0,-$dato2);
			$risultato=BinToGMP($risultato,0);
            break;

        default:
            $risultato="0";
            break;
    }

    $function_ret=$risultato;
    return $function_ret;
}
//#############################################################################

//#############################################################################
function IDMux($PCsrc,$exception,$dato1,$dato2)
{
    switch ((int)$PCsrc.(int)$exception)
    {
        case "10":
            $function_ret=$dato1;
            break;
        case "01":
            $function_ret=0;
            break;
        case "00":
            $function_ret=$dato2;
            break;
        default:
            $function_ret=0;

            break;
    }
    return $function_ret;
}
//#############################################################################

//#############################################################################
function EXMux3($MUX3controllo,$dato1,$dato2,$dato3)
{
    switch ($MUX3controllo)
    {
        case "00":
            $function_ret=$dato1;
            break;
        case "01":
            $function_ret=$dato2;
            break;
        case "10":
            $function_ret=$dato3;
            break;
        default:

            $function_ret=0;

            break;
    }
    return $function_ret;
}
//#############################################################################

//#############################################################################
function EXMux4($MUX4controllo,$dato1,$dato2,$dato3)
{
    switch ($MUX4controllo)
    {
        case "00":
            $function_ret=$dato1;
            break;
        case "01":
            $function_ret=$dato2;
            break;
        case "10":
            $function_ret=$dato3;
            break;
        default:

            $function_ret=0;

            break;
    }
    return $function_ret;
}
//#############################################################################

//#############################################################################
function EXMux5($MUX5controllo,$dato1,$dato2)
{
    $MUX5controllo=intval($MUX5controllo);

    switch ($MUX5controllo)
    {
        case 0:
            $function_ret=$dato1;
            break;

        case 1:
            $function_ret=$dato2;
            break;

        default:
            $function_ret=0;
            break;
    }
    return $function_ret;
}
//#############################################################################

//#############################################################################

function UnitaDiCtrl_ctrl($instruction)
{
    $op=substr($instruction,25,7);
    $op=BinToGMP($op,1);

    $funct3=substr($instruction,17,3);
    $funct3=BinToGMP($funct3,1);

    switch ($op)
    {
        case 0:
            //stallo
            $ex="000";
            $mem="0000";
            $wb="00";

        case hexdec(33):
            //tipo R
            $ex="100";
            $mem="0000";
            $wb="10";
            break;

        case hexdec(13):
            //tipo I
            $ex="101";
            $mem="0000";
            $wb="10";
            break;

        case hexdec(63):
            //tipo SB
            $ex="010";
            $mem="0000";
            $wb="00";
            break;

        case hexdec(3):
            $ex="001";
            $wb="11";
            switch($funct3)
            {
                case hexdec(0):
                    //lb
                    $mem="1000";
                    break;

                case hexdec(1):
                    //lh
                    $mem="1001";
                    break;
					
                case hexdec(2):
                    //lw
                    $mem="1010";
                    break;
					
                case hexdec(3):
                    //ld
                    $mem="1011";
                    break;

                case hexdec(4):
                    //lbu
                    $mem="1000";
                    break;
					
                default:
                    $mem="0000";
                    break;
            }
            break;

        case hexdec(23):
            //tipo S
            $ex="001";
            $wb="01";
            switch($funct3)
            {
                case hexdec(0):
                    //sb
                    $mem="0100";
                    break;

                case hexdec(1):
                    //sh
                    $mem="0101";
                    break;

                case hexdec(2):
                    //sw
                    $mem="0110";
                    break;

                case hexdec(3):
                    //sd
                    $mem="0111";
                    break;
					
                default:
                    $mem="0000";
                    break;
            }
            break;

        default:
            $ex="000";
            $mem="0000";
            $wb="00";
            break;
    }

    return array($ex,$mem,$wb);
}

//#############################################################################

//#############################################################################
function UnitaCtrlAlu($ctrl,$funct7,$funct3,$op)
{
    $function_ret="";
    switch ($ctrl)
    {
        case "00": //caso delle lw, sw, lb, lbu, sb:
            $function_ret="0010";
            break;

        case "01": //branch
            $function_ret="0110";
            break;

        case "10": //Tipo R
            if($op==hexdec(33))
            {
                switch($funct3)
                {
                    case hexdec(0):
                        if($funct7==hexdec(0)) //add
                            $function_ret="0010";
                        else if($funct7==hexdec(20)) //sub
                            $function_ret="0110";
                        else if($funct7==hexdec(1)) //mul
                            $function_ret="1000";
                        break;

                    case hexdec(7): //and
                        $function_ret="0000";
                        break;

                    case hexdec(6):
                        if($funct7==hexdec(0)) //or
                            $function_ret="0001";
                        else if($funct7==hexdec(1)) //rem
                            $function_ret="1011";
                        break;

                    case hexdec(4):
                        if($funct7==hexdec(0)) //xor
                            $function_ret="0011";
                        else if($funct7==hexdec(1)) //div
                            $function_ret="1001";
                        break;

                    case hexdec(1):
                        if($funct7==hexdec(0)) //sll
                            $function_ret="1110";
                        else if($funct7==hexdec(1)) //mulh
                            $function_ret="1010";
                        break;

                    case hexdec(5):
						if($funct7==hexdec(0))
							$function_ret="1101"; //srl
						if($funct7==hexdec(20))
							$function_ret="1111"; //sra
                        break;

                    case hexdec(2): //slt
                        $function_ret="0111";
                        break;

                    case hexdec(3): //sltu
                        $function_ret="0100";
                        break;

                    default:
                        $function_ret="";
                        break;
                }
            }
            else if($op==hexdec(13))
            {
                switch ($funct3)
                {
                    case hexdec(0): //addi
                        $function_ret="0010";
                        break;

                    case hexdec(7): //andi
                        $function_ret="0000";
                        break;

                    case hexdec(6): //ori
                        $function_ret="0001";
                        break;

                    case hexdec(4): //xori
                        $function_ret="0011";
                        break;

                    case hexdec(2): //slti
                        $function_ret="0111";
                        break;

                    case hexdec(3): //sltiu
                        $function_ret="0100";
                        break;
						
					case hexdec(1):
                        $function_ret="1110"; //slli
                        break;

                    case hexdec(5):
						if($funct7==hexdec(0))
							$function_ret="1101"; //srli
						if($funct7==hexdec(20))
							$function_ret="1111"; //srai
                        break;
                    default:
                        $function_ret="";
                        break;
                }
            }
            break;
    }

    return $function_ret;
}
//#############################################################################

//#############################################################################
//#################FUNZIONI DI CODIFICA E DECODIFICA###########################
//#############################################################################

//#############################################################################
//###### Funzione che in prende una istruzione come una striga e la decodifica
function decodeIstr($istr)
{
    $cmd=strtok($istr,' ');
    $a=substr($istr,strlen($istr)-(strlen($istr)-strlen($cmd)));
    $cmd=strtolower(trim($cmd));

    switch ($cmd)
    {
        case 'add':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(0);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'addi':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'sub':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(0);
            $funct7=hexdec(20);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'div':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(4);
            $funct7=hexdec(1);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'rem':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(6);
            $funct7=hexdec(1);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'mul':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(0);
            $funct7=hexdec(1);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'mulh':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(1);
            $funct7=hexdec(1);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'and':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(7);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'andi':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(7);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'or':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(6);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'ori':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(6);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'xor':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(4);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'xori':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(4);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'sll':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(1);
            $funct7=hexdec(0);
			if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'srl':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(5);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

		case 'sra':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(5);
            $funct7=hexdec(20);
             if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;
			
		case 'slli':
			$tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(1);
			$funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'srli':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(5);
			$funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;
		
        case 'srai':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(5);
			$funct7=hexdec(20);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
			$imm=($imm!='ERR')?BinToGMP(GMPToBin($funct7,7,1).GMPToBin($imm,5,1),1):$imm;
            break;
			
		case 'lb':
            $tipo='I';
            $op=hexdec(3);
            $funct3=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;

        case 'lh':
            $tipo='I';
            $op=hexdec(3);
            $funct3=hexdec(1);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;
			
        case 'lw':
            $tipo='I';
            $op=hexdec(3);
            $funct3=hexdec(2);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;

        case 'ld':
            $tipo='I';
            $op=hexdec(3);
            $funct3=hexdec(3);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;
			
        case 'lbu':
            $tipo='I';
            $op=hexdec(3);
            $funct3=hexdec(4);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;

        case 'sb':
            $tipo='S';
            $op=hexdec(23);
            $funct3=hexdec(0);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $rs2=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
            $rs2=trim($rs2);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;

        case 'sh':
            $tipo='S';
            $op=hexdec(23);
            $funct3=hexdec(1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $rs2=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
            $rs2=trim($rs2);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;

        case 'sw':
            $tipo='S';
            $op=hexdec(23);
            $funct3=hexdec(2);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $rs2=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
            $rs2=trim($rs2);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;			

        case 'sd':
            $tipo='S';
            $op=hexdec(23);
            $funct3=hexdec(3);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $rs2=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
            $rs2=trim($rs2);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;
			
        case 'beq':
            $tipo='SB';
            $op=hexdec(63);
            $funct3=hexdec(0);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs2=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
            $rs2=trim($rs2);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=trim($imm);
            break;

        case 'bne':
            $tipo='SB';
            $op=hexdec(63);
            $funct3=hexdec(1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs2=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
            $rs2=trim($rs2);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=trim($imm);
            break;

        case 'slt':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(2);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'slti':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(2);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'sltu':
            $tipo='R';
            $op=hexdec(33);
            $funct3=hexdec(3);
            $funct7=hexdec(0);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $rs2='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $rs2='ERR';
                break;
            }
            $rs2=strtok($a,PHP_EOL);
            $rs2=trim($rs2);
            break;

        case 'sltiu':
            $tipo='I';
            $op=hexdec(13);
            $funct3=hexdec(3);
            if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rs1=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
            $rs1=trim($rs1);
            if(strlen($a)==0)
            {
                $imm='ERR';
                break;
            }
            $imm=strtok($a,PHP_EOL);
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            break;

        case 'j':
            $tipo='UJ';
            $op=hexdec('6F');
            $rd='x0';
            if(strlen($a)==0)
            {
                $target='ERR';
                break;
            }
            $target=strtok($a,PHP_EOL);
            $target=trim($target);
            break;

        case 'jr':
            $tipo='I';
            $op=hexdec(67);
            $funct3=hexdec(0);
            $rd='x0';
            $imm=0;
            if(strlen($a)==0)
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,PHP_EOL);
            $rs1=trim($rs1);
            break;

        case 'jal':
            $tipo='UJ';
            $op=hexdec('6F');
            $rd='ra';
            if(strlen($a)==0)
            {
                $target='ERR';
                break;
            }
            $target=strtok($a,PHP_EOL);
            $target=trim($target);
            break;

        case 'jalr':
            $tipo='I';
            $op=hexdec(67);
            $funct3=hexdec(0);
			if(strlen($a)==0)
            {
                $rd='ERR';
                $rs1='ERR';
                $imm='ERR';
                break;
            }
            $rd=strtok($a,',');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
            $rd=trim($rd);
            if(strlen($a)==0)
            {
                $imm='ERR';
                $rs1='ERR';
                break;
            }
            $imm=strtok($a,'\(');
            $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
            $imm=is_numeric(trim($imm))?trim($imm):'ERR';
            if(strlen($a)==0 || $imm==='ERR')
            {
                $rs1='ERR';
                break;
            }
            $rs1=strtok($a,'\)');
            $rs1=trim($rs1);
            break;

        default:
            $tipo='ERR';
            $function_ret='ERR';
            break;
    }


    if ($tipo=='R')
    {
        $op=intval($op);
        $rs1=decRegister($rs1);
        $rs2=decRegister($rs2);
        $rd=decRegister($rd);
        $funct3=intval($funct3);
        $funct7=intval($funct7);

        if ($rs1==='ERR' || $rs2==='ERR' || $rd==='ERR')
        {
            $function_ret='ERR';
        }
        else
        {
            $rs1=intval($rs1);
            $rs2=intval($rs2);
            $rd=intval($rd);
            $function_ret=GMPToBin($funct7,7,1).GMPToBin($rs2,5,1).GMPToBin($rs1,5,1).GMPToBin($funct3,3,1).GMPToBin($rd,5,1).GMPToBin($op,7,1);
        }
    }

    if ($tipo=='I')
    {
        $op=intval($op);
        $rs1=decRegister($rs1);
        $rd=decRegister($rd);
        $funct3=intval($funct3);
        if ($rs1==='ERR' || $rd==='ERR' || $imm==='ERR')
        {
            $function_ret='ERR';
        }
        else
        {
            $rs1=intval($rs1);
            $rd=intval($rd);
            $imm=intval($imm);

            $function_ret=GMPToBin($imm,12,0).GMPToBin($rs1,5,1).GMPToBin($funct3,3,1).GMPToBin($rd,5,1).GMPToBin($op,7,1);
        }
    }

    if ($tipo=='S')
    {
        $op=intval($op);
        $rs1=decRegister($rs1);
        $rs2=decRegister($rs2);
        $funct3=intval($funct3);

        if ($rs1==='ERR' || $rs2==='ERR' || $imm==='ERR')
        {
            $function_ret='ERR';
        }
        else
        {
            $rs1=intval($rs1);
            $rs2=intval($rs2);
            $imm=intval($imm);
            $imm_bin=GMPToBin($imm,12,1);
            $function_ret=substr($imm_bin,0,7).GMPToBin($rs2,5,1).GMPToBin($rs1,5,1).GMPToBin($funct3,3,1).substr($imm_bin,7,5).GMPToBin($op,7,1);
        }
    }

    if ($tipo=='SB')
    {
        $op=intval($op);
        $rs1=decRegister($rs1);
        $rs2=decRegister($rs2);
        $funct3=intval($funct3);

        if ($rs1==='ERR' || $rs2==='ERR' || $imm==='ERR')
        {
            $function_ret='ERR';
        }
        else
        {
            $rs1=intval($rs1);
            $rs2=intval($rs2);

            $target=':'.$imm;
            $function_ret=GMPToBin($rs2,5,1).GMPToBin($rs1,5,1).GMPToBin($funct3,3,1).GMPToBin($op,7,1).$target; //to change target

        }
    }

    if ($tipo=='U')
    {
        $op=intval($op);
        $rd=decRegister($rd);

        if ($imm==='ERR')
        {
            $function_ret='ERR';
        }
        else
        {
            $rd=intval($rd);
            $function_ret=GMPToBin($imm,20,1).GMPToBin($rd,5,1).GMPToBin($op,7,1);
        }
    }

    if ($tipo=='UJ')
    {
        $op=intval($op);
        $rd=decRegister($rd);

        if ($target==='ERR')
        {
            $function_ret='ERR';
        }
        else
        {
            $rd=intval($rd);
            $function_ret=GMPToBin($rd,5,1).GMPToBin($op,7,1).':'.$target; //to change target
        }
    }

    return $function_ret;
}
//#############################################################################

//#############################################################################
//###### Funzione che trasfroma registro stringa in numero corispodente
function decRegister($reg)
{
    switch ($reg)
    {
		case 'x0':
            $function_ret=0;
            break;
			
		case 'x1':
            $function_ret=1;
            break;
			
		case 'x2':
            $function_ret=2;
            break;
			
		case 'x3':
            $function_ret=3;
            break;
			
		case 'x4':
            $function_ret=4;
            break;
			
		case 'x5':
            $function_ret=5;
            break;
			
        case 'x6':
            $function_ret=6;
            break;
			
		case 'x7':
            $function_ret=7;
            break;
			
		case 'x8':
            $function_ret=8;
            break;
			
		case 'x9':
            $function_ret=9;
            break;
			
		case 'x10':
            $function_ret=10;
            break;
			
		case 'x11':
            $function_ret=11;
            break;
			
		case 'x12':
            $function_ret=12;
            break;
			
        case 'x13':
            $function_ret=13;
            break;
			
		case 'x14':
            $function_ret=14;
            break;
			
		case 'x15':
            $function_ret=15;
            break;
			
		case 'x16':
            $function_ret=16;
            break;
			
		case 'x17':
            $function_ret=17;
            break;
			
		case 'x18':
            $function_ret=18;
            break;
			
		case 'x19':
            $function_ret=19;
            break;
			
        case 'x20':
            $function_ret=20;
            break;
			
		case 'x21':
            $function_ret=21;
            break;
			
		case 'x22':
            $function_ret=22;
            break;
			
		case 'x23':
            $function_ret=23;
            break;
			
		case 'x24':
            $function_ret=24;
            break;
			
		case 'x25':
            $function_ret=25;
            break;
			
		case 'x26':
            $function_ret=26;
            break;
			
        case 'x27':
            $function_ret=27;
            break;
			
		case 'x28':
            $function_ret=28;
            break;
			
		case 'x29':
            $function_ret=29;
            break;
			
		case 'x30':
            $function_ret=30;
            break;
			
		case 'x31':
            $function_ret=31;
            break;

        case 's0':
            $function_ret=8;
            break;

        case 's1':
            $function_ret=9;
            break;

        case 's2':
            $function_ret=18;
            break;

        case 's3':
            $function_ret=19;
            break;

        case 's4':
            $function_ret=20;
            break;

        case 's5':
            $function_ret=21;
            break;

        case 's6':
            $function_ret=22;
            break;

        case 's7':
            $function_ret=23;
            break;

        case 's8':
            $function_ret=24;
            break;

        case 's9':
            $function_ret=25;
            break;

        case 's10':
            $function_ret=26;
            break;

        case 's11':
            $function_ret=27;
            break;

        case 't0':
            $function_ret=5;
            break;

        case 't1':
            $function_ret=6;
            break;

        case 't2':
            $function_ret=7;
            break;

        case 't3':
            $function_ret=28;
            break;

        case 't4':
            $function_ret=29;
            break;

        case 't5':
            $function_ret=30;
            break;

        case 't6':
            $function_ret=31;
            break;

        case 'a0':
            $function_ret=10;
            break;

        case 'a1':
            $function_ret=11;
            break;

        case 'a2':
            $function_ret=12;
            break;

        case 'a3':
            $function_ret=13;
            break;

        case 'a4':
            $function_ret=14;
            break;

        case 'a5':
            $function_ret=15;
            break;

        case 'a6':
            $function_ret=16;
            break;

        case 'a7':
            $function_ret=17;
            break;

        case 'gp':
            $function_ret=3;
            break;

        case 'sp':
            $function_ret=2;
            break;

        case 'fp':
            $function_ret=8;
            break;

        case 'ra':
            $function_ret=1;
            break;

        case 'tp':
            $function_ret=4;
            break;

        default:
            $function_ret='ERR';
            break;
    }

    return $function_ret;
}
//#############################################################################

//###### Funzione che converte il nome del label all'indirizzo dove punta
function cLabel($label,$tabRil,$dimTabRil)
{
    $i=0;
    $function_ret='ERR';
    while($i<$dimTabRil)
    {
        $a1=$tabRil[$i];
        $b1=(strpos($a1,'|',1) ? strpos($a1,'|',1)+1 : 0);
        $c=substr($a1,$b1);

        if ($c==$label)
        {
            $function_ret=substr($a1,0,$b1-1);
            break;
        }
        $i=$i+1;
    }
    return $function_ret;
}

//#############################################################################

//###### Funzione che trasfroma numero corispodente di un registro in stringa $xx
function codRegister($reg)
{

    $reg=intval($reg);
    switch ($reg)
    {
        case 0:
            $function_ret='x0';
            break;

        case 8:
            $function_ret='s0';//fp
            break;

        case 9:
            $function_ret='s1';
            break;

        case 18:
            $function_ret='s2';
            break;

        case 19:
            $function_ret='s3';
            break;

        case 20:
            $function_ret='s4';
            break;

        case 21:
            $function_ret='s5';
            break;

        case 22:
            $function_ret='s6';
            break;

        case 23:
            $function_ret='s7';
            break;

        case 24:
            $function_ret='s8';
            break;

        case 25:
            $function_ret='s9';
            break;

        case 26:
            $function_ret='s10';
            break;

        case 27:
            $function_ret='s11';
            break;

        case 5:
            $function_ret='t0';
            break;

        case 6:
            $function_ret='t1';
            break;

        case 7:
            $function_ret='t2';
            break;

        case 28:
            $function_ret='t3';
            break;

        case 29:
            $function_ret='t4';
            break;

        case 30:
            $function_ret='t5';
            break;

        case 31:
            $function_ret='t6';
            break;

        case 10:
            $function_ret='a0';
            break;

        case 11:
            $function_ret='a1';
            break;

        case 12:
            $function_ret='a2';
            break;

        case 13:
            $function_ret='a3';
            break;

        case 14:
            $function_ret='a4';
            break;

        case 15:
            $function_ret='a5';
            break;

        case 16:
            $function_ret='a6';
            break;

        case 17:
            $function_ret='a7';
            break;

        case 1:
            $function_ret='ra';
            break;

        case 2:
            $function_ret='sp';
            break;

        case 3:
            $function_ret='gp';
            break;

        case 4:
            $function_ret='tp';
            break;

        default:
            $function_ret='';
            break;
    }

    return $function_ret;
}
//#############################################################################

//###### Funzione che identifica la istruzione
function instrName($op,$funct3,$funct7)
{
    $op=intval($op);
    $funct3=intval($funct3);
    $funct7=intval($funct7);
    $function_ret='';

    if($op==hexdec(33))
    {
        switch ($funct3)
        {
            case hexdec(0):
                if($funct7==hexdec(0))
                    $function_ret='Add';
                if($funct7==hexdec(20))
                    $function_ret='Sub';
                if($funct7==hexdec(1))
                    $function_ret='Mul';
                break;

            case hexdec(7):
                $function_ret='And';
                break;

            case hexdec(6):
                if($funct7==hexdec(0))
                    $function_ret='Or';
                if($funct7==hexdec(1))
                    $function_ret='Rem';
                break;

            case hexdec(4):
                if($funct7==hexdec(0))
                    $function_ret='Xor';
                if($funct7==hexdec(1))
                    $function_ret='Div';
                break;

            case hexdec(1):
                if($funct7==hexdec(0))
                    $function_ret='Sll';
                if($funct7==hexdec(1))
                    $function_ret='Mulh';
                break;

            case hexdec(5):
				if($funct7==hexdec(0))
					$function_ret='Srl';
				if($funct7==hexdec(20))
					$function_ret='Sra';
                break;

            case hexdec(2):
                $function_ret='Slt';
                break;

            case hexdec(3):
                $function_ret='Sltu';
                break;

            default:
                $function_ret='';
                break;
        }
    }
    else if($op==hexdec(3))
    {
        switch ($funct3)
        {
            case hexdec(0):
                $function_ret='Lb';
                break;
            case hexdec(1):
                $function_ret='Lh';
                break;
            case hexdec(2):
                $function_ret='Lw';
                break;
			case hexdec(3):
                $function_ret='Ld';
                break;
            case hexdec(4):
                $function_ret='Lbu';
                break;
            default:
                $function_ret='';
                break;
        }
    }
    else if($op==hexdec(13))
    {
        switch ($funct3)
        {
            case hexdec(0):
                $function_ret='Addi';
                break;
            case hexdec(7):
                $function_ret='Andi';
                break;
            case hexdec(6):
                $function_ret='Ori';
                break;
            case hexdec(4):
                $function_ret='Xori';
                break;
            case hexdec(2):
                $function_ret='Slti';
                break;
            case hexdec(3):
                $function_ret='Sltiu';
                break;
			case hexdec(1):
                $function_ret='Slli';
                break;
            case hexdec(5):
				if($funct7==hexdec(0))
					$function_ret="Srli";
				if($funct7==hexdec(20))
					$function_ret='Srai';
                break;
            default:
                $function_ret='';
                break;
        }
    }
    else if($op==hexdec(67))
    {
        switch ($funct3)
        {
            case hexdec(0):
                $function_ret='Jalr';
                break;
            default:
                $function_ret='';
                break;
        }
    }
    else if($op==hexdec(23))
    {
        switch ($funct3)
        {
            case hexdec(0):
                $function_ret='Sb';
                break;
            case hexdec(1):
                $function_ret='Sh';
                break;
			case hexdec(2):
                $function_ret='Sw';
                break;
            case hexdec(3):
                $function_ret='Sd';
                break;
            default:
                $function_ret='';
                break;
        }
    }
    else if($op==hexdec(63))
    {
        switch ($funct3)
        {
            case hexdec(0):
                $function_ret='Beq';
                break;
            case hexdec(1):
                $function_ret='Bne';
                break;
            default:
                $function_ret='';
                break;
        }
    }
    else if($op==hexdec('6F'))
    {
        $function_ret='Jal';
    }

    return $function_ret;
}
//#############################################################
//###### Funzione che identifica la istruzione
function instrType($op)
{
    $op=intval($op);
    $type='';

    if($op==hexdec(33))
    {
        $type='R';
    }
    if($op==hexdec(3))
    {
        $type='I';
    }
    if($op==hexdec(13))
    {
        $type='I';
    }
    if($op==hexdec(67))
    {
        $type='I';
    }
    if($op==hexdec(23))
    {
        $type='S';
    }
    if($op==hexdec(63))
    {
        $type='SB';
    }
    if($op==hexdec('6F'))
    {
        $type='UJ';
    }

    return $type;
}
//#############################################################

?>