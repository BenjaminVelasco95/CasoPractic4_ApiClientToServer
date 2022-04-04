<?php
    require_once("lib/nusoap.php");
    $cliente = new nusoap_client('http://localhost/SW/Caso%20Pr%C3%A1ctico%204/Servidor/Server.php');
    
    //$modelo=$_POST['modelo'];
    //$color=$_POST['color'];
    //$existencia=$_POST['existencia'];
    //$id_tenis=$_POST['id_tenis'];
    //echo $addtenis = $cliente->call('AddTenis', array('modelo'=>$modelo,'color'=>$color,'existencia'=>$existencia));
    echo $resultado[] = $cliente->call('GetTenis',array());
    var_dump($resultado);

?>