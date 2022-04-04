<?php
    require_once("lib/nusoap.php");
    require_once ("Conexion.php");
    ///////////////////////////////////////////////
        $ns="http://localhost/SW/Caso%20Pr%C3%A1ctico%204/Servidor/";
        $server = new soap_server();
        $server->configureWSDL('tenisCRUDService',$ns);
        $server->wsdl->schemaTargetNamespace=$ns;
        $server->register(
            'AddTenis',
            array('modelo'=>'xsd:string','color'=>'xsd:string','existencias'=>'xsd:int'),
            array('return'=>'xsd:string'),
            'urn:tenisCRUDService', //namespace
            'urn:tenisCRUDService#addTenis',//soapction
            'rpc',
            'encoded',
            'Crea un registro en la tabla tenis con nusoap'
        );
    
        function AddTenis($modelo, $color, $existencia){
            try {
                $conexion=new Conexion();
                $consulta=$conexion->prepare("INSERT INTO tenis(modelo, color, existencias)
                VALUES(:modelo, :color, :existencia)");
                $consulta->bindParam(":modelo",$modelo,PDO::PARAM_STR);
                $consulta->bindParam(":color",$color,PDO::PARAM_STR);
                $consulta->bindParam(":existencia",$existencia,PDO::PARAM_STR);
                $consulta->execute();
                $ultimoId=$conexion->LastInsertId();
                return join(",",array($ultimoId));
            } catch (Exeption $th) {
                return $th->getMessage();
            }
        }
        ///////////////////////////////////////////////
        $server->register(
            'ModTenis',
            array('id_tenis'=>'xsd:int','modelo'=>'xsd:string','color'=>'xsd:string','existencias'=>'xsd:int'),
            array('return'=>'xsd:string'),
            'urn:tenisCRUDService', //namespace
            'urn:tenisCRUDService#ModTenis',//soapction
            'rpc',
            'encoded',
            'Modifica un registro en la tabla tenis con nusoap'
        );
    
        function ModTenis($idTenis, $modelo, $color, $existencia){
            try {
                $conexion=new Conexion();
                $consulta=$conexion->prepare("UPDATE tenis SET modelo=:modelo,color=:color,existencias=:existencia WHERE id_tenis=:idTenis");
                $consulta->bindParam(":modelo",$modelo,PDO::PARAM_STR);
                $consulta->bindParam(":color",$color,PDO::PARAM_STR);
                $consulta->bindParam(":existencia",$existencia,PDO::PARAM_STR);
                $consulta->bindParam(":idTenis",$idTenis,PDO::PARAM_STR);
                $consulta->execute();
                $ultimoId=$conexion->LastInsertId();
                return join(",",array($ultimoId));
            } catch (Exeption $th) {
                return $th->getMessage();
            }
        }
        ///////////////////////////////////////////////
        $server->register(
            'DellTenis',
            array('id_tenis'=>'xsd:int'),
            array('return'=>'xsd:string'),
            'urn:tenisCRUDService', //namespace
            'urn:tenisCRUDService#DellTenis',//soapction
            'rpc',
            'encoded',
            'Elimina un registro en la tabla tenis con nusoap'
        );
        function DellTenis($idTenis){
            try {
                $conexion=new Conexion();
                $consulta=$conexion->prepare("DELETE FROM tenis WHERE id_tenis=:idTenis");
                $consulta->bindParam(":idTenis",$idTenis,PDO::PARAM_STR);
                $consulta->execute();
                $ultimoId=$conexion->LastInsertId();
                return join(",",array($ultimoId));
            } catch (Exeption $th) {
                return $th->getMessage();
            }
        }
        ///////////////////////////////////////////////
        $server->register(
            'GetTenis',
            array(),
            array('return'=>'xsd:array'),
            'urn:tenisCRUDService', //namespace
            'urn:tenisCRUDService#GetTenis',//soapction
            'rpc',
            'encoded',
            'Obtiene los registros en la tabla tenis con nusoap'
        );
        function GetTenis(){
            try {
                $conexion=new Conexion();
                $consulta=$conexion->prepare("SELECT * FROM tenis");
                $consulta->execute();
                $consulta->setFetchMode(PDO::FETCH_ASSOC);
                $result = $consulta->setFetchMode(PDO::FETCH_NUM);
                /*while($fila=$consulta->fetch()){
                    print $fila[0]."\t".$fila[1]."\t".$fila[2]."\n";
                }*/
                return $fila=$consulta->fetch();
            } catch (Exeption $th) {
                return $th->getMessage().'<br>';
            }
        }
        ///////////////////////////////////////////////
        $post=file_get_contents('php://input');
        $server->service($post);
?>