<?php

use Netzmacht\JavascriptBuilder\Builder;
use Netzmacht\JavascriptBuilder\Encoder\ChainEncoder;
use Netzmacht\JavascriptBuilder\Encoder\JavascriptEncoder;
use Netzmacht\JavascriptBuilder\Encoder\MultipleObjectsEncoder;
use Netzmacht\JavascriptBuilder\Output;
use Netzmacht\JavascriptBuilder\Symfony\EventDispatchingEncoder;
use Netzmacht\LeafletPHP\Definition\Map;
use Netzmacht\LeafletPHP\Definition\Raster\TileLayer;
use Netzmacht\LeafletPHP\Definition\UI\Marker;
use Netzmacht\LeafletPHP\Encoder\ControlEncoder;
use Netzmacht\LeafletPHP\Encoder\GroupEncoder;
use Netzmacht\LeafletPHP\Encoder\MapEncoder;
use Netzmacht\LeafletPHP\Encoder\RasterEncoder;
use Netzmacht\LeafletPHP\Encoder\TypeEncoder;
use Netzmacht\LeafletPHP\Encoder\UIEncoder;
use Netzmacht\LeafletPHP\Encoder\VectorEncoder;
use Netzmacht\LeafletPHP\Leaflet;
use Netzmacht\LeafletPHP\Value\LatLng;
use Symfony\Component\EventDispatcher\EventDispatcher;

require '../vendor/autoload.php';

/*
 * 1. Setup the encoder
 */

// The event dispatcher
$dispatcher = new EventDispatcher();

// All encoders are event subscribers.
$dispatcher->addSubscriber(new ControlEncoder());
$dispatcher->addSubscriber(new GroupEncoder());
$dispatcher->addSubscriber(new MapEncoder());
$dispatcher->addSubscriber(new RasterEncoder());
$dispatcher->addSubscriber(new TypeEncoder());
$dispatcher->addSubscriber(new UIEncoder());
$dispatcher->addSubscriber(new VectorEncoder());

// Create a custom factory for the javascript builder which uses the event dispatcher.
// The order of the registered encoders are important! Only change if you know what you do.
$factory = function(Output $output) use ($dispatcher) {
    $encoder = new ChainEncoder();

    $encoder
        ->register(new MultipleObjectsEncoder())
        ->register(new EventDispatchingEncoder($dispatcher))
        ->register(new JavascriptEncoder($output));

    return $encoder;
};

$builder = new Builder($factory);
$leaflet = new Leaflet($builder, $dispatcher);

/*
 * 2. Create the map definitions
 */
$map = new Map('leafletMap', 'map');
$position = new LatLng(51.047093, 13.747347);
$marker = (new Marker('marker', $position)) ->addTo($map);
$map
    ->setZoom(12)
    ->setCenter($position);

$copyRight = '© OpenStreetMap und Mitwirkende '.
    '<a href="http://www.openstreetmap.org/">http://www.openstreetmap.org/</a>'
    .'<br/>Lizenz: CC BY-SA'
    .'<a href="http://creativecommons.org/licenses/by-sa/2.0/">'
    .    ' http://creativecommons.org/licenses/by-sa/2.0/'
    .'</a>';
$tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
$tileLayer = (new TileLayer('osm', $tileUrl))
    ->setAttribution($copyRight);
$tileLayer->addTo($map);

/*
 * 3. Build the javascript
 */

// Will return javascript with following local vars: "map", "layers", "controls", "icons".
$jsCode = $leaflet->build($map);
?>

<html>
 <head>
     <title>php-leaflet example</title>
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
           integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
           crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
             integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
             crossorigin=""></script>
 </head>
 <body>
  <div id="leafletMap" style="height: 100%"></div>
  <script>
      <?= $jsCode; ?>
  </script>
 </body>
</html>
