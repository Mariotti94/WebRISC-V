<?php
session_start();
$_SESSION['inserted']=true;
if ($_POST['btn_submit']=="Insert in Textbox")
	$cosa=$_POST["programma"];
else
	$cosa="";
if ($_SESSION['branchFlush']) {
	switch ($cosa)
	{
		case "calculator":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This program serves as a simple'.PHP_EOL;
			$codice=$codice.'# 4 operation calculator between'.PHP_EOL;
			$codice=$codice.'# the two operands in s1 and s2'.PHP_EOL;
			$codice=$codice.'# the operation is choosen in s0'.PHP_EOL;
			$codice=$codice.'# add       s0 = 1'.PHP_EOL;
			$codice=$codice.'# sub       s0 = 2'.PHP_EOL;
			$codice=$codice.'# mul       s0 = 3'.PHP_EOL;
			$codice=$codice.'# div       s0 = 4'.PHP_EOL;
			$codice=$codice.'# operand 1  = s1'.PHP_EOL;
			$codice=$codice.'# operand 2  = s2'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi s0, x0, 1'.PHP_EOL;
			$codice=$codice.'addi s1, x0, 5'.PHP_EOL;
			$codice=$codice.'addi s2, x0, 10'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 1'.PHP_EOL;
			$codice=$codice.'beq s0, t0, somma'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 2'.PHP_EOL;
			$codice=$codice.'beq s0, t1, sottrazione'.PHP_EOL;
			$codice=$codice.'addi t2, x0, 3'.PHP_EOL;
			$codice=$codice.'beq s0, t2, molt'.PHP_EOL;
			$codice=$codice.'addi t3, x0, 4'.PHP_EOL;
			$codice=$codice.'beq s0, t3, div'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'somma:'.PHP_EOL;
			$codice=$codice.'add s3, s1, s2'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'sottrazione:'.PHP_EOL;
			$codice=$codice.'sub s3, s1, s2'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'molt:'.PHP_EOL;
			$codice=$codice.'mul s3, s1, s2'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'div:'.PHP_EOL;
			$codice=$codice.'div s3, s1, s2'.PHP_EOL;
			$codice=$codice.'fine:';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "memory":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This program copies a 10-element vector'.PHP_EOL;
			$codice=$codice.'# into another vector'.PHP_EOL;
			$codice=$codice.'# Addresses of the two vectors'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi s0, x0, 4'.PHP_EOL;
			$codice=$codice.'addi s1, x0, 44'.PHP_EOL;
			$codice=$codice.'# Initializing with some values'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 10'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 1'.PHP_EOL;
			$codice=$codice.'add s2, s0, x0'.PHP_EOL;
			$codice=$codice.'Inserimento:'.PHP_EOL;
			$codice=$codice.'beq t0, t1, FineInserimento'.PHP_EOL;
			$codice=$codice.'addi s2, s2, 4'.PHP_EOL;
			$codice=$codice.'sw t1, 0(s2)'.PHP_EOL;
			$codice=$codice.'addi t1, t1, 1'.PHP_EOL;
			$codice=$codice.'j Inserimento'.PHP_EOL;
			$codice=$codice.'FineInserimento:'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 1'.PHP_EOL;
			$codice=$codice.'add s2, s0, x0'.PHP_EOL;
			$codice=$codice.'add s3, s1, x0'.PHP_EOL;
			$codice=$codice.'# Procedure stars here'.PHP_EOL;
			$codice=$codice.'Copia:'.PHP_EOL;
			$codice=$codice.'beq t0, t1, FineProgramma'.PHP_EOL;
			$codice=$codice.'addi s2, s2, 4'.PHP_EOL;
			$codice=$codice.'lw t2, 0(s2)'.PHP_EOL;
			$codice=$codice.'addi s3, s3, 4'.PHP_EOL;
			$codice=$codice.'sw t2, 0(s3)'.PHP_EOL;
			$codice=$codice.'addi t1, t1, 1'.PHP_EOL;
			$codice=$codice.'j Copia'.PHP_EOL;
			$codice=$codice.'FineProgramma:';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "factorial":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# Compute the factorial of n (n!)'.PHP_EOL;
			$codice=$codice.'# int factorialRec(int n) {'.PHP_EOL;
			$codice=$codice.'#    if (n<2) { return 1; }'.PHP_EOL;
			$codice=$codice.'#    else { return n*factorial(n-1); }'.PHP_EOL;
			$codice=$codice.'# }'.PHP_EOL;
			$codice=$codice.'# a2 = n'.PHP_EOL;
			$codice=$codice.'# a0 = result'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'j main'.PHP_EOL;
			$codice=$codice.'factorialRec:'.PHP_EOL;
			$codice=$codice.'addi sp, sp, -8'.PHP_EOL;
			$codice=$codice.'sw a2, 0(sp)'.PHP_EOL;
			$codice=$codice.'sw ra, 4(sp)'.PHP_EOL;
			$codice=$codice.'#if (n < 2) do return 1'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 2	'.PHP_EOL;
			$codice=$codice.'#else return n*factorialRec(n-1)'.PHP_EOL;
			$codice=$codice.'slt t0, a2, t0	'.PHP_EOL;
			$codice=$codice.'beq t0, x0, anotherCall'.PHP_EOL;
			$codice=$codice.'#recursive anchor'.PHP_EOL;
			$codice=$codice.'lw ra, 4(sp)'.PHP_EOL;
			$codice=$codice.'lw a2, 0(sp)'.PHP_EOL;
			$codice=$codice.'addi sp, sp, 8'.PHP_EOL;
			$codice=$codice.'addi a0, x0, 1'.PHP_EOL;
			$codice=$codice.'jr ra'.PHP_EOL;
			$codice=$codice.'anotherCall:'.PHP_EOL;
			$codice=$codice.'addi a2, a2, -1'.PHP_EOL;
			$codice=$codice.'jal factorialRec'.PHP_EOL;
			$codice=$codice.'lw ra, 4(sp)'.PHP_EOL;
			$codice=$codice.'lw a2, 0(sp)'.PHP_EOL;
			$codice=$codice.'addi sp, sp, 8'.PHP_EOL;
			$codice=$codice.'mul a0, a2, a0'.PHP_EOL;
			$codice=$codice.'jr ra'.PHP_EOL;
			$codice=$codice.'main:'.PHP_EOL;
			$codice=$codice.'addi a2, x0, 5'.PHP_EOL;
			$codice=$codice.'jal factorialRec'.PHP_EOL;
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "hazard":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This programs does nothing...'.PHP_EOL;
			$codice=$codice.'# It demonstrate the behavior'.PHP_EOL;
			$codice=$codice.'# of forwarding unit'.PHP_EOL;
			$codice=$codice.'# in case of data hazards.'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 1'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 2'.PHP_EOL;
			$codice=$codice.'addi t2, x0, 3'.PHP_EOL;
			$codice=$codice.'add t0, t1, t2'.PHP_EOL;
			$codice=$codice.'# Hazard at first level'.PHP_EOL;
			$codice=$codice.'add t2, t0, t0'.PHP_EOL;
			$codice=$codice.'# Hazard at second level'.PHP_EOL;
			$codice=$codice.'add t3, t0, t2';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');        
			break;
			
		case "stall":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This program does nothing...'.PHP_EOL;
			$codice=$codice.'# It demonstrates the behavior'.PHP_EOL;
			$codice=$codice.'# of the hazard detection unit'.PHP_EOL;
			$codice=$codice.'# by creating a stall condition'.PHP_EOL;
			$codice=$codice.'# This is the only case when the'.PHP_EOL;
			$codice=$codice.'# forwarding unit cannot handle'.PHP_EOL;
			$codice=$codice.'# a data hazard.'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 10'.PHP_EOL;
			$codice=$codice.'addi  sp, x0, 0'.PHP_EOL;
			$codice=$codice.'sw t0, 0(sp)'.PHP_EOL;
			$codice=$codice.'add t1, t0, t0'.PHP_EOL;
			$codice=$codice.'lw t0, 0(sp)'.PHP_EOL;
			$codice=$codice.'# A stall happens here'.PHP_EOL;
			$codice=$codice.'add t1, t0, x0';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "syscall":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This programs demonstrates'.PHP_EOL;
			$codice=$codice.'# the behavior of syscalls.'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi a7, x0, 5 # read int syscall code'.PHP_EOL;
			$codice=$codice.'ecall'.PHP_EOL;
			$codice=$codice.'addi a7, x0, 1  # print int syscall code'.PHP_EOL;
			$codice=$codice.'ecall'.PHP_EOL;
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		default:
			$_SESSION['codice']='';
			$_SESSION['asmName']='not loaded';
			$_SESSION['inserted']=false;
			header("Location: editor.php");
			break;
	}
}
else {
	switch ($cosa)
	{
		case "calculator":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This program serves as a simple'.PHP_EOL;
			$codice=$codice.'# 4 operation calculator between'.PHP_EOL;
			$codice=$codice.'# the two operands in s1 and s2'.PHP_EOL;
			$codice=$codice.'# the operation is choosen in s0'.PHP_EOL;
			$codice=$codice.'# add       s0 = 1'.PHP_EOL;
			$codice=$codice.'# sub       s0 = 2'.PHP_EOL;
			$codice=$codice.'# mul       s0 = 3'.PHP_EOL;
			$codice=$codice.'# div       s0 = 4'.PHP_EOL;
			$codice=$codice.'# operand 1  = s1'.PHP_EOL;
			$codice=$codice.'# operand 2  = s2'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi s0, x0, 1'.PHP_EOL;
			$codice=$codice.'addi s1, x0, 5'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 1'.PHP_EOL;
			$codice=$codice.'beq s0, t0, somma'.PHP_EOL;
			$codice=$codice.'addi s2, x0, 10'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 2'.PHP_EOL;
			$codice=$codice.'beq s0, t1, sottrazione'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'addi t2, x0, 3'.PHP_EOL;
			$codice=$codice.'beq s0, t2, molt'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'addi t3, x0, 4'.PHP_EOL;
			$codice=$codice.'beq s0, t3, div'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'somma:'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'add s3, s1, s2'.PHP_EOL;
			$codice=$codice.'sottrazione:'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'sub s3, s1, s2'.PHP_EOL;
			$codice=$codice.'molt:'.PHP_EOL;
			$codice=$codice.'j fine'.PHP_EOL;
			$codice=$codice.'mul s3, s1, s2'.PHP_EOL;
			$codice=$codice.'div:'.PHP_EOL;
			$codice=$codice.'div s3, s1, s2'.PHP_EOL;
			$codice=$codice.'fine:';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "memory":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This program copies a 10-element vector'.PHP_EOL;
			$codice=$codice.'# into another vector'.PHP_EOL;
			$codice=$codice.'# Addresses of the two vectors'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi s0, x0, 4'.PHP_EOL;
			$codice=$codice.'addi s1, x0, 44'.PHP_EOL;
			$codice=$codice.'# Initializing with some values'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 10'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 1'.PHP_EOL;
			$codice=$codice.'add s2, s0, x0'.PHP_EOL;
			$codice=$codice.'Inserimento:'.PHP_EOL;
			$codice=$codice.'beq t0, t1, FineInserimento'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'addi s2, s2, 4'.PHP_EOL;
			$codice=$codice.'sw t1, 0(s2)'.PHP_EOL;
			$codice=$codice.'addi t1, t1, 1'.PHP_EOL;
			$codice=$codice.'j Inserimento'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'FineInserimento:'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 1'.PHP_EOL;
			$codice=$codice.'add s2, s0, x0'.PHP_EOL;
			$codice=$codice.'add s3, s1, x0'.PHP_EOL;
			$codice=$codice.'# Procedure stars here'.PHP_EOL;
			$codice=$codice.'Copia:'.PHP_EOL;
			$codice=$codice.'beq t0, t1, FineProgramma'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'addi s2, s2, 4'.PHP_EOL;
			$codice=$codice.'lw t2, 0(s2)'.PHP_EOL;
			$codice=$codice.'addi s3, s3, 4'.PHP_EOL;
			$codice=$codice.'addi t1, t1, 1'.PHP_EOL;
			$codice=$codice.'j Copia'.PHP_EOL;
			$codice=$codice.'sw t2, 0(s3)'.PHP_EOL;
			$codice=$codice.'FineProgramma:';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "factorial":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# Compute the factorial of n (n!)'.PHP_EOL;
			$codice=$codice.'# int factorialRec(int n) {'.PHP_EOL;
			$codice=$codice.'#    if (n<2) { return 1; }'.PHP_EOL;
			$codice=$codice.'#    else { return n*factorial(n-1); }'.PHP_EOL;
			$codice=$codice.'# }'.PHP_EOL;
			$codice=$codice.'# a2 = n'.PHP_EOL;
			$codice=$codice.'# a0 = result'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'j main'.PHP_EOL;
			$codice=$codice.'addi x0, x0, 0 #NOP'.PHP_EOL;
			$codice=$codice.'factorialRec:'.PHP_EOL;
			$codice=$codice.'addi sp, sp, -8'.PHP_EOL;
			$codice=$codice.'sw a2, 0(sp)'.PHP_EOL;
			$codice=$codice.'#if (n < 2) do return 1'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 2	'.PHP_EOL;
			$codice=$codice.'#else return n*factorialRec(n-1)'.PHP_EOL;
			$codice=$codice.'slt t0, a2, t0	'.PHP_EOL;
			$codice=$codice.'beq t0, x0, anotherCall'.PHP_EOL;
			$codice=$codice.'sw ra, 4(sp)'.PHP_EOL;
			$codice=$codice.'#recursive anchor'.PHP_EOL;
			$codice=$codice.'lw a2, 0(sp)'.PHP_EOL;
			$codice=$codice.'lw ra, 4(sp)'.PHP_EOL;
			$codice=$codice.'addi sp, sp, 8'.PHP_EOL;
			$codice=$codice.'jr ra'.PHP_EOL;
			$codice=$codice.'addi a0, x0, 1'.PHP_EOL;
			$codice=$codice.'anotherCall:'.PHP_EOL;
			$codice=$codice.'jal factorialRec'.PHP_EOL;
			$codice=$codice.'addi a2, a2, -1'.PHP_EOL;
			$codice=$codice.'lw ra, 4(sp)'.PHP_EOL;
			$codice=$codice.'lw a2, 0(sp)'.PHP_EOL;
			$codice=$codice.'addi sp, sp, 8'.PHP_EOL;
			$codice=$codice.'jr ra'.PHP_EOL;
			$codice=$codice.'mul a0, a2, a0'.PHP_EOL;
			$codice=$codice.'main:'.PHP_EOL;
			$codice=$codice.'jal factorialRec'.PHP_EOL;
			$codice=$codice.'addi a2, x0, 5'.PHP_EOL;
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "hazard":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This programs does nothing...'.PHP_EOL;
			$codice=$codice.'# It demonstrate the behavior'.PHP_EOL;
			$codice=$codice.'# of forwarding unit'.PHP_EOL;
			$codice=$codice.'# in case of data hazards.'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 1'.PHP_EOL;
			$codice=$codice.'addi t1, x0, 2'.PHP_EOL;
			$codice=$codice.'addi t2, x0, 3'.PHP_EOL;
			$codice=$codice.'add t0, t1, t2'.PHP_EOL;
			$codice=$codice.'# Hazard at first level'.PHP_EOL;
			$codice=$codice.'add t2, t0, t0'.PHP_EOL;
			$codice=$codice.'# Hazard at second level'.PHP_EOL;
			$codice=$codice.'add t3, t0, t2';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');        
			break;
			
		case "stall":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This program does nothing...'.PHP_EOL;
			$codice=$codice.'# It demonstrates the behavior'.PHP_EOL;
			$codice=$codice.'# of the hazard detection unit'.PHP_EOL;
			$codice=$codice.'# by creating a stall condition'.PHP_EOL;
			$codice=$codice.'# This is the only case when the'.PHP_EOL;
			$codice=$codice.'# forwarding unit cannot handle'.PHP_EOL;
			$codice=$codice.'# a data hazard.'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi t0, x0, 10'.PHP_EOL;
			$codice=$codice.'addi  sp, x0, 0'.PHP_EOL;
			$codice=$codice.'sw t0, 0(sp)'.PHP_EOL;
			$codice=$codice.'add t1, t0, t0'.PHP_EOL;
			$codice=$codice.'lw t0, 0(sp)'.PHP_EOL;
			$codice=$codice.'# A stall happens here'.PHP_EOL;
			$codice=$codice.'add t1, t0, x0';
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;
			
		case "syscall":
			$codice='';
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'# This programs demonstrates'.PHP_EOL;
			$codice=$codice.'# the behavior of syscalls.'.PHP_EOL;
			$codice=$codice.'####################################'.PHP_EOL;
			$codice=$codice.'addi a7, x0, 5 # read int syscall code'.PHP_EOL;
			$codice=$codice.'ecall'.PHP_EOL;
			$codice=$codice.'addi a7, x0, 1  # print int syscall code'.PHP_EOL;
			$codice=$codice.'ecall'.PHP_EOL;
			$_SESSION['codice']=$codice;
			$_SESSION['asmName']=$cosa.'.s';
			header('Location: editor.php');
			break;

		default:
			$_SESSION['codice']='';
			$_SESSION['asmName']='not loaded';
			$_SESSION['inserted']=false;
			header("Location: editor.php");
			break;
	}
}
?>
