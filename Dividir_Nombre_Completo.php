<?php
	$full_name='INGRESA AQUI EL NOMBRE COMPLETO';
	
	/* separar el nombre completo en espacios */
	$tokens=explode(' ',trim($full_name));
	/* arreglo donde se guardan las "palabras" del nombre */
	$names = array();
	/* palabras de apellidos (y nombres) compuetos */
	$special_tokens=array('-', 'd', 'viuda', 'vda', 'vda.', 'vda.de', '', 'vd', 'vd.', 'viud', 'da', 'de', 'del', 'la', 'las', 'los', 'mac', 'mac.','mc', 'mc.', 'van', 'von', 'y', 'san', 'santa');
	$prev = "";
	
	/* DIVIDE LAS PALABRAS NORMALES DE LOS COMPUESTOS, LOS COMPUESTOS LOS JUNTA EJM: ARRAY[0]=>DE LA CRUZ*/
	foreach($tokens as $token){
		$_token=strtolower($token);
		if(in_array($_token, $special_tokens)){
			$prev.=$token." ";
		}		
		else{
			$names[]=$prev.$token." ";
			$prev="";
		}
	}
	
	/* limpiamos variables y contamos */
	$num_nombres=count($names);
	$nombres="";$apellidos="";	
	/* PRINT_R($names);ECHO $num_nombres; */
	
	/* algoritmo que divide los nombres con los nombres mas usados en español*/
	if($num_nombres==0){$nombres='';$apellidos='';}
	elseif($num_nombres==1){$apellidos=$names[0];$nombres=$names[0];}
	elseif($num_nombres==2){$apellidos=$names[0];$nombres=$names[1];}
	elseif($num_nombres==3){
		$de1=strtolower(substr($names[2], 0, 3));$de2=strtolower(substr($names[1], 0, 3));
		$de4=strtolower(substr($names[2], 0, 4));$de5=strtolower(substr($names[1], 0, 4));
		$vi1=strtolower(substr($names[2], 0, 5));$vi2=strtolower(substr($names[1], 0, 5));
		if($de2=='de ' or $de2=='vda' or $vi2=='viuda' or $de5=='del '){
			$apellidos=$names[0]." ".$names[1];$nombres=$names[2];}
		elseif($de1=='de ' or $de1=='vda' or $vi1=='viuda' or $de4=='del '){
			$apellidos=$names[0]." ".$names[1]." ".$names[2];$nombres="";}		
		else{$apellidos=$names[0]." ".$names[1];$nombres=$names[2];}
	}
	elseif($num_nombres==4){
		$de1=strtolower(substr($names[2], 0, 3));$de2=strtolower(substr($names[1], 0, 3));
		$de4=strtolower(substr($names[2], 0, 4));$de5=strtolower(substr($names[1], 0, 4));
		$vi1=strtolower(substr($names[2], 0, 5));$vi2=strtolower(substr($names[1], 0, 5));
		if($de2=='de ' or $de2=='vda' or $de2==' vd' or $de5=='del ' or $vi2=='viuda'){
			$apellidos=$names[0]." ".$names[1];$nombres=$names[2]." ".$names[3];}
		elseif(($de1=='jua' and $de3=='de ') or ($de1=='flo' and $de3=='de ')){$apellidos=$names[0]." ".$names[1];$nombres=$names[2]." ".$names[3];}
		elseif($de1=='de ' or $de1=='vda' or $de1==' vd' or $de4=='del ' or $vi1=='viuda'){
			$apellidos=$names[0]." ".$names[1]." ".$names[2];$nombres=$names[3];}
		else{$apellidos=$names[0]." ".$names[1];$nombres=$names[2]." ".$names[3];} 
	}
	else{
		$de1=strtolower(substr($names[2], 0, 3));$de2=strtolower(substr($names[1], 0, 3));$de3=strtolower(substr($names[3], 0, 3));
		$de4=strtolower(substr($names[2], 0, 4));$de5=strtolower(substr($names[1], 0, 4));$de6=strtolower(substr($names[3], 0, 4));
		$vi1=strtolower(substr($names[2], 0, 5));$vi2=strtolower(substr($names[1], 0, 5));$vi3=strtolower(substr($names[3], 0, 5));
		if($de2=='de ' or $de2=='vda' or $de2==' vd' or $de5=='del ' or $vi2=='viuda'){
			$apellidos=$names[0]." ".$names[1];
			unset($names[0]);unset($names[1]);
			$nombres=implode(' ', $names);}
		elseif($de1=='de ' or $de1=='vda' or $de1==' vd' or $de4=='del ' or $vi1=='viuda'){
			$apellidos=$names[0]." ".$names[1]." ".$names[2];
			unset($names[0]);unset($names[1]);unset($names[2]);
			$nombres=implode(' ', $names);}		
		elseif(($de1=='jua' and $de3=='de ') or ($de1=='flo' and $de3=='de ')){$apellidos=$names[0]." ".$names[1];unset($names[0]);unset($names[1]);$nombres=implode(' ', $names);}
		elseif($de3=='de ' or $de3=='vda' or $de3==' vd' or $de6=='del ' or $vi3=='viuda' or $de4=='d '){
			$apellidos=$names[0]." ".$names[1]." ".$names[2]." ".$names[3];
			unset($names[0]);unset($names[1]);unset($names[2]);unset($names[3]);
			$nombres=implode(' ', $names);}
		else{$apellidos=$names[0]." ".$names[1];unset($names[0]);unset($names[1]);$nombres=implode(' ', $names);}
	}

	$nombres=mb_convert_case($nombres, MB_CASE_TITLE, 'UTF-8');
	$apellidos=mb_convert_case($apellidos, MB_CASE_TITLE, 'UTF-8');
	echo  " Nombres: ".$nombres." Apellidos: ".$apellidos;

  ?>