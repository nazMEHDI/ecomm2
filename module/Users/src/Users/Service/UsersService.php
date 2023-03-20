<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace Users\Service;

use MelisCore\Service\MelisGeneralService;
use Laminas\Session\Container;
use Laminas\Stdlib\ArrayUtils;
use Laminas\View\Model\JsonModel;

class UsersService extends MelisGeneralService
{
    public function getItemById($id)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('Users_service_get_item_start', $arrayParameters);

        $UsersTable = $this->getServiceManager()->get('UsersTable');
        $item = $UsersTable->getEntryById($arrayParameters['id'])->current();

        $arrayParameters['results'] = $item;
        $arrayParameters = $this->sendEvent('Users_service_get_item_end', $arrayParameters);
        return $arrayParameters['results'];
    }

    public function getList($start = null, $limit = null, $searchKeys = [], $searchValue = null, $orderKey = null, $order = 'ASC', $langId = 1, $count = false)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('users_service_get_list_start', $arrayParameters);

        $usersTable = $this->getServiceManager()->get('UsersTable');
        $list = $usersTable->getList(
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
        $arrayParameters = $this->sendEvent('users_service_get_list_end', $arrayParameters);
        return $arrayParameters['results'];
    }

    public function saveItem($data, $id = null)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('users_service_save_item_start', $arrayParameters);

        if ($data) {
            $usersTable = $this->getServiceManager()->get('UsersTable');
            $res = $usersTable->save($arrayParameters['data'], $arrayParameters['id']);
        }

        $arrayParameters['result'] = $res;
        $arrayParameters = $this->sendEvent('users_service_save_item_end', $arrayParameters);
        return $arrayParameters['result'];
    }

    public function deleteItem($id)
    {
        $arrayParameters = $this->makeArrayFromParameters(__METHOD__, func_get_args());
        $arrayParameters = $this->sendEvent('users_service_delete_item_start', $arrayParameters);

        $usersTable = $this->getServiceManager()->get('UsersTable');
        $res = $usersTable->deleteById($arrayParameters['id']);

        $arrayParameters['result'] = $res;
        $arrayParameters = $this->sendEvent('users_service_delete_item_end', $arrayParameters);
        return $arrayParameters['result'];
    }


}