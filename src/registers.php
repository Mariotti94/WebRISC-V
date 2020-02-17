<?php
require_once 'functions.php';
$height=3;
$registri=$_SESSION['data'][$_SESSION['index']]['registri'];
?>
<br>
<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro">
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
    <td width="10%" align="center" bgcolor="#333333" class="indice">0</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">x0</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[0];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[0],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">1</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">ra</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[1];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[1],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">2</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">sp</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[2];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[2],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">3</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">gp</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[3];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[3],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">4</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">tp</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[4];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[4],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">5</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t0</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[5];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[5],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">6</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t1</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[6];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[6],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">7</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t2</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[7];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[7],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">8</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s0/fp</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[8];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[8],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">9</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s1</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[9];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[9],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">10</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a0</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[10];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[10],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">11</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a1</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[11];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[11],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">12</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a2</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[12];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[12],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">13</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a3</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[13];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[13],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">14</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a4</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[14];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[14],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">15</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a5</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[15];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[15],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">16</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a6</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[16];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[16],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">17</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">a7</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[17];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[17],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">18</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s2</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[18];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[18],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">19</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s3</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[19];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[19],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">20</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s4</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[20];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[20],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">21</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s5</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[21];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[21],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">22</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s6</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[22];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[22],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">23</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s7</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[23];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[23],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">24</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s8</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[24];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[24],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">25</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s9</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[25];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[25],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">26</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s10</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[26];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[26],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">27</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">s11</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[27];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[27],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">28</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t3</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[28];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[28],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">29</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t4</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[29];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[29],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">30</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t5</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[30];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[30],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#333333" class="indice">31</td>
    <td width="10%" align="center" bgcolor="#333333" class="indice">t6</td>
    <td width="20%" align="center" style="word-break: break-all;" bgcolor="white"><?php echo $registri[31];?></td>
    <td width="55%" align="center" bgcolor="white">
      <?php
      $temp=GMPToBin($registri[31],64,0);
      echo substr($temp,0,32)."<br>".substr($temp,32,32);
      ?>
    </td>
  </tr>
</table>

