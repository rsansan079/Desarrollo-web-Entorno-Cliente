<?php
// Clase para gestionar la conexión a la base de datos
class Conexion {
    public $pdo;

    public function __construct() {
        try {
            // Configuración de la base de datos
            $dsn = "mysql:host=localhost;dbname=futbol";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            $this->pdo = new PDO($dsn, "root", "", $options);
        } catch (PDOException $e) {
            die(json_encode(["error" => "Error de conexión: " . $e->getMessage()]));
        }
    }
}

// Manejo de solicitudes mediante $_GET
if (isset($_GET['accion'])) {
    $conexion = new Conexion();

    switch ($_GET['accion']) {
        case 'equipos':
            // Obtener la lista de equipos
            $sql = "SELECT id_equipo, nombre FROM equipos";
            $pdostmt = $conexion->pdo->query($sql);
            $resultados = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultados);
            break;

        case 'jugador_unico':
            // Obtener un jugador representativo de un equipo
            $id_equipo = isset($_GET['id_equipo']) ? (int)$_GET['id_equipo'] : 0;

            if ($id_equipo > 0) {
                $sql = "SELECT j.id_jugador, j.nombre, j.apellidos, j.edad, j.posicion, j.nacionalidad
                        FROM jugadores j
                        WHERE j.id_equipo = :id_equipo
                        LIMIT 1"; // Seleccionar un solo jugador
                $pdostmt = $conexion->pdo->prepare($sql);
                $pdostmt->execute(['id_equipo' => $id_equipo]);
                $jugador = $pdostmt->fetch(PDO::FETCH_ASSOC);

                if ($jugador) {
                    echo json_encode($jugador);
                } else {
                    echo json_encode(["error" => "No se encontró un jugador para el equipo seleccionado."]);
                }
            } else {
                echo json_encode(["error" => "ID de equipo inválido."]);
            }
            break;

        default:
            echo json_encode(["error" => "Acción no válida."]);
            break;
    }
} else {
    echo json_encode(["error" => "No se especificó ninguna acción."]);
}
?>