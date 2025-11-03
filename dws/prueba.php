<?php
class perro{

    private $nombre;
    private $edad;
    public $raza;

    public function __constructor($nombre, $edad, $raza){

        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->raza = $raza;

    }

    public function ladrar(){
        echo "afw";
    }

    public function getNombre(){
        return $this->nombre;
    }


}

$perro = new perro("lol",14,"golden retrover");
$perro ->ladrar();