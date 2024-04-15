<?php

namespace Vehicles;

interface FuelVehicle
{
    public function getRemainingFuel();
    public function refill($amount);
    public function drive($distance);
}