<?php
class Coche {
    public $color;
    public $marca;
    public $modelo;
    public $velocidad;
    public $caballaje;
    public $plazas;

    public function __construct($color, $marca, $modelo, $velocidad, $caballaje, $plazas){
        $this->color = $color;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->velocidad = $velocidad;
        $this->caballaje = $caballaje;
        $this->plazas = $plazas;
    }

    public function getColor(){ return $this->color; }
    public function setColor($color){ $this->color = $color; }

    public function getMarca(){ return $this->marca; }
    public function setMarca($marca){ $this->marca = $marca; }

    public function getModelo(){ return $this->modelo; }
    public function setModelo($modelo){ $this->modelo = $modelo; }

    public function getVelocidad(){ return $this->velocidad; }
    public function setVelocidad($velocidad){ $this->velocidad = $velocidad; }

    public function getCaballaje(){ return $this->caballaje; }
    public function setCaballaje($caballaje){ $this->caballaje = $caballaje; }

    public function getPlazas(){ return $this->plazas; }
    public function setPlazas($plazas){ $this->plazas = $plazas; }

    public function acelerar(){ $this->velocidad++; }
    public function frenar(){ $this->velocidad--; }
    public function getVelocidadActual(){ return $this->getVelocidad(); }

    public function mostrarInformacion($coche){
        echo "Información del coche: <br>";
        echo "Color: " . $coche->getColor() . "<br>";
        echo "Marca: " . $coche->getMarca() . "<br>";
        echo "Modelo: " . $coche->getModelo() . "<br>";
        echo "Velocidad: " . $coche->getVelocidad() . "<br>";
        echo "Caballaje: " . $coche->getCaballaje() . "<br>";
        echo "Plazas: " . $coche->getPlazas() . "<br>";
    }
}

$coche = new Coche("Amarillo", "Renault", "Clio", 150, 200, 5);
$coche1 = new Coche("Verde", "Seat", "Panda", 250, 200, 5);
$coche2 = new Coche("Azul", "Citroen", "Xara", 100, 220, 4);
$coche3 = new Coche("Rojo", "Mercedes", "Clase A", 350, 100, 3);

// Probar métodos
$coche->setColor("Rosa");
$coche->setMarca("Audi");

$coche->mostrarInformacion($coche);

$coche1->mostrarInformacion($coche1);
$coche2->mostrarInformacion($coche2);
$coche3->mostrarInformacion($coche3);
?>
