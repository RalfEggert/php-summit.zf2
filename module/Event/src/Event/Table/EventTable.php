<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 09:59
 */

namespace Event\Table;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class EventTable
 *
 * @package Event\Table
 */
class EventTable extends TableGateway
{

    /**
     * @param AdapterInterface   $adapter
     * @param ResultSetInterface $resultSet
     */
    function __construct(
        AdapterInterface $adapter, ResultSetInterface $resultSet
    ) {
        parent::__construct('events', $adapter, null, $resultSet);
    }

    /**
     * @return null|ResultSetInterface
     */
    function fetchMany()
    {
        $select = $this->getSql()->select();
        $select->order('date DESC');

        return $this->selectWith($select);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function fetchSingleById($id)
    {
        $select = $this->getSql()->select();
        $select->where->equalTo('id', $id);

        return $this->selectWith($select)->current();
    }
}