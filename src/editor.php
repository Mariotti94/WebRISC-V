<?php
session_start();
if(!isset($_SESSION['version'])) { header('Location: ../index.php'); exit; }
?>
<html>
<head>
  <title>WebRISC-V - RISC-V PIPELINED DATAPATH SIMULATION ONLINE</title>
  <link href="../css/main.css" rel="stylesheet" type="text/css">
  <script language='JavaScript' type='text/JavaScript'>
    window.onload = function() {
      //PANEL NAME
      if (top.frames[0].document.getElementById('mainLabel'))
        top.frames[0].document.getElementById('mainLabel').innerHTML="EDITOR";
    };
    function textAreaName() {
      if (top.frames[2].document.getElementById('asmName').value=='')
        top.frames[2].document.getElementById('asmName').value='handwritten.s';
    };
    function textAreaKeypress() {
      var totLines = top.frames[2].document.getElementById("asmTxt").value.split("\n").length;
      if (totLines>1000) {
        event.preventDefault();
      }
    };
    function textAreaPaste() {
      var totLines = top.frames[2].document.getElementById("asmTxt").value.split("\n").length;
      var clipLines = (event.clipboardData || window.clipboardData).getData('text').split("\n").length;
      if ((totLines+clipLines-1)>1000) {
        event.preventDefault();
      }
    };
    function tooltipText(elem) {
      var span = elem.querySelector('.tooltiptext');
      var spanStyle = span.getAttribute('style');
      var list = document.getElementsByClassName('tooltiptext');
      for (var i = 0; i < list.length; i++) {
        list[i].removeAttribute('style');
      }
      if (spanStyle!="visibility:visible;") {
        span.setAttribute('style','visibility:visible;');
      }
    };
  </script>
  <meta name="robots" content="noindex">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background: #f0f0f0;">

<table width="80%" cellpadding="0" cellspacing="0" style="margin: auto;">
  <tr>
    <td>

      <div align="center" class="testo" style="margin: 10px auto 0px auto; width: 600px;">
        The purpose of this site is to allow students to check the operating of a RISC-V processor having a 5-stage pipeline.
        <p style="margin: 10px 0px 5px 0px;">The programs that can be tested must:</p>
        &#8226; Have no more than <?php echo $_SESSION['maxTextMem']/4; ?> Instructions (<?php echo $_SESSION['maxTextMem']/1024; ?>kB Text Segment)<br>
        &#8226; Execute in no more than <?php echo $_SESSION['maxCycle']; ?> Cycles<br>
        &#8226;	Use no more than <?php echo $_SESSION['maxWritableMem']/1024; ?>kB of Data Memory (<?php echo $_SESSION['maxDynamicMem']/1024; ?>kB Dynamic Data Segment + <?php echo $_SESSION['maxStaticMem']/1024; ?>kB Static Data Segment)
      </div>

      <div align="center" style="margin-top: 20px;">
        ASSEMBLY EDITOR
      </div>

      <form action="asmFile.php" name="prova" method="post" style="margin: 0px;">
      <table cellpadding="0" cellspacing="0" align="center" style="margin-top: 10px;">
        <tr style="height: 30px;">
          <td class="edMenuTd1" align="left">
            <table>
              <tr>
                <td align="center" class="testo" style="white-space: nowrap;">
                  Examples List:
                </td>
                <td align="center">
                    <select name="programma" class="form" style="width: 150px;" onchange="javascript:document.getElementById('btn_insert').click();">
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
          </td>
          <td class="edMenuTd2">
            <!-- has to be empty -->
          </td>
          <td class="edMenuTd3">
            <table>
              <tr>
                <td align="center" class="testo" id="btn_insertTd">
                  <input type="submit" value="Insert in Textbox" class="form" name="btn_submit" style="width: 120px; padding: 1px; margin-right: 5px;" id="btn_insert">
                </td>
                <script language='JavaScript' type='text/JavaScript'>document.getElementById('btn_insertTd').style.display='none';</script>
                <td align="center" class="testo">
                  <input type="submit" value="Clear Textbox" class="form" name="btn_submit" style="width: 120px; padding: 1px;">
                </td>
              </tr>
            </table>
          </td>
          <td class="edMenuTd4">
            <!-- has to be empty -->
          </td>
        </tr>
      </table>
      </form>

      <form action="assembler.php" method="post" target="MemReg" style="margin: 0px;">
      <table cellpadding="0" cellspacing="0" align="center" style="margin-top: -30px;">
        <tr style="height: 30px;">
          <td class="edMenuTd1">
            <!-- has to be empty -->
          </td>
          <td class="edMenuTd2">
            <table>
              <tr>
                <td align="center">
                  <input type="submit" value="Load into Memory" class="form" style="width: 120px; padding: 1px;" onclick="javascript:top.frames[2].document.getElementById('anlzPipe').click();">
                </td>
              </tr>
            </table>
          </td>
          <td class="edMenuTd3">
            <!-- has to be empty -->
          </td>
          <td class="edMenuTd4">
            <input type="hidden" id="asmName" name="asmName" value="">
            <table>
              <tr>
                <td align="center">
                  <a href="executeStep.php?agg=return" target="Layout" class="link4 form" style="display: block; width: 116px; padding: 1px;" id="anlzPipe">Return to pipeline</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table cellpadding="0" cellspacing="0" align="center" style="margin-top: 10px; margin-bottom: 20px;">
        <tr>
          <td align="left" style="padding-left: 20px; padding-right: 40px;">
            <table class="testo" style="height: 100%; border-collapse: collapse; background-color: white; font-size: 9px;">
              <tr>
                <th class="edInstr bLeft bTop bRight" align="center" colspan="5"><b>List of .text Instructions</b></th>
              </tr>
              <tr>
                <th class="edInstr bLeft bTop bRight" align="center" colspan="3"><b>RV64I</b></th>
                <th class="edInstr bTop bRight" align="center"><b>RV64M</b></th>
                <th class="edInstr bTop bRight" align="center"><b>pseudo</b></th>
              </tr>
              <tr>
                <td class="edInstr bLeft bTop"><div class="tooltip" onclick="javascript:tooltipText(this);">add rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] + x[rs2]</span></div></td>
                <td class="edInstr bTop"><div class="tooltip" onclick="javascript:tooltipText(this);">lh rd, offset(rs1)<span class="tooltiptext">x[rd] = sign_extend(M[x[rs1] + sign_extend(offset)][15:0])</span></div></td>
                <td class="edInstr bTop bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">srai rd, rs1, shamt<span class="tooltiptext">x[rd] = x[rs1] >>[replicates sign bit] shamt{imm[5:0]}</span></div></td>
                <td class="edInstr bTop bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">div rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] /[signed] x[rs2]</span></div></td>
                <td class="edInstr bTop bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">la rd, symbol<span class="tooltiptext">x[rd] = symbol_address<p style="margin: 0px; margin-top: 5px;">Encoded as:</p>&#8226; auipc rd, delta[31 : 12] + delta[11]<br>&#8226; addi rd, rd, delta[11:0]<br>&#8594; {delta = symbol_address − pc}</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">addi rd, rs1, imm<span class="tooltiptext">x[rd] = x[rs1] + sign_extend(imm)</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">lhu rd, offset(rs1)<span class="tooltiptext">x[rd] = M[x[rs1] + sign_extend(offset)][15:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">sraiw rd, rs1, shamt<span class="tooltiptext">x[rd] = sign_extend((x[rs1] >>[replicates sign bit] shamt{imm[4:0]})[31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">divu rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] /[unsigned] x[rs2]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">j label<span class="tooltiptext">pc = label_address<p style="margin: 0px; margin-top: 5px;">Encoded as:</p>jal x0, label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">addiw rd, rs1, imm<span class="tooltiptext">x[rd] = sign_extend((x[rs1] + sign_extend(imm))[31:0])</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">lw rd, offset(rs1)<span class="tooltiptext">x[rd] = sign_extend(M[x[rs1] + sign_extend(offset)][31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">sraw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend((x[rs1] >>[replicates sign bit] x[rs2][4:0])[31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">divuw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend(x[rs1][31:0] /[unsigned] x[rs2][31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">jr rs1<span class="tooltiptext">pc = x[rs1]<p style="margin: 0px; margin-top: 5px;">Encoded as:</p>jalr x0, 0(rs1)</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">addw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend((x[rs1] + x[rs2])[31:0])</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">lwu rd, offset(rs1)<span class="tooltiptext">x[rd] = M[x[rs1] + sign_extend(offset)][31:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">srl rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] >> x[rs2][5:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">divw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend(x[rs1][31:0] /[signed] x[rs2][31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">mv rd, rs1<span class="tooltiptext">x[rd] = x[rs1]<p style="margin: 0px; margin-top: 5px;">Encoded as:</p>addi rd, rs1, 0</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">and rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] &amp; x[rs2]</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">lui rd, imm<span class="tooltiptext">x[rd] = sign_extend(imm[31:12] &lt;&lt; 12)</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">srli rd, rs1, shamt<span class="tooltiptext">x[rd] = x[rs1] >> shamt{imm[5:0]}</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">mul rd, rs1, rs2<span class="tooltiptext">x[rd] = (x[rs1] * x[rs2])[63:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">nop<span class="tooltiptext">Do nothing<p style="margin: 0px; margin-top: 5px;">Encoded as:</p>addi x0, x0, 0</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">andi rd, rs1, imm<span class="tooltiptext">x[rd] = x[rs1] &amp; sign_extend(imm)</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">or rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] | x[rs2]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">srliw rd, rs1, shamt<span class="tooltiptext">x[rd] = sign_extend((x[rs1] >> shamt{imm[4:0]})[31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">mulh rd, rs1, rs2<span class="tooltiptext">x[rd] = (x[rs1] * x[rs2])[127:64]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">ret<span class="tooltiptext">pc = x[ra]<p style="margin: 0px; margin-top: 5px;">Encoded as:</p>jalr x0, 0(ra)</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">auipc rd, imm<span class="tooltiptext">x[rd] = pc + sign_extend(imm[31:12] &lt;&lt; 12)</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">ori rd, rs1, imm<span class="tooltiptext">x[rd] = x[rs1] | sign_extend(imm)</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">srlw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend((x[rs1] >> x[rs2][4:0])[31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">mulhsu rd, rs1, rs2<span class="tooltiptext">x[rd] = (x[rs1][signed] * x[rs2][unsigned])[127:64]</span></div></td>
                <td class="bRight bBot" rowspan="15"></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">beq rs1, rs2, label<span class="tooltiptext">if (rs1 == rs2) pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sb rs2, offset(rs1)<span class="tooltiptext">M[x[rs1] + sign_extend(offset)] = x[rs2][7:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">sub rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] - x[rs2]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">mulhu rd, rs1, rs2<span class="tooltiptext">x[rd] = (x[rs1] *[unsigned] x[rs2])[127:64]</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">bge rs1, rs2, label<span class="tooltiptext">if (rs1 >= rs2) pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sd rs2, offset(rs1)<span class="tooltiptext">M[x[rs1] + sign_extend(offset)] = x[rs2][63:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">subw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend((x[rs1] - x[rs2])[31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">mulw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend((x[rs1] * x[rs2])[31:0])</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">bgeu rs1, rs2, label<span class="tooltiptext">if (rs1 >=[unsigned] rs2) pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sh rs2, offset(rs1)<span class="tooltiptext">M[x[rs1] + sign_extend(offset)] = x[rs2][15:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">xor rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] ^ x[rs2]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">rem rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] % x[rs2]</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">blt rs1, rs2, label<span class="tooltiptext">if (rs1 &lt; rs2) pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sw rs2, offset(rs1)<span class="tooltiptext">M[x[rs1] + sign_extend(offset)] = x[rs2][31:0]</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">xori rd, rs1, imm<span class="tooltiptext">x[rd] = x[rs1] ^ sign_extend(imm)</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">remu rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] %[unsigned] x[rs2]</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">bltu rs1, rs2, label<span class="tooltiptext">if (rs1 &lt;[unsigned] rs2) pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sll rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] &lt;&lt; x[rs2][5:0]</span></div></td>
                <td class="bRight bBot" style="border-left: 1px dashed #999!important;" rowspan="9"></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">remuw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend(x[rs1][31:0] %[unsigned] x[rs2][31:0])</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">bne rs1, rs2, label<span class="tooltiptext">if (rs1 != rs2) pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">slli rd, rs1, shamt<span class="tooltiptext">x[rd] = sign_extend((x[rs1] &lt;&lt; shamt{imm[5:0]})[31:0])</span></div></td>
                <td class="edInstr bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">remw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend(x[rs1][31:0] % x[rs2][31:0])</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">ebreak<span class="tooltiptext">RaiseException(Breakpoint)</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">slliw rd, rs1, shamt<span class="tooltiptext">x[rd] = sign_extend((x[rs1] &lt;&lt; shamt{imm[4:0]})[31:0])</span></div></td>
                <td class="bRight bBot" rowspan="7"></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">ecall<span class="tooltiptext">RaiseException(EnvironmentCall)</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sllw rd, rs1, rs2<span class="tooltiptext">x[rd] = sign_extend((x[rs1] &lt;&lt; x[rs2][4:0])[31:0])</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">jal rd, label<span class="tooltiptext">x[rd] = pc+4; pc = label_address<br>&#8594; {label_address = pc + sign_extend(offset &lt;&lt; 1)}</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">slt rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] &lt; x[rs2]</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">jalr rd, offset(rs1)<span class="tooltiptext">x[rd] = pc+4; pc=x[rs1]+sign_extend(offset);</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">slti rd, rs1, imm<span class="tooltiptext">x[rd] = x[rs1] &lt; sign_extend(imm)</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">lb rd, offset(rs1)<span class="tooltiptext">x[rd] = sign_extend(M[x[rs1] + sign_extend(offset)][7:0])</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sltiu rd, rs1, imm<span class="tooltiptext">x[rd] = x[rs1] &lt;[unsigned] sign_extend(imm)</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft"><div class="tooltip" onclick="javascript:tooltipText(this);">lbu rd, offset(rs1)<span class="tooltiptext">x[rd] = M[x[rs1] + sign_extend(offset)][7:0]</span></div></td>
                <td class="edInstr"><div class="tooltip" onclick="javascript:tooltipText(this);">sltu rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] &lt;[unsigned] x[rs2]</span></div></td>
              </tr>
              <tr>
                <td class="edInstr bLeft bBot"><div class="tooltip" onclick="javascript:tooltipText(this);">ld rd, offset(rs1)<span class="tooltiptext">x[rd] = M[x[rs1] + sign_extend(offset)][63:0]</span></div></td>
                <td class="edInstr bBot"><div class="tooltip" onclick="javascript:tooltipText(this);">sra rd, rs1, rs2<span class="tooltiptext">x[rd] = x[rs1] >>[replicates sign bit] x[rs2][5:0]</span></div></td>
              </tr>
            </table>

            <table class="testo" style="margin-top: 10px; height: 100%; border-collapse: collapse; background-color: white; font-size: 9px;">
              <tr>
                <th class="edInstr bLeft bTop bRight" align="center" colspan="5"><b>List of .data Directives</b></th>
              </tr>
              <tr>
                <td class="edInstr bLeft bTop"><div class="tooltip" onclick="javascript:tooltipText(this);">.align 2<span class="tooltiptext">Align next data item on specified byte boundary (0=byte, 1=half, 2=word, 3=double)</span></div></td>
                <td class="edInstr bTop"><div class="tooltip" onclick="javascript:tooltipText(this);">.ascii "string"<span class="tooltiptext">Store the string in the Data segment but do not add null terminator</span></div></td>
                <td class="edInstr bTop"><div class="tooltip" onclick="javascript:tooltipText(this);">.asciz "string"<span class="tooltiptext">Store the string in the Data segment and add null terminator</span></td>
                <td class="edInstr bTop"><div class="tooltip" onclick="javascript:tooltipText(this);">.byte 1, 2, 3<span class="tooltiptext">Store the listed value(s) as 8 bit bytes</span></td>
                <td class="edInstr bTop bRight"><div class="tooltip" onclick="javascript:tooltipText(this);">.dword 1, 2, 3<span class="tooltiptext">Store the listed value(s) as 64 bit dwords on dword boundary</span></td>
              </tr>
              <tr>
                <td class="edInstr bLeft bBot"><div class="tooltip" onclick="javascript:tooltipText(this);">.half 1, 2, 3<span class="tooltiptext">Store the listed value(s) as 16 bit halfwords on halfword boundary</span></td>
                <td class="edInstr bBot"><div class="tooltip" onclick="javascript:tooltipText(this);">.space 16<span class="tooltiptext">Reserve the next specified number of bytes in Data segment</span></td>
                <td class="edInstr bBot"><div class="tooltip" onclick="javascript:tooltipText(this);">.string "string"<span class="tooltiptext">Alias of .asciz</span></td>
                <td class="edInstr bBot"><div class="tooltip" onclick="javascript:tooltipText(this);">.word 1, 2, 3<span class="tooltiptext">Store the listed value(s) as 32 bit words on word boundary</span></td>
                <td class="bBot bRight"></td>
              </tr>
            </table>
            <table class="testo" style="margin: auto; margin-top: 10px; height: 100%; border-collapse: collapse; background-color: white; font-size: 9px;">
              <tr>
                <th class="edInstr bLeft bTop bRight" align="center" colspan="5"><b>Supported System Calls</b></th>
              </tr>
              <tr>
                <td rowspan="3" class="edScall bLeft bBot bTop" style="min-width: 200px; border-right: 1px dashed #999;">
                    Syscall code in a7, Argument in a0
                </td>
                <td rowspan="3" class="edScall bBot bTop" style="min-width: 100px;">
                  <b>ECALL CODES:</b>
                </td>
                <td class="edScall bRight bTop" style="min-width: 100px;">
                  Print Int    = 1
                </td>
              </tr>
              <tr>
                <td class="edScall bRight">
                  Print String = 4
                </td>
              </tr>
              <tr>
                <td class="edScall bBot bRight">
                  Read Int     = 5
                </td>
              </tr>
            </table>
          </td>
          <td style="min-width: 580px; padding-right: 20px;">
            <div style="height: 420px; overflow-x: auto; overflow-y: auto; border: 1px solid black;">
              <table cellpadding="0" cellspacing="0">
                <tr>
                  <td style="float: left; min-width: 30px;" bgcolor="#cccccc">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <?php
                      $i=0;
                      while($i<1000)
                      {
                        ?>
                        <tr>
                          <td align="right" valign="middle" class="indice"<?php if (!$i) echo ' style="padding-top: 1px;"';?>><?php echo $i+1;?></td>
                        </tr>
                        <?php $i=$i+1;
                      } ?>
                    </table>
                  <td>
                  <td style="min-width: 530px;">
                    <textarea id="asmTxt" name="codice" style="border: 0px; margin: 0px; width: 100%;" rows="1000" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" onkeypress="javascript:textAreaName();textAreaKeypress();" onpaste="javascript:textAreaName();textAreaPaste();"><?php echo isset($_SESSION['codice'])?$_SESSION['codice']:'';?></textarea>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      </form>

    </td>
  </tr>
</table>
</body>
</html>

