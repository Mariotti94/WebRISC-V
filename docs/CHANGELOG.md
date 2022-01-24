## Changelog
>logs only major versions<br>
>minor version improvements logged on following major version

* **Version 1.8**
  * Implementation of the full RV32I (excluding: fence) and RV32M instruction set
  * Add selector for Architecture [RV64IM || RV32IM]
  * Add selector for Pipeline execution table [Full loops || Squashed loops]
  * Implementation of pseudoinstructions MV, LI

* **Version 1.7**
  * Implementation of .data Directives
  * Upgrade of the Memory model
  * Add ECALL Syscall
  * Add Editor page Directive list (with simple description on click)
  * Implementation of pseudoinstruction LA

* **Version 1.6**
  * Upgrade of the Pipeline Schema
  * Add selector for Forwarding Inside Pipeline [Activated || Deactivated]
    * Pipeline Schema change depending on the selection
  * Implementation of the full RV64I (excluding: fence) and RV64M instruction set
  * Add Editor page Instruction list (with simple description on click)
  * Add Hexadecimal(0xNUMBER) recognition for immediates in Editor

* **Version 1.5**
  * Multiple steps backwards now possible during execution
  * Fix layout data visualization

* **Version 1.4**
  * Adjustment of Pipeline branch logic visualization

* **Version 1.3**
  * Implementation of EBREAK
  * Implementation of ECALL
    * Implementation ofation of a console to execute certain syscalls

* **Version 1.2**
  * Remove approximation errors (Float to GMP number)
  * Add selector for Jump Control Hazard Resolution [Flush Instruction || Execute Delay Slot]
    * Examples in Load Program page change depending on the selection
  * Implementation of SRAI

* **Version 1.1**
  * Implementation of Pipeline execution table
  * Implementation of SLLI, SRLI

* **Version 1.0**
  * Initial version
    * Described in the paper: \
[WebRISC-V: a Web-Based Education-Oriented RISC-V Pipeline Simulation Environment
](https://dl.acm.org/citation.cfm?id=3338894)
