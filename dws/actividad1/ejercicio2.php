<?php
    class persona{
        public $nombre;
        public $apellido;
        public $altura;
        public $edad;
        public function __construct($nombre, $apellido, $altura, $edad){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->altura = $altura;
            $this->edad = $edad;
        }
        public function getNombre(){ return $this->nombre; }
        public function setNombre($nombre){ $this->nombre = $nombre; }
        public function getApellido(){ return $this->apellido; }
        public function setApellido($apellido){ $this->apellido = $apellido; }
        public function getAltura(){ return $this->altura; }
        public function setAltura($altura){ $this->altura = $altura; }
        public function getEdad(){ return $this->edad; }
        public function setEdad($edad){ $this->edad = $edad; }
        public function hablar(){
            return "Estoy hablando";
        }
        public function caminar(){
            return "Estoy caminando";
        }

    }
    class informatico extends persona{
        public $lenguajes;
        public $experiencia;

        public function getLenguajes(){ return $this->lenguajes; }
        public function setLenguajes($lenguajes){ $this->lenguajes = $lenguajes; }
        public function getExperiencia(){ return $this->experiencia; }
        public function setExperiencia($experiencia){ $this->experiencia = $experiencia ;}

        public function __construct($nombre = "Pepe", $apellido = "Garcia", $altura = 1.75, $edad = 25, $lenguajes = "HTML, CSS y JS", $experiencia = 5){
            parent::__construct($nombre, $apellido, $altura, $edad); 
            $this->lenguajes = $lenguajes;
            $this->experiencia = $experiencia;
        }

        public function programar(){
            return "Estoy programando";
        }
        public function repararOrdenador(){
            return "He reparado el ordenador";
        }
        public function hacerOfimatica(){
            return "Estoy escribiendo en word";
        }    
    }
    class tecnicoRedes extends informatico{
        public $auditarRedes;
        public $experiencia;

        public function getAuditarRedes(){ return $this->auditarRedes; }
        public function setAuditarRedes($auditarRedes){ $this->auditarRedes = $auditarRedes; }
        public function getExperiencia(){ return $this->experiencia; }
        public function setExperiencia($experiencia){ $this->experiencia = $experiencia ;}

        public function __construct($nombre = "Pepe", $apellido = "Garcia", $altura = 1.75, $edad = 25, $lenguajes = "HTML, CSS y JS", $experiencia = 5, $auditarRedes = "Experto"){
            parent::__construct($nombre, $apellido, $altura, $edad, $lenguajes, $experiencia);
            $this->auditarRedes = $auditarRedes;
            $this->experiencia = $experiencia;
        }

        public function auditar(){
            return "Estoy auditando una red";
        }
    }
    
    $persona = new persona("Pepe","Garcia",1.75,25);
    echo $persona->getNombre()."<br>";
    echo $persona->hablar()."<br>";
    echo $persona->caminar()."<br>";
    echo "<br>";
    $informatico = new informatico();
    echo $informatico->programar()."<br>";
    echo $informatico->repararOrdenador()."<br>";
    echo $informatico->hacerOfimatica()."<br>";
    echo "<br>";
    $tecnicoRedes = new tecnicoRedes();
    echo $tecnicoRedes->auditar()."<br>";
    echo $tecnicoRedes->programar()."<br>";
    echo $tecnicoRedes->repararOrdenador()."<br>";
    echo $tecnicoRedes->hacerOfimatica()."<br>";
    echo $tecnicoRedes->hablar()."<br>";
    echo $tecnicoRedes->caminar()."<br>";
    var_dump($tecnicoRedes);
?>
