<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Ecom\Controller;

use MelisFront\Controller\MelisSiteActionController;
use MelisFront\Service\MelisSiteConfigService;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\ViewModel;

class BaseController extends MelisSiteActionController
{
    public $view = null;
    
    function __construct()
    {
        $this->view = new ViewModel();
    }
    
    public function onDispatch(MvcEvent $event)
    {
        // Getting the Site config "Ecom.config.php"
        $sm = $event->getApplication()->getServiceManager();
        $pageId = $this->params()->fromRoute('idpage');
        $menuPlugin = $this->MelisFrontMenuPlugin();
        $footerPlugin = $this->MelisFrontMenuPlugin();
        
        
        // Set parameters for the menu
        $menuParameters = [
            'template_path' =>'Dekra/plugins/header',
            'pageIdRootMenu' => 1
        ];
        // Render plugin
        $menu = $menuPlugin->render($menuParameters);
        // Add rendered menu to the layout
        $this->layout()->addChild($menu, 'header');


        // Set parameters for the footer
        $footerParameters = [
            'template_path' =>'Dekra/plugins/footer',
            'pageIdRootMenu' => 1
        ];
        // Render plugin
        $footer = $footerPlugin->render($footerParameters);
        // Add rendered menu to the layout
        $this->layout()->addChild($footer, 'footer');


        return parent::onDispatch($event);
    }
}