<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 10:04
 */

namespace Event\Service;


use Event\Entity\EventEntity;
use Event\Hydrator\EventHydrator;
use Event\Table\EventTable;
use Zend\Db\Adapter\Exception\InvalidQueryException;

/**
 * Class EventService
 *
 * @package Event\Service
 */
class EventService
{
    /**
     * @var EventEntity
     */
    protected $entity;
    /**
     * @var EventHydrator
     */
    protected $hydrator;
    /**
     * @var EventTable
     */
    protected $table;

    /**
     * @param null $id
     *
     * @return bool
     */
    public function delete($id = null)
    {
        try {
            $this->getTable()->delete(array('id' => $id));
        } catch (InvalidQueryException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function fetchEventEntity($id)
    {
        return $this->getTable()->fetchSingleById($id);
    }

    /**
     * @return array
     */
    public function fetchEventList()
    {
        $eventList = array();

        foreach ($this->getTable()->fetchMany() as $entity) {
            $eventList[] = $entity;
        }

        return $eventList;
    }

    /**
     * @return \Event\Entity\EventEntity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param \Event\Entity\EventEntity $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return \Event\Hydrator\EventHydrator
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param \Event\Hydrator\EventHydrator $hydrator
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return \Event\Table\EventTable
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param \Event\Table\EventTable $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @param array $data
     * @param null  $id
     *
     * @return bool|EventEntity|mixed
     */
    public function save(array $data, $id = null)
    {
        $mode = $id ? 'update' : 'insert';

        $entity = $mode == 'insert' ? clone $this->getEntity()
            : $this->fetchEventEntity($id);

        $this->getHydrator()->hydrate($data, $entity);

        $saveData = $this->getHydrator()->extract($entity);

        try {
            if ($mode == 'insert') {
                $this->getTable()->insert($saveData);
                $id = $this->getTable()->getLastInsertValue();
            } else {
                $this->getTable()->update($saveData, array('id' => $id));
            }
        } catch (InvalidQueryException $e) {
            return false;
        }

        $entity = $this->fetchEventEntity($id);

        return $entity;
    }
} 