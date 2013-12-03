<?php
/**
 * Created by PhpStorm.
 * User: ralf
 * Date: 03.12.13
 * Time: 10:18
 */

namespace Event\Service;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EventServiceFactory implements FactoryInterface
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

        $table = $serviceLocator->get('Event\Table\Event');
        $entity  = $serviceLocator->get('Event\Entity\Event');
        $hydrator = $hydratorManager->get('Event\Hydrator');

        $service = new EventService();
        $service->setTable($table);
        $service->setEntity($entity);
        $service->setHydrator($hydrator);

        return $service;
    }

} 