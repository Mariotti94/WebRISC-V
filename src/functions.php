<?php
//######################## FUNCTIONS: CONVERSIONS #############################

//#############################################################################
//GMP string to binary number
function GMPToBin($str,$lunghezza,$istruzione)
{
  $str=strval($str);
  $num=$str;
  $str=gmp_strval(gmp_abs($str));
  $risultato='';

  while($str!="1" && $str!="0") {
    $i=gmp_strval(gmp_mod($str,"2"));
    $str=gmp_div_q(gmp_sub($str,$i),"2");
    $risultato=$i.$risultato;

  }
  if ($str!="0") {
    $risultato="1".$risultato;
  }
  else {
    $risultato="0";
  }

  //pad to length
  if ($istruzione!=1) //signed
  {
    if (gmp_cmp($num,0)>=0)
    {
      if (strlen($risultato)<$lunghezza)
      {
        $i=$lunghezza-strlen($risultato);
        while($i!=0) {
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
        while($i!=0) {
          $risultato="1".$risultato;
          $i=$i-1;
        }
      }
    }
  }
  else //unsigned
  {
    if (strlen($risultato)<$lunghezza)
    {
      $i=$lunghezza-strlen($risultato);
      while($i!=0) {
        $risultato="0".$risultato;
        $i=$i-1;
      }
    }
  }

  $function_ret=(strlen($risultato)>$lunghezza)?str_repeat('1',$lunghezza):$risultato; //overflow
  return $function_ret;
}
//#############################################################################

//#############################################################################
//Binary number to GMP string
function BinToGMP($str,$istruzione)
{
  $lunghezza=strlen($str);
  if ($lunghezza!=0)
  {
    if ( (isset($str[0])?$str[0]:'0')=='1' && $lunghezza!=1 && $istruzione!=1)
    {
      $str=twoComplement($str);
      $j=0;
      $k="0";
      $l=0;
      while($lunghezza!=$l) {
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
      while($lunghezza!=$l) {
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
//Two's complement of binary number
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

//################### FUNCTIONS: ARCHITECTURAL ELEMENTS #######################

//#############################################################################
function ALU($controllo,$dato1,$dato2)
{
  $dato1=strval($dato1);
  $dato2=strval($dato2);

  switch ($controllo)
  {
    case "00000": //AND
      $risultato=gmp_strval(gmp_and($dato1,$dato2));
      break;

    case "00011": //XOR
      $risultato=gmp_strval(gmp_xor($dato1,$dato2));
      break;

    case "00001": //OR
      $risultato=gmp_strval(gmp_or($dato1,$dato2));
      break;

    case "00010": //ADD
      $risultato=gmp_strval(gmp_add($dato1,$dato2));
      break;

    case "00110": //SUB
      $risultato=gmp_strval(gmp_sub($dato1,$dato2));
      break;

    case "00100": //SLT
      $risultato=(gmp_cmp($dato1,$dato2)<0)?"1":"0";
      break;

    case "00101": //SLTU
      $dato1=BinToGMP(GMPToBin($dato1,64,0),1);
      $dato2=BinToGMP(GMPToBin($dato2,64,0),1);
      $risultato=(gmp_cmp($dato1,$dato2)<0)?"1":"0";
      break;

    case "01000": //MUL
      $HILO=gmp_strval(gmp_mul($dato1,$dato2));
      $HILO_bin=GMPToBin($HILO,128,0);
      $risultato=BinToGMP(substr($HILO_bin,64,64),0);
      break;

    case "01001": //MULH
      $HILO=gmp_strval(gmp_mul($dato1,$dato2));
      $HILO_bin=GMPToBin($HILO,128,0);
      $risultato=BinToGMP(substr($HILO_bin,0,64),0);
      break;

    case "01001": //MULHSU
      $dato2=BinToGMP(GMPToBin($dato2,64,0),1);
      $HILO=gmp_strval(gmp_mul($dato1,$dato2));
      $HILO_bin=GMPToBin($HILO,128,0);
      $risultato=BinToGMP(substr($HILO_bin,0,64),0);
      break;

    case "01011": //MULHU
      $dato1=BinToGMP(GMPToBin($dato1,64,0),1);
      $dato2=BinToGMP(GMPToBin($dato2,64,0),1);
      $HILO=gmp_strval(gmp_mul($dato1,$dato2));
      $HILO_bin=GMPToBin($HILO,128,0);
      $risultato=BinToGMP(substr($HILO_bin,0,64),0);
      break;

    case "11000": //DIV
      $HI_val=gmp_strval(gmp_mod($dato1,$dato2));
      $LO_val=gmp_strval(gmp_div_q(gmp_sub($dato1,$HI_val),$dato2));
      $risultato=$LO_val;
      break;

    case "11001": //DIVU
      $dato1=BinToGMP(GMPToBin($dato1,64,0),1);
      $dato2=BinToGMP(GMPToBin($dato2,64,0),1);
      $HI_val=gmp_strval(gmp_mod($dato1,$dato2));
      $LO_val=gmp_strval(gmp_div_q(gmp_sub($dato1,$HI_val),$dato2));
      $risultato=$LO_val;
      break;

    case "11010": //REM
      $HI_val=gmp_strval(gmp_mod($dato1,$dato2));
      $risultato=$HI_val;
      break;

    case "11011": //REMU
      $dato1=BinToGMP(GMPToBin($dato1,64,0),1);
      $dato2=BinToGMP(GMPToBin($dato2,64,0),1);
      $HI_val=gmp_strval(gmp_mod($dato1,$dato2));
      $risultato=$HI_val;
      break;

    case "01101": //SLL
      $risultato=GMPToBin($dato1,64,0);
      $risultato=substr($risultato,$dato2).str_repeat('0',$dato2);
      $risultato=BinToGMP($risultato,0);
      break;

    case "01110": //SRL
      $risultato=GMPToBin($dato1,64,0);
      $risultato=str_repeat('0',$dato2).substr($risultato,0,-$dato2);
      $risultato=BinToGMP($risultato,0);
      break;

    case "01111": //SRA
      $risultato=GMPToBin($dato1,64,0);
      $risultato=str_repeat($risultato[0],$dato2).substr($risultato,0,-$dato2);
      $risultato=BinToGMP($risultato,0);
      break;

    case "10010": //ADDW
      $risultato=GMPToBin(gmp_add($dato1,$dato2),64,0);
      $risultato=str_repeat('0',32).substr($risultato,32,32);
      $risultato=BinToGMP($risultato,0);
      break;

    case "10110": //SUBW
      $risultato=GMPToBin(gmp_sub($dato1,$dato2),64,0);
      $risultato=str_repeat('0',32).substr($risultato,32,32);
      $risultato=BinToGMP($risultato,0);
      break;

    case "11101": //SLLW
      $risultato=GMPToBin($dato1,64,0);
      $risultato=substr($risultato,$dato2).str_repeat('0',$dato2);
      $risultato=str_repeat('0',32).substr($risultato,32,32);
      $risultato=BinToGMP($risultato,0);
      break;

    case "11110": //SRLW
      $risultato=GMPToBin($dato1,64,0);
      $risultato=str_repeat('0',$dato2).substr($risultato,0,-$dato2);
      $risultato=str_repeat('0',32).substr($risultato,32,32);
      $risultato=BinToGMP($risultato,0);
      break;

    case "11111": //SRAW
      $risultato=GMPToBin($dato1,64,0);
      $risultato=str_repeat($risultato[0],$dato2).substr($risultato,0,-$dato2);
      $risultato=str_repeat('0',32).substr($risultato,32,32);
      $risultato=BinToGMP($risultato,0);
      break;

    default:
      $risultato="0";
      break;
  }

  return $risultato;
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
function EXMux5($ctrl,$dato1,$dato2)
{
  switch ($ctrl)
  {
    case '00':
      $function_ret=$dato1;
      break;

    case '01':
      $function_ret=$dato2;
      break;

    case '10':
      $function_ret=0;
      break;

    default:
      $function_ret=0;
      break;
  }
  return $function_ret;
}
//#############################################################################

//#############################################################################
function EXMux6($ctrl,$dato1,$dato2)
{
  switch ($ctrl)
  {
    case '00':
      $function_ret=$dato1;
      break;

    case '01':
      $function_ret=$dato2;
      break;

    case '10':
      $function_ret=4;
      break;

    default:
      $function_ret=0;
      break;
  }
  return $function_ret;
}
//#############################################################################

//#############################################################################
function ctrlUnit($instruction)
{
  $op=substr($instruction,25,7);
  $op=BinToGMP($op,1);

  $funct3=substr($instruction,17,3);
  $funct3=BinToGMP($funct3,1);

  switch ($op)
  {
    //type R
    case hexdec(33):
      $ex="100000";
      $mem="00000";
      $wb="10";
      break;
    case hexdec('3B'):
      $ex="100000";
      $mem="00000";
      $wb="10";
      break;

    //type I
    case hexdec(13):
      $ex="100001";
      $mem="00000";
      $wb="10";
      break;
    case hexdec('1B'):
      $ex="100001";
      $mem="00000";
      $wb="10";
      break;

    //type SB
    case hexdec(63):
      $ex="010000";
      $mem="00000";
      $wb="00";
      break;

    case hexdec(3):
      $ex="000001";
      $wb="11";
      switch($funct3)
      {
        case hexdec(0): //lb
          $mem="10000";
          break;

        case hexdec(1): //lh
          $mem="10010";
          break;

        case hexdec(2): //lw
          $mem="10100";
          break;

        case hexdec(3): //ld
          $mem="10110";
          break;

        case hexdec(4): //lbu
          $mem="10001";
          break;

        case hexdec(5): //lhu
          $mem="10011";
          break;

        case hexdec(6): //lwu
          $mem="10101";
          break;

        default:
          $mem="00000";
          break;
      }
      break;

    //type S
    case hexdec(23):
      $ex="000001";
      $wb="01";
      switch($funct3)
      {
        case hexdec(0): //sb
          $mem="01000";
          break;

        case hexdec(1): //sh
          $mem="01010";
          break;

        case hexdec(2): //sw
          $mem="01100";
          break;

        case hexdec(3): //sd
          $mem="01110";
          break;

        default:
          $mem="00000";
          break;
      }
      break;

    case hexdec(67): //jalr
      $ex="000110";
      $mem="00000";
      $wb="10";
      break;

    case hexdec('6F'): //jal
      $ex="000110";
      $mem="00000";
      $wb="10";
      break;

    case hexdec(17): //auipc
      $ex="000101";
      $mem="00000";
      $wb="10";
      break;

    case hexdec(37): //lui
      $ex="001001";
      $mem="00000";
      $wb="10";
      break;

    default:
      $ex="000000";
      $mem="00000";
      $wb="00";
      break;
  }

  return array($ex,$mem,$wb);
}
//#############################################################################

//#############################################################################
function ctrlAlu($ctrl,$funct7,$funct3,$op)
{
  $funct6=BinToGMP(substr(GMPToBin($funct7,7,1),0,6),1);
  $function_ret="";
  switch ($ctrl)
  {
    case "00": //load, save, jump, U-type
      $function_ret="00010";
      break;

    case "01": //branch
      $function_ret="00110";
      break;

    case "10": //arithmetic
      if ($op==hexdec(33))
      {
        switch($funct3)
        {
          case hexdec(0):
            if ($funct7==hexdec(0)) //add
              $function_ret="00010";
            if ($funct7==hexdec(20)) //sub
              $function_ret="00110";
            if ($funct7==hexdec(1)) //mul
              $function_ret="01000";
            break;

          case hexdec(1):
            if ($funct7==hexdec(0)) //sll
              $function_ret="01101";
            if ($funct7==hexdec(1)) //mulh
              $function_ret="01001";
            break;

          case hexdec(2):
            if ($funct7==hexdec(0)) //slt
              $function_ret="00100";
            if ($funct7==hexdec(1)) //mulhsu
              $function_ret="01010";
            break;

          case hexdec(3):
            if ($funct7==hexdec(0)) //sltu
              $function_ret="00101";
            if ($funct7==hexdec(1)) //mulhu
              $function_ret="01011";
            break;

          case hexdec(4):
            if ($funct7==hexdec(0)) //xor
              $function_ret="00011";
            if ($funct7==hexdec(1)) //div
              $function_ret="11000";
            break;

          case hexdec(5):
            if ($funct7==hexdec(0))
              $function_ret="01110"; //srl
            if ($funct7==hexdec(1))
              $function_ret="11001"; //divu
            if ($funct7==hexdec(20))
              $function_ret="01111"; //sra
            break;

          case hexdec(6):
            if ($funct7==hexdec(0)) //or
              $function_ret="00001";
            if ($funct7==hexdec(1)) //rem
              $function_ret="11010";
            break;

          case hexdec(7):
            if ($funct7==hexdec(0)) //and
              $function_ret="00000";
            if ($funct7==hexdec(1)) //remu
              $function_ret="11011";
            break;
        }
      }
      else if ($op==hexdec('3B'))
      {
        switch($funct3)
        {
          case hexdec(0):
            if ($funct7==hexdec(0)) //addw
              $function_ret="10010";
            if ($funct7==hexdec(20)) //subw
              $function_ret="10110";
            if ($funct7==hexdec(1)) //mulw
              $function_ret="10011";
            break;

          case hexdec(1):
            if ($funct7==hexdec(0)) //sllw
              $function_ret="11101";
            break;

          case hexdec(4):
            if ($funct7==hexdec(1)) //divw
              $function_ret="10000";
            break;

          case hexdec(5):
            if ($funct7==hexdec(0)) //srlw
              $function_ret="11110";
            if ($funct7==hexdec(1)) //divuw
              $function_ret="10001";
            if ($funct7==hexdec(20)) //sraw
              $function_ret="11111";
            break;

          case hexdec(6):
            if ($funct7==hexdec(1)) //remw
              $function_ret="10100";
            break;

          case hexdec(7):
            if ($funct7==hexdec(1)) //remuw
              $function_ret="10101";
            break;
        }
      }
      else if ($op==hexdec(13))
      {
        switch ($funct3)
        {
          case hexdec(0): //addi
            $function_ret="00010";
            break;

          case hexdec(1): //slli
            $function_ret="01101";
            break;

          case hexdec(2): //slti
            $function_ret="00111";
            break;

          case hexdec(3): //sltiu
            $function_ret="00100";
            break;

          case hexdec(4): //xori
            $function_ret="00011";
            break;

          case hexdec(5):
            if ($funct6==hexdec(0))
              $function_ret="01110"; //srli
            if ($funct6==hexdec(20))
              $function_ret="01111"; //srai
            break;

          case hexdec(6): //ori
            $function_ret="00001";
            break;

          case hexdec(7): //andi
            $function_ret="00000";
            break;
        }
      }
      else if ($op==hexdec('1B'))
      {
        switch ($funct3)
        {
          case hexdec(0): //addiw
            $function_ret="10010";
            break;

          case hexdec(1): //slliw
            $function_ret="11101";
            break;

          case hexdec(5):
            if ($funct7==hexdec(0))
              $function_ret="11110"; //srliw
            if ($funct7==hexdec(20))
              $function_ret="11111"; //sraiw
            break;
        }
      }
      break;
  }

  return $function_ret;
}
//#############################################################################

//################## FUNCTIONS: ENCODING AND DECODING #########################

//#############################################################################
//Instruction string to binary
function decodeIstr($istr)
{
  $cmd=strtok($istr,' ');
  $a=substr($istr,strlen($istr)-(strlen($istr)-strlen($cmd)));
  $cmd=trim($cmd);

  switch ($cmd)
  {
    case 'add':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(0);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'addw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(0);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'addiw':
      $tipo='I';
      $op=hexdec('1B');
      $funct3=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'sub':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(0);
      $funct7=hexdec(20);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'subw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(0);
      $funct7=hexdec(20);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'divu':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(5);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'remu':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(7);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'mulhsu':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(2);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'mulhu':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(3);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'mulw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(0);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'divw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(4);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'remw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(6);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'divuw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(5);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'remuw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(7);
      $funct7=hexdec(1);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'or':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(6);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'xor':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(4);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'sll':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(1);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'sllw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(1);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'srlw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(5);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
       if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        break;
      }
      $rs2=strtok($a,PHP_EOL);
      $rs2=trim($rs2);
      break;

    case 'sraw':
      $tipo='R';
      $op=hexdec('3B');
      $funct3=hexdec(5);
      $funct7=hexdec(20);
       if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      $funct6=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      $imm=($imm!='ERR')?BinToGMP(GMPToBin($funct6,6,1).GMPToBin($imm,6,1),1):$imm;
      break;

    case 'slliw':
      $tipo='I';
      $op=hexdec('1B');
      $funct3=hexdec(1);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      $imm=($imm!='ERR')?BinToGMP(GMPToBin($funct7,7,1).GMPToBin($imm,5,1),1):$imm;
      break;

    case 'srli':
      $tipo='I';
      $op=hexdec(13);
      $funct3=hexdec(5);
      $funct6=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      $imm=($imm!='ERR')?BinToGMP(GMPToBin($funct6,6,1).GMPToBin($imm,6,1),1):$imm;
      break;

    case 'srliw':
      $tipo='I';
      $op=hexdec('1B');
      $funct3=hexdec(5);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      $imm=($imm!='ERR')?BinToGMP(GMPToBin($funct7,7,1).GMPToBin($imm,5,1),1):$imm;
      break;

    case 'srai':
      $tipo='I';
      $op=hexdec(13);
      $funct3=hexdec(5);
      $funct6=hexdec(20);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      $imm=($imm!='ERR')?BinToGMP(GMPToBin($funct6,6,1).GMPToBin($imm,6,1),1):$imm;
      break;

    case 'sraiw':
      $tipo='I';
      $op=hexdec('1B');
      $funct3=hexdec(5);
      $funct7=hexdec(20);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      $imm=($imm!='ERR')?BinToGMP(GMPToBin($funct7,7,1).GMPToBin($imm,5,1),1):$imm;
      break;

    case 'lb':
      $tipo='I';
      $op=hexdec(3);
      $funct3=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
      {
        $rs1='ERR';
        break;
      }
      $rs1=strtok($a,'\)');
      $rs1=trim($rs1);
      break;

    case 'lhu':
      $tipo='I';
      $op=hexdec(3);
      $funct3=hexdec(5);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
      {
        $rs1='ERR';
        break;
      }
      $rs1=strtok($a,'\)');
      $rs1=trim($rs1);
      break;

    case 'lwu':
      $tipo='I';
      $op=hexdec(3);
      $funct3=hexdec(6);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
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
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=strtok($a,PHP_EOL);
      $imm=trim($imm);
      break;

    case 'blt':
      $tipo='SB';
      $op=hexdec(63);
      $funct3=hexdec(4);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=strtok($a,PHP_EOL);
      $imm=trim($imm);
      break;

    case 'bge':
      $tipo='SB';
      $op=hexdec(63);
      $funct3=hexdec(5);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=strtok($a,PHP_EOL);
      $imm=trim($imm);
      break;

    case 'bltu':
      $tipo='SB';
      $op=hexdec(63);
      $funct3=hexdec(6);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=strtok($a,PHP_EOL);
      $imm=trim($imm);
      break;

    case 'bgeu':
      $tipo='SB';
      $op=hexdec(63);
      $funct3=hexdec(7);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $rs2='ERR';
        $imm='ERR';
        break;
      }
      $rs2=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs2)+1)));
      $rs2=trim($rs2);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'sltu':
      $tipo='R';
      $op=hexdec(33);
      $funct3=hexdec(3);
      $funct7=hexdec(0);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $rs2='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rs1=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rs1)+1)));
      $rs1=trim($rs1);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'j':
      $tipo='UJ';
      $op=hexdec('6F');
      $rd='x0';
      if (strlen($a)==0)
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
      if (strlen($a)==0)
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
      if (strlen($a)==0)
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
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        $rs1='ERR';
        break;
      }
      $imm=strtok($a,'\(');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($imm)+1)));
      $imm=is_numeric(trim($imm))?trim($imm):'ERR';
      if (strlen($a)==0 || $imm==='ERR')
      {
        $rs1='ERR';
        break;
      }
      $rs1=strtok($a,'\)');
      $rs1=trim($rs1);
      break;

    case 'ecall':
      $tipo='I';
      $op=hexdec(73);
      $funct3=hexdec(0);
      $rd='x0';
      $rs1='x0';
      $imm=0;
      break;

    case 'ebreak':
      $tipo='I';
      $op=hexdec(73);
      $funct3=hexdec(0);
      $rd='x0';
      $rs1='x0';
      $imm=1;
      break;

    case 'mv':
      $tipo='I';
      $op=hexdec(13);
      $funct3=hexdec(0);
      $imm=0;
      if (strlen($a)==0)
      {
        $rd='ERR';
        $rs1='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $rs1='ERR';
        break;
      }
      $rs1=strtok($a,PHP_EOL);
      $rs1=trim($rs1);
      break;

    case 'nop':
      $tipo='I';
      $op=hexdec(13);
      $funct3=hexdec(0);
      $rd='x0';
      $rs1='x0';
      $imm=0;
      break;

    case 'ret':
      $tipo='I';
      $op=hexdec(67);
      $funct3=hexdec(0);
      $rd='x0';
      $rs1='ra';
      $imm=0;
      break;

    case 'la':
      $tipo='MULTI';
      break;

    case 'li':
      $tipo='MULTI';
      break;

    case 'auipc':
      $tipo='U';
      $op=hexdec(17);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
      break;

    case 'lui':
      $tipo='U';
      $op=hexdec(37);
      if (strlen($a)==0)
      {
        $rd='ERR';
        $imm='ERR';
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $imm='ERR';
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $imm='ERR';
          }
        }
        else {
          $imm='ERR';
        }
      }
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
      $imm_bin=GMPToBin($imm,12,0);
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
      $target=':'.$imm; //target label to decode later
      $function_ret=GMPToBin($rs2,5,1).GMPToBin($rs1,5,1).GMPToBin($funct3,3,1).GMPToBin($op,7,1).$target;

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
      $target=':'.$target; //target label to decode later
      $function_ret=GMPToBin($rd,5,1).GMPToBin($op,7,1).$target;
    }
  }
  if ($tipo=='MULTI')
  {
    $function_ret='MULTI';
  }

  return $function_ret;
}
//#############################################################################

//#############################################################################
//MultiInstruction to Instruction strings to binary
function decodeMultiIstr($istr,$pc,$tabRil)
{
  $cmd=strtok($istr,' ');
  $a=substr($istr,strlen($istr)-(strlen($istr)-strlen($cmd)));
  $cmd=trim($cmd);

  switch ($cmd)
  {
    case 'la':
      if (strlen($a)==0) {
        $function_ret=array('ERR','instr');
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0) {
        $function_ret=array('ERR','instr');
        break;
      }
      $symbol=trim(strtok($a,PHP_EOL));

      $rd=decRegister($rd);
      if ($rd==='ERR') {
        $function_ret=array('ERR','instr');
        break;
      }
      $symbol_addr=cLabel($symbol,$tabRil);
      if ($symbol_addr==='ERR') {
        $function_ret=array('ERR','label',$symbol);
        break;
      }
      $delta=$symbol_addr-$pc;
      $binDelta=GMPToBin($delta,32,0);
      $auipc_addr=BinToGMP(substr($binDelta,0,20),0)+BinToGMP(substr($binDelta,20,1),0);
      $addi_addr=BinToGMP(substr($binDelta,20,12),0);
      $auipc=GMPToBin($auipc_addr,20,1).GMPToBin($rd,5,1).GMPToBin(hexdec(17),7,1);
      $addi=GMPToBin($addi_addr,12,0).GMPToBin($rd,5,1).GMPToBin(hexdec(0),3,1).GMPToBin($rd,5,1).GMPToBin(hexdec(13),7,1);
      $function_ret=array($auipc,$addi);
      break;

    case 'li':
      if (strlen($a)==0)
      {
        $function_ret=array('ERR','instr');
        break;
      }
      $rd=strtok($a,',');
      $a=substr($a,strlen($a)-(strlen($a)-(strlen($rd)+1)));
      $rd=trim($rd);
      if (strlen($a)==0)
      {
        $function_ret=array('ERR','instr');
        break;
      }
      $imm=trim(strtok($a,PHP_EOL));
      if (!is_numeric($imm)) {
        if (substr($imm,0,2)=="0x") {
          if (ctype_xdigit(substr($imm,2))) {
            $imm=hexdec(substr($imm,2));
          }
          else {
            $function_ret=array('ERR','instr');
          }
        }
        else {
          $function_ret=array('ERR','instr');
        }
      }

      $rd=decRegister($rd);
      if ($rd==='ERR') {
        $function_ret=array('ERR','instr');
        break;
      }

      $binImm=GMPToBin($imm,64,0);
      $addi_param=GMPToBin($rd,5,1).GMPToBin(hexdec(0),3,1).GMPToBin($rd,5,1).GMPToBin(hexdec(13),7,1);
      $slli_param=GMPToBin($rd,5,1).GMPToBin(hexdec(1),3,1).GMPToBin($rd,5,1).GMPToBin(hexdec(13),7,1);

      $binTempVal=array();
      $i=0;
      while ($i<64) {
          $step=($i==0)?9:11;
          $str=substr($binImm,0,$step);
          array_push($binTempVal,$str);
          $binImm=substr($binImm,$step);
          $i+=$step;
      }
      //var_dump($binTempVal);exit;
      $function_ret=array();
      $shift_trigger=false;
      $cntBinTempVal=count($binTempVal);
      for ($i=0; $i<$cntBinTempVal; $i++)
      {
        if ($binTempVal[$i]!=0) {
          array_push($function_ret,GMPToBin(BinToGMP($binTempVal[$i],1),12,0).$addi_param);
          $shift_trigger=true;
        }
        if ($shift_trigger && $i!=($cntBinTempVal-1)) {
          array_push($function_ret,GMPToBin(11,12,0).$slli_param);
        }
      }
      break;

    default:
      $function_ret=array('ERR','instr');
      break;
  }

  return $function_ret;
}
//#############################################################################

//#############################################################################
//Register string to number
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

    case 'zero':
      $function_ret=0;
      break;

    default:
      $function_ret='ERR';
      break;
  }

  return $function_ret;
}
//#############################################################################

//#############################################################################
//Label to Label Address
function cLabel($label,$tabRil)
{
  $i=0;
  $length=count($tabRil);
  $function_ret='ERR';
  while($i<$length)
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

//#############################################################################
//Register number to string
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

//#############################################################################
//Identify instruction name
function instrName($op,$funct3,$funct7,$rs2)
{
  $funct6=BinToGMP(substr(GMPToBin($funct7,7,1),0,6),1);
  $function_ret='';

  if ($op==hexdec(33))
  {
    switch ($funct3)
    {
      case hexdec(0):
        if ($funct7==hexdec(0))
          $function_ret='add';
        if ($funct7==hexdec(20))
          $function_ret='sub';
        if ($funct7==hexdec(1))
          $function_ret='mul';
        break;

      case hexdec(1):
        if ($funct7==hexdec(0))
          $function_ret='sll';
        if ($funct7==hexdec(1))
          $function_ret='mulh';
        break;

      case hexdec(2):
        if ($funct7==hexdec(0))
          $function_ret='slt';
        if ($funct7==hexdec(1))
          $function_ret='mulhsu';
        break;

      case hexdec(3):
        if ($funct7==hexdec(0))
          $function_ret='sltu';
        if ($funct7==hexdec(1))
          $function_ret='mulhu';
        break;

      case hexdec(4):
        if ($funct7==hexdec(0))
          $function_ret='xor';
        if ($funct7==hexdec(1))
          $function_ret='div';
        break;

      case hexdec(5):
        if ($funct7==hexdec(0))
          $function_ret='srl';
        if ($funct7==hexdec(1))
          $function_ret='divu';
        if ($funct7==hexdec(20))
          $function_ret='sra';
        break;

      case hexdec(6):
        if ($funct7==hexdec(0))
          $function_ret='or';
        if ($funct7==hexdec(1))
          $function_ret='rem';
        break;

      case hexdec(7):
        if ($funct7==hexdec(0))
          $function_ret='and';
        if ($funct7==hexdec(1))
          $function_ret='remu';
        break;

      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec('3B'))
  {
    switch ($funct3)
    {
      case hexdec(0):
        if ($funct7==hexdec(0))
          $function_ret='addw';
        if ($funct7==hexdec(20))
          $function_ret='subw';
        if ($funct7==hexdec(1))
          $function_ret='mulw';
        break;

      case hexdec(1):
        if ($funct7==hexdec(0))
          $function_ret='sllw';
        break;

      case hexdec(4):
        if ($funct7==hexdec(1))
          $function_ret='divw';
        break;

      case hexdec(5):
        if ($funct7==hexdec(0))
          $function_ret='srlw';
        if ($funct7==hexdec(1))
          $function_ret='divuw';
        if ($funct7==hexdec(20))
          $function_ret='sraw';
        break;

      case hexdec(6):
        if ($funct7==hexdec(1))
          $function_ret='remw';
        break;

      case hexdec(7):
        if ($funct7==hexdec(1))
          $function_ret='remuw';
        break;

      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec(3))
  {
    switch ($funct3)
    {
      case hexdec(0):
        $function_ret='lb';
        break;
      case hexdec(1):
        $function_ret='lh';
        break;
      case hexdec(2):
        $function_ret='lw';
        break;
      case hexdec(3):
        $function_ret='ld';
        break;
      case hexdec(4):
        $function_ret='lbu';
        break;
      case hexdec(5):
        $function_ret='lhu';
        break;
      case hexdec(6):
        $function_ret='lwu';
        break;
      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec(13))
  {
    switch ($funct3)
    {
      case hexdec(0):
        $function_ret='addi';
        break;
      case hexdec(1):
        $function_ret='slli';
        break;
      case hexdec(2):
        $function_ret='slti';
        break;
      case hexdec(3):
        $function_ret='sltiu';
        break;
      case hexdec(4):
        $function_ret='xori';
        break;
      case hexdec(5):
        if ($funct6==hexdec(0))
          $function_ret="srli";
        if ($funct6==hexdec(20))
          $function_ret='srai';
        break;
      case hexdec(6):
        $function_ret='ori';
        break;
      case hexdec(7):
        $function_ret='andi';
        break;
      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec('1B'))
  {
    switch ($funct3)
    {
      case hexdec(0):
        $function_ret='addiw';
        break;
      case hexdec(1):
        $function_ret='slliw';
        break;
      case hexdec(5):
        if ($funct7==hexdec(0))
          $function_ret="srliw";
        if ($funct7==hexdec(20))
          $function_ret='sraiw';
        break;
      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec(67))
  {
    switch ($funct3)
    {
      case hexdec(0):
        $function_ret='jalr';
        break;
      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec(23))
  {
    switch ($funct3)
    {
      case hexdec(0):
        $function_ret='sb';
        break;
      case hexdec(1):
        $function_ret='sh';
        break;
      case hexdec(2):
        $function_ret='sw';
        break;
      case hexdec(3):
        $function_ret='sd';
        break;
      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec(63))
  {
    switch ($funct3)
    {
      case hexdec(0):
        $function_ret='beq';
        break;
      case hexdec(1):
        $function_ret='bne';
        break;
      case hexdec(4):
        $function_ret='blt';
        break;
      case hexdec(5):
        $function_ret='bge';
        break;
      case hexdec(6):
        $function_ret='bltu';
        break;
      case hexdec(7):
        $function_ret='bgeu';
        break;
      default:
        $function_ret='';
        break;
    }
  }
  else if ($op==hexdec('6F'))
  {
    $function_ret='jal';
  }
  else if ($op==hexdec(73))
  {
    if ($rs2==0)
      $function_ret='ecall';
    else if ($rs2==1)
      $function_ret='ebreak';
    else
      $function_ret='';
  }
  else if ($op==hexdec(17))
  {
    $function_ret='auipc';
  }
  else if ($op==hexdec(37))
  {
    $function_ret='lui';
  }

  return $function_ret;
}
//#############################################################

//#############################################################
//Identify instruction type
function instrType($op)
{
  $op=intval($op);
  $type='';

  if (($op==hexdec(33))||($op==hexdec('3B')))
  {
    $type='R';
  }
  if (($op==hexdec(3))||($op==hexdec(13))||($op==hexdec('1B'))||($op==hexdec(67))||($op==hexdec(73)))
  {
    $type='I';
  }
  if ($op==hexdec(23))
  {
    $type='S';
  }
  if ($op==hexdec(63))
  {
    $type='SB';
  }
  if (($op==hexdec(17))||($op==hexdec(37)))
  {
    $type='U';
  }
  if ($op==hexdec('6F'))
  {
    $type='UJ';
  }

  return $type;
}
//#############################################################

//#############################################################
//Instruction binary to string
function encodeIstr($a) {
  $istruzione='';

  $op=substr($a,25,7);
  $funct3=substr($a,17,3);
  $funct7=substr($a,0,7);
  $rs2=substr($a,7,5);

  $tipo=instrType(BinToGMP($op,1));
  $oper=instrName(BinToGMP($op,1),BinToGMP($funct3,1),BinToGMP($funct7,1),BinToGMP($rs2,1));

  if ($tipo=="R")
  {
    $rd=substr($a,20,5);
    $rs1=substr($a,12,5);
    $rs2=substr($a,7,5);
    $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".codRegister(BinToGMP($rs2,1));
  }
  else if ($tipo=="I")
  {
    $rd=substr($a,20,5);
    $rs1=substr($a,12,5);
    $imm=substr($a,0,12);
    $check=BinToGMP($op,1);
    if ($check==hexdec(3) || $check==hexdec(67))
    {
      $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,0)."(".codRegister(BinToGMP($rs1,1)).")";
    }
    else
    {
      if (BinToGMP($op,1)==hexdec(13) && (BinToGMP($funct3,1)==1 || BinToGMP($funct3,1)==5) )
        $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".BinToGMP(substr($a,7,5),0);
      else if (BinToGMP($op,1)!=hexdec(73) )
        $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".BinToGMP($imm,0);
      else
        $istruzione=$oper;
    }

  }
  else if ($tipo=="S")
  {
    $imm=substr($a,0,7).substr($a,20,5);
    $rs1=substr($a,12,5);
    $rs2=substr($a,7,5);
    $istruzione=$oper." ".codRegister(BinToGMP($rs2,1)).", ".BinToGMP($imm,0)."(".codRegister(BinToGMP($rs1,1)).")";
  }
  else if ($tipo=="SB")
  {
    $imm=substr($a,0,1).substr($a,24,1).substr($a,1,6).substr($a,20,4).'0';
    $rs1=substr($a,12,5);
    $rs2=substr($a,7,5);
    $istruzione=$oper." ".codRegister(BinToGMP($rs1,1)).", ".codRegister(BinToGMP($rs2,1)).", ".BinToGMP($imm,0)*2;
  }
  else if ($tipo=="U")
  {
    $rd=substr($a,20,5);
    $imm=substr($a,0,20);
    $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,0);
  }
  else if ($tipo=="UJ")
  {
    $rd=substr($a,20,5);
    $imm=substr($a,0,1).substr($a,12,8).substr($a,11,1).substr($a,1,10).'0';
    $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,0)*2;
  }
  return $istruzione;
}
//#########################################################################

//################### FUNCTIONS: DATA VISUALIZATION #######################

//#########################################################################
function generateTextH2L($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0) {
  $text='<tr>';
  $text=$text.'<td rowspan="3" width="40" style="word-break: break-all;" align="center" bgcolor="white">'.BinToGMP($byte7.$byte6.$byte5.$byte4.$byte3.$byte2.$byte1.$byte0,0).'</td>';
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
  $text=$text.'<tr>';
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
  return $text;
}
function generateTextL2H($height,$memIndex,$byte7,$byte6,$byte5,$byte4,$byte3,$byte2,$byte1,$byte0) {
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
?>