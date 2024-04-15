<?php

namespace Vehicles;

use http\Exception\InvalidArgumentException;
use http\Exception\RuntimeException;

Abstract class Vehicle
{
    // declare protected properties

    protected static $id = 1;
    protected $car_id;
    protected $znacka;
    protected $objemNadrze;
    protected $spotreba;
    protected $stavPaliva;

    public function __construct($znacka, $objemNadrze, $spotreba)
    {
        // data validation, only positive values
        if ($objemNadrze <= 0 || $spotreba <= 0) {
            throw new InvalidArgumentException("Objem nadrze a spotreba musi mit kladnou hodnotu");
        }
        $this->car_id = self::$id++;
        $this->objemNadrze = $objemNadrze;
        $this->spotreba = $spotreba;
        $this->stavPaliva = $objemNadrze;
        }
    public function getRemainingFuel(){
        return $this->stavPaliva;
    }
    public function refill($amount){
        if ($amount <= 0){
            throw new InvalidArgumentException("Refill must be positive");
        }
        $this->stavPaliva = $this->stavPaliva + $amount;
    }
    public function drive($distance){
        if ($this->isTankEmpty()){
            throw new RuntimeException("Cannot drive with an empty tank");
        }
        $fuelUsed = $distance ($this->spotreba / 100);
        $this->stavPaliva -= $fuelUsed;
    }
    private function isTankEmpty(){
        return $this->stavPaliva <= 0;
    }

}