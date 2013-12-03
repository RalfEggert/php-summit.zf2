<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 10:18
 */

namespace Event\Table;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EventTableFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydratorManager = $serviceLocator->get('HydratorManager');

        $adapter = $serviceLocator->get('Zend\Db\Adapter\Sqlite');
        $entity  = $serviceLocator->get('Event\Entity\Event');
        $hydrator = $hydratorManager->get('Event\Hydrator');

        $resultSet = new HydratingResultSet($hydrator, $entity);

        $table = new EventTable($adapter, $resultSet);

        return $table;
    }

} 