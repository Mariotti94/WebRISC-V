<?php
require_once 'functions.php';
if (!isset($height))
    $height = 0;
?>
<br>
<form action="leftPanel.php?dst=dati&tipo=parola" method="post">
    <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
        <tr><td class="registro" align="center" width="100%" bgcolor="white">
                Display the dword at address
                <select name="parola" class="form">
                    <?php
                    $memIndex=0;
                    while($memIndex<=($_SESSION['maxMem']-8))
                    {
                        ?>
                        <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
                        <?php
                        $memIndex=$memIndex+8;
                    }
                    ?>
                </select>
            </td>
            <td align="left">
                <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
            </td></tr>
</form>

<form action="leftPanel.php?dst=dati&tipo=serie" method="post">
    <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 35px;">
        <tr><td class="registro" align="center" width="100%" bgcolor="white">
                Display the dwords between<br>
                address
                <select name="parola1" class="form">
                    <?php
                    $memIndex=0;
                    while($memIndex<=($_SESSION['maxMem']-8))
                    {

                        ?>
                        <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
                        <?php
                        $memIndex=$memIndex+8;
                    }
                    ?>
                </select>
                and
                <select name="parola2" class="form">
                    <?php
                    $memIndex=0;
                    while($memIndex<=($_SESSION['maxMem']-8))
                    {   ?>
                        <option value="<?php echo $memIndex;?>"><?php echo $memIndex;?></option>
                        <?php
                        $memIndex=$memIndex+8;
                    }
                    ?>
                </select>
            </td>
            <td align="left">
                <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
            </td></tr>
</form>

<form action="leftPanel.php?dst=dati&tipo=tutto" method="post">
    <table cellpadding="0" cellspacing="2" border="0" width="90%" align="center" class="registro" style="height: 22px;">
        <tr><td class="registro" align="center" width="100%" bgcolor="white">
                Display ALL Memory
            </td>
            <td align="left">
                <input type="submit" name="submit" value="GO!" class="form" style="height: 100%;">
            </td></tr>
</form>

<table cellpadding="0" cellspacing="2" border="0" width="100%" class="registro" style="margin-top: 5px;">
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
    $memDati=$_SESSION['data'][$_SESSION['index']]['memDati'];
    $tipo=isset($_GET["tipo"])?$_GET["tipo"]:"";
    switch ($tipo)
    {
		case "tutto":
			
			$memIndex=0;
            while($memIndex<=($_SESSION['maxMem']-8))
            {				
                ?>
				
				<tr>
					<td rowspan="3" width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+7].$memDati[$memIndex+6].$memDati[$memIndex+5].$memDati[$memIndex+4].$memDati[$memIndex+3].$memDati[$memIndex+2].$memDati[$memIndex+1].$memDati[$memIndex],0); ?></td>
                    <td width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+3].$memDati[$memIndex+2].$memDati[$memIndex+1].$memDati[$memIndex],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+3]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+3],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+2]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+2],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+1]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+1],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex]; ?><br>( <?php echo BinToGMP($memDati[$memIndex],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php echo $memIndex; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><img src="../img/layout/x.gif" height="<?php echo $height; ?>"></td>
                </tr>
                <tr>
                    <td width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+7].$memDati[$memIndex+6].$memDati[$memIndex+5].$memDati[$memIndex+4],0); ?></td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+7]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+7],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+6]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+6],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+5]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+5],0); ?> )</td>
                    <td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+4]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+4],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php echo $memIndex+4; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><img src="../img/layout/x.gif" height="<?php echo $height; ?>"></td>
                </tr>
				
                <?php
                $memIndex=$memIndex+8;
            }
            break;       
			
        case "parola":
			$memIndex=$_POST["parola"];
            $memIndex2=$memIndex;
            $memIndex=intval($memIndex);
            $memIndex2=intval($memIndex2)+8;

            while($memIndex<$memIndex2)
            {
				?>
				<tr>
					<td rowspan="3" width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+7].$memDati[$memIndex+6].$memDati[$memIndex+5].$memDati[$memIndex+4].$memDati[$memIndex+3].$memDati[$memIndex+2].$memDati[$memIndex+1].$memDati[$memIndex],0); ?></td>
					<td width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+3].$memDati[$memIndex+2].$memDati[$memIndex+1].$memDati[$memIndex],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+3]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+3],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+2]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+2],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+1]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+1],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex]; ?><br>( <?php echo BinToGMP($memDati[$memIndex],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php echo $memIndex; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php echo $height; ?>"></td>
				</tr>
				<tr>
					<td width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+7].$memDati[$memIndex+6].$memDati[$memIndex+5].$memDati[$memIndex+4],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+7]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+7],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+6]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+6],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+5]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+5],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+4]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+4],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php echo $memIndex+4; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php echo $height; ?>"></td>
				</tr>

				<?php
				$memIndex=$memIndex+8;
			}
            break;
			
        case "serie":
            $memIndex=$_POST["parola1"];
            $memIndex2=$_POST["parola2"];
            $memIndex=intval($memIndex);
            $memIndex2=intval($memIndex2)+8;

            if ($memIndex>$memIndex2)
            {
                print "<br><br><div align=center><b>ERROR SELECTING ADDRESS INDEXES</b></div>";
                exit();
            }

            while($memIndex<$memIndex2)
            {
				?>
				<tr>
					<td rowspan="3" width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+7].$memDati[$memIndex+6].$memDati[$memIndex+5].$memDati[$memIndex+4].$memDati[$memIndex+3].$memDati[$memIndex+2].$memDati[$memIndex+1].$memDati[$memIndex],0); ?></td>
					<td width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+3].$memDati[$memIndex+2].$memDati[$memIndex+1].$memDati[$memIndex],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+3]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+3],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+2]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+2],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+1]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+1],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex]; ?><br>( <?php echo BinToGMP($memDati[$memIndex],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php echo $memIndex; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php echo $height; ?>"></td>
				</tr>
				<tr>
					<td width="40" style="word-break: break-all;" align="center" bgcolor="white"><?php echo BinToGMP($memDati[$memIndex+7].$memDati[$memIndex+6].$memDati[$memIndex+5].$memDati[$memIndex+4],0); ?></td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+7]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+7],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+6]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+6],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+5]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+5],0); ?> )</td>
					<td width="50" align="center" bgcolor="white"><?php echo $memDati[$memIndex+4]; ?><br>( <?php echo BinToGMP($memDati[$memIndex+4],0); ?> )</td>
					<td width="30" align="center" bgcolor="#333333" class="numRiga"><?php echo $memIndex+4; ?></td>
				</tr>
				<tr>
					<td colspan="6"><img src="../img/layout/x.gif" height="<?php echo $height; ?>"></td>
				</tr>

				<?php
				$memIndex=$memIndex+8;
			}
            break;
    }
    ?>

</table>

