<?php

interface iMac {
    public function encender();
    public function apagar();
    public function reiniciar();
}


class Computadora implements iMac {
    
    const MARCA = "Apple";

    public function encender() {
        echo "La computadora " . self::MARCA . " está encendida.<br>";
    }

    public function apagar() {
        echo "La computadora " . self::MARCA . " está apagada.<br>";
    }

    public function reiniciar() {
        echo "La computadora " . self::MARCA . " se está reiniciando.<br>";
    }
}

$miMac = new Computadora();
$miMac->encender();
$miMac->reiniciar();
$miMac->apagar();

echo "Marca: " . Computadora::MARCA;
