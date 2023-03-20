<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Productstable\Listener;

use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use MelisCore\Listener\MelisGeneralListener;

class DeleteListener extends MelisGeneralListener implements ListenerAggregateInterface
{
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->attachEventListener(
            $events,
            'Productstable',
            'productstable_delete_end',
            function($e){

                $this->dispatchPlugin(
                    $e,
                    'Productstable\Controller\Properties',
                    ['action' => 'delete']
                );


            }
        );
    }

    private function dispatchPlugin($e, $ctrl, $vars)
    {
        $resultForward = $e->getTarget()->forward()->dispatch($ctrl, $vars);

        return $resultForward->getVariables();
    }
}