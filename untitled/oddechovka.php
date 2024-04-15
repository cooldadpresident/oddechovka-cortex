<?php
namespace Vehicles;

// Interface for common functionality of Diesel and Petrol vehicles
interface FuelVehicle
{
    public function getRemainingFuel();
    public function refill($amount);
    public function drive($distance);


}

// Abstract class representing a base vehicle with common properties
abstract class Vehicle
{

    // declare protected properties

    protected static $id;
    protected $znacka; // Brand
    protected $objemNadrze; // Fuel tank capacity in liters
    protected $spotreba; // Fuel consumption in liters per 100 kilometers
    protected $stavPaliva; // Current fuel level in liters


    public function __construct($znacka, $objemNadrze, $spotreba)
    {
        // Data validation for positive values
        if ($objemNadrze <= 0 || $spotreba <= 0) {
            throw new InvalidArgumentException("Fuel tank capacity and consumption must be positive values");
        }
        $this->id =

        $this->znacka = $znacka;
        $this->objemNadrze = $objemNadrze;
        $this->spotreba = $spotreba;
        $this->stavPaliva = $objemNadrze; // Start with full tank

    }

    public function getRemainingFuel()
    {
        return $this->stavPaliva;
    }

    public function refill($amount)
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Refill amount must be positive");
        }

        $this->stavPaliva = min($this->objemNadrze, $this->stavPaliva + $amount);
    }

    public function drive($distance)
    {
        if ($this->isTankEmpty()) {
            throw new RuntimeException("Cannot drive with empty tank");
        }

        $fuelUsed = $distance * ($this->spotreba / 100);
        $this->stavPaliva -= $fuelUsed;
    }

    private function isTankEmpty()
    {
        return $this->stavPaliva <= 0;
    }
}

//namespace Vehicles\Diesel;

// Class representing a Diesel vehicle inheriting from Vehicle and implementing FuelVehicle interface
class DieselVehicle extends Vehicle implements FuelVehicle
{
    //private $id;
    private $stavSvicek; // Glow plug health (percentage)

    public function __construct($znacka, $objemNadrze, $spotreba)
    {
        parent::__construct($znacka, $objemNadrze, $spotreba);
        $this->stavSvicek = 100; // Start with new glow plugs
        $this->id = uniqid("vehicle_");

    }

    // Check glow plug health
    public function getZhaviciSvicekStav()
    {
        return $this->stavSvicek;
    }

    // Simulate glow plug degradation (example, adjust logic as needed)
    public function degradeZhaviciSvicek($degradation)
    {
        $this->stavSvicek = max(0, $this->stavSvicek - $degradation); // Ensure value stays between 0 and 100
    }

    // Replace glow plugs (set health to 100%)
    public function vymenZhaviciSvice()
    {
        $this->stavSvicek = 100;
    }


}

// Class representing a Petrol vehicle inheriting from Vehicle and implementing FuelVehicle interface
//namespace Vehicles\Petrol;

class PetrolVehicle extends Vehicle implements FuelVehicle
{
    //private $id;
    private $stavDPF; // Diesel Particulate Filter health (percentage)

    public function __construct($znacka, $objemNadrze, $spotreba)
    {
        parent::__construct($znacka, $objemNadrze, $spotreba);
        $this->stavDPF = 100; // Start with clean DPF
        $this->id = uniqid("vehicle_");

    }
    // Check DPF health
    public function getDPFStav()
    {
        return $this->stavDPF;
    }

    // Simulate DPF degradation (example, adjust logic as needed)
    public function degradeDPF($degradation)
    {
        $this->stavDPF = max(0, $this->stavDPF - $degradation); // Ensure value stays between 0 and 100
    }

    // Replace DPF (set health to 100%)
    public function vymenDPF()
    {
        $this->stavDPF = 100;
    }


}


// Example usage
$myDieselCar = new DieselVehicle("Audi", 60, 6.5);
$myPetrolCar = new PetrolVehicle("Skoda", 45, 8);

// Check initial fuel levels
echo "Audi (Diesel) fuel level: " . $myDieselCar->getRemainingFuel() . " liters\n";
echo "Skoda (Petrol) fuel level: " . $myPetrolCar->getRemainingFuel() . " liters\n";

// Simulate driving the Audi for 100 kilometers
$myDieselCar->drive(100);

// Check remaining fuel in Audi after driving
echo "Audi (Diesel) fuel level after driving 100km: " . $myDieselCar->getRemainingFuel() . " liters\n";

// Simulate degrading glow plugs in Audi by 10%
$myDieselCar->degradeZhaviciSvicek(10);

// Check glow plug health
echo "Audi (Diesel) glow plug health: " . $myDieselCar->getZhaviciSvicekStav() . "%\n";

// Refill both cars with 10 liters each
$myDieselCar->refill(10);
$myPetrolCar->refill(10);

// Check fuel levels after refill
echo "Audi (Diesel) fuel level after refill: " . $myDieselCar->getRemainingFuel() . " liters\n";
echo "Skoda (Petrol) fuel level after refill: " . $myPetrolCar->getRemainingFuel() . " liters\n";
?>

/*
$myDieselCar = new DieselVehicle("skoda", 32, 7.6);
// extract vehicle properties
//$brand = $myDieselCar->znacka;
$capacity = $myDieselCar->objemNadrze;
$consumption = $myDieselCar->spotreba;
?>
<!DOCTYPE html>
<html>

<head>
    <title> Diesel Vehicle Details</title>
</head>

<body>
<h1>Diesel Vehicle Details</h1>
<table>
    <tr>
        <th>Brand</th>
        <td><?php echo $brand; ?></td>
    </tr>
    <tr>
        <th>Fuel tank capacity (liters) </th>
        <td><?php echo $capacity; ?>
    </tr>
    <tr>
        <th>Fuel consumption (liters/100km)</th>
        <td> <?php echo $consumption; ?></td>
    </tr>
</table>
</body>

</html>
*/