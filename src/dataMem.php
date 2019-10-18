<?php
require "functions.php";
if (!isset($height))
    $height = 0;
?>
<form action="leftPanel.php?dst=dati&tipo=parola" method="post">
    <table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" >
        <tr><td class="registro" align="center" width="70%" bgcolor="white">
                Display the dword at address
                <select name="parola" class="form">
                    <?php
                    $MemIndex=0;
                    while($MemIndex<=4992)
                    {
                        ?>
                        <option value="<?php   echo $MemIndex;?>"><?php   echo $MemIndex;?></option>
                        <?php
                        $MemIndex=$MemIndex+8;
                    }
                    ?>
                </select>
            </td>
            <td align="center">
                <input type="submit" name="submit" value="GO!" class="form">
            </td></tr>
</form>

<form action="leftPanel.php?dst=dati&tipo=serie" method="post" ID="Form1">
    <table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" >
        <tr><td class="registro" align="center" width="70%" bgcolor="white">
                Display the dwords between<br>
                address
                <select name="parola1" class="form" ID="Select1">
                    <?php
                    $MemIndex=0;
                    while($MemIndex<=4992)
                    {

                        ?>
                        <option value="<?php   echo $MemIndex;?>"><?php   echo $MemIndex;?></option>
                        <?php
                        $MemIndex=$MemIndex+8;
                    }
                    ?>
                </select>
                and
                <select name="parola2" class="form" ID="Select2">
                    <?php
                    $MemIndex=0;
                    while($MemIndex<=4992)
                    {   ?>
                        <option value="<?php   echo $MemIndex;?>"><?php   echo $MemIndex;?></option>
                        <?php
                        $MemIndex=$MemIndex+8;
                    }
                    ?>
                </select>
            </td>
            <td align="center">
                <input type="submit" name="submit" value="GO!" class="form" ID="Submit1">
            </td></tr>
</form>

<form action="leftPanel.php?dst=dati&tipo=tutto" method="post" ID="Form2">
    <table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" >
        <tr><td class="registro" align="center" width="70%" bgcolor="white">
                Display ALL Memory
            </td>
            <td align="center">
                <input type="submit" name="submit" value="GO!" class="form" ID="Submit2">
            </td></tr>
</form>

<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" >
    <tr>
		<td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(dword)</td>
        <td width="40" align="center" style="border:1px solid #666666">Dec. Val.<br>(word)</td>
        <td width="50" align="center" style="border:1px solid #666666">Byte 3<br>(dec.val.)</td>
        <td width="50" align="center" style="border:1px solid #666666">Byte 2<br>(dec.val.)</td>
        <td width="50" align="center" style="border:1px solid #666666">Byte 1<br>(dec.val.)</td>
        <td width="50" align="center" style="border:1px solid #666666">Byte 0<br>(dec.val.)</td>
		<td width="30" align="center" style="border:1px solid #666666">Addr.</td>
    </tr>
        <td colspan="4"><img src="../img/layout/x.gif" height="<?php echo $height;?>"></td>
    </tr>

    <?php
    $MemDati=$_SESSION['MemDati'];
    $tipo=isset($_GET["tipo"])?$_GET["tipo"]:"";
    switch ($tipo)
    {
		case "tutto":
			//var_dump(array_slice($MemDati,-100));
			$MemIndex=0;
            while($MemIndex<=4992)
            {				
                ?>
				
				<tr>
					<td rowspan="3" width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+7].$MemDati[$MemIndex+6].$MemDati[$MemIndex+5].$MemDati[$MemIndex+4].$MemDati[$MemIndex+3].$MemDati[$MemIndex+2].$MemDati[$MemIndex+1].$MemDati[$MemIndex],0); ?></td>
                    <td width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+3].$MemDati[$MemIndex+2].$MemDati[$MemIndex+1].$MemDati[$MemIndex],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+3]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+3],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+2]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+2],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+1]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+1],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php       echo $MemIndex; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><img src="../img/layout/x.gif" height="<?php       echo $height; ?>"></td>
                </tr>
                <tr>
                    <td width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+7].$MemDati[$MemIndex+6].$MemDati[$MemIndex+5].$MemDati[$MemIndex+4],0); ?></td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+7]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+7],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+6]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+6],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+5]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+5],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+4]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+4],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php       echo $MemIndex+4; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><img src="../img/layout/x.gif" height="<?php       echo $height; ?>"></td>
                </tr>
				
                <?php
                $MemIndex=$MemIndex+8;
            }
            break;       
			
        case "parola":
			$MemIndex=$_POST["parola"];
            $MemIndex2=$MemIndex;
            $MemIndex=intval($MemIndex);
            $MemIndex2=intval($MemIndex2)+8;

            while($MemIndex<$MemIndex2)
            {
				?>
				<tr>
					<td rowspan="3" width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+7].$MemDati[$MemIndex+6].$MemDati[$MemIndex+5].$MemDati[$MemIndex+4].$MemDati[$MemIndex+3].$MemDati[$MemIndex+2].$MemDati[$MemIndex+1].$MemDati[$MemIndex],0); ?></td>
					<td width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+3].$MemDati[$MemIndex+2].$MemDati[$MemIndex+1].$MemDati[$MemIndex],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+3]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+3],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+2]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+2],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+1]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+1],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php       echo $MemIndex; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php       echo $height; ?>"></td>
				</tr>
				<tr>
					<td width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+7].$MemDati[$MemIndex+6].$MemDati[$MemIndex+5].$MemDati[$MemIndex+4],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+7]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+7],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+6]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+6],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+5]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+5],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+4]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+4],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php       echo $MemIndex+4; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php       echo $height; ?>"></td>
				</tr>

				<?php
				$MemIndex=$MemIndex+8;
			}
            break;
			
        case "serie":
            $MemIndex=$_POST["parola1"];
            $MemIndex2=$_POST["parola2"];
            $MemIndex=intval($MemIndex);
            $MemIndex2=intval($MemIndex2)+8;

            if ($MemIndex>$MemIndex2)
            {
                print "<br><br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
                exit();
            }

            while($MemIndex<$MemIndex2)
            {
				?>
				<tr>
					<td rowspan="3" width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+7].$MemDati[$MemIndex+6].$MemDati[$MemIndex+5].$MemDati[$MemIndex+4].$MemDati[$MemIndex+3].$MemDati[$MemIndex+2].$MemDati[$MemIndex+1].$MemDati[$MemIndex],0); ?></td>
					<td width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+3].$MemDati[$MemIndex+2].$MemDati[$MemIndex+1].$MemDati[$MemIndex],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+3]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+3],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+2]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+2],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+1]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+1],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php       echo $MemIndex; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php       echo $height; ?>"></td>
				</tr>
				<tr>
					<td width="40" style="word-break: break-word;" align="center" bgcolor="white"><?php       echo BinToGMP($MemDati[$MemIndex+7].$MemDati[$MemIndex+6].$MemDati[$MemIndex+5].$MemDati[$MemIndex+4],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+7]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+7],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+6]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+6],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+5]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+5],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php       echo $MemDati[$MemIndex+4]; ?><br>( <?php       echo BinToGMP($MemDati[$MemIndex+4],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php       echo $MemIndex+4; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php       echo $height; ?>"></td>
				</tr>

				<?php
				$MemIndex=$MemIndex+8;
			}
            break;
    }
    ?>

</table>

