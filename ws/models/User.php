<?php

require_once __DIR__ . '/../interfaces/IToJson.php';

/**
 * Clase User: representa un alumno (un registro de la tabla alumno).
 * Guarda los datos y los convierte a array o JSON para las respuestas.
 */
class User implements IToJson
{
    private $id;         // Id en la BD (null cuando aún no se ha guardado)
    private $nombre;
    private $apellidos;
    private $password;
    private $telefono;
    private $email;
    private $sexo;

    /**
     * @param string $nombre
     * @param string $apellidos
     * @param string $password
     * @param string $telefono
     * @param string $email
     * @param string $sexo
     * @param int|null $id Solo se usa cuando el alumno ya existe en la BD
     */
    public function __construct($nombre, $apellidos, $password, $telefono, $email, $sexo, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
    }

    // --- Getters (devuelven el valor de cada propiedad) ---
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSexo()
    {
        return $this->sexo;
    }

    // --- Setters (asignan un nuevo valor a cada propiedad) ---
    public function setId($v)
    {
        $this->id = $v;
    }
    public function setNombre($v)
    {
        $this->nombre = $v;
    }
    public function setApellidos($v)
    {
        $this->apellidos = $v;
    }
    public function setPassword($v)
    {
        $this->password = $v;
    }
    public function setTelefono($v)
    {
        $this->telefono = $v;
    }
    public function setEmail($v)
    {
        $this->email = $v;
    }
    public function setSexo($v)
    {
        $this->sexo = $v;
    }

    /**
     * Convierte el alumno a un array para meterlo en la respuesta JSON (data).
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'password' => $this->password,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'sexo' => $this->sexo
        ];
    }

    /**
     * Devuelve el usuario en formato JSON (string).
     * JSON_UNESCAPED_UNICODE evita que ñ, tildes, etc. salgan como \u00f1.
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}