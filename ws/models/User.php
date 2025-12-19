<?php

require_once __DIR__ . '/../interfaces/IToJson.php';

class User implements IToJson {
    private $nombre;
    private $apellidos;
    private $contraseña;
    private $telefono;
    private $email;
    private $sexo;

    public function __construct($nombre, $apellidos, $contraseña, $telefono, $email, $sexo) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->contraseña = $contraseña;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->sexo = $sexo;
    }

    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getContraseña() { return $this->contraseña; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }
    public function getSexo() { return $this->sexo; }

    public function setNombre($v) { $this->nombre = $v; }
    public function setApellidos($v) { $this->apellidos = $v; }
    public function setContraseña($v) { $this->contraseña = $v; }
    public function setTelefono($v) { $this->telefono = $v; }
    public function setEmail($v) { $this->email = $v; }
    public function setSexo($v) { $this->sexo = $v; }

    public function toJson() {
        $data = [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'contraseña' => $this->contraseña,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'sexo' => $this->sexo
        ];
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
