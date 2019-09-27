<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/JavaScript" src="../js/script.js"></script>
    <script language="JavaScript" type="text/JavaScript">
        window.onload = function() {
            var rFrame=top.frames[1];
            rFrame.document.location.reload();

            if(!top.frames[0].document.getElementById('toggleHover').checked)	{
                top.frames[2].popup_unset();
            }
            else {
                top.frames[2].popup_set();
            }
        };
    </script>
	<meta name="robots" content="noindex" />
</head>
<body bgcolor="#F0F0F0" style="margin-left:5px; margin-top:5px;" >
<?php
$classElemento="elemento";

$widthST1="147";
$widthST2="272";
$widthST3="273";
$widthST4="141";
$widthST5="106";
?>

<table width="1036" height="500" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="13">&nbsp;</td>
        <!--#### STATO INSTRUCTION FETCH-->
        <td width="<?php echo isset($widthST1)?$widthST1:0;?>">

            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="35%">&nbsp;</td>
                    <td width="65%" align="center" valign="middle">
                        <table width="40" height="40" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                            <tr><td valign="middle" align="center"><font size="1">AND</font></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center" valign="middle">
                        <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table4">
                            <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="center" valign="middle">
                        <table width="50" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table5">
                            <tr><td valign="middle" align="center"><font size="1">+</font></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="170" valign="middle" align="center">
                        <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table6">
                            <tr><td valign="middle" align="center" bgcolor="pink"><font size="1">PC</font></td></tr>
                        </table>
                    </td>
                    <td align="center" valign="middle">
                        <table width="60" height="150" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                            <tr><td valign="top" align="center">
                                    <font size="1">INSTRUCION<br>MEMORY
                                        <br><br><br><br>
                                        <div align="left">ADDRESS</div>
                                        <br><br>
                                        <div align="right">READ INSTRUCTION</div>
                                    </font>
                                </td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="30">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>

        </td>
        <!--#### IF/ID REGISTRI-->
        <td width="45" valign="bottom" align="center">

            <font size="1">IF/ID</font>
            <table width="100%" height="300" cellpadding="0" cellspacing="0" border="0" bgcolor="red">
                <tr>
                    <td><img src="../img/layout/x.gif"></td>
                </tr>
            </table>

        </td>
        <!--#### STATO INSTRUCTION DECODE-->
        <td width="<?php echo isset($widthST2)?$widthST2:0;?>">

            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" ID="Table7">
                <tr>
                    <td width="45%" align="right" valign="bottom" height="70">
                        <table width="80" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table8">
                            <tr><td valign="middle" align="center">
                                    <font size="1">HAZARD DETECTION UNIT<br></font>
                                </td></tr>
                        </table>
                    </td>
                    <td width="35%" align="center" valign="middle">
                        &nbsp;
                    </td>
                    <td width="20%" align="left" valign="bottom">
                        <table width="40" height="40" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table14">
                            <tr><td valign="middle" align="center"><font size="1">OR</font></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" height="125">
                        <table width="60" height="100" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table9">
                            <tr><td valign="middle" align="center">
                                    <font size="1">CONTROL<BR>UNIT<br></font>
                                </td></tr>
                        </table>
                    </td>
                    <td align="center" valign="middle">
                        &nbsp;
                    </td>
                    <td align="left" valign="middle">
                        <br><br>
                        <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table15">
                            <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="bottom" height="65">

                    </td>
                    <td align="center" valign="top">

                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td valign="middle" align="center">
                        &nbsp;
                    </td>
                    <td align="center" valign="top">
                        <table width="90" height="150" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table12">
                            <tr><td valign="top" align="center">
                                    <font size="1">
                                        <div align="right">Read Data 1</div>
                                        <div align="left">Read<br>Register 1</div>
                                        <div align="left">Read<br>Register 2</div>
                                        <br>
                                        <div align="center"><b>REGISTERS</b></div>
                                        <br>
                                        <div align="left">Write<br>Register</div>
                                        <div align="right">Read Data 2</div>
                                        <div align="left">Write Data</div>
                                    </font>
                                </td></tr>
                        </table>
                    </td>
                    <td align="center" valign="middle">
                        <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table16">
                            <tr><td valign="middle" align="center"><font size="1">=</font></td></tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="90" align="right" valign="top">
                        <br>
                        <table width="60" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table11">
                            <tr><td valign="middle" align="center">
                                    <font size="1">IMMEDIATE<br>GENERATOR<br></font>
                                </td></tr>
                        </table>

                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>

        </td>
        <!--#### ID/EX REGISTRI-->
        <td width="45" valign="bottom" align="center">

            <font size="1">ID/EX</font>
            <table width="100%" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                <tr>
                    <td valign="middle" align="center">
                        <font size="1">WB
                        </font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#666666"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
            </table>
            <table width="100%" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                <tr>
                    <td valign="middle" align="center">
                        <font size="1">M
                        </font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#666666"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
            </table>
            <table width="100%" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_ID_EX.gif">
                <tr>
                    <td valign="middle" align="center">
                        <font size="1">EX
                        </font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#666666"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
            </table>
            <table width="100%" height="300" cellpadding="0" cellspacing="0" border="0" bgcolor="yellow" ID="Table1">
                <tr>
                    <td><img src="../img/layout/x.gif"></td>
                </tr>
            </table>

        </td>
        <!--#### STATO EXECUTION-->
        <td width="<?php echo isset($widthST3)?$widthST3:0;?>">

            <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" ID="Table17">
                <tr>
                    <td width="23%">
                        &nbsp;
                    </td>
                    <td width="22%">
                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" ID="Table18">
                            <tr>
                                <td valign="middle" align="center" >&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" >
                                    <table width="36" height="40" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">CAUSE</font></td></tr>
                                    </table>
                                    <br>
                                    <table width="36" height="40" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">EPC</font></td></tr>
                                    </table>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="center" height="140">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="center" height="90">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" height="50">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0">
                                        <tr><td valign="middle" align="center"></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="20%">
                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" ID="Table19">
                            <tr>
                                <td valign="middle" align="center" >
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="center" height="140">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="center" height="90">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="bottom" align="center" height="50">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td width="30%">
                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" ID="Table20">
                            <tr>
                                <td valign="middle" align="center" height="300">
                                    <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="center" height="100">
                                    <table width="50" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center"><font size="1"><b>ALU</b></font></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="center" >
                                    <table width="40" height="60" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                                        <tr><td valign="middle" align="center">
                                                <font size="1">ALU<br>CONTROL<br>UNIT</font></td></tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="5%">&nbsp;</td>
                </tr>
            </table>
        </td>
        <!--#### EX/MEM REGISTRI-->
        <td width="45" valign="bottom" align="center">

            <font size="1">EX/MEM</font>
            <table width="100%" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif">
                <tr>
                    <td valign="middle" align="center">
                        <font size="1">WB
                        </font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#666666"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
            </table>
            <table width="100%" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_EX_MEM.gif">
                <tr>
                    <td valign="middle" align="center">
                        <font size="1">M
                        </font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#666666"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
            </table>
            <table width="100%" height="300" cellpadding="0" cellspacing="0" border="0" bgcolor="blue" ID="Table2">
                <tr>
                    <td><img src="../img/layout/x.gif"></td>
                </tr>
            </table>

        </td>
        <!--#### STATO MEMORY-->
        <td width="<?php echo isset($widthST4)?$widthST4:0;?>">

            <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" ID="Table22">
                <tr>
                    <td align="right" valign="middle">
                        <br><br><br><br><br><br><br><br><br><br><br>
                        <table width="60" height="150" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>">
                            <tr><td valign="top" align="center">
                                    <font size="1"><br>DATA<br>MEMORY<br>
                                        <br><br><br>
                                        <div align="left">ADDRESS</div>
                                        <br><br>
                                        <div align="right">DATA VALUE</div>
                                        <br>
                                        <div align="left">WRITTEN VALUE</div>
                                    </font>
                                </td></tr>
                        </table>

                    </td>
                    <td width="20"><img src="../img/layout/x.gif"></td>
                </tr>
            </table>

        </td>
        <!--#### MEM/WB REGISTRI-->
        <td width="45" valign="bottom" align="center">

            <font size="1">MEM/WB</font>
            <table width="100%" height="35" cellpadding="0" cellspacing="0" border="0" background="../img/layout/bg_MEM_WB.gif">
                <tr>
                    <td valign="middle" align="center">
                        <font size="1">WB
                        </font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#666666"><img src="../img/layout/x.gif" width="1" height="1"></td></tr>
            </table>
            <table width="100%" height="300" cellpadding="0" cellspacing="0" border="0" bgcolor="green" ID="Table3">
                <tr>
                    <td><img src="../img/layout/x.gif"></td>
                </tr>
            </table>

        </td>
        <!--#### STATO WB-->
        <td width="<?php echo isset($widthST5)?$widthST5:0;?>">

            <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" ID="Table23">
                <tr>
                    <td align="right" valign="middle">
                        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        <table width="30" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table24">
                            <tr><td valign="middle" align="center"><font size="1">M<br>U<br>X</font></td></tr>
                        </table>

                    </td>
                    <td width="20"><img src="../img/layout/x.gif"></td>
                </tr>
            </table>

        </td>
    </tr>
</table>
<table width="1036" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="600"><img src="../img/layout/x.gif"></td>
        <td width="150" align="center" valign="middle">
            <table width="80" height="50" cellpadding="0" cellspacing="0" class="<?php echo isset($classElemento)?$classElemento:0;?>" ID="Table21">
                <tr><td valign="middle" align="center">
                        <font size="1">FORWARDING UNIT<br></font>
                    </td></tr>
            </table>
        </td>
        <td><img src="../img/layout/x.gif"></td>
    </tr>
</table>
<!--#### SEGNALI DI DATI-->

<?php
if ($_SESSION['segDati']!="")
{
    ?>
    <div id="Div2" style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:1">
        <img src="../img/content/segnali_Dati.gif">
    </div>
<?php } ?>
<!--#### SEGNALI DI CONTROLLO-->
<?php if ($_SESSION['segCtrl']!="")
{
    ?>
    <div id="Div1" style="position:absolute; left:0px; top:2px; width:1px; height:1px; z-index:1">
        <img src="../img/content/segnali_Controllo.gif">
    </div>
<?php } ?>

<!--#### LINK AGLI ELEMENTI-->
<div id="Div3" style="position:absolute; left:78px; top:315px; width:60px; height:150px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=Istruzioni&PC=<?php echo isset($PC)?$PC:0;?>&istr=<?php echo isset($temp_Istruzione)?$temp_Istruzione:0;?>','','width=450 height=330');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION MEMORY">
    </a>
</div>

<div id="Div4" style="position:absolute; left:83px; top:225px; width:50px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=IF_som&newPC=<?php echo isset($PC)?$PC:0;?>&PCpiu4=<?php echo isset($temp_IF_ID_PCpiu4)?$temp_IF_ID_PCpiu4:0;?>','','width=300 height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ADDER 1">
    </a>
</div>

<div id="Div5" style="position:absolute; left:93px; top:119px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=if_mux&newPC=<?php echo isset($newPC)?$newPC:0;?>&PCpiu4=<?php echo isset($newPC2)?$newPC2:0;?>&salto=<?php echo isset($newPC1)?$newPC1:0;?>&ctrl1=<?php echo isset($PCsrc)?(int)$PCsrc:0;?>&ctrl2=<?php echo 0;?>','','width=380 height=300');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION FETCH MULTIPLEXER">
    </a>
</div>

<div id="Div6" style="position:absolute; left:88px; top:28px; width:40px; height:40px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=and&ctrl1=<?php echo isset($branchCheck)?(int)$branchCheck:0;?>&ctrl2=<?php echo isset($branch)?(int)$branch:0;?>&ris=<?php echo isset($PCsrc)?(int)$PCsrc:0;?>','','width=300 height=270');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="LOGIC AND - Output = <?php echo isset($PCsrc)?(int)$PCsrc:0;?>">
    </a>
</div>

<div id="Div7" style="position:absolute; left:25px; top:365px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=PC&newPC=<?php echo isset($temp_PC)?$temp_PC:0;?>&PC=<?php echo isset($PC)?$PC:0;?>&ctrl=<?php echo isset($stallo)?(int)$stallo:0;?>','','width=300 height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="PROGRAM COUNTER = <?php echo isset($PC)?$PC:0;?>">
    </a>
</div>

<div id="Div8" style="position:absolute; left:229px; top:25px; width:80px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=criticita&rl1=<?php echo isset($RL1)?$RL1:0;?>&rl2=<?php echo isset($RL2)?$RL2:0;?>&stallo=<?php echo isset($stallo)?(int)$stallo:0;?>&mem=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>&rd=<?php echo isset($ID_EX_RD)?$ID_EX_RD:0;?>','','width=400 height=270');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="HAZARD DETECTION UNIT">
    </a>
</div>

<div id="Div9" style="position:absolute; left:222px; top:87px; width:56px; height:100px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=controllo&istr=<?php echo isset($istruzione)?$istruzione:0;?>&salta=<?php echo isset($branch)?(int)$branch:0;?>&ecc=<?php echo 0;?>&wb=<?php echo isset($ctrl_WB)?$ctrl_WB:0;?>&mem=<?php echo isset($ctrl_M)?$ctrl_M:0;?>&ex=<?php echo isset($ctrl_EX)?$ctrl_EX:0;?>&if_scarta=<?php echo isset($IF_scarta)?$IF_scarta:0;?>&id_scarta=<?php echo isset($ID_scarta)?$ID_scarta:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=450 height=270');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="CONTROL UNIT">
    </a>
</div>

<div id="Div12" style="position:absolute; left:400px; top:130px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idmux&ctrl=<?php echo isset($stallo)?(int)$stallo:0;?>&wb=<?php echo isset($ctrl_WB)?$ctrl_WB:0;?>&mem=<?php echo isset($ctrl_M)?$ctrl_M:0;?>&ex=<?php echo isset($ctrl_EX)?$ctrl_EX:0;?>&wb2=<?php echo isset($ctrl_WB)?$ctrl_WB:0;?>&mem2=<?php echo isset($ctrl_M)?$ctrl_M:0;?>&ex2=<?php echo isset($ctrl_EX)?$ctrl_EX:0;?>','','width=300 height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="INSTRUCTION DECODE MULTIPLEXER">
    </a>
</div>

<div id="Div13" style="position:absolute; left:400px; top:35px; width:40px; height:40px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=or&stallo=<?php echo isset($stallo)?(int)$stallo:0;?>&id_scarta=<?php echo isset($ID_scarta)?$ID_scarta:0;?>','','width=300 height=280');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="LOGIC OR">
    </a>
</div>

<div id="Div14" style="position:absolute; left:309px; top:265px; width:90px; height:150px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=registri&DL1=<?php echo isset($temp_ID_EX_Data1)?$temp_ID_EX_Data1:0;?>&DL2=<?php echo isset($temp_ID_EX_Data2)?$temp_ID_EX_Data2:0;?>&RL1=<?php echo isset($RL1)?$RL1:0;?>&RL2=<?php echo isset($RL2)?$RL2:0;?>&RW=<?php echo isset($MEM_WB_RegW)?$MEM_WB_RegW:0;?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>&RegWrite=<?php echo substr($MEM_WB_WB,0,1);?>','','width=380 height=350');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="32 REGISTERS (32-BIT)">
    </a>
</div>

<div id="Div15" style="position:absolute; left:411px; top:315px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=uguale&DL1=<?php echo isset($temp_ID_EX_Data1)?$temp_ID_EX_Data1:0;?>&DL2=<?php echo isset($temp_ID_EX_Data2)?$temp_ID_EX_Data2:0;?>&ris=<?php echo isset($branchCheck)?"true":"false";?>&isBranch=<?php echo isset($isBranch)?(int)$isBranch:0;?>&isJal=<?php echo isset($isJal)?(int)$isJal:0;?>&isJalr=<?php echo isset($isJalr)?(int)$isJalr:0;?>','','width=300 height=260');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="=">
    </a>
</div>

<div id="Div16" style="position:absolute; left:246px; top:434px; width:63px; height:25px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=segno&dato=<?php echo $istruzione;?>&esteso=<?php echo isset($temp_ID_EX_imm)?(($temp_ID_EX_imm==0)?str_repeat('0',64):$temp_ID_EX_imm):str_repeat('0',64);?>','','width=400 height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="IMMEDIATE GENERATOR 32 TO 64 BITS">
    </a>
</div>

<div id="Div17" style="position:absolute; left:557px; top:107px; width:36px; height:40px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=cause','','width=300 height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="CAUSE">
    </a>
</div>

<div id="Div18" style="position:absolute; left:557px; top:165px; width:36px; height:40px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=epc','','width=300 height=200');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EPC">
    </a>
</div>

<div id="Div19" style="position:absolute; left:560px; top:270px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ExMux3&DL1=<?php echo isset($ID_EX_Data1)?$ID_EX_Data1:0;?>&mem_wb=<?php echo isset($WBdata)?$WBdata:0;?>&ex_mem=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo isset($Mux3Ctrl)?$Mux3Ctrl:0;?>&ris=<?php echo isset($ALUdato1)?$ALUdato1:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 3">
    </a>
</div>

<div id="Div20" style="position:absolute; left:560px; top:385px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ExMux4&DL1=<?php echo isset($ID_EX_Data2)?$ID_EX_Data2:0;?>&mem_wb=<?php echo isset($WBdata)?$WBdata:0;?>&ex_mem=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&ctrl=<?php echo isset($Mux4Ctrl)?$Mux4Ctrl:0;?>&ris=<?php echo isset($temp_EX_MEM_DataW)?$temp_EX_MEM_DataW:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 4">
    </a>
</div>

<div id="Div22" style="position:absolute; left:611px; top:90px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ExMux1&dato=<?php echo isset($ID_EX_WB)?$ID_EX_WB:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 1">
    </a>
</div>

<div id="Div24" style="position:absolute; left:611px; top:385px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ExMux5&op1=<?php echo isset($temp_EX_MEM_DataW)?$temp_EX_MEM_DataW:0;?>&op2=<?php echo isset($ID_EX_imm2)?$ID_EX_imm2:0;?>&ris=<?php echo isset($ALUdato2)?$ALUdato2:0;?>&ctrl=<?php echo isset($Mux5Ctrl)?$Mux5Ctrl:0;?>','','width=380 height=240');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 5">
    </a>
</div>

<div id="Div25" style="position:absolute; left:672px; top:130px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ExMux2&dato=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>&ex_scarta=<?php echo isset($EX_scarta)?$EX_scarta:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EXECUTE MULTIPLEXER 2">
    </a>
</div>

<div id="Div26" style="position:absolute; left:662px; top:330px; width:50px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=alu&valore1=<?php echo isset($ALUdato1)?$ALUdato1:0;?>&valore2=<?php echo isset($ALUdato2)?$ALUdato2:0;?>&ris=<?php echo isset($temp_EX_MEM_RIS)?$temp_EX_MEM_RIS:0;?>&ctrl=<?php echo isset($aluCtrl)?$aluCtrl:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ARITHMETIC LOGIC UNIT">
    </a>
</div>

<div id="Div27" style="position:absolute; left:667px; top:424px; width:40px; height:62px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=controlloALU&funct=<?php echo isset($ID_EX_funct7)?(isset($ID_EX_funct3)?GMPToBin($ID_EX_funct7,7,1)[1].GMPToBin($ID_EX_funct3,3,1):0):0;?>&aluOp=<?php echo isset($AluOP)?$AluOP:0;?>&ris=<?php echo isset($temp_EX_MEM_RIS)?$temp_EX_MEM_RIS:0;?>&ctrl=<?php echo isset($aluCtrl)?$aluCtrl:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ALU CONTROL UNIT">
    </a>
</div>

<div id="Div28" style="position:absolute; left:640px; top:505px; width:80px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=propagazione&rs1=<?php echo isset($ID_EX_RS1)?$ID_EX_RS1:0;?>&rs2=<?php echo isset($ID_EX_RS2)?$ID_EX_RS2:0;?>&mux1=<?php echo isset($Mux4Ctrl)?$Mux4Ctrl:0;?>&mux2=<?php echo isset($Mux3Ctrl)?$Mux3Ctrl:0;?>&regW1=<?php echo isset($EX_MEM_RegW)?$EX_MEM_RegW:0;?>&regW2=<?php echo isset($MEM_WB_RegW)?$MEM_WB_RegW:0;?>&mem1=<?php echo substr($EX_MEM_WB,0,1);?>&mem2=<?php echo substr($MEM_WB_WB,0,1);?>','','width=450 height=350');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="FORWARDING UNIT">
    </a>
</div>

<div id="Div29" style="position:absolute; left:825px; top:274px; width:60px; height:170px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memdati&memW=<?php echo substr($EX_MEM_WB,strlen($EX_MEM_WB)-(1));?>&memR=<?php echo substr($EX_MEM_WB,0,1);?>&ind=<?php echo isset($EX_MEM_RIS)?$EX_MEM_RIS:0;?>&DS=<?php echo isset($EX_MEM_DataW)?$EX_MEM_DataW:0;?>&DL=<?php echo isset($temp_MEM_WB_DataR)?$temp_MEM_WB_DataR:0;?>','','width=350 height=400');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="DATA MEMORY">
    </a>
</div>

<div id="Div30" style="position:absolute; left:991px; top:382px; width:30px; height:50px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=wbmux&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1));?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="WRITE BACK MULTIPLEXER">
    </a>
</div>

<!--#### REGISTRI DELLA PIPELINE-->


<div id="Div10" style="position:absolute; left:152px; top:205px; width:40px; height:300px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=ifid&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1));?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="IF/ID LATCHES">
    </a>
</div>

<div id="Div11" style="position:absolute; left:453px; top:205px; width:40px; height:300px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idex&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1));?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX LATCHES">
    </a>
</div>

<div id="Div23" style="position:absolute; left:738px; top:205px; width:40px; height:300px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmem&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1));?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM LATCHES">
    </a>
</div>

<div id="Div31" style="position:absolute; left:908px; top:205px; width:40px; height:300px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memwb&DL=<?php echo isset($MEM_WB_DataR)?$MEM_WB_DataR:0;?>&DC=<?php echo isset($MEM_WB_Data)?$MEM_WB_Data:0;?>&ctrl=<?php echo substr($MEM_WB_WB,strlen($MEM_WB_WB)-(1));?>&WBdata=<?php echo isset($WBdata)?$WBdata:0;?>','','width=350 height=250');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="MEM/WB LATCHES">
    </a>
</div>

<div id="Div32" style="position:absolute; left:452px; top:100px; width:41px; height:33px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexwb&dataIn=<?php echo isset($temp_ID_EX_WB)?$temp_ID_EX_WB:0;?>&dataOut=<?php echo isset($ID_EX_WB)?$ID_EX_WB:0;?>','','width=290 height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.WB Register">
    </a>
</div>

<div id="Div33" style="position:absolute; left:452px; top:135px; width:41px; height:33px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexmem&dataIn=<?php echo isset($temp_ID_EX_M)?$temp_ID_EX_M:0;?>&dataOut=<?php echo isset($ID_EX_M)?$ID_EX_M:0;?>','','width=290 height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.MEM Register">
    </a>
</div>

<div id="Div34" style="position:absolute; left:452px; top:170px; width:41px; height:33px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=idexex&dataIn=<?php echo isset($temp_ID_EX_EX)?$temp_ID_EX_EX:0;?>&dataOut=<?php echo isset($ID_EX_EX)?$ID_EX_EX:0;?>','','width=290 height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="ID/EX.EX Register">
    </a>
</div>

<div id="Div35" style="position:absolute; left:737px; top:135; width:43px; height:32px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmemwb&dataIn=<?php echo isset($temp_EX_MEM_WB)?$temp_EX_MEM_WB:0;?>&dataOut=<?php echo isset($EX_MEM_WB)?$EX_MEM_WB:0;?>','','width=290 height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM.WB Register">
    </a>
</div>

<div id="Div36" style="position:absolute; left:737px; top:170; width:43px; height:32px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=exmemmem&dataIn=<?php echo isset($temp_EX_MEM_M)?$temp_EX_MEM_M:0;?>&dataOut=<?php echo isset($EX_MEM_M)?$EX_MEM_M:0;?>','','width=290 height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="EX/MEM.MEM REgister">
    </a>
</div>

<div id="Div37" style="position:absolute; left:906px; top:170; width:43px; height:32px; z-index:1">
    <a href="javascript:void(0);" onclick="javascript:window.open('elements.php?el=memwbwb&dataIn=<?php echo isset($temp_MEM_WB_WB)?$temp_MEM_WB_WB:0;?>&dataOut=<?php echo isset($MEM_WB_WB)?$MEM_WB_WB:0;?>','','width=290 height=190');">
    <img src="../img/layout/x.gif" width="100%" height="100%" border="0" alt="MEM/WB.WB Register">
    </a>
</div>

</body>
</html>

