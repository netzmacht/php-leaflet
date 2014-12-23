<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\LeafletPHP\Compiler;

use Netzmacht\LeafletPHP\Compiler\Event\CompileEvent;
use Netzmacht\LeafletPHP\Definition\Control;
use Netzmacht\LeafletPHP\Definition\Control\Attribution;
use Netzmacht\LeafletPHP\Definition\Control\Layers;
use Netzmacht\LeafletPHP\Definition\Control\Scale;
use Netzmacht\LeafletPHP\Definition\Control\Zoom;
use Netzmacht\LeafletPHP\Definition\Layer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ControlCompiler implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'leaflet-php.compiler.compile' => array('handleCompile')
        );
    }

    public function handleCompile(CompileEvent $event)
    {
        $definition = $event->getDefinition();
        $type       = $definition->getType();
        $method     = $this->convertTypeToMethod($type);
        $output     = $event->getOutput();

        if (method_exists($this, $method)) {
            $output->addLibraries($definition->getRequiredLibraries());

            $this->$method($definition, $event->getOutput());
        }
    }

    /**
     * Compile scale object.
     *
     * @param Scale  $scale  The scale control.
     * @param Output $output The output.
     *
     * @return void
     */
    public function compileControlScale(Scale $scale, Output $output)
    {
        $this->doControlCompile('scale', $scale, $output);
    }

    /**
     * Compile the zoom object.
     *
     * @param Zoom   $zoom   The zoom control.
     * @param Output $output The output.
     *
     * @reutrn void
     */
    public function compileControlZoom(Zoom $zoom, Output $output)
    {
        $this->doControlCompile('zoom', $zoom, $output);
    }

    /**
     * Compile attributions.
     *
     * @param Attribution $attribution The attributions.
     * @param Output      $output      The compiler output.
     */
    public function compileControlAttribution(Attribution $attribution, Output $output)
    {
        $this->doControlCompile('attribution', $attribution, $output);

        foreach ($attribution->getAttributions() as $value) {
            $output->add(sprintf('controls.%s.AddAttribution(\'%s\')', $attribution->getName(), $value));
        }
    }

    /**
     * Compile layer control.
     *
     * @param Layers $layers The layers control.
     * @param Output $output The compiler output.
     *
     * @return array
     */
    public function compileControlLayers(Layers $layers, Output $output)
    {
        $baseLayers = $this->getLayersDefinitionAsJson($layers->getBaseLayers());
        $overlays   = $this->getLayersDefinitionAsJson($layers->getOverlays());

        $output
            ->add(
                sprintf(
                    'controls.%s = L.control.layers(%s, %s, %s);',
                    $layers->getName(),
                    $baseLayers,
                    $overlays,
                    json_encode($layers->getOptions())
                )
            )
            ->add(sprintf('map.addControl(controls.%s)', $layers->getName()));
    }

    /**
     * @param $type
     *
     * @return string
     */
    private function convertTypeToMethod($type)
    {
        $parts = explode('.', $type);
        $parts = array_map('ucfirst', $parts);

        return 'compile' . implode(',', $parts);
    }

    /**
     * Compile a control.
     *
     * @param string  $type    The control type.
     * @param Control $control The control definition.
     * @param Output  $output  The output object.
     */
    private function doControlCompile($type, Control $control, Output $output)
    {
        $output
            ->add(
                sprintf(
                    'controls.%s = L.control.%s(%s);',
                    $control->getName(),
                    $type,
                    json_encode($control->getOptions())
                )
            )
            ->add(sprintf('map.addControl(controls.%s)', $control->getName()));
    }

    /**
     * Convert layers to their label => variable json definition.
     *
     * @param Layer[] $layers
     *
     * @return string
     */
    private function getLayersDefinitionAsJson($layers)
    {
        $definition = '';

        foreach ($layers as $layer) {
            if ($definition) {
                $definition .= ", ";
            }

            $definition .= sprintf('\'%s\': layers.%s', $layer->getLabel(), $layer->getName());
        }

        return '{' . $definition . '}';
    }
}
