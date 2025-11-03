<?php
class configuracion{
    static $color = "rojo";
    static $newsletter = "Arial";
    static $entorno = "Desarrollo";

    public static function getColor(){ return self::$color; }
    public static function setColor($color){ self::$color = $color; }
    public static function getNewsletter(){ return self::$newsletter; }
    public static function setNewsletter($newsletter){ self::$newsletter = $newsletter; }
    public static function getEntorno(){ return self::$entorno; }
    public static function setEntorno($entorno){ self::$entorno = $entorno; }
}
Configuracion::setColor("verde");
Configuracion::setNewsletter(true);
Configuracion::setEntorno("desarrollo");

echo "Color: " . Configuracion::getColor() . "<br>";
echo "Newsletter: " . (Configuracion::getNewsletter() ? "Activo" : "Inactivo") . "<br>";
echo "Entorno: " . Configuracion::getEntorno() . "<br>";
?>
