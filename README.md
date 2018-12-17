
PHP Leaflet library
===================

[![Build Status](http://img.shields.io/travis/netzmacht/php-leaflet/master.svg?style=flat-square)](https://travis-ci.org/netzmacht/php-leaflet)
[![Version](http://img.shields.io/packagist/v/netzmacht/php-leaflet.svg?style=flat-square)](http://packagist.org/packages/netzmacht/php-leaflet)
[![License](http://img.shields.io/packagist/l/netzmacht/php-leaflet.svg?style=flat-square)](http://packagist.org/packages/netzmacht/php-leaflet)
[![Downloads](http://img.shields.io/packagist/dt/netzmacht/php-leaflet.svg?style=flat-square)](http://packagist.org/packages/netzmacht/php-leaflet)
[![Contao Community Alliance coding standard](http://img.shields.io/badge/cca-coding_standard-red.svg?style=flat-square)](https://github.com/contao-community-alliance/coding-standard)

This library provides a PHP API to setup the Leaflet map definitions. The goal of the library is to provide a handy way
to handle dynamic map configurations working in a PHP context.

Install
-------

You can install the library using composer:

```
$ php composer.phar require netzmacht/php-leaflet
```

Features
--------

This library provides different components:

 - Definition classes to define the leaflet map with all layers, controls and so on.
 - Value classes which have real behaviour and can be used to handle LatLng or GeoJSON features.
 - The Encoder component to convert the PHP leaflet definition into javascript.
 - Support for several Leaflet plugins.
 - Assets handling to autoload all required javascripts and css files from all plugins.

Before you start
----------------

 - The definition classes has some mixed behaviours. There useful behaviour is implemented. Some method creates just 
   javascript method calls.
 - The goal is to have a close reflection of the Javascript API. Since the languages differs there are some changes 
   which you should be aware of.

Requirements
------------

This library requires PHP 5.6 and the symfony event dispatcher. The event dispatcher is used by the 
[php-javascript-builder](https://github.com/netzmacht/php-javascript-builder) which encodes the PHP definition.
 
Example
-------

```php

/*
 * 1. Setup the encoder
 */

// The event dispatcher
$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

// All encoders are event subscribers.
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\ControlEncoder());
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\GroupEncoder());
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\MapEncoder());
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\RasterEncoder());
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\TypeEncoder());
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\UIEncoder());
$dispatcher->addSubscriber(new Netzmacht\LeafletPHP\Encoder\VectorEncoder());

// Create a custom factory for the javascript builder which uses the event dispatcher.
// The order of the registered encoders are important! Only change if you know what you do.
$factory = function(Output $output) use ($dispatcher) {
    $encoder = new ChainEncoder();

    $encoder
        ->register(new \Netzmacht\JavascriptBuilder\Encoder\MultipleObjectsEncoder())
        ->register(new \Netzmacht\JavascriptBuilder\Symfony\EventDispatchingEncoder($dispatcher))
        ->register(new \Netzmacht\JavascriptBuilder\Encoder\JavascriptEncoder($output));

    return $encoder;
}; 

$builder = new \Netzmacht\JavascriptBuilder\Builder($factory);
$leaflet = new \Netzmacht\LeafletPHP\leaflet($builder, $dispatcher);

/*
 * 2. Create the map definitions
 */
$map = new \Netzmacht\LeafletPHP\Definition\Map('html_id', 'map');
$map
  ->setZoom(12)
  ->addControl(...)
  ->addLayer(...);
  
/*
 * 3. Build the javascript
 */

// Will return javascript with following local vars: "map", "layers", "controls", "icons".
echo $leaflet->build($map);

```
