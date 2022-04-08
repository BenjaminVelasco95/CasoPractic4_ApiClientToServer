<?php
    require_once("lib/nusoap.php");//referencia libreria
    require_once ("Conexion.php");//referencia conexion
    ///////////////////////////////////////////////
        $ns="http://localhost/SW/CasoPrac4/CasoPrac4/Servidor/Server.php";
        $server = new soap_server(); //creacion del service y configuracion
        $server->configureWSDL('tenisCRUDService',$ns);
        $server->wsdl->schemaTargetNamespace=$ns;
        $server->register(//registro de metodos del servicio
            'AddTenis',
            array('modelo'=>'xsd:string','color'=>'xsd:string','existencias'=>'xsd:int'),
            array('return'=>'xsd:string'),
            'urn:tenisCRUDService', //namespace
            'urn:tenisCRUDService#addTenis',//soapction
            'rpc',
            'encoded',
            'Crea un registro en la tabla tenis con nusoap'
        );
    
        function AddTenis($modelo, $color, $existencia){//metodo del agregar registro
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
    
        function ModTenis($idTenis, $modelo, $color, $existencia){//metodo del modificar registro
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
        function DellTenis($idTenis){//metodo del eliminar registro
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
                while($tabla = $consulta->fetch(PDO::FETCH_ASSOC)){
                    return $tabla;
                }
            } catch (Exeption $th) {
                return $th->getMessage().'<br>';
            }
        }
        ///////////////////////////////////////////////
        $post=file_get_contents('php://input');
        $server->service($post);
?>