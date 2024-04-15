<?php

namespace Vehicles\Petrol;

use Vehicles\FuelVehicle;
use Vehicles\Vehicle;

class PetrolVehicle extends Vehicle implements FuelVehicle
{
    private $stavFilteru;
    public function __construct($znacka, $objemNadrze, $spotreba)
    {
        parent::__construct($znacka, $objemNadrze, $spotreba);
        $this->stavFilteru = 100;
    }
    public function getFilterStav(){
        return $this->stavFilteru;
    }

    // degrade filter by degradation

    public function degradeFilter($degradation){
        $this->stavFilteru = ($this->stavFilteru - $degradation);
    }

    public function replaceFilter(){
        $this->stavFilteru = 100;
    }

}


$myPetrolVehicle = new PetrolVehicle("skoda", 45, 6);
echo " . $this->znacka stav paliva "  . $myPetrolVehicle->getRemainingFuel() . "liters";
