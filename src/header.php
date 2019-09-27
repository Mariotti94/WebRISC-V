<?php
session_start();
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <script language="JavaScript" type="text/JavaScript">
        function toggleHover() {
            if(top.frames[0].document.getElementById('toggleHover').checked)	{
                top.frames[2].popup_set();
            }
            else {
                top.frames[2].popup_unset();
            }
        }
		
		function stepSwitchOff() {
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].textContent="Cannot Step Back";
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].setAttribute('class','link4disabled');
		}
		
		function stepSwitchOn() {
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].textContent="Step Back";
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].setAttribute('class','link4');
		}
    </script>
	<meta name="robots" content="noindex" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
    <tr>
        <td width="137" valign="top" bgcolor="#f7b217">
		<a href="../index.php" target="_parent"><img src="../img/content/img_logo.gif" border="0" width="137"></a>
		<font face="Arial" size=1><br><b>VERSION <?php echo $_SESSION['version'];?></b>: Write your feedback to <a HREF="mailto:giorgi@unisi.it">Roberto Giorgi</a>.</font>
		</td>
        <td width="50%" align="left">
            <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
                <tr><td align="left" background="../img/layout/bg_header.gif" height="13">
                        <font size=2>COMMANDS:</font>
                    </td></tr>
                <tr>
					<td align="center" valign="middle" bgcolor="#EBEBEB" height="68" style="border:2px solid #CCCCCC">
                        <table cellpadding="0" width="100%" cellspacing="0" border="0">
                            <tr>
                                <td align="center" width="50%">
                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                                        <tr>
                                            <td align="center"><a href="executeAll.php" target="Body" class="link4">Execute ALL</a></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" border="0"ID="Table5">
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" ID="Table2">
                                        <tr>
                                            <td align="center"><a href="executeStep.php" target="Body" class="link4" onclick="javascript:stepSwitchOn()">Step Forward</a></td>
                                        </tr>
                                    </table>
									
									<table cellpadding="0" cellspacing="0" border="0"ID="Table5">
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" ID="backButton">
                                        <tr>
                                            <td align="center"><a href="executeStep.php?agg=back" target="Body" class="link4" onclick="javascript:stepSwitchOff()">Step Back</a></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center" width="50%">
                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" ID="Table3">
                                        <tr>
                                            <td align="center">
                                                <a href="editor.php" target="Body" class="link4">Load/Reload Program</a></td>
                                        </tr>
                                    </table>
									
									<table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                                        <tr>
                                            <td align="center"><a href="executeStep.php?agg=new" target="_blank" class="link4">Layout in New Window</a></td>
                                        </tr>
                                    </table>
									
                                    <table cellpadding="0" cellspacing="0" border="0"ID="Table6">
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" ID="Table4">
                                        <tr>
                                            <td align="center"><a href="../index.php" target="_parent" class="link4">System Reset</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </td></tr>
                <tr><td bgcolor="#f7b217" height="2"><img src="../img/layout/x.gif"></td></tr>
            </table>
        </td>
        <td width="2" align="left" bgcolor="#f7b217"><img src="../img/layout/x.gif" border="0" width="2"></td>
        <td width="50%" align="left">
            <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
                <tr><td align="left" background="../img/layout/bg_header.gif" height="13">
                        <font size=2>OPTIONS:</font>
                    </td></tr>
                <tr>
					<td align="center" valign="middle" bgcolor="#EBEBEB" height="68" style="border:2px solid #CCCCCC">
                        <table cellpadding="0" width="100%" cellspacing="0" border="0">
                            <tr>
                                <td align="center" width="50%">
									<table>
										<tr>
											<td><input type="checkbox" id="toggleHover" name="toggleHover" onclick="javascript:top.frames[0].toggleHover()"></td>
											<td class="testo" width="80" align="center">Popup Elements on Hover</td>
										</tr>
									</table>
                                </td>
								
                                <td align="center" width="50%">
									<form action="executeStep.php?agg=refresh" target="Body" method="post">
                                    <table cellpadding="0" cellspacing="0" border="0" width="145">
                                        <tr>
                                            <td align="center">
												<table>
													<tr>
														<td><input type="checkbox" name="segDati" onclick="javascript:top.frames[0].document.getElementById('refreshLayout').click();" <?php echo $_SESSION['segDati'];?>></td>
														<td class="testo">Data Path</td>
													</tr>
												</table>
											</td>
											<td align="center">
												<table>
													<tr>
														<td><input type="checkbox" name="segCtrl" onclick="javascript:top.frames[0].document.getElementById('refreshLayout').click();" <?php echo $_SESSION['segCtrl'];?>></td>
														<td class="testo">Control Path</td>
													</tr>
												</table>
											</td>
                                        </tr>
                                    </table>
									<table cellpadding="0" cellspacing="0" border="0" width="145" >
                                        <tr>
                                            <td align="center"><input type="submit" value="Refresh Layout" id="refreshLayout" class="form" style="width:145px; padding:2px; margin-bottom: -20px;"></td>
                                        </tr>
                                    </table>
									</form>
                                </td>
                            </tr>
                        </table>
                    </td>
				</tr>
                <tr><td bgcolor="#f7b217" height="2"><img src="../img/layout/x.gif"></td></tr>
            </table>
        </td>
    </tr>
</table>
<table cellpadding="0" width="100%" cellspacing="0" border="0" background="../img/layout/bg_header2.gif">
    <tr>
        <td width="300" align="center"><font size=2>MEMORY AND REGISTERS:</font></td>
        <td align="center"><font size=2>LAYOUT:</font></td>
    </tr>
</table>

</body>
</html>

