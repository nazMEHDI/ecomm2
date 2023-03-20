<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Ordertable\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use MelisCore\Listener\MelisGeneralListener;
use Laminas\Session\Container;
use Laminas\Stdlib\ArrayUtils;

class SavePropertiesListener extends MelisGeneralListener implements ListenerAggregateInterface
{
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->attachEventListener(
            $events,
            'Ordertable',
            'ordertable_properties_save_start',
            function($e){

                $result = $this->dispatchPlugin(
                    $e,
                    'Ordertable\Controller\Properties',
                    ['action' => 'saveProperties']
                );



                $container = new Container('ordertable');
                $container['ordertable-save-action'] = $result;

            }
        );
    }

    private function dispatchPlugin($e, $ctrl, $vars)
    {
        $resultForward = $e->getTarget()->forward()->dispatch($ctrl, $vars);

        return $resultForward->getVariables();
    }
}