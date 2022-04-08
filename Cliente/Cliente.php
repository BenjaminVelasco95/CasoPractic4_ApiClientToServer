<?php
    require_once("lib/nusoap.php");
    $cliente = new nusoap_client('http://localhost/SW/CasoPrac4/CasoPrac4/Servidor/Server.php');//referencia servidor
    
    
    $action=$_POST['accion'];
    
    switch($action){//agregar registro de tenis
        case '1';
        case "1";
        case 1;
            $modelo=$_POST['modelo'];
            $color=$_POST['color'];
            $existencia=$_POST['existencia'];
            echo '<h1> Agregado con exito con numero de ID: '.$addtenis = $cliente->call('AddTenis', array('modelo'=>$modelo,'color'=>$color,'existencia'=>$existencia)).'</h1>';
            break;
        case '2';//modifica registro de tenis
        case "2";
        case 2;
            $idTenis=$_POST['id_tenis'];
            $modelo=$_POST['modelo'];
            $color=$_POST['color'];
            $existencia=$_POST['existencia'];
            $ModTenis = $cliente->call('ModTenis', array('idTenis'=>$idTenis,'modelo'=>$modelo,'color'=>$color,'existencia'=>$existencia));
            echo '<h1>El tenis con ID '.$idTenis.' ah sido modificado</h1>'; 
            break;
        case '3';//elimina registro tenis
        case "3";
        case 3;
            $idTenis=$_POST['id_tenis'];
            $DellTenis = $cliente->call('DellTenis', array('idTenis'=>$idTenis));
            echo '<h1>El tenis con ID '.$idTenis.' ah sido Eliminado</h1>'; 
            break;
        case '4';//muestra registro tenis
        case "4";
        case 4;
            $GetTenis = $cliente->call('GetTenis', array());
            if ($cliente->fault){
				echo "<h2>fault</h2><pre>";
				print_r($GetTenis); 
				echo "</pre>";
			}

		else{
			$error = $cliente->getError(); 
			if($error){
				echo "<h2>Error</h2><pre>".$error."</pre>";
			}
			else{
				echo "<h2>Motos</h2><pre>";
				foreach($GetTenis as $resul){  
				echo $resul, " ";
				}
				echo "</pre>";
			    }
			}
            break;
        default:
            echo "ERROR Seleccione un numero de accion correcto!";
            break;
    }
    
    

?>