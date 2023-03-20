<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2017 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Categoriestable\Controller;


use Laminas\Session\Container;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use MelisCore\Controller\MelisAbstractActionController;

class ListController extends MelisAbstractActionController
{
    public function renderToolAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function renderToolHeaderAction()
    {
        $view = new ViewModel();
        return $view;
    }

    public function renderToolContentAction()
    {
        $view = new ViewModel();

        $melisTool = $this->getServiceManager()->get('MelisCoreTool');
        $melisTool->setMelisToolKey('categoriestable', 'categoriestable_tools');

        $columns = $melisTool->getColumns();
        $translator = $this->getServiceManager()->get('translator');
        $columns['actions'] = ['text' => $translator->translate('tr_categoriestable_common_table_column_action')];

        $view->tableColumns = $columns;
        $view->toolTable = $melisTool->getDataTableConfiguration('#categoriestableTableContent', true, false, ['order' => [[ 0, 'desc' ]]]);

        return $view;
    }

    public function getListAction()
    {
        $melisTool = $this->getServiceManager()->get('MelisCoreTool');
        $melisTool->setMelisToolKey('categoriestable', 'categoriestable_tools');

        $categoriestableService = $this->getServiceManager()->get('CategoriestableService');

        $draw = 0;
        $dataCount = 0;
        $tableData = [];

        if($this->getRequest()->isPost()){

            // Get the locale used from meliscore session
            $container = new Container('meliscore');
            $langId = $container['melis-lang-id'];

            $draw = $this->getRequest()->getPost('draw');

            $start = $this->getRequest()->getPost('start');
            $length =  $this->getRequest()->getPost('length');

            $search = $this->getRequest()->getPost('search');
            $search = $search['value'];

            $selCol = $this->getRequest()->getPost('order');
            $colId = array_keys($melisTool->getColumns());
            $selCol = $colId[$selCol[0]['column']];

            $sortOrder = $this->getRequest()->getPost('order');
            $sortOrder = $sortOrder[0]['dir'];

            $tableData = $categoriestableService->getList($start, $length, $melisTool->getSearchableColumns(), $search, $selCol, $sortOrder, $langId)->toArray();
            $dataCount = $categoriestableService->getList(null, null, $melisTool->getSearchableColumns(), $search, null, 'ASC', $langId, true)->current();

            







        }

        return new JsonModel([
            'draw' => (int) $draw,
            'recordsTotal' => count($tableData),
            'recordsFiltered' =>  $dataCount->totalRecords,
            'data' => $tableData,
        ]);
    }

    public function renderTableFilterLimitAction()
    {
        return new ViewModel();
    }

    public function renderTableFilterSearchAction()
    {
        return new ViewModel();
    }

    public function renderTableFilterRefreshAction()
    {
        return new ViewModel();
    }

    public function renderTableActionEditAction()
    {
        return new ViewModel();
    }

    public function renderTableActionDeleteAction()
    {
        return new ViewModel();
    }

    public function renderModalFormAction()
    {
        $view = new ViewModel();

        $id = $this->params()->fromQuery('id', 'add');
        $view->id = $id;

        return $view;
    }

    public function deleteItemAction()
    {
        $this->getEventManager()->trigger('categoriestable_delete_end', $this, $this->getRequest());

        return new JsonModel([
            'success' => true,
            'textTitle' => 'tr_categoriestable_delete_item',
            'textMessage' => 'tr_categoriestable_delete_success',
        ]);
    }
}