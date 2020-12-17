<?php
session_start();
if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <?php
  if (isset($_POST['btnMemDatiShow'])) {
    if ($_POST['selectMemDatiShow']=="high_to_low")
      $_SESSION['memDatiShow']=0;
    if ($_POST['selectMemDatiShow']=="low_to_high")
      $_SESSION['memDatiShow']=1;
  }
  if (isset($_POST['btnBranchRes'])) {
    require_once 'init.php';
    $_SESSION['codice']='';
    if ($_POST['selectBranchRes']=="flush")
      $_SESSION['branchRes']=0;
    if ($_POST['selectBranchRes']=="delay_slot")
      $_SESSION['branchRes']=1;
  }
  if (isset($_POST['btnForwarding'])) {
    require_once 'init.php';
    if ($_POST['selectForwarding']=="forwarding_false")
      $_SESSION['forwarding']=0;
    if ($_POST['selectForwarding']=="forwarding_true")
      $_SESSION['forwarding']=1;
  }
  if (isset($_POST['btnBranchRes']) || isset($_POST['btnForwarding'])) {
    ?>
    <script language='JavaScript' type='text/JavaScript'>
      window.onload = function() {
        if (top.frames[2].document.getElementById('editorBody')) {
          switchCmd();
        }
        //RELOAD PANELS
        var rFrame=top.frames[2];
        if (rFrame)
          rFrame.document.location.reload();
        <?php
        if (isset($_POST['btnBranchRes'])) {
          ?>
          //EDITOR: CLEAR TEXTAREA
          var edFrame=top.frames[2];
          if (edFrame.document.getElementById("asmTxt"))
            edFrame.document.getElementById("asmTxt").value='';
        <?php
        }
        ?>
      };
    </script>
    <?php
  }
  if (isset($_POST['btnMemDatiShow'])) {
    ?>
    <script language='JavaScript' type='text/JavaScript'>
      window.onload = function() {
        if (top.frames[2].document.getElementById('editorBody')) {
          switchCmd();
        }
        //RELOAD PANELS
        var rFrame=top.frames[1];
        if (rFrame)
          rFrame.document.location.reload();
      };
    </script>
    <?php
  }
  ?>
  <script language='JavaScript' type='text/JavaScript'>
    //SET/UNSET POPUPS
    function toggleHover() {
      if (top.frames[2].document.getElementById('schemaBody')) {
        if (top.frames[0].document.getElementById('toggleHover') && top.frames[0].document.getElementById('toggleHover').checked) {
          top.frames[2].popup_set();
        }
        else {
          top.frames[2].popup_unset();
        }
      }
    };
    //SWITCH CMD SET WINDOW
    function switchCmd() {
      if (document.getElementById('schemaCmd').style.display=='') {
        document.getElementById('schemaCmd').style.display='none';
        document.getElementById('editorCmd').style.display='';
        document.getElementById('popupToggleTd').style.display='none';
        document.getElementById('btn_refreshLayoutForm').style.display='none';
        document.getElementById('mainLabel').innerHTML="EDITOR";
      } else {
        document.getElementById('editorCmd').style.display='none';
        document.getElementById('schemaCmd').style.display='';
        document.getElementById('popupToggleTd').style.display='';
        document.getElementById('btn_refreshLayoutForm').style.display='';
        document.getElementById('mainLabel').innerHTML="SCHEMA LAYOUT";
      }
    };
  </script>
  <meta name="robots" content="noindex">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background: #f0f0f0;">
<table cellpadding="0" width="100%" cellspacing="0" border="0" height="109" bgcolor="#f7b217">
  <tr>
    <td valign="top" style="width:137px; height:109px;">
    <a href="../index.php" target="_parent"><img src="../img/content/logo.gif" border="0" width="137"></a>
    <div style="text-align: center; font-family: Arial; font-size: 10px;">
        <b>VERSION <?php echo $_SESSION['version'];?></b>
        <br>Write your feedback:
        <br><a href="mailto:giorgi@unisi.it">Roberto Giorgi</a> || <a href="https://github.com/Mariotti94/WebRISC-V" target="_blank">GitHub</a>
    </div>
    </td>
    <td width="33%" align="left">
      <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
        <tr>
          <td align="center" style="border-width: 2px 2px 0px 2px; border-style: solid; border-color: #cccccc; line-height: 17px; font-size: 13px;">COMMANDS</td>
        </tr>
        <tr>
          <td align="center" valign="middle" bgcolor="#ebebeb" style="border:2px solid #cccccc; height:100%; padding:0px 2px;">

            <table id="schemaCmd" cellpadding="0" width="100%" cellspacing="0" border="0">
              <tr>
                <td align="center" width="50%">
                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                    <tr>
                      <td align="center" style="height: 13px;"><a href="editor.php" target="Layout" class="link4" onclick="javascript: window.switchCmd();">Load Program</a></td></tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><img src="../img/layout/x.gif" height="3"></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                    <tr>
                      <td align="center" style="height: 13px;"><a href="executeStep.php?agg=new" target="_blank" class="link4">Pipeline in New Window</a></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><img src="../img/layout/x.gif" height="3"></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                    <tr>
                      <td align="center" style="height: 13px;"><a href="../index.php" target="_parent" class="link4">System Reset</a></td>
                    </tr>
                  </table>
                </td>

                <td align="center" width="50%">
                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" id="allButton">
                    <tr>
                      <td align="center" style="height: 13px;"><a href="executeAll.php" target="Layout" class="link4"><span style='position:relative; top:3px; font-size:20px; margin:-12px 1px -12px -10px; transform: rotate(90deg); display: inline-block;'>&#8686;</span> Execute ALL</a></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><img src="../img/layout/x.gif" height="3"></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" id="stepButton">
                    <tr>
                      <td align="center" style="height: 13px;"><a href="executeStep.php" target="Layout" class="link4"><span style='position:relative; top:3px; font-size:20px; margin:-12px 2px -12px -10px; display: inline-block;'>&#8680;</span>Step Forward</a></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><img src="../img/layout/x.gif" height="3"></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" id="backButton">
                    <tr>
                      <td align="center" style="height: 13px;"><a href="executeStep.php?agg=back" target="Layout" class="link4"><span style='position:relative; top:3px; font-size:20px; margin:-12px 2px -12px -10px; display: inline-block;'>&#8678;</span>Step Back</a></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            <table id="editorCmd" style="display:none;" cellpadding="0" width="100%" cellspacing="0" border="0">
              <tr>
                <td align="center" width="50%">
                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                    <tr>
                      <td align="center" style="height: 13px;">
                        <p style="margin-bottom: 2px;">Example List:</p>
                        <select name="programma" class="form" style="width: 139px;" onchange="javascript: top.frames[2].document.getElementById('programSel').value=this.value; top.frames[2].document.getElementById('btn_insert').click(); this.value='';">
                          <option value="" selected>-----</option>
                          <option value="calculator">Simple Calculator</option>
                          <option value="memory">Memory References</option>
                          <option value="factorial">Factorial</option>
                          <option value="hazard">Data Hazard Example</option>
                          <option value="stall">Stall Example</option>
                          <option value="syscall">Syscall and Data Example</option>
                        </select>
                      </td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><img src="../img/layout/x.gif" height="3"></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form">
                    <tr>
                      <td align="center" style="height: 13px;">
                        <span class="link4" onclick="javascript:top.frames[2].document.getElementById('clearBtn').click();">Clear Textbox</span>
                      </td>
                    </tr>
                  </table>
                </td>

                <td align="center" width="50%">
                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" id="allButton">
                    <tr>
                      <td align="center" style="height: 13px;">
                        <span class="link4" onclick="javascript: top.frames[2].document.getElementById('loadMemBtn').click(); window.switchCmd();">Load into Memory</span>
                      </td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center"><img src="../img/layout/x.gif" height="3"></td>
                    </tr>
                  </table>

                  <table cellpadding="0" cellspacing="2" border="0" width="145" class="form" id="stepButton">
                    <tr>
                      <td align="center" style="height: 13px;">
                        <span class="link4" onclick="javascript: top.frames[2].document.getElementById('retPipeBtn').click(); window.switchCmd();">Return to pipeline</span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

          </td></tr>
        <tr><td height="2"><img src="../img/layout/x.gif"></td></tr>
      </table>
    </td>

    <td width="2" align="left"  ><img src="../img/layout/x.gif" border="0" width="2"></td>
    <td width="34%" align="left">
      <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
        <tr>
          <td align="center" style="border-width: 2px 2px 0px 2px; border-style: solid; border-color: #cccccc; line-height: 17px; font-size: 13px;">EXECUTION OPTIONS</td>
        </tr>
        <tr>
          <td align="center" valign="middle" bgcolor="#ebebeb" height="100%" style="border:2px solid #cccccc; height:100%; padding:0px 2px;">
            <table width="90%">
            <tr>
              <td align="center">
                <p class="testo">Jump Control Hazard Resolution</p>
                <form action="" method="post" style="margin:0px;">
                  <select name="selectBranchRes" class="form" style="width:180px;" onchange="javascript:document.getElementById('btn_BranchRes').click();">
                    <option value="flush" <?php if ($_SESSION['branchRes']==0) {?> selected <?php } ?>>Flush Instruction</option>
                    <option value="delay_slot" <?php if ($_SESSION['branchRes']==1) {?> selected <?php } ?>>Execute Delay Slot</option>
                  </select>
                  <input type="submit" value="Select" name="btnBranchRes" class="form" style="width:60px; padding:1px;" id="btn_BranchRes">
                  <script language='JavaScript' type='text/JavaScript'>document.getElementById('btn_BranchRes').style.display='none';</script>
                </form>
              </td>
              <td align="center">
                <p class="testo">Forwarding Inside Pipeline</p>
                <form action="" method="post" style="margin:0px;">
                  <select name="selectForwarding" class="form" style="width:150px;" onchange="javascript:document.getElementById('btn_Forwarding').click();">
                    <option value="forwarding_true" <?php if ($_SESSION['forwarding']==1) {?> selected <?php } ?>>Activated</option>
                    <option value="forwarding_false" <?php if ($_SESSION['forwarding']==0) {?> selected <?php } ?>>Deactivated</option>
                  </select>
                  <input type="submit" value="Select" name="btnForwarding" class="form" style="width:60px; padding:1px;" id="btn_Forwarding">
                  <script language='JavaScript' type='text/JavaScript'>document.getElementById('btn_Forwarding').style.display='none';</script>
                </form>
              </td>
            </tr>
            </table>
          </td>
        </tr>
        <tr><td height="2"><img src="../img/layout/x.gif"></td></tr>
      </table>
    </td>

    <td width="2" align="left"  ><img src="../img/layout/x.gif" border="0" width="2"></td>
    <td width="33%" align="left">
      <table cellpadding="0" width="100%" cellspacing="0" border="0" height="96">
        <tr>
          <td align="center" style="border-width: 2px 2px 0px 2px; border-style: solid; border-color: #cccccc; line-height: 17px; font-size: 13px;">VISUALIZATION OPTIONS</td>
        </tr>
        <tr>
          <td align="center" valign="middle" bgcolor="#ebebeb" height="68" style="border:2px solid #cccccc;  height:100%; padding:0px 2px;">
            <table cellpadding="0" width="100%" cellspacing="0" border="0">
              <tr>
                <td align="center" id="popupToggleTd">
                  <table>
                    <tr>
                      <td><input type="checkbox" id="toggleHover" name="toggleHover" onclick="javascript:top.frames[0].toggleHover()"></td>
                      <td class="testo" align="left">Popup<br>Elements<br>on Hover</td>
                    </tr>
                  </table>
                </td>
                <script language='JavaScript' type='text/JavaScript'>
                  window.mobilecheck = function() {
                    var check = false;
                    (function(a){if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
                    return check;
                  };
                  if (window.mobilecheck()) {
                    var styleSheet = document.createElement("style");
                    styleSheet.type = "text/css";
                    styleSheet.innerText = "#popupToggleTd { display: none; } #popupToggleBox {  display: none; }";
                    document.head.appendChild(styleSheet);
                  }
                </script>
                <td align="center">
                  <form action="executeStep.php?agg=refresh" method="post" target="Layout" id="btn_refreshLayoutForm">
                  <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td align="center">
                        <table>
                          <tr>
                            <td><input type="checkbox" name="segDati" onclick="javascript:top.frames[0].document.getElementById('refreshLayout').click();" <?php echo $_SESSION['segDati'];?>></td>
                            <td class="testo">Show<br>Data&nbsp;Path</td>
                          </tr>
                        </table>
                      </td>
                      <td align="center">
                        <table>
                          <tr>
                            <td><input type="checkbox" name="segCtrl" onclick="javascript:top.frames[0].document.getElementById('refreshLayout').click();" <?php echo $_SESSION['segCtrl'];?>></td>
                            <td class="testo">Show<br>Control&nbsp;Path</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="145" id="btn_refreshLayout">
                    <tr>
                      <td align="center"><input type="submit" value="Refresh Layout" id="refreshLayout" class="form" style="width: 145px; padding: 2px; margin-bottom: -20px;"></td>
                    </tr>
                  </table>
                  <script language='JavaScript' type='text/JavaScript'>
                    document.getElementById('btn_refreshLayout').style.display='none';
                    document.getElementById('btn_refreshLayoutForm').style.margin='0px';
                  </script>
                  </form>
                </td>
                <td align="center">
                <p class="testo">Data Memory</p>
                <form action="" method="post" style="margin:0px;">
                  <select name="selectMemDatiShow" class="form" style="width:140px;" onchange="javascript:document.getElementById('btn_MemDatiShow').click();">
                    <option value="high_to_low" <?php if ($_SESSION['memDatiShow']==0) {?> selected <?php } ?>>Upper to Lower bytes</option>
                    <option value="low_to_high" <?php if ($_SESSION['memDatiShow']==1) {?> selected <?php } ?>>Lower to Upper bytes</option>
                  </select>
                  <input type="submit" value="Select" name="btnMemDatiShow" class="form" style="width:60px; padding:1px;" id="btn_MemDatiShow">
                  <script language='JavaScript' type='text/JavaScript'>document.getElementById('btn_MemDatiShow').style.display='none';</script>
                </form>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr><td height="2"><img src="../img/layout/x.gif"></td></tr>
      </table>
    </td>

    <td width="2" align="left"  ><img src="../img/layout/x.gif" border="0" width="2"></td>
  </tr>
  <tr>
    <td colspan="7">
      <table cellpadding="0" width="100%" cellspacing="0" border="0" bgcolor="#f7b217" style="border-width: 2px 0px; border-style: solid; border-color: #cccccc;">
      <tr>
        <td width="340" align="center" style="line-height: 17px; font-size: 13px; box-sizing: border-box; border-right: 1px solid #cccccc;">EXECUTION STATUS</td>
        <td align="center" id="mainLabel" style="line-height: 17px; font-size: 13px; box-sizing: border-box; border-left: 1px solid #cccccc;">SCHEMA LAYOUT</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>

