<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Ecom\Controller;

use Laminas\View\Model\ViewModel;

class ProductController extends BaseController
{
    public function productAction()
    {
    	$view = new ViewModel();
    	
    	$view->setVariable('idPage', $this->idPage);
    	$view->setVariable('renderType', $this->renderType);
    	$view->setVariable('renderMode', $this->renderMode);
    	
    	return $view;
    }
}