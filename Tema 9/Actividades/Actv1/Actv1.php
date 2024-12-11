<?php 


class Config{

    public function __construct(){

    define('SERVER', 'localhost');
    define('USER', 'root');
    define ('PASS', null);
    define('BD', 'tema10');
    define('CHARSET', 'utf8mb4');
    define('COLLECTION', 'utf8mb4_unicode_ci');
    }
}



class Class_datos{

    public $id;
    public $nombre;
    public $apellidos;
    public $ciudad;
  

    public function __construct(
        $id = null,
        $nombre = null,
        $apellidos = null,
        $ciudad = null,
        
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->ciudad = $ciudad;
      
    }
}



class Class_conexion extends  Config
{

    // objeto de la clase pdo
    public $pdo;

    public function __construct(   
    ) {
        try {

            // nombre fuente de datos
            $dsn = "mysql:host=" . SERVER . ";dbname=". BD;

            // array de opciones para la clase pdo
            $options = [

                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT =>  false,
                PDO::ATTR_EMULATE_PREPARES =>  false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".CHARSET. " COLLATE ". COLLECTION

            ];

            // realizo la conexión
            $this->pdo = new PDO($dsn, USER, PASS, $options);

        } catch (PDOException $e) {

            // error de  base dedatos
            include 'views/partials/errorDB.php';

            // cierro conexión
            $this->pdo = null;

            // cancelo ejecución programa
            exit();

        }
    }

}








class Class_Persona extends Class_conexion {


public function getNombre($nombre){


    try{


        $sql="
        SELECT
                    datos.nombre
                    FROM
                     datos 
                    LEFT JOIN datos ON datos.nombre_persona = datos.nombre
                    GROUP BY datos.nombre
                    ORDER BY datos.nombre;
                    ";

                    $stmt = $this->pdo->prepare($sql);

                    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);

                    $stmt->setFetchMode(PDO::FETCH_OBJ);

                    $stmt->execute();

                    return $stmt;
    }catch(PDOException $e){

        $stmt= null;
        $this->pdo = null;

        exit();
    }

}





public function getDatos(){

try{


$sql = "SELECT
id, nombre , apellidos , ciudad FROM datos WHERE nombre = :nombre ";


$stmt = $this->pdo->prepare($sql);

$stmt->bindParam(':nombre' , $nombre , PDO::PARAM_STR);

$stmt->setFetchMode(PDO::FETCH_OBJ);

$stmt->execute();

return $stmt->fetch();


} catch(PDOException $e){

$stnt = null;

$this->pdo = null;

exit();

}



}







}