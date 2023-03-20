<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCmsProspects\Model\Tables;

use MelisCore\Model\Tables\MelisGenericTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Sql\Predicate\Expression;
use Laminas\Db\Sql\Select;
use Laminas\Db\Metadata\Metadata;
use Laminas\Db\Sql\Where;
use Laminas\Db\Sql\Predicate\PredicateSet;
use Laminas\Db\Sql\Predicate\Like;
use Laminas\Db\Sql\Predicate\Operator;
use Laminas\Db\Sql\Predicate\Predicate;

class MelisCmsProspectsThemeItemTable extends MelisGenericTable
{
    /**
     * Table name
     */
    const TABLE = 'melis_cms_prospects_theme_items';
    /**
     * Primary key
     */
    const PRIMARY_KEY = 'pros_theme_item_id';

    public function __construct()
    {
        $this->idField = self::PRIMARY_KEY;
    }

    public function getItemByThemeId($themeId, $langId , $includeTheme = false)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(array('*'));

        $join = new Expression('item_trans_theme_item_id = pros_theme_item_id AND item_trans_lang_id = '.$langId);
        
        $select->join(
            'melis_cms_prospects_theme_items_trans', 
            $join,
            array('*'),
            $select::JOIN_LEFT
        );     
        
        if($includeTheme){
            $select->join('melis_cms_prospects_themes', 'melis_cms_prospects_themes.pros_theme_id = melis_cms_prospects_theme_items.pros_theme_id', array('*'), $select::JOIN_LEFT);
        }
        
        $select->where->equalTo('melis_cms_prospects_theme_items.pros_theme_id', $themeId);

        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
    public function getItemByIdAndLangId($itemId, $langId)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(array('*'));
        
        $select->join('melis_cms_prospects_themes', 'melis_cms_prospects_themes.pros_theme_id = melis_cms_prospects_theme_items.pros_theme_id', ['*'], $select::JOIN_LEFT);
        
        $select->where->equalTo('melis_cms_prospects_theme_items.pros_theme_item_id', $itemId);
        $select->where->equalTo('melis_cms_prospects_theme_items.pros_theme_item_lang_id', $langId);
        
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getItemById($itemId, $langId = null, $includeTheme = false)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(array('*'));

        $select->join(
            'melis_cms_prospects_theme_items_trans', 
            'melis_cms_prospects_theme_items_trans.item_trans_theme_item_id = melis_cms_prospects_theme_items.pros_theme_item_id',
            array('*'),
            $select::JOIN_LEFT
        );        
        
        if($includeTheme){
            $select->join('melis_cms_prospects_themes', 'melis_cms_prospects_themes.pros_theme_id = melis_cms_prospects_theme_items.pros_theme_id', array('*'), $select::JOIN_LEFT);
        }

        if(is_int($langId)) {
            $select->where->and->equalTo('melis_cms_prospects_theme_items_trans.item_trans_lang_id', $langId);
        }
        
        $select->where->equalTo('pros_theme_item_id', $itemId);

        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
    public function getItemData(array $options, $fixedCriteria, $themeId, $langId)
    {
        $select = $this->tableGateway->getSql()->select();
        $result = $this->tableGateway->select();
        
        $join = new Expression('item_trans_theme_item_id = pros_theme_item_id AND item_trans_lang_id = '.$langId);
        
        $select->join(
            'melis_cms_prospects_theme_items_trans', 
            $join,
            array('*'),
            $select::JOIN_LEFT
        );
        
        $where = !empty($options['where']['key']) ? $options['where']['key'] : '';
        $whereValue = !empty($options['where']['value']) ? $options['where']['value'] : '';
        
        $order = !empty($options['order']['key']) ? $options['order']['key'] : '';
        $orderDir = !empty($options['order']['dir']) ? $options['order']['dir'] : 'ASC';
        
        $start = (int) $options['start'];
        $limit = (int) $options['limit'] === -1 ? $this->getTotalData() : (int) $options['limit'];
        
        $columns = array(
            'pros_theme_item_id',
            'melis_cms_prospects_theme_items_trans.item_trans_text'  
        );
        
        // check if there's an extra variable that should be included in the query
        $dateFilter = $options['date_filter'];
        $dateFilterSql = '';
         
        if(count($dateFilter)) {
            if(!empty($dateFilter['startDate']) && !empty($dateFilter['endDate'])) {
                $dateFilterSql = '`' . $dateFilter['key'] . '` BETWEEN \'' . $dateFilter['startDate'] . '\' AND \'' . $dateFilter['endDate'] . '\'';
            }
        }
        
        // this is used when searching
        if(!empty($where)) {
            $w = new Where();
            $p = new PredicateSet();
            $filters = array();
            $likes = array();
            foreach($columns as $colKeys)
            {
                $likes[] = new Like($colKeys, '%'.$whereValue.'%');
            }
             
            if(!empty($dateFilterSql))
            {
                $filters = array(new PredicateSet($likes,PredicateSet::COMBINED_BY_OR), new \Laminas\Db\Sql\Predicate\Expression($dateFilterSql));
            }
            else
            {
                $filters = array(new PredicateSet($likes,PredicateSet::COMBINED_BY_OR));
            }
            $fixedWhere = array(new PredicateSet(array(new Operator('', '=', ''))));
            if(is_null($fixedCriteria))
            {
                $select->where($filters);
            }
            else
            {
                $select->where(array(
                    $fixedWhere,
                    $filters,
                ), PredicateSet::OP_AND);
            }
             
        }
        $select->where->and->nest->equalTo('pros_theme_id', (int) $themeId)->unnest;
        
        $select->order($order . ' ' . $orderDir);
         
        $getCount = $this->tableGateway->selectWith($select);
        $this->setCurrentDataCount((int) $getCount->count());
         
         
        // this is used in paginations
        $select->limit($limit);
        $select->offset($start);
        
        $resultSet = $this->tableGateway->selectWith($select);
        
        $sql = $this->tableGateway->getSql();
        $raw = $sql->getSqlstringForSqlObject($select);
        return $resultSet;
    }

}