<?php
session_start();
?>
<html>
<head>
    <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
	<?php
	if(isset($_POST['btnBranchPred'])){
		require "init.php";
		$_SESSION['codice']='';
		if($_POST['selectBranchPred']=="flush")
			$_SESSION['branchFlush']=true;
		if($_POST['selectBranchPred']=="delay_slot")
			$_SESSION['branchFlush']=false;
	?>
    <script language="JavaScript" type="text/JavaScript">
        window.onload = function() {
            var rFrame=top.frames[1];
            rFrame.document.location.reload();
			var edFrame=top.frames[2];
			if(edFrame.document.getElementById("asmTxt"))
				edFrame.document.getElementById("asmTxt").value='';
        };
    </script>
	<?php
	}
	?>
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
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].innerHTML='Cannot Step Back';
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].setAttribute('class','link4disabled');
		}
		
		function stepSwitchOn() {
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].innerHTML='<span style="position:relative; top:3px; font-size:20px; margin:-10px 2px -10px -10px; display: inline-block;">&#8678;</span>Step Back';
			top.frames[0].document.getElementById('backButton').getElementsByTagName('a')[0].setAttribute('class','link4');
		}
    </script>
	<meta name="robots" content="noindex" />
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table cellpadding="0" width="100%" cellspacing="0" border="0" height="96" bgcolor="#f7b217">
    <tr>
        <td width="137" valign="top"  >
		<a href="../index.php" target="_parent"><img src="../img/content/img_logo.gif" border="0" width="137"></a>
		<font face="Arial" size=1><br><b>VERSION <?php echo $_SESSION['version'];?></b>: Write your feedback to <a href="mailto:giorgi@unisi.it">Roberto Giorgi</a>.</font>
		</td>
        <td width="35%" align="left">
            <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
                <tr><td align="center" background="../img/layout/bg_header.gif" height="13">
                        <font size=2>COMMANDS</font>
                    </td></tr>
                <tr>
					<td align="center" valign="middle" bgcolor="#EBEBEB" style="border:2px solid #CCCCCC; height:100%;">
					
                        <table cellpadding="0" width="100%" cellspacing="0" border="0">
                            <tr>
                                <td align="center" width="50%">
                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                                        <tr>
                                            <td align="center"><a href="executeAll.php" target="Body" class="link4" ><span style='position:relative; top:3px; font-size:20px; margin:-10px 1px -10px -10px; transform: rotate(90deg); display: inline-block;'>&#8686;</span> Execute ALL</a></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" border="0" >
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" >
                                        <tr>
                                            <td align="center"><a href="executeStep.php" target="Body" class="link4" onclick="javascript:stepSwitchOn()"><span style='position:relative; top:3px; font-size:20px; margin:-10px 2px -10px -10px; display: inline-block;'>&#8680;</span>Step Forward</a></td>
                                        </tr>
                                    </table>
									
									<table cellpadding="0" cellspacing="0" border="0" >
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" id="backButton">
                                        <tr>
                                            <td align="center"><a href="executeStep.php?agg=back" target="Body" class="link4" onclick="javascript:stepSwitchOff()"><span style='position:relative; top:3px; font-size:20px; margin:-10px 2px -10px -10px; display: inline-block;'>&#8678;</span>Step Back</a></td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center" width="50%">
                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" >
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
									
                                    <table cellpadding="0" cellspacing="0" border="0" >
                                        <tr>
                                            <td align="center"><img src="../img/layout/x.gif" height="5"></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" >
                                        <tr>
                                            <td align="center"><a href="../index.php" target="_parent" class="link4">System Reset</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </td></tr>
                <tr><td   height="2"><img src="../img/layout/x.gif"></td></tr>
            </table>
        </td>
		
		<td width="2" align="left"  ><img src="../img/layout/x.gif" border="0" width="2"></td>
		<td width="30%" align="left">
			<table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
				<tr><td align="center" background="../img/layout/bg_header.gif" height="13">
						<font size=2>EXECUTION OPTIONS</font>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle" bgcolor="#EBEBEB" height="100%" style="border:2px solid #CCCCCC;  height:100%;">
						<table>
						<tr>
							<td align="center">
							    <p class="testo">Jump Control Hazard Resolution</p>
								<form action="" method="post" style="margin:0px;">
									<select name="selectBranchPred" class="form" style="width:150px;" >
										<option value="flush" <?php if($_SESSION['branchFlush']) {?> selected <?php } ?> >Flush Instruction</option>
										<option value="delay_slot" <?php if(!$_SESSION['branchFlush']) {?> selected <?php } ?>>Execute Delay Slot</option>
									</select>
									<input type="submit" value="Select" name="btnBranchPred" class="form" style="width:60px;">
								</form>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr><td   height="2"><img src="../img/layout/x.gif"></td></tr>
			</table>
		</td>
		
        <td width="2" align="left"  ><img src="../img/layout/x.gif" border="0" width="2"></td>
        <td width="35%" align="left">
            <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
                <tr><td align="center" background="../img/layout/bg_header.gif" height="13">
                        <font size=2>VISUALIZATION OPTIONS</font>
                    </td>
				</tr>
                <tr>
					<td align="center" valign="middle" bgcolor="#EBEBEB" height="68" style="border:2px solid #CCCCCC;  height:100%;">
                        <table cellpadding="0" width="100%" cellspacing="0" border="0">
                            <tr>
                                <td align="center" width="50%">
									<table>
										<tr>
											<td><input type="checkbox" id="toggleHover" name="toggleHover" onclick="javascript:top.frames[0].toggleHover()"></td>
											<td class="testo" width="80" align="left">Popup Elements on Hover</td>
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
                <tr><td   height="2"><img src="../img/layout/x.gif"></td></tr>
            </table>
        </td>
		
		<td width="2" align="left"  ><img src="../img/layout/x.gif" border="0" width="2"></td>
    </tr>
</table>
<table cellpadding="0" width="100%" cellspacing="0" border="0" background="../img/layout/bg_header2.gif">
    <tr>
        <td width="340" align="center"><font size=2>MEMORY AND REGISTERS</font></td>
        <td align="center"><font size=2>LAYOUT</font></td>
    </tr>
</table>

</body>
</html>

