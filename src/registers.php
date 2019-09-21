<?php
require "functions.php";
$height=3;
$registri=$_SESSION['registri'];
$HILO=$_SESSION['HILO'];
?>
<br>
<br>
<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" style="table-layout: fixed;">
    <tr>
        <td width="10%" align="center" style="border:1px solid #666666">R.No.</td>
        <td width="10%" align="center" style="border:1px solid #666666">Reg.Id.</td>
        <td width="20%" align="center" style="border:1px solid #666666">Dec.Val</td>
        <td width="55%" align="center" style="border:1px solid #666666">Binary Value (64 bit)</td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">0</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">x0</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[0];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[0],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">1</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">ra</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[1];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[1],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">2</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">sp</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[2];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[2],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">3</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">gp</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[3];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[3],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">4</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">tp</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[4];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[4],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">5</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t0</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[5];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[5],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">6</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t1</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[6];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[6],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">7</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t2</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[7];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[7],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">8</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s0/fp</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[8];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[8],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">9</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s1</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[9];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[9],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">10</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a0</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[10];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[10],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">11</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a1</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[11];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[11],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">12</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a2</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[12];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[12],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">13</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a3</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[13];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[13],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">14</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a4</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[14];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[14],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">15</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a5</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[15];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[10],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">16</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a6</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[16];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[16],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">17</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">a7</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[17];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[17],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">18</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s2</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[18];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[18],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">19</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s3</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[19];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[19],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">20</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s4</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[20];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[20],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">21</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s5</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[21];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[21],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">22</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s6</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[22];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[22],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">23</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s7</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[23];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[23],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">24</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s8</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[24];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[24],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">25</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s9</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[25];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[25],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">26</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s10</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[26];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[26],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">27</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">s11</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[27];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[27],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">28</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t3</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[28];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[28],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">29</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t4</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[29];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[29],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">30</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t5</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[30];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[20],64,0);?></td>
    </tr>
    <tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>
    <tr>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">31</td>
        <td width="10%" align="center" bgcolor="#333333" class="numRiga">t6</td>
        <td width="20%" align="center" bgcolor="white"><?php echo $registri[31];?></td>
        <td width="55%" style="word-wrap:break-word; white-space: normal;" align="center" bgcolor="white"><?php echo IntToBin($registri[31],64,0);?></td>
    </tr>
</table>

