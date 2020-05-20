<?php
require_once 'functions.php';
$mem=$_SESSION['memIstr'];
$dim=$_SESSION['memIstrUse'];
$dim=intval($dim);

if ($dim!=0)
{
  echo '<div id="memIstr"></div>';
  $index=0;
  while($index<$dim)
  {
    $a=$mem[$index];
    $op=substr($a,25,7);
    $funct3=substr($a,17,3);
    $funct7=substr($a,0,7);
    $rs2=substr($a,7,5);

    $tipo=instrType(BinToGMP($op,1));
    $oper=instrName(BinToGMP($op,1),BinToGMP($funct3,1),BinToGMP($funct7,1),BinToGMP($rs2,1));
    $istruzione='';

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
          $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".codRegister(BinToGMP($rs1,1)).", ".BinToGMP(substr($a,6,6),1);
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
      $imm=substr($a,0,1).substr($a,24,1).substr($a,1,6).substr($a,20,4);
      $rs1=substr($a,12,5);
      $rs2=substr($a,7,5);
      $address=($index*4+BinToGMP($imm,0)*2);
      $istruzione=$oper." ".codRegister(BinToGMP($rs1,1)).", ".codRegister(BinToGMP($rs2,1)).", ".$address;
    }
    else if ($tipo=="U")
    {
      $rd=substr($a,20,5);
      $imm=substr($a,0,20);
      $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".BinToGMP($imm,1);
    }
    else if ($tipo=="UJ")
    {
      $rd=substr($a,20,5);
      $imm=substr($a,0,1).substr($a,12,8).substr($a,11,1).substr($a,1,10);
      $address=($index*4+BinToGMP($imm,0)*2);
      $istruzione=$oper." ".codRegister(BinToGMP($rd,1)).", ".$address;
    }

    ?>
    <br>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">

    <?php
      $text1='<tr bgcolor="white"><td align="center" valign="middle" style="border-style: solid; border-width: 1px 0px; background: ';
      $text2='> <font size="2" face="arial" color="black">';
      $text3='</font> </td></tr>';
      if ($_SESSION['data'][$_SESSION['index']]['ifIstruzione']==$index) {
        $color='#ffc0cbdf';
        $id=';" id="ifStage"';
        $message='INSTRUCTION IN IF STAGE';
        $message=($_SESSION['data'][$_SESSION['index']]['idIstruzione']==1001)?$message.'<b style="position: absolute; font-size: 20px; margin-left: 2px;">*</b>':$message;
        echo $text1.$color.$id.$text2.$message.$text3;

        echo "<script language='JavaScript' type='text/JavaScript'>top.frames[2].document.getElementById('ifLabel').innerText='".$istruzione."'; top.frames[2].document.getElementById('ifLabel').style.background='".$color."';</script>";
      }
      if ($_SESSION['data'][$_SESSION['index']]['idIstruzione']==$index) {
        $color='#ff0000af';
        $id=';" id="idStage"';
        $message='INSTRUCTION IN ID STAGE';
        $message=($_SESSION['data'][$_SESSION['index']]['exIstruzione']==1001)?$message.'<b style="position: absolute; font-size: 20px; margin-left: 2px;">*</b>':$message;
        echo $text1.$color.$id.$text2.$message.$text3;

        echo "<script language='JavaScript' type='text/JavaScript'>top.frames[2].document.getElementById('idLabel').innerText='".$istruzione."'; top.frames[2].document.getElementById('idLabel').style.background='".$color."';</script>";
      }
      if ($_SESSION['data'][$_SESSION['index']]['exIstruzione']==$index) {
        $color='#ffff00af';
        $id=';" id="exStage"';
        $message='INSTRUCTION IN EX STAGE';
        $message=($_SESSION['data'][$_SESSION['index']]['memIstruzione']==1001)?$message.'<b style="position: absolute; font-size: 20px; margin-left: 2px;">*</b>':$message;
        echo $text1.$color.$id.$text2.$message.$text3;

        echo "<script language='JavaScript' type='text/JavaScript'>top.frames[2].document.getElementById('exLabel').innerText='".$istruzione."'; top.frames[2].document.getElementById('exLabel').style.background='".$color."';</script>";
      }
      if ($_SESSION['data'][$_SESSION['index']]['memIstruzione']==$index) {
        $color='#0000ff9f';
        $id=';" id="memStage"';
        $message='INSTRUCTION IN MEM STAGE';
        $message=($_SESSION['data'][$_SESSION['index']]['wbIstruzione']==1001)?$message.'<b style="position: absolute; font-size: 20px; margin-left: 2px;">*</b>':$message;
        echo $text1.$color.$id.$text2.$message.$text3;

        echo "<script language='JavaScript' type='text/JavaScript'>top.frames[2].document.getElementById('memLabel').innerText='".$istruzione."'; top.frames[2].document.getElementById('memLabel').style.background='".$color."';</script>";
      }
      if ($_SESSION['data'][$_SESSION['index']]['wbIstruzione']==$index) {
        $color='#008000af';
        $id=';" id="wbStage"';
        $message='INSTRUCTION IN WB STAGE';
        echo $text1.$color.$id.$text2.$message.$text3;

        echo "<script language='JavaScript' type='text/JavaScript'>top.frames[2].document.getElementById('wbLabel').innerText='".$istruzione."'; top.frames[2].document.getElementById('wbLabel').style.background='".$color."';</script>";
      }

    ?>
      <tr>
        <td width="40%" align="center" valign="middle" bgcolor="white">
          <font size="1" face="arial">
            <b>Address <?php echo $index*4;?> (0x<?php echo dechex($index*4);?>)</b><br>
            <?php echo $tipo;?>-type Instruction:<br>
          </font>
          <font face="arial" style="font-size: 16px; display: block; margin-top: 1px; margin-bottom: -1px;">
            <b><?php echo $istruzione;?></b>
          </font>
          <font face="arial" style="font-size: 14px;">
            <b><?php echo $a;?></b>
          </font>
        </td>
      </tr>
      <tr>
        <td width="60%" bgcolor="#cccccc" valign="top" align="center">
          <?php if ($tipo=="R")
          {
            ?>
            <table width="280" cellpadding="2" cellspacing="0" style="border:1px solid #666666">
              <tr>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($funct7,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs2,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs1,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($funct3,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rd,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($op,1);?></font></td>
              </tr>
              <tr>
                <td width="20%" align="center"><font size="1"><?php echo $funct7;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs2;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs1;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $funct3;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rd;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $op;?></font></td>
              </tr>
              <tr>
                <td width="20%" align="center"><font size="1">FUNCT7</font></td>
                <td width="15%" align="center"><font size="1">RS2</font></td>
                <td width="15%" align="center"><font size="1">RS1</font></td>
                <td width="15%" align="center"><font size="1">FUNCT3</font></td>
                <td width="15%" align="center"><font size="1">RD</font></td>
                <td width="20%" align="center"><font size="1">OP</font></td>
              </tr>
            </table>
          <?php } ?>
          <?php if ($tipo=="I")
          {
            ?>
            <table width="280" cellpadding="2" cellspacing="0" style="border:1px solid #666666">
              <tr>
                <td width="35%" align="center"><font size="1"><?php echo BinToGMP($imm,0);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs1,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($funct3,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rd,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($op,1);?></font></td>
              </tr>
              <tr>
                <td width="35%" align="center"><font size="1"><?php echo $imm;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs1;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $funct3;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rd;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $op;?></font></td>
              </tr>
              <tr>
                <td width="35%" align="center"><font size="1">IMMEDIATE</font></td>
                <td width="15%" align="center"><font size="1">RS1</font></td>
                <td width="15%" align="center"><font size="1">FUNCT3</font></td>
                <td width="15%" align="center"><font size="1">RD</font></td>
                <td width="20%" align="center"><font size="1">OP</font></td>
              </tr>
            </table>
          <?php } ?>
          <?php if ($tipo=="S")
          {
            ?>
            <table width="280" cellpadding="2" cellspacing="0" style="border:1px solid #666666">
              <tr>
                <td width="35%" align="center"><font size="1"><?php echo BinToGMP($imm,0);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs2,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs1,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($funct3,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($op,1);?></font></td>
              </tr>
              <tr>
                <td width="35%" align="center"><font size="1"><?php echo $imm;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs2;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs1;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $funct3;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $op;?></font></td>
              </tr>
              <tr>
                <td width="35%" align="center"><font size="1">IMMEDIATE</font></td>
                <td width="15%" align="center"><font size="1">RS2</font></td>
                <td width="15%" align="center"><font size="1">RS1</font></td>
                <td width="15%" align="center"><font size="1">FUNCT3</font></td>
                <td width="20%" align="center"><font size="1">OP</font></td>
              </tr>
            </table>
          <?php } ?>
          <?php if ($tipo=="SB")
          {
            ?>
            <table width="280" cellpadding="2" cellspacing="0" style="border:1px solid #666666">
              <tr>
                <td width="35%" align="center"><font size="1"><?php echo BinToGMP($imm,0);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs2,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($rs1,1);?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo BinToGMP($funct3,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($op,1);?></font></td>
              </tr>
              <tr>
                <td width="35%" align="center"><font size="1"><?php echo $imm;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs2;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $rs1;?></font></td>
                <td width="15%" align="center"><font size="1"><?php echo $funct3;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $op;?></font></td>
              </tr>
              <tr>
                <td width="35%" align="center"><font size="1">IMMEDIATE</font></td>
                <td width="15%" align="center"><font size="1">RS2</font></td>
                <td width="15%" align="center"><font size="1">RS1</font></td>
                <td width="15%" align="center"><font size="1">FUNCT3</font></td>
                <td width="20%" align="center"><font size="1">OP</font></td>
              </tr>
            </table>
          <?php } ?>
          <?php if ($tipo=="U")
          {
            ?>
            <table width="280" cellpadding="2" cellspacing="0" style="border:1px solid #666666">
              <tr>
                <td width="60%" align="center"><font size="1"><?php echo BinToGMP($imm,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($rd,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($op,1);?></font></td>
              </tr>
              <tr>
                <td width="60%" align="center"><font size="1"><?php echo $imm;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $rd;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $op;?></font></td>
              </tr>
              <tr>
                <td width="60%" align="center"><font size="1">IMMEDIATE</font></td>
                <td width="20%" align="center"><font size="1">RD</font></td>
                <td width="20%" align="center"><font size="1">OP</font></td>
              </tr>
            </table>
          <?php } ?>
          <?php if ($tipo=="UJ")
          {
            ?>
            <table width="280" cellpadding="2" cellspacing="0" style="border:1px solid #666666">
              <tr>
                <td width="60%" align="center"><font size="1"><?php echo BinToGMP($imm,0);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($rd,1);?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo BinToGMP($op,1);?></font></td>
              </tr>
              <tr>
                <td width="60%" align="center"><font size="1"><?php echo $imm;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $rd;?></font></td>
                <td width="20%" align="center"><font size="1"><?php echo $op;?></font></td>
              </tr>
              <tr>
                <td width="60%" align="center"><font size="1">ADDRESS</font></td>
                <td width="20%" align="center"><font size="1">RD</font></td>
                <td width="20%" align="center"><font size="1">OP</font></td>
              </tr>
            </table>
          <?php } ?>
        </td>
      </tr>
    </table>
    <?php
    $index=$index+1;
  }
}
else
{
  ?>
  <div align="center" class="testoGrande">
    <b style="font-size:14px; display:block; margin:30px 0px 15px 0px;">EMPTY</b>
    <form action="editor.php" method="post" target="Layout" style="margin: 5px;">
      <input type="submit" value="Click HERE to load a program" name="load" class="form" style="padding: 1px 5px;">
    </form>
  </div>
<?php } ?>

