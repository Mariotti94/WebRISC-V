## Changelog

* **Version 1.7**
  * Implemented .data Directives
    * Upgraded Memory model
    * Additional ECALL Syscall
    * Editor page Directive list
    * Implementation of pseudoinstruction LLA

* **Version 1.6**
  * Upgraded the Pipeline Schema
  * Added selector for Forwarding Inside Pipeline [Activated || Deactivated]
    * Changes to Pipeline Schema depending on the selection
  * Implemented the full RV64I (excluding: fence) and RV64M instruction set
    * Editor page Instruction list with small descriptions on click
  * Hexadecimal(0xNUMBER) recognition for immediates in Editor

* **Version 1.5**
  * Multiple steps backwards now possible during execution
  * Fixes to layout data visualization

* **Version 1.4**
  * Adjustment of Pipeline branch logic visualization

* **Version 1.3**
  * Implementation of EBREAK
  * Implementation of ECALL
    * Implementation of a console to execute certain syscalls

* **Version 1.2**
  * Float to GMP numbers to remove approximation errors
  * Added selector for Jump Control Hazard Resolution [Flush Instruction || Execute Delay Slot]
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
