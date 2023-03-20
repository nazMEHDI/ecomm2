<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Productstable\Service;

use MelisCore\Service\MelisGeneralService;
use Laminas\Session\Container;
use Laminas\Stdlib\ArrayUtils;
use Laminas\View\Model\JsonModel;

class ProductstableService extends MelisGeneralService
{
    public function getItemById($id)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('Productstable_service_get_item_start', $arrayParameters);

        $ProductstableTable = $this->getServiceManager()->get('ProductstableTable');
        $item = $ProductstableTable->getEntryById($arrayParameters['id'])->current();

        $arrayParameters['results'] = $item;
        $arrayParameters = $this->sendEvent('Productstable_service_get_item_end', $arrayParameters);
        return $arrayParameters['results'];
    }

    public function getList($start = null, $limit = null, $searchKeys = [], $searchValue = null, $orderKey = null, $order = 'ASC', $langId = 1, $count = false)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('productstable_service_get_list_start', $arrayParameters);

        $productstableTable = $this->getServiceManager()->get('ProductstableTable');
        $list = $productstableTable->getList(
            $arrayParameters['start'],
            $arrayParameters['limit'],
            $arrayParameters['searchKeys'],
            $arrayParameters['searchValue'],
            $arrayParameters['orderKey'],
            $arrayParameters['order'],
            $arrayParameters['langId'],
            $arrayParameters['count']
        );

        $arrayParameters['results'] = $list;
        $arrayParameters = $this->sendEvent('productstable_service_get_list_end', $arrayParameters);
        return $arrayParameters['results'];
    }

    public function saveItem($data, $id = null)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('productstable_service_save_item_start', $arrayParameters);

        if ($data) {
            $productstableTable = $this->getServiceManager()->get('ProductstableTable');
            $res = $productstableTable->save($arrayParameters['data'], $arrayParameters['id']);
        }

        $arrayParameters['result'] = $res;
        $arrayParameters = $this->sendEvent('productstable_service_save_item_end', $arrayParameters);
        return $arrayParameters['result'];
    }

    public function deleteItem($id)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('productstable_service_delete_item_start', $arrayParameters);

        $productstableTable = $this->getServiceManager()->get('ProductstableTable');
        $res = $productstableTable->deleteById($arrayParameters['id']);

        $arrayParameters['result'] = $res;
        $arrayParameters = $this->sendEvent('productstable_service_delete_item_end', $arrayParameters);
        return $arrayParameters['result'];
    }


}