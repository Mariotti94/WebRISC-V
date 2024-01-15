# WebRISC-V
[<img height="30" src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/images/version.png?raw=true"/>](https://github.com/Mariotti94/WebRISC-V/blob/master/docs/CHANGELOG.md)

WebRISC-V is a web-based graphical pipelined datapath simulation environment built for the [RISC-V instruction set architecture](https://content.riscv.org/wp-content/uploads/2017/05/riscv-spec-v2.2.pdf).
It is suitable for teaching how assembly level code is executed on the RISC-V pipelined architecture and for illustrating the Pipeline Architectural Elements.

[WebRISC-V is online and ready for use](https://webriscv.altervista.org)

<p align="center">
    <img src="https://github.com/Mariotti94/WebRISC-V/blob/master/docs/images/intro.png?raw=true"/>
</p>

## Publication
If you would like to cite WebRISC-V, please use this reference:

```
@Article{Mariotti22-softwarex,
  author = {Mariotti, Gianfranco and Giorgi, Roberto},
  title = {{WebRISC-V}: A 32/64-bit RISC-V pipeline simulation tool},
  journal = {SoftwareX},
  publisher = {Elsevier},
  volume = {18},
  pages = {1--7},
  month = {May},
  year = {2022},
  url = {https://doi.org/10.1016/j.softx.2022.101105},
  doi = {10.1016/j.softx.2022.101105},
  issn = {2352-7110},
  scopus = {2-s2.0-85130837344}
}
```

## Features
* 5-stage Graphical Pipeline 32/64-bit Simulator
  * Pipeline Schema taken and enhanced from Patterson's 'Computer Organization and Design: RISC-V Edition'
  * Visualize every Architectural Element and the Data and Control paths
  * Execute with or without Forwarding
  * Change the Branch Hazard handling using the Delay Slot
  * Keep track of the execution in the Pipeline
    * Instruction Memory | Data Memory | Registers
  * Show the execution trace with the Pipeline Table
  * Interact with the execution through implemented syscalls on the Console
* Supported instructions are the full **RV32I** and **RV64I** Base Instruction Sets (excluding: fence) as well as the full **RV32M** and **RV64M** Standard Multiplication Extensions
  * List of supported instructions with small Verilog descriptions available
  * List of supported directives with small descriptions of meaning available
  * RISC-V Assembly simple examples available

## Documentation
For informations on usage, local installation and other topics, please refer to the [WebRISC-V wiki](https://github.com/Mariotti94/WebRISC-V/wiki).


