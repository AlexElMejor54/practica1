<?php

/**
 * Configuración de la base de datos.
 * Cambia estos valores si tu MySQL usa otro usuario o contraseña.
 */
define('HOST', 'localhost');
define('DBNAME', 'colegio');
define('USER', 'root');
define('PASSWORD', '');

/**
 * Clase Database: crea y devuelve la conexión PDO a MySQL.
 * Se usa en getUsuario.php, deleteUsuario.php, crearUsuario2.php y modificarUsuario.php.
 */
class Database
{
    /** @var PDO Objeto de conexión a la base de datos */
    private $conexion;

    /**
     * Conecta con MySQL usando PDO.
     * Si falla, el script se detiene (die).
     */
    public function __construct()
    {
        try {
            $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8";
            $this->conexion = new PDO($dsn, USER, PASSWORD);
            // Así los errores de PDO lanzan excepciones en lugar de solo avisos
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexion: " . $e->getMessage());
        }
    }

    /**
     * Devuelve el objeto PDO para hacer consultas (SELECT, INSERT, etc.).
     * @return PDO
     */
    public function getConexion()
    {
        return $this->conexion;
    }
}