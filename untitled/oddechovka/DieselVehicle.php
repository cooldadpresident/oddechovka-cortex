<?php

namespace Vehicles\Diesel;

use Vehicles\FuelVehicle;
use Vehicles\Vehicle;

class DieselVehicle extends Vehicle implements FuelVehicle
{
private $stavSvicek;

public function __construct($znacka, $objemNadrze, $spotreba)
{
    parent::__construct($znacka, $objemNadrze, $spotreba);
    $this->stavSvicek = 100;
}
public function getGlowPlugHealth() {
    return $this->stavSvicek;
}

public function degradeGlowPlug($degradation) {
    $this->stavSvicek = $this->stavSvicek - $degradation;
}

public function replaceGLowPlug(){
    $this->stavSvicek = 100;
}
}