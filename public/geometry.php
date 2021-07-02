<?php

use Kilo\Geometry\Geometry;
use Kilo\Geometry\Shape\Square;

require_once '../vendor/autoload.php';

$square = new Square(2);
$geometry = new Geometry($square);

echo '<pre>';

echo '<strong>Square:</strong><br/>';

echo 'Area: ' . $geometry->area();

echo '<br/>';

echo 'Perimeter: ' . $geometry->perimeter();
